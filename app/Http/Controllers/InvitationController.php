<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\RsvpResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class InvitationController extends Controller
{
    /**
     * GET /api/invitations
     * Lista todas las invitaciones con su respuesta (si ya contestaron).
     */
    public function index(): JsonResponse
    {
        $invitations = Invitation::with('rsvpResponse')
            ->latest()
            ->get()
            ->map(fn (Invitation $inv) => [
                'id'      => $inv->id,
                'name'    => $inv->name,
                'type'    => $inv->type,
                'link_id' => $inv->link_id,
                'status'  => $inv->status,
                'response' => $inv->rsvpResponse ? [
                    'confirmed_name' => $inv->rsvpResponse->confirmed_name,
                    'attendance'     => $inv->rsvpResponse->attendance,
                    'guests_count'   => $inv->rsvpResponse->guests_count,
                    'companions'     => $inv->rsvpResponse->companions,
                    'responded_at'   => $inv->rsvpResponse->responded_at,
                ] : null,
            ]);

        return response()->json($invitations);
    }

    /**
     * POST /api/invitations
     * Crea una nueva invitación personalizada.
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'type' => ['required', Rule::in(['individual', 'familia'])],
        ]);

        $invitation = Invitation::create($data);

        return response()->json([
            'id'      => $invitation->id,
            'name'    => $invitation->name,
            'type'    => $invitation->type,
            'link_id' => $invitation->link_id,
            'status'  => $invitation->status,
        ], 201);
    }

    /**
     * GET /api/invitations/{link_id}
     * Devuelve la info de la invitación a partir del link_id (para pre-llenar el RSVP).
     */
    public function show(string $linkId): JsonResponse
    {
        $invitation = Invitation::where('link_id', $linkId)->firstOrFail();

        return response()->json([
            'id'      => $invitation->id,
            'name'    => $invitation->name,
            'type'    => $invitation->type,
            'link_id' => $invitation->link_id,
            'status'  => $invitation->status,
        ]);
    }

    /**
     * POST /api/rsvp
     * Registra la respuesta del invitado y actualiza el status de la invitación.
     */
    public function rsvp(Request $request): JsonResponse
    {
        $data = $request->validate([
            'link_id'        => ['required', 'string', 'exists:invitations,link_id'],
            'name'           => ['required', 'string', 'max:120'],
            'attendance'     => ['required', Rule::in(['yes', 'no'])],
            'guests_count'   => ['required', 'integer', 'min:1', 'max:20'],
            'companions'     => ['nullable', 'string', 'max:500'],
        ]);

        $invitation = Invitation::where('link_id', $data['link_id'])->firstOrFail();

        // Invitaciones individuales solo permiten 1 persona
        if ($invitation->type === 'individual' && $data['guests_count'] > 1) {
            return response()->json([
                'message' => 'Esta es una invitación individual. Solo puede asistir 1 persona.',
            ], 422);
        }

        // Actualizar o crear la respuesta (permite re-confirmar)
        $invitation->rsvpResponse()->updateOrCreate(
            ['invitation_id' => $invitation->id],
            [
                'confirmed_name' => $data['name'],
                'attendance'     => $data['attendance'],
                'guests_count'   => $data['guests_count'],
                'companions'     => $data['companions'] ?? null,
                'responded_at'   => now(),
            ]
        );

        $invitation->update([
            'status' => $data['attendance'] === 'yes' ? 'confirmed' : 'declined',
        ]);

        return response()->json(['message' => 'RSVP registrado correctamente.']);
    }
}

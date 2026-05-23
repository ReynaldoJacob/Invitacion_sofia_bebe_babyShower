<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rsvp_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invitation_id')->constrained()->cascadeOnDelete();
            $table->string('confirmed_name');                // Nombre que escribió el invitado al confirmar
            $table->enum('attendance', ['yes', 'no']);       // ¿Asistirá?
            $table->unsignedTinyInteger('guests_count')->default(1); // Cuántas personas asistirán
            $table->text('companions')->nullable();          // Nombres de acompañantes (opcional)
            $table->timestamp('responded_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rsvp_responses');
    }
};

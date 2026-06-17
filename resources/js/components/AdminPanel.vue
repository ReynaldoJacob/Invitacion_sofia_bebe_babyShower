<template>
    <div class="admin-root">

        <!-- TopAppBar -->
        <header class="sticky top-0 z-40 flex justify-between items-center px-4 py-4 w-full"
                style="background:#f8f9ff; border-bottom:1px solid rgba(251,211,77,0.2); backdrop-filter:blur(8px);">
            <h1 style="font-family:'Plus Jakarta Sans',sans-serif; font-size:1.25rem; font-weight:700; color:#735c00;">
                Naiara Sofía Admin
            </h1>
            <button
                class="rounded-full p-2 transition-colors hover:bg-amber-50"
                style="color:#735c00;"
                @click="() => { createdMessage = ''; showCreateModal = true; }"
            >
                <span class="material-symbols-outlined" style="font-size:1.5rem; font-variation-settings:'FILL' 1;">add_circle</span>
            </button>
        </header>

        <main class="px-4 pt-6 pb-28 max-w-2xl mx-auto">

            <!-- Botón Crear Invitación -->
            <section class="mb-8 flex justify-center">
                <button
                    class="flex items-center gap-2 py-3 px-8 rounded-full transition-transform hover:scale-105"
                    style="background:#fbd34d; color:#715b00; font-family:'Be Vietnam Pro',sans-serif; font-size:14px; font-weight:600; box-shadow:0 4px 12px rgba(245,158,11,0.2);"
                    @click="() => { createdMessage = ''; showCreateModal = true; }"
                >
                    <span class="material-symbols-outlined" style="font-size:1.2rem;">edit_document</span>
                    Crear Invitación
                </button>
            </section>

            <!-- Stats Bento -->
            <section class="grid grid-cols-2 gap-4 mb-8">
                <!-- Total -->
                <div class="col-span-2 card-surface p-5 flex flex-col items-center justify-center gingham-accent">
                    <span style="font-family:'Be Vietnam Pro',sans-serif; font-size:13px; font-weight:600; color:#4d4635;">Total de invitaciones</span>
                    <span style="font-family:'Plus Jakarta Sans',sans-serif; font-size:2.5rem; font-weight:700; color:#735c00;">{{ stats.total }}</span>
                </div>
                <!-- Confirmed -->
                <div class="col-span-2 card-surface p-5">
                    <span style="font-family:'Be Vietnam Pro',sans-serif; font-size:12px; font-weight:600; color:#4d4635;">Confirmados</span>
                    <div class="flex items-end justify-between mt-1 gap-4">
                        <!-- Invitaciones confirmadas -->
                        <div class="flex flex-col">
                            <span style="font-family:'Plus Jakarta Sans',sans-serif; font-size:1.75rem; font-weight:700; color:#855300; line-height:1;">{{ stats.confirmed }}</span>
                            <span style="font-family:'Be Vietnam Pro',sans-serif; font-size:11px; color:#7f7662; margin-top:2px;">invitaciones</span>
                        </div>
                        <div style="width:1px; height:2.5rem; background:rgba(115,92,0,0.15); flex-shrink:0;"></div>
                        <!-- Total de personas -->
                        <div class="flex flex-col items-end">
                            <span style="font-family:'Plus Jakarta Sans',sans-serif; font-size:1.75rem; font-weight:700; color:#735c00; line-height:1;">{{ stats.totalPeople }}</span>
                            <span class="flex items-center gap-1" style="font-family:'Be Vietnam Pro',sans-serif; font-size:11px; color:#7f7662; margin-top:2px;">
                                <span class="material-symbols-outlined" style="font-size:13px; font-variation-settings:'FILL' 1;">group</span>
                                personas en total
                            </span>
                        </div>
                    </div>
                    <div class="w-full rounded-full overflow-hidden mt-3" style="height:4px; background:rgba(226,224,205,0.6);">
                        <div class="h-full rounded-full" style="background:#fbd34d; transition:width 0.5s ease;"
                             :style="{ width: stats.total ? Math.round(stats.confirmed / stats.total * 100) + '%' : '0%' }"></div>
                    </div>
                </div>
                <!-- Pending -->
                <div class="col-span-2 card-surface p-5 flex flex-col items-center justify-center">
                    <span style="font-family:'Be Vietnam Pro',sans-serif; font-size:12px; font-weight:600; color:#4d4635;">Pendientes</span>
                    <span style="font-family:'Plus Jakarta Sans',sans-serif; font-size:1.75rem; font-weight:600; color:#4d4635;">{{ stats.pending }}</span>
                    <div class="w-full rounded-full overflow-hidden mt-2" style="height:4px; background:rgba(226,224,205,0.6);">
                        <div class="h-full rounded-full" style="background:#c9c7b5; transition:width 0.5s ease;"
                             :style="{ width: stats.total ? Math.round(stats.pending / stats.total * 100) + '%' : '0%' }"></div>
                    </div>
                </div>
            </section>

            <!-- Búsqueda -->
            <section class="mb-6">
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2"
                          style="font-size:1.15rem; color:#7f7662;">search</span>
                    <input
                        v-model="search"
                        type="text"
                        placeholder="Buscar invitados..."
                        class="w-full pl-10 pr-4 py-3 rounded-xl transition-shadow"
                        style="background:#fff; border:1.5px solid rgba(115,92,0,0.15); font-family:'Be Vietnam Pro',sans-serif; font-size:15px; color:#0d1c2f; outline:none;"
                        @focus="e => e.target.style.borderColor='#fbd34d'"
                        @blur="e => e.target.style.borderColor='rgba(115,92,0,0.15)'"
                    />
                </div>
            </section>

            <!-- Lista de invitados -->
            <section>
                <h2 style="font-family:'Plus Jakarta Sans',sans-serif; font-size:1.25rem; font-weight:600; color:#735c00; margin-bottom:12px;">
                    Invitaciones
                </h2>

                <div v-if="loading" class="text-center py-12" style="color:#7f7662; font-family:'Itim',cursive;">
                    Cargando... 🐝
                </div>

                <div v-else-if="filteredGuests.length === 0" class="text-center py-12" style="color:#7f7662; font-family:'Itim',cursive;">
                    No se encontraron invitados.
                </div>

                <div v-else class="space-y-3 overflow-y-auto pr-1" style="max-height:60vh; scrollbar-width:thin; scrollbar-color:rgba(115,92,0,0.2) transparent;">
                    <div
                        v-for="guest in filteredGuests"
                        :key="guest.id"
                        class="card-surface p-4"
                        :style="borderStyle(guest.status)"
                    >
                        <div class="flex justify-between items-start gap-2">
                            <div class="flex items-start gap-3 min-w-0">
                                <!-- Avatar inicial -->
                                <div class="w-9 h-9 rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0"
                                     style="background:rgba(251,211,77,0.2); color:#735c00;">
                                    {{ initials(guest.name) }}
                                </div>
                                <div class="min-w-0">
                                    <!-- Para quién va dirigida la invitación -->
                                    <div class="flex items-center gap-1 flex-wrap">
                                        <span class="material-symbols-outlined" style="font-size:13px; color:#7f7662; flex-shrink:0;">mail</span>
                                        <span style="font-family:'Be Vietnam Pro',sans-serif; font-size:11px; color:#7f7662;">Para:</span>
                                        <p class="truncate" style="font-family:'Be Vietnam Pro',sans-serif; font-size:14px; font-weight:600; color:#0d1c2f; max-width:160px;">
                                            {{ guest.name }}
                                        </p>
                                    </div>
                                    <!-- Tipo + personas -->
                                    <div class="flex items-center gap-2 flex-wrap mt-0.5 ml-5">
                                        <p style="font-family:'Be Vietnam Pro',sans-serif; font-size:12px; color:#4d4635;">
                                            {{ guest.type === 'familia' ? 'Familia' : 'Individual' }}
                                        </p>
                                        <span v-if="guest.response && guest.response.attendance === 'yes' && guest.type === 'familia'"
                                              class="flex items-center gap-1 px-2 py-0.5 rounded-full"
                                              style="background:rgba(251,211,77,0.3); font-family:'Be Vietnam Pro',sans-serif; font-size:11px; font-weight:600; color:#735c00;">
                                            <span class="material-symbols-outlined" style="font-size:12px; font-variation-settings:'FILL' 1;">group</span>
                                            {{ guest.response.guests_count }} persona{{ guest.response.guests_count !== 1 ? 's' : '' }}
                                        </span>
                                        <span v-else-if="guest.response && guest.response.attendance === 'no'"
                                              class="flex items-center gap-1 px-2 py-0.5 rounded-full"
                                              style="background:rgba(255,218,214,0.5); font-family:'Be Vietnam Pro',sans-serif; font-size:11px; font-weight:600; color:#93000a;">
                                            <span class="material-symbols-outlined" style="font-size:12px;">person_off</span>
                                            No asiste
                                        </span>
                                    </div>
                                    <!-- Quién llenó el formulario -->
                                    <div v-if="guest.response && guest.response.confirmed_name"
                                         class="flex items-center gap-1 mt-1">
                                        <span class="material-symbols-outlined" style="font-size:13px; color:#7f7662;">how_to_reg</span>
                                        <span style="font-family:'Be Vietnam Pro',sans-serif; font-size:11px; color:#7f7662;">Confirmó:</span>
                                        <strong class="truncate" style="font-family:'Be Vietnam Pro',sans-serif; font-size:12px; color:#4d4635; max-width:120px;">{{ guest.response.confirmed_name }}</strong>
                                    </div>
                                </div>
                            </div>

                            <!-- Acciones: badge + botón apilados -->
                            <div class="flex flex-col items-end gap-1.5 flex-shrink-0">
                                <span class="px-2 py-1 rounded-full text-xs flex items-center gap-1"
                                      :style="badgeStyle(guest.status)">
                                    <span class="material-symbols-outlined" style="font-size:12px;">{{ statusIcon(guest.status) }}</span>
                                    <span class="hidden sm:inline">{{ statusLabel(guest.status) }}</span>
                                </span>
                                <button
                                    class="rounded-full p-1 transition-colors hover:bg-amber-50"
                                    style="color:#735c00;"
                                    :title="'Copiar link de ' + guest.name"
                                    @click="copyLink(guest)"
                                >
                                    <span class="material-symbols-outlined" style="font-size:1.1rem;">link</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </main>

        <!-- Modal Crear Invitación -->
        <Transition name="modal-fade">
            <div v-if="showCreateModal"
                 class="fixed inset-0 z-50 flex items-end md:items-center justify-center"
                 style="background:rgba(13,28,47,0.4); backdrop-filter:blur(4px);">
                <div class="w-full max-w-md rounded-t-3xl md:rounded-3xl overflow-hidden flex flex-col"
                     style="background:#f8f9ff; box-shadow:0 -8px 32px rgba(115,92,0,0.12); max-height:90dvh;">
                    <!-- Franja decorativa -->
                    <div class="w-full h-1.5"
                         style="background:#e9c33e; background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,255,255,0.3) 10px, rgba(255,255,255,0.3) 20px);"></div>

                    <div class="p-6 overflow-y-auto flex-1" style="overscroll-behavior:contain;">
                        <div class="flex justify-between items-center mb-5">
                            <h3 style="font-family:'Plus Jakarta Sans',sans-serif; font-size:1.15rem; font-weight:700; color:#735c00;">
                                🐝 Nueva Invitación
                            </h3>
                            <button class="rounded-full p-1 hover:bg-amber-50 transition-colors"
                                    style="color:#735c00;"
                                    @click="showCreateModal = false">
                                <span class="material-symbols-outlined" style="font-size:1.25rem;">close</span>
                            </button>
                        </div>

                        <div class="space-y-4">
                            <!-- Nombre -->
                            <div>
                                <label class="block mb-1"
                                       style="font-family:'Be Vietnam Pro',sans-serif; font-size:13px; font-weight:600; color:#4d4635;">
                                    Nombre del invitado
                                </label>
                                <input
                                    v-model="newGuest.name"
                                    type="text"
                                    placeholder="Ej: Familia González"
                                    required
                                    class="w-full px-4 py-3 rounded-xl"
                                    style="background:#fff; border:1.5px solid rgba(115,92,0,0.2); font-family:'Be Vietnam Pro',sans-serif; font-size:14px; outline:none;"
                                    @focus="e => e.target.style.borderColor='#fbd34d'"
                                    @blur="e => e.target.style.borderColor='rgba(115,92,0,0.2)'"
                                />
                            </div>
                            <!-- Tipo de invitación -->
                            <div>
                                <label class="block mb-2"
                                       style="font-family:'Be Vietnam Pro',sans-serif; font-size:13px; font-weight:600; color:#4d4635;">
                                    Tipo de Invitación
                                </label>
                                <div class="flex gap-3">
                                    <button
                                        type="button"
                                        class="flex-1 flex items-center justify-center gap-2 py-3 rounded-xl transition-all duration-200"
                                        :style="newGuest.type === 'individual'
                                            ? 'background:#fbd34d; border:2px solid #e9c33e; color:#715b00;'
                                            : 'background:#fff; border:1.5px solid rgba(115,92,0,0.2); color:#4d4635;'"
                                        @click="newGuest.type = 'individual'"
                                    >
                                        <span class="material-symbols-outlined" style="font-size:1.1rem;">person</span>
                                        <span style="font-family:'Be Vietnam Pro',sans-serif; font-size:13px; font-weight:600;">Individual</span>
                                    </button>
                                    <button
                                        type="button"
                                        class="flex-1 flex items-center justify-center gap-2 py-3 rounded-xl transition-all duration-200"
                                        :style="newGuest.type === 'familia'
                                            ? 'background:#fbd34d; border:2px solid #e9c33e; color:#715b00;'
                                            : 'background:#fff; border:1.5px solid rgba(115,92,0,0.2); color:#4d4635;'"
                                        @click="newGuest.type = 'familia'"
                                    >
                                        <span class="material-symbols-outlined" style="font-size:1.1rem;">group</span>
                                        <span style="font-family:'Be Vietnam Pro',sans-serif; font-size:13px; font-weight:600;">Familia</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Banner de éxito -->
                            <Transition name="fade-up">
                                <div v-if="createdMessage"
                                     class="flex items-center gap-3 rounded-2xl px-4 py-3"
                                     style="background:rgba(34,197,94,0.1); border:1px solid rgba(34,197,94,0.3);">
                                    <span class="material-symbols-outlined flex-shrink-0"
                                          style="font-size:1.25rem; color:#16a34a; font-variation-settings:'FILL' 1;">check_circle</span>
                                    <div>
                                        <p style="font-family:'Be Vietnam Pro',sans-serif; font-size:13px; font-weight:700; color:#15803d;">
                                            ¡Invitación creada con éxito! 🐝
                                        </p>
                                        <p style="font-family:'Be Vietnam Pro',sans-serif; font-size:11px; color:#166534; margin-top:1px;">
                                            El mensaje ya fue copiado al portapapeles.
                                        </p>
                                    </div>
                                </div>
                            </Transition>

                            <!-- Preview del mensaje generado -->
                            <Transition name="fade-up">
                                <div v-if="createdMessage" class="rounded-2xl overflow-hidden"
                                     style="border:1px solid rgba(251,211,77,0.5);">
                                    <!-- Cabecera -->
                                    <div class="flex items-center justify-between px-4 py-2"
                                         style="background:rgba(251,211,77,0.2);">
                                        <div class="flex items-center gap-1.5">
                                            <span class="material-symbols-outlined" style="font-size:0.95rem; color:#735c00;">chat_bubble</span>
                                            <span style="font-family:'Be Vietnam Pro',sans-serif; font-size:11px; font-weight:600; color:#735c00;">Mensaje listo para enviar</span>
                                        </div>
                                        <button type="button"
                                                class="flex items-center gap-1 rounded-full px-3 py-1 transition-colors hover:bg-amber-200"
                                                style="background:rgba(251,211,77,0.4); color:#715b00; font-family:'Be Vietnam Pro',sans-serif; font-size:11px; font-weight:600;"
                                                @click="copyText(createdMessage)">
                                            <span class="material-symbols-outlined" style="font-size:0.9rem;">content_copy</span>
                                            Copiar
                                        </button>
                                    </div>
                                    <!-- Burbuja estilo WhatsApp -->
                                    <div class="px-4 py-3" style="background:#fff;">
                                        <p class="whitespace-pre-wrap"
                                           style="font-family:'Be Vietnam Pro',sans-serif; font-size:12px; line-height:1.6; color:#1a1a1a;">
                                            {{ createdMessage }}
                                        </p>
                                    </div>
                                </div>
                            </Transition>

                            <button
                                type="button"
                                :disabled="creating"
                                class="w-full py-3.5 rounded-full transition-all duration-200 hover:-translate-y-0.5"
                                style="background:#fbd34d; color:#715b00; font-family:'Be Vietnam Pro',sans-serif; font-size:14px; font-weight:600; box-shadow:0 4px 12px rgba(245,158,11,0.25); border:none; cursor:pointer;"
                                @click="createInvitation"
                            >
                                <span v-if="!creating">Crear y Copiar Mensaje 🐝</span>
                                <span v-else>Creando...</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </Transition>

        <!-- Toast copiado -->
        <Transition name="toast-fade">
            <div v-if="toastVisible"
                 class="fixed bottom-24 left-1/2 -translate-x-1/2 z-50 px-5 py-2.5 rounded-full"
                 style="background:#735c00; color:#fff; font-family:'Be Vietnam Pro',sans-serif; font-size:13px; font-weight:600; box-shadow:0 4px 16px rgba(115,92,0,0.3); white-space:nowrap;">
                ✓ Mensaje copiado
            </div>
        </Transition>

        <!-- Bottom Nav (mobile) -->
        <nav class="fixed bottom-0 left-0 w-full md:hidden z-40 flex justify-around items-center px-4 pb-4 pt-2"
             style="background:rgba(255,255,255,0.92); backdrop-filter:blur(12px); border-top:1px solid rgba(251,211,77,0.25); border-radius:1.5rem 1.5rem 0 0;">
            <button class="flex flex-col items-center justify-center gap-0.5 py-1 px-4 rounded-full"
                    :style="activeTab === 'dashboard' ? 'background:rgba(251,211,77,0.25); color:#735c00;' : 'color:#4d4635;'"
                    @click="activeTab = 'dashboard'">
                <span class="material-symbols-outlined" style="font-size:1.25rem; font-variation-settings:'FILL' 1;">dashboard</span>
                <span style="font-family:'Be Vietnam Pro',sans-serif; font-size:10px; font-weight:600;">Dashboard</span>
            </button>
            <button class="flex flex-col items-center justify-center gap-0.5 py-1 px-4 rounded-full"
                    :style="activeTab === 'guests' ? 'background:rgba(251,211,77,0.25); color:#735c00;' : 'color:#4d4635;'"
                    @click="activeTab = 'guests'">
                <span class="material-symbols-outlined" style="font-size:1.25rem; font-variation-settings:'FILL' 0;">group</span>
                <span style="font-family:'Be Vietnam Pro',sans-serif; font-size:10px; font-weight:600;">Guests</span>
            </button>
            <button class="flex flex-col items-center justify-center gap-0.5 py-1 px-4 rounded-full"
                    :style="activeTab === 'invites' ? 'background:rgba(251,211,77,0.25); color:#735c00;' : 'color:#4d4635;'"
                    @click="activeTab = 'invites'">
                <span class="material-symbols-outlined" style="font-size:1.25rem; font-variation-settings:'FILL' 0;">mail</span>
                <span style="font-family:'Be Vietnam Pro',sans-serif; font-size:10px; font-weight:600;">Invites</span>
            </button>
            <button class="flex flex-col items-center justify-center gap-0.5 py-1 px-4 rounded-full"
                    :style="activeTab === 'settings' ? 'background:rgba(251,211,77,0.25); color:#735c00;' : 'color:#4d4635;'"
                    @click="activeTab = 'settings'">
                <span class="material-symbols-outlined" style="font-size:1.25rem; font-variation-settings:'FILL' 0;">settings</span>
                <span style="font-family:'Be Vietnam Pro',sans-serif; font-size:10px; font-weight:600;">Settings</span>
            </button>
        </nav>

    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';

// --- Estado UI ---
const activeTab = ref('dashboard');
const showCreateModal = ref(false);
const search = ref('');
const loading = ref(false);
const creating = ref(false);
const toastVisible = ref(false);
const createdMessage = ref('');

function buildMessage(name, link) {
    return `🌼🐝 ¡Baby Shower de Naiara Sofía! 🐝🌼

Hola, *${name}* 🌸

Tenemos el gusto de invitarte al baby shower de nuestra pequeña abejita que viene en camino.

Confirma tu asistencia en tu invitación personalizada:
👉 ${link}

¡Te esperamos con mucho amor! 💛🐝`;
}

// --- Datos ---
const guests = ref([]);

const stats = computed(() => ({
    total:       guests.value.length,
    confirmed:   guests.value.filter(g => g.status === 'confirmed').length,
    pending:     guests.value.filter(g => g.status === 'pending').length,
    totalPeople: guests.value.reduce((sum, g) =>
        sum + (g.response?.attendance === 'yes' ? (g.response.guests_count ?? 1) : 0), 0),
}));

const filteredGuests = computed(() => {
    const q = search.value.trim().toLowerCase();
    if (!q) return guests.value;
    return guests.value.filter(g => g.name.toLowerCase().includes(q));
});

// --- Nueva invitación ---
const newGuest = ref({ name: '', type: 'individual' });

async function createInvitation() {
    if (!newGuest.value.name.trim()) return;
    creating.value = true;
    createdMessage.value = '';
    try {
        const { data } = await window.axios.post('/api/invitations', {
            name: newGuest.value.name,
            type: newGuest.value.type,
        });
        const link = `${window.location.origin}/?link_id=${data.link_id}&nombre=${encodeURIComponent(data.name)}`;
        const msg = buildMessage(data.name, link);
        createdMessage.value = msg;
        await copyText(msg);
        guests.value.unshift({
            id: data.id,
            name: data.name,
            type: data.type,
            status: 'pending',
            link_id: data.link_id,
        });
        newGuest.value = { name: '', type: 'individual' };
    } catch {
        // Fallback offline: genera un link_id local temporal
        const tempId = Math.random().toString(36).slice(2, 10);
        const link = `${window.location.origin}/?link_id=${tempId}&nombre=${encodeURIComponent(newGuest.value.name)}`;
        const msg = buildMessage(newGuest.value.name, link);
        createdMessage.value = msg;
        await copyText(msg);
        guests.value.unshift({
            id: Date.now(),
            name: newGuest.value.name,
            type: newGuest.value.type,
            status: 'pending',
            link_id: tempId,
        });
        newGuest.value = { name: '', type: 'individual' };
    } finally {
        creating.value = false;
    }
}

async function copyLink(guest) {
    const link = `${window.location.origin}/?link_id=${guest.link_id}&nombre=${encodeURIComponent(guest.name)}`;
    await copyText(buildMessage(guest.name, link));
}

async function copyText(text) {
    try {
        await navigator.clipboard.writeText(text);
    } catch {
        // fallback
        const el = document.createElement('textarea');
        el.value = text;
        el.style.position = 'fixed';
        el.style.opacity = '0';
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
    }
    toastVisible.value = true;
    setTimeout(() => { toastVisible.value = false; }, 2000);
}

// --- Helpers visuales ---
function initials(name) {
    return name.trim().charAt(0).toUpperCase();
}

function borderStyle(status) {
    if (status === 'confirmed') return 'border-left:4px solid #fbd34d;';
    if (status === 'declined')  return 'border-left:4px solid #ffdad6;';
    return '';
}

function badgeStyle(status) {
    if (status === 'confirmed')
        return 'background:#fbd34d; color:#715b00; font-family:\'Be Vietnam Pro\',sans-serif; font-weight:600;';
    if (status === 'declined')
        return 'background:#ffdad6; color:#93000a; font-family:\'Be Vietnam Pro\',sans-serif; font-weight:600;';
    return 'background:#e6eeff; color:#4d4635; font-family:\'Be Vietnam Pro\',sans-serif; font-weight:600;';
}

function statusIcon(status) {
    if (status === 'confirmed') return 'check_circle';
    if (status === 'declined')  return 'cancel';
    return 'schedule';
}

function statusLabel(status) {
    if (status === 'confirmed') return 'Confirmado';
    if (status === 'declined')  return 'No asiste';
    return 'Pendiente';
}

// --- Carga inicial ---
onMounted(async () => {
    loading.value = true;
    try {
        const { data } = await window.axios.get('/api/invitations');
        guests.value = data;
    } catch {
        // datos de muestra si no hay API aún
        guests.value = [
            { id: 1, name: 'Familia Gómez',  type: 'familia',    status: 'pending',   link_id: 'demo1' },
            { id: 2, name: 'Tía María',       type: 'individual', status: 'confirmed', link_id: 'demo2' },
            { id: 3, name: 'Laura y Andrés',  type: 'familia',    status: 'confirmed', link_id: 'demo3' },
            { id: 4, name: 'Pablo R.',         type: 'individual', status: 'declined',  link_id: 'demo4' },
        ];
    } finally {
        loading.value = false;
    }
});
</script>

<style>
.admin-root {
    position: relative;
    min-height: 100vh;
    background-color: #FEFCE8;
    background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(251,211,77,0.06) 10px, rgba(251,211,77,0.06) 20px);
    overflow-x: hidden;
}
.card-surface {
    background: #fff;
    border-radius: 16px;
    border: 1px solid rgba(245,158,11,0.2);
    box-shadow: 0 4px 12px rgba(245,158,11,0.08);
}
.gingham-accent {
    background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(251,211,77,0.1) 10px, rgba(251,211,77,0.1) 20px);
}
/* Modal */
.modal-fade-enter-active,
.modal-fade-leave-active { transition: opacity 0.25s ease; }
.modal-fade-enter-active > div,
.modal-fade-leave-active > div { transition: transform 0.3s cubic-bezier(0.34,1.56,0.64,1); }
.modal-fade-enter-from { opacity: 0; }
.modal-fade-enter-from > div { transform: translateY(40px); }
.modal-fade-leave-to { opacity: 0; }
/* Toast */
.toast-fade-enter-active,
.toast-fade-leave-active { transition: opacity 0.2s ease, transform 0.2s ease; }
.toast-fade-enter-from,
.toast-fade-leave-to { opacity: 0; transform: translate(-50%, 8px); }
</style>

<template>
    <div class="rsvp-root">

        <!-- Fondo con imagen local watermark -->
        <div class="fixed inset-0 pointer-events-none"
             style="background-image: url('/images/background.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; opacity: 0.08; z-index: -1;"></div>

        <!-- Header con imagen local + fade -->
        <header style="position:relative; width:100%; background:#f8f9ff;">
            <div style="position:relative; width:100%; height: clamp(140px, 30vw, 260px); overflow:hidden;">
                <img src="/images/background.jpg" alt=""
                     style="width:100%; height:100%; object-fit:cover; object-position:center top; display:block;" />
                <!-- fade superior -->
                <div style="position:absolute; top:0; left:0; right:0; height:20%; background: linear-gradient(to bottom, #f8f9ff 0%, transparent 100%); pointer-events:none;"></div>
                <!-- fade inferior -->
                <div style="position:absolute; bottom:0; left:0; right:0; height:80%; background: linear-gradient(to bottom, transparent 0%, rgba(248,249,255,0.55) 45%, #f8f9ff 100%); pointer-events:none;"></div>
            </div>
        </header>

        <!-- Main -->
        <main class="px-4 md:px-10 pb-32 md:pb-16 pt-2">
            <div class="max-w-md mx-auto">

                <!-- Título centrado -->
                <div class="scroll-reveal text-center mb-6">
                    <span class="material-symbols-outlined" style="font-size:2.5rem; color:#735c00; font-variation-settings:'FILL' 1;">favorite</span>
                    <p style="font-family:'Bubblegum Sans',cursive; font-size:1.35rem; color:#735c00; font-style:italic; margin-top:4px;">¡Hola, {{ guestName || '[Nombre]' }}!</p>
                    <h1 style="font-family:'Bubblegum Sans',cursive; font-size:1.6rem; color:#735c00; margin-bottom:6px;">Confirmar Asistencia</h1>
                    <!-- Divider con abejita -->
                    <div class="flex items-center justify-center gap-3" style="opacity:0.55;">
                        <div style="width:3rem; height:1px; background:rgba(115,92,0,0.3);"></div>
                        <span style="font-size:1.1rem;">🐝</span>
                        <div style="width:3rem; height:1px; background:rgba(115,92,0,0.3);"></div>
                    </div>
                    <p style="font-family:'Itim',cursive; font-size:15px; color:#4d4635; margin-top:8px;">
                        Por favor, confirma tu asistencia antes del 10 de Junio.
                    </p>
                </div>

                <!-- Chip: a quién va dirigida la invitación -->
                <div v-if="guestName" class="flex justify-center mb-4">
                    <div class="flex items-center gap-2 px-4 py-2 rounded-full"
                         style="background:rgba(251,211,77,0.25); border:1px solid rgba(233,195,62,0.5); backdrop-filter:blur(6px);">
                        <span class="material-symbols-outlined" style="font-size:16px; color:#735c00; font-variation-settings:'FILL' 1;">mail</span>
                        <span style="font-family:'Be Vietnam Pro',sans-serif; font-size:12px; color:#7f7662;">Invitación para:</span>
                        <strong style="font-family:'Be Vietnam Pro',sans-serif; font-size:13px; color:#735c00;">{{ guestName }}</strong>
                    </div>
                </div>

                <!-- Tarjeta glassmorphism con el formulario -->
                <div class="scroll-reveal rounded-3xl overflow-hidden"
                     style="background-color:rgba(255,253,240,0.75); border:1px solid rgba(255,255,255,0.6); box-shadow:0 10px 25px -5px rgba(0,0,0,0.1),0 8px 10px -6px rgba(0,0,0,0.1); backdrop-filter:blur(10px);">

                    <!-- Franja decorativa superior -->
                    <div class="w-full h-2"
                         style="background: #e9c33e; background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,255,255,0.3) 10px, rgba(255,255,255,0.3) 20px);"></div>

                    <form class="p-6 md:p-8 space-y-6" @submit.prevent="handleSubmit">

                        <!-- Nombre (solo para familias; en individuales se usa el nombre del link) -->
                        <div v-if="invitationType !== 'individual'" class="space-y-1">
                            <label class="block" for="fullName"
                                   style="font-family:'Bubblegum Sans',cursive; font-size:14px; color:#4d4635; font-weight:600;">
                                Tu nombre completo
                            </label>
                            <p style="font-family:'Itim',cursive; font-size:12px; color:#735c00; opacity:0.8; margin-bottom:2px;">
                                Escribe el nombre de quien está respondiendo.
                            </p>
                            <input
                                id="fullName"
                                v-model="form.name"
                                type="text"
                                placeholder="Ej: María González"
                                class="w-full px-4 py-3 rounded-xl transition-shadow"
                                :style="`background:rgba(255,255,255,0.8); border:1.5px solid ${errors.name ? '#ba1a1a' : 'rgba(115,92,0,0.2)'}; font-family:'Itim',cursive; font-size:15px; color:#0d1c2f; outline:none;`"
                                @focus="e => { e.target.style.borderColor='#e9c33e'; errors.name = '' }"
                                @blur="e => e.target.style.borderColor = errors.name ? '#ba1a1a' : 'rgba(115,92,0,0.2)'"
                            />
                            <p v-if="errors.name" style="font-family:'Itim',cursive; font-size:12px; color:#ba1a1a;">
                                {{ errors.name }}
                            </p>
                        </div>

                        <!-- ¿Asistirás? — primero para condicionar los demás campos -->
                        <div class="space-y-3">
                            <p class="text-center" style="font-family:'Bubblegum Sans',cursive; font-size:14px; color:#4d4635; font-weight:600;">
                                {{ invitationType === 'familia' ? '¿Asistirán?' : '¿Asistirás?' }}
                            </p>
                            <div class="flex gap-4">
                                <button
                                    type="button"
                                    class="flex-1 flex flex-col items-center justify-center py-3 rounded-xl transition-all duration-200"
                                    :style="form.attendance === 'yes'
                                        ? 'background:#fbd34d; border:2px solid #e9c33e; color:#715b00;'
                                        : 'background:rgba(255,255,255,0.5); border:1.5px solid rgba(115,92,0,0.2); color:#4d4635;'"
                                    @click="form.attendance = 'yes'"
                                >
                                    <span class="material-symbols-outlined mb-1" style="font-size:1.4rem; font-variation-settings:'FILL' 1;">check_circle</span>
                                    <span style="font-family:'Bubblegum Sans',cursive; font-size:13px;">
                                        {{ invitationType === 'familia' ? '¡Sí, allí estaremos!' : '¡Sí, allí estaré!' }}
                                    </span>
                                </button>
                                <button
                                    type="button"
                                    class="flex-1 flex flex-col items-center justify-center py-3 rounded-xl transition-all duration-200"
                                    :style="form.attendance === 'no'
                                        ? 'background:#ffdad6; border:2px solid #ffb4ab; color:#93000a;'
                                        : 'background:rgba(255,255,255,0.5); border:1.5px solid rgba(115,92,0,0.2); color:#4d4635;'"
                                    @click="form.attendance = 'no'"
                                >
                                    <span class="material-symbols-outlined mb-1" style="font-size:1.4rem; font-variation-settings:'FILL' 0;">cancel</span>
                                    <span style="font-family:'Bubblegum Sans',cursive; font-size:13px;">
                                        {{ invitationType === 'familia' ? 'No podremos asistir' : 'No podré asistir' }}
                                    </span>
                                </button>
                            </div>
                        </div>

                        <!-- Campos solo visibles si asiste -->
                        <Transition name="fields-fade">
                            <div v-if="form.attendance === 'yes'" class="space-y-6">

                                <!-- Número total de personas (solo familias) -->
                                <div v-if="invitationType !== 'individual'" class="space-y-1">
                                    <label class="block" for="guests"
                                           style="font-family:'Bubblegum Sans',cursive; font-size:14px; color:#4d4635; font-weight:600;">
                                        Número total de personas
                                    </label>
                                    <p style="font-family:'Itim',cursive; font-size:13px; color:#735c00; opacity:0.8; margin-bottom:4px;">
                                        Incluyéndote a ti, ¿cuántas personas asistirán?
                                    </p>
                                    <!-- Individual: bloqueado en 1 -->
                                    <div v-if="invitationType === 'individual'"
                                         class="flex items-center justify-center gap-3 px-4 py-3 rounded-xl"
                                         style="background:rgba(255,255,255,0.5); border:1.5px solid rgba(115,92,0,0.15);">
                                        <span class="material-symbols-outlined" style="font-size:16px; color:#7f7662;">lock</span>
                                        <span style="font-family:'Itim',cursive; font-size:14px; color:#7f7662;">Invitación individual &mdash; 1 persona</span>
                                    </div>
                                    <!-- Familia: contador libre -->
                                    <div v-else class="flex items-center gap-3">
                                        <button type="button"
                                                class="w-10 h-10 rounded-full flex items-center justify-center transition-all"
                                                style="background:rgba(251,211,77,0.25); border:1.5px solid rgba(115,92,0,0.2); color:#735c00; font-size:1.2rem; font-weight:700;"
                                                @click="form.guests_count = Math.max(1, form.guests_count - 1)">−</button>
                                        <span class="flex-1 text-center rounded-xl py-3"
                                              style="background:rgba(255,255,255,0.8); border:1.5px solid rgba(115,92,0,0.2); font-family:'Bubblegum Sans',cursive; font-size:1.3rem; color:#735c00;">
                                            {{ form.guests_count }}
                                        </span>
                                        <button type="button"
                                                class="w-10 h-10 rounded-full flex items-center justify-center transition-all"
                                                style="background:rgba(251,211,77,0.25); border:1.5px solid rgba(115,92,0,0.2); color:#735c00; font-size:1.2rem; font-weight:700;"
                                                @click="form.guests_count = Math.min(10, form.guests_count + 1)">+</button>
                                    </div>
                                </div>

                                <!-- Nombres de acompañantes (solo si más de 1) -->
                                <Transition name="fields-fade">
                                    <div v-if="form.guests_count > 1" class="space-y-1">
                                        <label class="block" for="companions"
                                               style="font-family:'Bubblegum Sans',cursive; font-size:14px; color:#4d4635; font-weight:600;">
                                            Nombres de acompañantes
                                            <span style="font-weight:400; font-family:'Itim',cursive; font-size:13px;">(opcional)</span>
                                        </label>
                                        <textarea
                                            id="companions"
                                            v-model="form.companions"
                                            rows="2"
                                            placeholder="Por favor, indica los nombres de tus acompañantes..."
                                            class="w-full px-4 py-3 rounded-xl resize-none transition-shadow"
                                            style="background:rgba(255,255,255,0.8); border:1.5px solid rgba(115,92,0,0.2); font-family:'Itim',cursive; font-size:15px; color:#0d1c2f; outline:none;"
                                            @focus="e => e.target.style.borderColor='#e9c33e'"
                                            @blur="e => e.target.style.borderColor='rgba(115,92,0,0.2)'"
                                        ></textarea>
                                    </div>
                                </Transition>

                            </div>
                        </Transition>

                        <!-- Error general -->
                        <p v-if="errors.general" class="text-center rounded-xl py-2 px-4"
                           style="font-family:'Itim',cursive; font-size:13px; color:#93000a; background:#ffdad6;">
                            {{ errors.general }}
                        </p>

                        <!-- Botón Confirmar -->
                        <div class="pt-2">
                            <button
                                type="submit"
                                :disabled="submitting"
                                class="w-full py-4 rounded-full transition-all duration-300 hover:-translate-y-1"
                                style="background:#fbd34d; color:#715b00; font-family:'Bubblegum Sans',cursive; font-size:1.1rem; letter-spacing:0.05em; box-shadow:0 4px 12px rgba(251,211,77,0.4); border:none; cursor:pointer;"
                            >
                                <span v-if="submitting" class="flex items-center justify-center gap-2">
                                    <span class="animate-spin material-symbols-outlined" style="font-size:1rem;">progress_activity</span>
                                    Enviando...
                                </span>
                                <span v-else>
                                    {{ form.attendance === 'yes' ? 'Confirmar asistencia 🐝' : 'Enviar respuesta' }}
                                </span>
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </main>

        <!-- Modal de éxito -->
        <Transition name="modal-fade">
            <div v-if="submitted"
                 class="fixed inset-0 z-50 flex items-center justify-center px-5"
                 style="background:rgba(13,28,47,0.45); backdrop-filter:blur(6px);">
                <div class="w-full max-w-sm rounded-3xl overflow-hidden relative"
                     style="background:#fffdf0; box-shadow:0 24px 48px rgba(0,0,0,0.18);">

                    <!-- Franja decorativa -->
                    <div class="w-full h-2" style="background:#e9c33e; background-image:repeating-linear-gradient(45deg,transparent,transparent 10px,rgba(255,255,255,0.3) 10px,rgba(255,255,255,0.3) 20px);"></div>

                    <div class="p-8 text-center">
                        <!-- Emoji grande -->
                        <div style="font-size:3.5rem; line-height:1;">{{ form.attendance === 'yes' ? '🐝' : '🥺' }}</div>

                        <!-- Título -->
                        <h2 style="font-family:'Bubblegum Sans',cursive; font-size:1.5rem; color:#735c00; margin-top:14px;">
                            {{ form.attendance === 'yes'
                                ? `¡Gracias, ${form.name || guestName}! 🎉`
                                : `¡Gracias por avisarnos!` }}
                        </h2>

                        <!-- Mensaje principal -->
                        <p style="font-family:'Itim',cursive; font-size:15px; color:#4d4635; margin-top:8px; line-height:1.65;">
                            {{ form.attendance === 'yes'
                                ? '¡Te esperamos con mucho amor el 20 de Junio! Va a ser un día muy especial. 🌼'
                                : 'Lamentamos que no puedas estar, pero te queremos mucho. 💛' }}
                        </p>

                        <!-- Recordatorios (solo si asiste) -->
                        <div v-if="form.attendance === 'yes'"
                             class="mt-5 rounded-2xl p-4 text-left space-y-2"
                             style="background:rgba(251,211,77,0.15); border:1px solid rgba(233,195,62,0.35);">
                            <p style="font-family:'Bubblegum Sans',cursive; font-size:13px; color:#735c00; margin-bottom:4px;">Recuerda llevar:</p>
                            <p style="font-family:'Itim',cursive; font-size:14px; color:#4d4635;">🩱 Tu traje de baño</p>
                            <p style="font-family:'Itim',cursive; font-size:14px; color:#4d4635;">&#128338; Llegar puntual — 2:00 pm</p>
                            <p style="font-family:'Itim',cursive; font-size:14px; color:#4d4635;">🎁 Tu mejor vibra para Naiara Sofía</p>
                            <p style="font-family:'Itim',cursive; font-size:14px; color:#4d4635;">&#128205; Campestre Ana Luisa</p>
                        </div>

                        <!-- Aviso cambio de opinión -->
                        <p class="mt-4 rounded-2xl px-4 py-3"
                           style="font-family:'Itim',cursive; font-size:13px; color:#7f7662; line-height:1.6; background:rgba(226,224,205,0.3); border:1px solid rgba(115,92,0,0.1);">
                            💬 ¿Cambiaste de opinión? Puedes volver a responder esta invitación antes del <strong style="color:#735c00;">10 de Junio</strong> y actualizaremos tu confirmación.
                        </p>

                        <!-- Botón cerrar -->
                        <button
                            class="mt-6 w-full py-3 rounded-full transition-all hover:scale-105"
                            style="background:#fbd34d; color:#715b00; font-family:'Bubblegum Sans',cursive; font-size:1rem; border:none; cursor:pointer; box-shadow:0 4px 12px rgba(251,211,77,0.4);"
                            @click="submitted = false"
                        >
                            ¡Entendido! 🐝
                        </button>
                    </div>
                </div>
            </div>
        </Transition>

        <!-- Footer con imagen local -->
        <div style="position:relative; width:100%; height:220px; overflow:hidden; background:#f8f9ff;">
            <img src="/images/background.jpg" alt=""
                 style="width:100%; height:100%; object-fit:cover; object-position:center bottom; display:block;" />
            <div style="position:absolute; top:0; left:0; right:0; height:60%; background:linear-gradient(to bottom, #f8f9ff 0%, transparent 100%); pointer-events:none; z-index:1;"></div>
        </div>

        <!-- Bottom nav mobile -->
        <nav class="fixed bottom-0 left-0 w-full md:hidden z-50 flex justify-around items-center px-4 pb-4 pt-2"
             style="background:rgba(255,255,255,0.88); backdrop-filter:blur(12px); border-top:1px solid rgba(251,211,77,0.3); border-radius:1.5rem 1.5rem 0 0;">
            <RouterLink :to="linkId ? { path: '/', query: { link_id: linkId, nombre: guestName } } : '/'" class="flex flex-col items-center justify-center gap-1 py-1 px-3 rounded-full transition-all"
               style="color:#4d4635;">
                <span class="material-symbols-outlined" style="font-size:1.25rem; font-variation-settings:'FILL' 0;">mail</span>
                <span style="font-family:'Itim',cursive; font-size:10px;">Invitación</span>
            </RouterLink>
            <RouterLink :to="linkId ? { path: '/lugar', query: { link_id: linkId, nombre: guestName } } : '/lugar'" class="flex flex-col items-center justify-center gap-1 py-1 px-3 rounded-full transition-all"
               style="color:#4d4635;">
                <span class="material-symbols-outlined" style="font-size:1.25rem; font-variation-settings:'FILL' 0;">location_on</span>
                <span style="font-family:'Itim',cursive; font-size:10px;">Lugar</span>
            </RouterLink>
            <div class="flex flex-col items-center justify-center gap-1 py-1 px-5 rounded-full"
                 style="background:rgba(251,211,77,0.25); color:#735c00;">
                <span class="material-symbols-outlined" style="font-size:1.25rem; font-variation-settings:'FILL' 1;">event_available</span>
                <span style="font-family:'Itim',cursive; font-size:10px; font-weight:700;">Confirmar</span>
            </div>
        </nav>

    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const guestName = ref(route.query.nombre || '');
const linkId = route.query.link_id || '';

const form = ref({
    name:         '',
    guests_count: 1,
    companions:   '',
    attendance:   'yes',
});

const errors    = ref({ name: '', general: '' });
const submitting = ref(false);
const submitted  = ref(false);
const invitationType = ref(null); // 'individual' | 'familia' | null (desconocido)

function validate() {
    errors.value.name    = '';
    errors.value.general = '';
    if (invitationType.value !== 'individual' && !form.value.name.trim()) {
        errors.value.name = 'Por favor escribe tu nombre.';
        return false;
    }
    return true;
}

async function handleSubmit() {
    if (!validate()) return;
    submitting.value = true;
    try {
        await window.axios.post('/api/rsvp', {
            link_id:      route.query.link_id || null,
            name:         form.value.name.trim(),
            attendance:   form.value.attendance,
            guests_count: form.value.attendance === 'yes' ? form.value.guests_count : 1,
            companions:   form.value.attendance === 'yes' ? (form.value.companions || null) : null,
        });
        submitted.value = true;
    } catch (err) {
        const msg = err?.response?.data?.message;
        errors.value.general = msg || 'Ocurrió un error al enviar. Intenta de nuevo.';
    } finally {
        submitting.value = false;
    }
}

let revealObserver = null;

onMounted(async () => {
    // Obtener tipo de invitación para restricciones del formulario
    const linkId = route.query.link_id;
    if (linkId) {
        try {
            const { data } = await window.axios.get(`/api/invitations/${linkId}`);
            invitationType.value = data.type;
            if (data.type === 'individual') {
                form.value.guests_count = 1;
                // Para individuales, el nombre se toma directo del link
                form.value.name = guestName.value || data.name;
            }
        } catch { /* si falla, no restringimos */ }
    }

    const revealEls = document.querySelectorAll('.scroll-reveal');
    revealEls.forEach((el, i) => {
        el.style.transitionDelay = `${i * 0.13}s`;
    });
    revealObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('bee-revealed');
                revealObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -20px 0px' });
    revealEls.forEach(el => revealObserver.observe(el));
});

onUnmounted(() => {
    if (revealObserver) revealObserver.disconnect();
});
</script>

<style>
.rsvp-root {
    position: relative;
    min-height: 100vh;
    background-color: #f8f9ff;
    overflow-x: hidden;
}
/* Scroll reveal — abejita aterrizando */
.scroll-reveal {
    opacity: 0;
    transform: translateY(50px) rotate(-3deg) scale(0.96);
    transition:
        opacity 0.7s cubic-bezier(0.34, 1.56, 0.64, 1),
        transform 0.7s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.scroll-reveal.bee-revealed {
    opacity: 1;
    transform: translateY(0) rotate(0deg) scale(1);
}
.modal-fade-enter-active,
.modal-fade-leave-active {
    transition: opacity 0.3s ease;
}
.modal-fade-enter-active .w-full.max-w-sm,
.modal-fade-leave-active .w-full.max-w-sm {
    transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.modal-fade-enter-from,
.modal-fade-leave-to {
    opacity: 0;
}
.modal-fade-enter-from .w-full.max-w-sm {
    transform: scale(0.88) translateY(20px);
}
.fade-up-enter-active {
    transition: opacity 0.5s ease, transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.fade-up-enter-from {
    opacity: 0;
    transform: translateY(20px) scale(0.97);
}
.fields-fade-enter-active,
.fields-fade-leave-active {
    transition: opacity 0.3s ease, transform 0.3s ease, max-height 0.4s ease;
    overflow: hidden;
}
.fields-fade-enter-from,
.fields-fade-leave-to {
    opacity: 0;
    transform: translateY(-8px);
}
</style>

<template>
    <div class="invitation-details-root">
        <!-- Flying Bees Overlay -->
        <div ref="beesOverlay" aria-hidden="true" class="fixed inset-0 pointer-events-none overflow-hidden" style="z-index:100;"></div>

        <!-- Background con imagen local -->
        <div
            class="fixed inset-0 pointer-events-none"
            style="background-image: url('/images/background.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; opacity: 0.12; z-index: -1;"
        ></div>

        <!-- Header -->
        <header class="relative w-full bg-white">
            <div style="position:relative; width:100%; height: clamp(180px, 40vw, 380px); overflow:hidden;">
                <img
                    alt="Ilustración de abejas y colmena"
                    style="width:100%; height:100%; object-fit:cover; object-position: center top; display:block;"
                    src="/images/background.jpg"
                />
                <!-- Fade inferior -->
                <div style="position:absolute; bottom:0; left:0; right:0; height:50%; background: linear-gradient(to bottom, transparent, #ffffff); pointer-events:none;"></div>
            </div>
            <div class="flex justify-center relative z-20" style="margin-top: -5rem;">
                <div class="bg-white rounded-full p-2 shadow-xl">
                    <img
                        alt="Logo Naiara Sofía"
                        class="rounded-full object-contain"
                        style="width: 12rem; height: 12rem;"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDdBzaE4U2SlRR7lgZGz3xjj-ePY9urCCGI8gG8Y8OyS3Oq4_luWiq6dLab0pSCJYdQmclsh6oOaG-NntTXwTRjQlZqMZ1cW1BBf677KAQ56jhLS1jie7CngMe2wLmg9refAlwWknqKggQkqWA7bxEh4eeMKTFsTB4UGmWLUG7ifaHTHBdj_Zi2GxRQsRI-yxDy0y1-Jq_vo3_Zv0839bHjUgsXPTUtc9cOKsjf9skekhNlYizlNdokCTwEe3Fe5rPwAhNUCuyzlG_e"
                    />
                </div>
            </div>
        </header>

        <!-- Main -->
        <main>
            <!-- Hero Section -->
            <section class="relative text-center overflow-hidden pb-12 px-4 md:px-10">
                <!-- Decorativos desktop -->
                <div class="absolute top-10 left-10 bee-float opacity-80 hidden md:block">
                    <span class="material-symbols-outlined text-primary-container text-6xl" style="font-variation-settings: 'FILL' 1;">eco</span>
                </div>
                <div class="absolute top-40 right-20 bee-float opacity-80 hidden md:block" style="animation-delay: 0.7s;">
                    <span class="material-symbols-outlined text-primary text-4xl" style="font-variation-settings: 'FILL' 1;">favorite</span>
                </div>

                <div class="max-w-4xl mx-auto relative" style="z-index:10;">
                    <p class="text-on-surface-variant mb-12 max-w-2xl mx-auto italic"
                       style="font-family:'Playfair Display',serif; font-size:24px; line-height:32px; font-weight:600;">
                        "¡Estamos esperando a nuestra pequeña abejita!"
                    </p>

                    <!-- Countdown -->
                    <div class="flex justify-center gap-4 md:gap-8 mb-16 w-full">
                        <div class="flex flex-col items-center bg-white rounded-2xl shadow-sm flex-1 p-4" style="border: 1px solid rgba(251,211,77,0.2); min-width: 80px;">
                            <span class="font-display-name text-4xl text-primary" style="font-family:'Plus Jakarta Sans',sans-serif; font-size:2.5rem; font-weight:700; color:#735c00;">{{ timeLeft.days }}</span>
                            <span class="uppercase" style="font-family:'Be Vietnam Pro',sans-serif; font-size:14px; font-weight:600; color:#4d4635; letter-spacing:0.05em;">Días</span>
                        </div>
                        <div class="flex flex-col items-center bg-white rounded-2xl shadow-sm flex-1 p-4" style="border: 1px solid rgba(251,211,77,0.2); min-width: 80px;">
                            <span class="font-display-name text-4xl text-primary" style="font-family:'Plus Jakarta Sans',sans-serif; font-size:2.5rem; font-weight:700; color:#735c00;">{{ timeLeft.hours }}</span>
                            <span class="uppercase" style="font-family:'Be Vietnam Pro',sans-serif; font-size:14px; font-weight:600; color:#4d4635; letter-spacing:0.05em;">Horas</span>
                        </div>
                        <div class="flex flex-col items-center bg-white rounded-2xl shadow-sm flex-1 p-4" style="border: 1px solid rgba(251,211,77,0.2); min-width: 80px;">
                            <span class="font-display-name text-4xl text-primary" style="font-family:'Plus Jakarta Sans',sans-serif; font-size:2.5rem; font-weight:700; color:#735c00;">{{ timeLeft.minutes }}</span>
                            <span class="uppercase" style="font-family:'Be Vietnam Pro',sans-serif; font-size:14px; font-weight:600; color:#4d4635; letter-spacing:0.05em;">Min</span>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <button class="flex items-center justify-center gap-2 w-full px-10 py-4 rounded-full shadow-md transition-transform hover:scale-95"
                                style="background:#fbd34d; color:#715b00; font-family:'Be Vietnam Pro',sans-serif; font-size:14px; font-weight:600;">
                            <span class="material-symbols-outlined">calendar_today</span>
                            Ver Detalles del Evento
                        </button>
                        <button class="flex items-center justify-center gap-2 w-full px-10 py-4 rounded-full transition-all"
                                style="border: 2px solid #fbd34d; color:#735c00; font-family:'Be Vietnam Pro',sans-serif; font-size:14px; font-weight:600; background:transparent;">
                            <span class="material-symbols-outlined">favorite</span>
                            Mesa de Regalos
                        </button>
                    </div>
                </div>
            </section>

            <!-- Venue Section -->
            <section class="py-24 px-4 md:px-10" style="background: linear-gradient(to bottom, transparent, #eff4ff 150px, #eff4ff);">
                <div class="max-w-6xl mx-auto">
                    <div class="flex flex-col md:flex-row gap-12 items-center">
                        <!-- Left: date & location -->
                        <div class="w-full md:w-1/2 space-y-8 text-center">
                            <div class="space-y-4">
                                <h2 style="font-family:'Plus Jakarta Sans',sans-serif; font-size:3rem; font-weight:700; color:#735c00; line-height:1.1;">
                                    ¿Cuándo y Dónde?
                                </h2>
                                <p style="color:#4d4635; font-family:'Be Vietnam Pro',sans-serif; font-size:18px;">
                                    No faltes a nuestra celebración en el jardín de las abejitas.
                                </p>
                            </div>

                            <div class="space-y-6">
                                <!-- Date -->
                                <div class="flex flex-col items-center gap-4 p-8 rounded-xl transition-all"
                                     style="background: rgba(255,255,255,0.5); border: 1px solid rgba(115,92,0,0.05); backdrop-filter: blur(4px);">
                                    <div class="p-2.5 rounded-full" style="background: rgba(115,92,0,0.1);">
                                        <span class="material-symbols-outlined" style="color: rgba(115,92,0,0.8); font-size:20px;">calendar_today</span>
                                    </div>
                                    <div class="text-center">
                                        <h4 style="font-family:'Plus Jakarta Sans',sans-serif; font-size:1.5rem; font-weight:700; color:#0d1c2f; margin-bottom:4px;">
                                            Sábado, 20 de Junio
                                        </h4>
                                        <div style="height:1px; width:2rem; background:rgba(115,92,0,0.2); margin:12px auto;"></div>
                                        <p style="font-family:'Be Vietnam Pro',sans-serif; font-size:12px; color:#4d4635; font-weight:600; letter-spacing:0.1em; text-transform:uppercase;">
                                            A partir de las 4:00 PM
                                        </p>
                                    </div>
                                </div>

                                <!-- Location -->
                                <div class="flex flex-col items-center gap-4 p-8 rounded-xl transition-all"
                                     style="background: rgba(255,255,255,0.5); border: 1px solid rgba(115,92,0,0.05); backdrop-filter: blur(4px);">
                                    <div class="p-2.5 rounded-full" style="background: rgba(115,92,0,0.1);">
                                        <span class="material-symbols-outlined" style="color: rgba(115,92,0,0.8); font-size:20px;">location_on</span>
                                    </div>
                                    <div class="text-center">
                                        <h4 style="font-family:'Plus Jakarta Sans',sans-serif; font-size:1.5rem; font-weight:700; color:#0d1c2f; margin-bottom:4px;">
                                            Salón de eventos "El Trébol"
                                        </h4>
                                        <p style="color:#4d4635; font-family:'Be Vietnam Pro',sans-serif; font-size:14px; margin-bottom:16px;">
                                            28984 Cdad. de Villa de Álvarez, Col.
                                        </p>
                                        <button class="inline-flex items-center gap-2 hover:opacity-70 transition-opacity"
                                                style="color:#735c00; font-size:12px; font-weight:700; letter-spacing:0.1em; text-transform:uppercase; font-family:'Be Vietnam Pro',sans-serif;">
                                            Ver mapa <span class="material-symbols-outlined" style="font-size:12px;">open_in_new</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right: image -->
                        <div class="w-full md:w-1/2 relative">
                            <div class="relative rounded-[40px] overflow-hidden shadow-2xl" style="border: 8px solid #ffffff;">
                                <img
                                    class="w-full object-cover"
                                    style="height: 300px;"
                                    alt="Decoración para baby shower con tema de abejas y margaritas"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuACz1gXDC6GHEqoob_YZEJOfFOFTWsSAvwxADOIJSLnV9A_kQtIiBiLwowZiZsbq9PeyY4xULKblqWusxtikheT7CF4NAzBeJQVtt-TQUIK7-Vk3HMNadM1pL8cgXJIvKDh65u2Ay3oeJQ6RiJJnzAZ2tzTVk1AvyKVAM0AAX5JO1Bvt80KpetB9pmA0W79mQJ-mWcQnnw8vXik8s7-ND2y5w2R8HP-jSg-i1tbPRE88dNC3-t-6yLHtOEYubnrmONpzb2zv9ehlQi2"
                                />
                            </div>
                            <!-- Bee decoration -->
                            <div class="absolute -bottom-8 -right-8 p-6 rounded-full shadow-lg bee-float"
                                 style="background:#fbd34d;">
                                <span class="material-symbols-outlined text-4xl" style="color:#715b00; font-variation-settings: 'FILL' 1; font-size:2.25rem;">eco</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Footer wildflower image -->
            <div style="position:relative; width:100%; height:300px; overflow:hidden; background-color:#eff4ff; margin-top:-2px;">
                <img
                    alt="Campo de flores silvestres"
                    style="width:100%; height:100%; object-fit:cover; object-position: center bottom; display:block;"
                    src="/images/background.jpg"
                />
                <!-- Fade superior que disimula el corte con la sección anterior -->
                <div style="position:absolute; top:0; left:0; right:0; height:55%; background: linear-gradient(to bottom, #eff4ff 0%, transparent 100%); pointer-events:none; z-index:1;"></div>
            </div>
        </main>
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

// --- Countdown ---
const EVENT_DATE = new Date('2026-06-15T16:00:00');

const timeLeft = ref({ days: 0, hours: 0, minutes: 0 });

function computeTimeLeft() {
    const diff = EVENT_DATE - Date.now();
    if (diff <= 0) {
        timeLeft.value = { days: 0, hours: 0, minutes: 0 };
        return;
    }
    timeLeft.value = {
        days:    Math.floor(diff / (1000 * 60 * 60 * 24)),
        hours:   Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
        minutes: Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60)),
    };
}

let countdownTimer = null;

// --- Flying Bees ---
const beesOverlay = ref(null);

function launchBees() {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
    const overlay = beesOverlay.value;
    if (!overlay) return;

    const numBees = 12;
    for (let i = 0; i < numBees; i++) {
        const beeContainer = document.createElement('div');
        beeContainer.style.cssText = 'position:absolute; left:0; top:0; will-change:transform,opacity;';

        const flipWrapper = document.createElement('div');
        const bee = document.createElement('div');
        bee.style.cssText = 'font-size:2rem; display:inline-block; filter:drop-shadow(0 4px 6px rgba(0,0,0,0.1));';
        bee.innerHTML = '🐝';

        const startLeft = Math.random() > 0.5;
        const startX = startLeft ? -100 : window.innerWidth + 100;
        const endX   = startLeft ? window.innerWidth + 100 : -100;
        const startY = Math.random() * (window.innerHeight * 0.8);
        const endY   = Math.random() * (window.innerHeight * 0.8);
        const midY   = (startY + endY) / 2 + (Math.random() - 0.5) * 400;

        if (!startLeft) flipWrapper.style.transform = 'scaleX(-1)';

        flipWrapper.appendChild(bee);
        beeContainer.appendChild(flipWrapper);
        overlay.appendChild(beeContainer);

        const duration = 3000 + Math.random() * 2000;
        const delay    = Math.random() * 800;

        const anim = beeContainer.animate([
            { transform: `translate(${startX}px, ${startY}px)`, opacity: 0 },
            { opacity: 1, offset: 0.1 },
            { transform: `translate(${(startX + endX) / 2}px, ${midY}px)`, offset: 0.5 },
            { opacity: 1, offset: 0.8 },
            { transform: `translate(${endX}px, ${endY}px)`, opacity: 0 },
        ], { duration, delay, easing: 'ease-in-out', fill: 'forwards' });

        anim.onfinish = () => beeContainer.remove();
    }
}

onMounted(() => {
    computeTimeLeft();
    countdownTimer = setInterval(computeTimeLeft, 60000);
    launchBees();
});

onUnmounted(() => {
    clearInterval(countdownTimer);
});
</script>

<style>
.invitation-details-root {
    position: fixed;
    inset: 0;
    overflow-y: auto;
    overflow-x: hidden;
    z-index: 50;
    background-color: #f8f9ff;
    font-family: 'Be Vietnam Pro', sans-serif;
    color: #0d1c2f;
}
.bee-float {
    animation: inv-float 4s ease-in-out infinite;
}
@keyframes inv-float {
    0%   { transform: translateY(0px) rotate(0deg); }
    50%  { transform: translateY(-10px) rotate(5deg); }
    100% { transform: translateY(0px) rotate(0deg); }
}
</style>

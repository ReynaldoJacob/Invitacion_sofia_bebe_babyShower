<template>
    <div class="invitation-details-root">
        <!-- Flying Bees Overlay -->
        <div ref="beesOverlay" aria-hidden="true" class="fixed inset-0 pointer-events-none overflow-hidden" style="z-index:100;"></div>

        <!-- Background con imagen local -->
        <div
            class="fixed inset-0 pointer-events-none"
            style="background-image: url('/images/background.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; opacity: 0.12; z-index: -1;"
        ></div>

        <!-- Header (imagen local con fade inferior + logo) -->
        <header class="relative w-full" style="background:#f8f9ff;">
            <div style="position:relative; width:100%; height: clamp(180px, 40vw, 380px); overflow:hidden;">
                <img
                    alt="Ilustración de abejas y colmena"
                    style="width:100%; height:100%; object-fit:cover; object-position: center top; display:block;"
                    src="/images/background.jpg"
                />
                <!-- fade superior -->
                <div style="position:absolute; top:0; left:0; right:0; height:20%; background: linear-gradient(to bottom, #f8f9ff 0%, transparent 100%); pointer-events:none;"></div>
                <!-- fade inferior -->
                <div style="position:absolute; bottom:0; left:0; right:0; height:80%; background: linear-gradient(to bottom, transparent 0%, rgba(248,249,255,0.55) 45%, #f8f9ff 100%); pointer-events:none;"></div>
            </div>
            <div class="flex justify-center relative z-20" style="margin-top: -5rem;">
                <div class="rounded-full p-2" style="background:#f8f9ff;">
                    <img
                        alt="Logo Naiara Sofía"
                        class="rounded-full object-contain"
                        style="width: 25rem; height: 25rem;"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDdBzaE4U2SlRR7lgZGz3xjj-ePY9urCCGI8gG8Y8OyS3Oq4_luWiq6dLab0pSCJYdQmclsh6oOaG-NntTXwTRjQlZqMZ1cW1BBf677KAQ56jhLS1jie7CngMe2wLmg9refAlwWknqKggQkqWA7bxEh4eeMKTFsTB4UGmWLUG7ifaHTHBdj_Zi2GxRQsRI-yxDy0y1-Jq_vo3_Zv0839bHjUgsXPTUtc9cOKsjf9skekhNlYizlNdokCTwEe3Fe5rPwAhNUCuyzlG_e"
                    />
                </div>
            </div>
        </header>

        <!-- Main -->
        <main>
            <section class="relative px-4 md:px-10 text-center overflow-hidden pb-12" style="padding-top: 3rem;">
                <!-- Decorativos desktop -->
                <div class="absolute top-10 left-10 bee-float opacity-80 hidden md:block">
                    <span class="material-symbols-outlined text-6xl" style="color:#fbd34d; font-variation-settings: 'FILL' 1;">eco</span>
                </div>
                <div class="absolute top-40 right-20 bee-float opacity-80 hidden md:block" style="animation-delay: 0.7s;">
                    <span class="material-symbols-outlined text-4xl" style="color:#735c00; font-variation-settings: 'FILL' 1;">favorite</span>
                </div>

                <div class="max-w-4xl mx-auto relative" style="z-index:10;">

                    <!-- Fecha y horario -->
                    <div class="flex items-center justify-center gap-6 mb-12" style="color: rgba(115,92,0,0.8);">
                        <div style="font-family:'Bubblegum Sans',cursive; font-size:1.25rem; letter-spacing:0.1em; text-transform:uppercase;">Sab</div>
                        <div style="width:1px; height:3rem; background:rgba(115,92,0,0.2);"></div>
                        <div class="flex flex-col items-center">
                            <span style="font-family:'Bubblegum Sans',cursive; font-size:3rem; font-weight:400; line-height:1;">09</span>
                            <span style="font-family:'Itim',cursive; font-size:11px; letter-spacing:0.3em; font-weight:400; text-transform:uppercase; margin-top:4px;">May</span>
                        </div>
                        <div style="width:1px; height:3rem; background:rgba(115,92,0,0.2);"></div>
                        <div class="text-left" style="font-family:'Itim',cursive;">
                            <div style="font-size:1.125rem; line-height:1.4;">1:00 pm</div>
                            <div style="font-size:0.875rem; opacity:0.7;">a</div>
                            <div style="font-size:1.125rem; line-height:1.4;">7:00 pm</div>
                        </div>
                    </div>

                    <!-- Quote -->
                    <p class="max-w-2xl mx-auto mb-12"
                       style="font-family:'Bubblegum Sans',cursive; font-size:22px; line-height:34px; color:#4d4635;">
                        "¡Estamos esperando a nuestra pequeña abejita!"
                    </p>

                    <!-- Countdown card -->
                    <div class="max-w-md mx-auto mb-16">
                        <div class="flex flex-col items-center gap-6 p-8"
                             style="background-color:rgba(255,253,240,0.5); border-radius:2rem; border:1px solid rgba(255,255,255,0.6); box-shadow:0 10px 25px -5px rgba(0,0,0,0.1),0 8px 10px -6px rgba(0,0,0,0.1); backdrop-filter:blur(8px);">
                            <h3 style="font-family:'Bubblegum Sans',cursive; font-size:1.5rem; color:#735c00;">
                                Faltan para el momento
                            </h3>
                            <div class="flex justify-center gap-3 w-full">
                                <div class="flex flex-col items-center flex-1 rounded-xl p-3"
                                     style="background:rgba(255,255,255,0.6); border:1px solid rgba(251,211,77,0.2); min-width:72px;">
                                    <span style="font-family:'Bubblegum Sans',cursive; font-size:1.875rem; color:#735c00;">{{ timeLeft.days }}</span>
                                    <span style="font-family:'Itim',cursive; font-size:11px; color:#4d4635; letter-spacing:0.1em; text-transform:uppercase;">Días</span>
                                </div>
                                <div class="flex flex-col items-center flex-1 rounded-xl p-3"
                                     style="background:rgba(255,255,255,0.6); border:1px solid rgba(251,211,77,0.2); min-width:72px;">
                                    <span style="font-family:'Bubblegum Sans',cursive; font-size:1.875rem; color:#735c00;">{{ timeLeft.hours }}</span>
                                    <span style="font-family:'Itim',cursive; font-size:11px; color:#4d4635; letter-spacing:0.1em; text-transform:uppercase;">Horas</span>
                                </div>
                                <div class="flex flex-col items-center flex-1 rounded-xl p-3"
                                     style="background:rgba(255,255,255,0.6); border:1px solid rgba(251,211,77,0.2); min-width:72px;">
                                    <span style="font-family:'Bubblegum Sans',cursive; font-size:1.875rem; color:#735c00;">{{ timeLeft.minutes }}</span>
                                    <span style="font-family:'Itim',cursive; font-size:11px; color:#4d4635; letter-spacing:0.1em; text-transform:uppercase;">Min</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botón Mesa de Regalos -->
                    <!-- <div class="flex justify-center mb-12">
                        <button class="flex items-center justify-center gap-2 px-10 py-4 rounded-full transition-all w-full max-w-md"
                                style="border:2px solid #fbd34d; color:#735c00; font-family:'Be Vietnam Pro',sans-serif; font-size:14px; font-weight:600; background:transparent;">
                            <span class="material-symbols-outlined">favorite</span>
                            Mesa de Regalos
                        </button>
                    </div> -->

                    <!-- Card Ubicación -->
                    <!-- <div class="max-w-md mx-auto mt-4">
                        <div class="flex flex-col items-center gap-3 p-8"
                             style="background-color:rgba(255,253,240,0.5); border-radius:2rem; border:1px solid rgba(255,255,255,0.6); box-shadow:0 10px 25px -5px rgba(0,0,0,0.1),0 8px 10px -6px rgba(0,0,0,0.1); backdrop-filter:blur(8px);">
                            <span class="material-symbols-outlined" style="font-size:1.875rem; color:#735c00; font-variation-settings:'FILL' 0,'wght' 300;">location_on</span>
                            <a class="inline-flex items-center justify-center gap-2 hover:opacity-70 transition-opacity"
                               style="font-family:'Playfair Display',serif; font-size:1.25rem; font-style:italic; color:#735c00; font-weight:700;" href="#">
                                Ver Ubicación <span class="material-symbols-outlined" style="font-size:0.875rem;">east</span>
                            </a>
                        </div>
                    </div> -->
                    <div class="max-w-md mx-auto mt-4">
                        <a  :href="linkId ? '/lugar?link_id=' + linkId : '/lugar'" style="background-color:rgba(255,253,240,0.5);" class="ripple-button group flex flex-col items-center justify-center p-8 bg-white/50 backdrop-blur-sm rounded-3xl border border-primary/5 hover:bg-white/70 transition-all duration-500 relative overflow-hidden scroll-reveal">
                            <div class="w-12 h-12 rounded-full bg-primary/5 text-primary flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-2xl" data-icon="location_on">location_on</span>
                            </div>
                            <span style="font-family:'Bubblegum Sans',cursive; font-size:13px; color:#4d4635; letter-spacing:0.15em; text-transform:uppercase;">Lugar</span>
                            <span style="font-family:'Itim',cursive; font-size:11px; color:#735c00; margin-top:2px;">Ver mapa y dirección</span>
                        </a>
                    </div>

                    <!-- Card Confirmar Asistencia -->
                    <div class="max-w-md mx-auto mt-4">
                        <a href="#" style="background-color:rgba(255,253,240,0.5);" class="ripple-button group flex flex-col items-center justify-center p-8 bg-white/50 backdrop-blur-sm rounded-3xl border border-primary/5 hover:bg-white/70 transition-all duration-500 relative overflow-hidden scroll-reveal">
                            <div class="w-12 h-12 rounded-full bg-primary/5 text-primary flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-2xl" data-icon="favorite_border">favorite_border</span>
                            </div>
                            <span style="font-family:'Bubblegum Sans',cursive; font-size:13px; color:#4d4635; letter-spacing:0.15em; text-transform:uppercase;">Confirmar Asistencia</span>
                            <span style="font-family:'Itim',cursive; font-size:11px; color:#735c00; margin-top:2px;">Antes del 1 de Junio</span>
                        </a>
                    </div>

                    <!-- Card Mesa de Regalos -->
                    <div class="max-w-md mx-auto mt-4 mb-8">
                        <a href="#" style="background-color:rgba(255,253,240,0.5);" class="ripple-button group flex flex-col items-center justify-center p-8 bg-white/50 backdrop-blur-sm rounded-3xl border border-primary/5 hover:bg-white/70 transition-all duration-500 relative overflow-hidden scroll-reveal">
                            <div class="w-12 h-12 rounded-full bg-primary/5 text-primary flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-2xl" data-icon="card_giftcard">card_giftcard</span>
                            </div>
                            <span style="font-family:'Bubblegum Sans',cursive; font-size:13px; color:#4d4635; letter-spacing:0.15em; text-transform:uppercase;">Mesa de Regalos</span>
                            <span style="font-family:'Itim',cursive; font-size:11px; color:#735c00; margin-top:2px;">Ver lista de regalos</span>
                        </a>
                    </div>

                </div>
            </section>

            <!-- Footer (imagen local con fade superior) -->
            <div style="position:relative; width:100%; height:300px; overflow:hidden; background-color:#f8f9ff; margin-top:-2px;">
                <img
                    alt="Campo de flores silvestres"
                    style="width:100%; height:100%; object-fit:cover; object-position:center bottom; display:block;"
                    src="/images/background.jpg"
                />
                <div style="position:absolute; top:0; left:0; right:0; height:55%; background:linear-gradient(to bottom, #f8f9ff 0%, transparent 100%); pointer-events:none; z-index:1;"></div>
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
    font-family: 'Itim', cursive;
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

<template>
    <div class="location-root">

        <!-- Fondo con imagen local watermark -->
        <div class="fixed inset-0 pointer-events-none"
             style="background-image: url('/images/background.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; opacity: 0.08; z-index: -1;"></div>

        <!-- Header con imagen local + fade -->
        <header style="position:relative; width:100%; background:#f8f9ff;">
            <div style="position:relative; width:100%; height: clamp(200px, 42vw, 360px); overflow:hidden;">
                <img src="/images/background.jpg" alt=""
                     style="width:100%; height:100%; object-fit:cover; object-position:center top; display:block;" />
                <!-- fade superior -->
                <div style="position:absolute; top:0; left:0; right:0; height:20%; background: linear-gradient(to bottom, #f8f9ff 0%, transparent 100%); pointer-events:none;"></div>
                <!-- fade inferior -->
                <div style="position:absolute; bottom:0; left:0; right:0; height:80%; background: linear-gradient(to bottom, transparent 0%, rgba(248,249,255,0.55) 45%, #f8f9ff 100%); pointer-events:none;"></div>
            </div>
        </header>

        <!-- Main -->
        <main class="px-4 md:px-10 pb-32 md:pb-16 pt-6">
            <div class="max-w-2xl mx-auto">

                <!-- Título -->
                <div class="scroll-reveal text-center mb-8">
                    <h1 style="font-family:'Bubblegum Sans',cursive; font-size:clamp(1.6rem,5vw,2.4rem); color:#735c00; margin-bottom:8px;">
                        Ubicación del Evento
                    </h1>
                    <!-- Divider con abejita -->
                    <div class="flex items-center justify-center gap-3" style="opacity:0.55;">
                        <div style="width:3rem; height:1px; background:rgba(115,92,0,0.3);"></div>
                        <span style="font-size:1.1rem;">🐝</span>
                        <div style="width:3rem; height:1px; background:rgba(115,92,0,0.3);"></div>
                    </div>

                </div>

                <!-- Card Ubicación -->
                <div class="scroll-reveal rounded-3xl overflow-hidden"
                     style="background-color:rgba(255,253,240,0.5); border:1px solid rgba(255,255,255,0.6); box-shadow:0 10px 25px -5px rgba(0,0,0,0.1),0 8px 10px -6px rgba(0,0,0,0.1); backdrop-filter:blur(8px);">

                    <div class="p-6 md:p-8">

                        <!-- Nombre del salón -->
                        <div class="text-center mb-6">
                            <span class="material-symbols-outlined text-primary/50 text-2xl mb-4 block" style="font-variation-settings: 'FILL' 1;">location_on</span>
                            <h2 style="font-family:'Bubblegum Sans',cursive; font-size:1.5rem; color:#4d4635; margin-bottom:6px;">
                                Salón de Eventos "El Trébol" (local B)
                            </h2>
                            <p style="font-family:'Itim',cursive; font-size:15px; color:#735c00; line-height:1.6;">
                                28984 Cdad. de Villa de Álvarez, Col.
                            </p>
                        </div>
                         <!-- Foto del salón -->
                        <div class="rounded-2xl overflow-hidden mb-6"
                             style="border:1px solid rgba(251,211,77,0.3);">
                            <img src="https://lh3.googleusercontent.com/gps-cs-s/APNQkAHcaA3OUw3vlpXdHlzQIcLuTgChbxfjpKHQUwISQBUkQ40bBclHL01nQZDSCobitZbUszWURlKN-hb_MmxXUBXnsVkjcIC4YmEol59GnUh0tTwYqj1lbnKm29mQysyTpvDXCXdA=s1360-w1360-h1020-rw"
                                 alt="Salón de Eventos El Trébol"
                                 style="width:100%; height:200px; object-fit:cover; object-position:center; display:block;" />
                        </div>
                <div class="overflow-hidden rounded-3xl bg-white/50 backdrop-blur-sm border border-primary/5 shadow-sm scroll-reveal">
                    <div class="px-6 pt-6 pb-4 text-center">
                        <span class="material-symbols-outlined text-primary/50 text-2xl mb-2 block" style="font-variation-settings: 'FILL' 1;">on_device_training</span>
                        <p class="font-label text-[10px] uppercase tracking-[0.3em] text-on-surface-variant/60 mb-1">Cómo llegar</p>
                        <p class="font-headline italic text-on-surface-variant text-sm">Te esperamos aquí</p>
                    </div>
                      <div style="height:260px;">
                        <iframe
                                title="Mapa del evento"
                                width="100%"
                                height="100%"
                                style="border:0; display:block; filter:grayscale(1) contrast(0.88) brightness(1.06);"
                                loading="lazy"
                                allowfullscreen
                                referrerpolicy="no-referrer-when-downgrade"
                                src="https://maps.google.com/maps?q=19.2641668,-103.7837397&z=16&output=embed">
                            </iframe>
                      </div>
                    <!-- <img src="/images/croquis.png" alt="Croquis del lugar" class="w-full object-contain" /> -->
                </div>


                        <!-- Mapa embebido (tema gris) -->
                        <!-- <div class="rounded-2xl overflow-hidden mb-6 relative"
                             style="height:260px; border:1.5px solid rgba(251,211,77,0.35);">
                            <iframe
                                title="Mapa del evento"
                                width="100%"
                                height="100%"
                                style="border:0; display:block; filter:grayscale(1) contrast(0.88) brightness(1.06);"
                                loading="lazy"
                                allowfullscreen
                                referrerpolicy="no-referrer-when-downgrade"
                                src="https://maps.google.com/maps?q=19.2641668,-103.7837397&z=16&output=embed">
                            </iframe>
                        </div> -->


                        <!-- Detalles fecha/hora -->
                        <!-- <div class="flex gap-3 mb-6">
                            <div class="flex-1 rounded-2xl p-4 text-center"
                                 style="background:rgba(251,211,77,0.12); border:1px solid rgba(251,211,77,0.25);">
                                <span class="material-symbols-outlined block mb-1" style="color:#735c00; font-size:1.25rem;">calendar_today</span>
                                <p style="font-family:'Bubblegum Sans',cursive; font-size:1rem; color:#735c00;">Sábado 20</p>
                                <p style="font-family:'Itim',cursive; font-size:12px; color:#4d4635;">de Junio, 2026</p>
                            </div>
                            <div class="flex-1 rounded-2xl p-4 text-center"
                                 style="background:rgba(251,211,77,0.12); border:1px solid rgba(251,211,77,0.25);">
                                <span class="material-symbols-outlined block mb-1" style="color:#735c00; font-size:1.25rem;">schedule</span>
                                <p style="font-family:'Bubblegum Sans',cursive; font-size:1rem; color:#735c00;">1:00 – 7:00</p>
                                <p style="font-family:'Itim',cursive; font-size:12px; color:#4d4635;">pm</p>
                            </div>
                        </div> -->

                        <!-- Botón Google Maps -->
                         <br><br>
                        <a href="https://www.google.com/maps/place/Sal%C3%B3n+de+eventos+%22El+Tr%C3%A9bol%22/@19.275199,-103.7822294,13.34z/data=!4m15!1m8!3m7!1s0x8425453ee675017d:0xb7b213275f421382!2sCdad.+de+Villa+de+%C3%81lvarez,+Col.,+M%C3%A9xico!3b1!8m2!3d19.2662338!4d-103.7390574!16s%2Fm%2F02q1744!3m5!1s0x842545b5a172e3cb:0x5a94803413497f21!8m2!3d19.2641668!4d-103.7837397!16s%2Fg%2F11sdq46__1?hl=es-419&entry=ttu&g_ep=EgoyMDI2MDUyMC4wIKXMDSoASAFQAw%3D%3D"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="scroll-reveal flex items-center justify-center gap-2 w-full py-4 rounded-full transition-all hover:opacity-90 hover:scale-[1.02]"
                           style="background:#fbd34d; color:#715b00; font-family:'Bubblegum Sans',cursive; font-size:1rem; letter-spacing:0.05em; box-shadow:0 4px 12px rgba(251,211,77,0.4);">
                            <span class="material-symbols-outlined" style="font-size:1.1rem;">map</span>
                            Abrir en Google Maps
                        </a>
                        <!-- Aviso alberca --><br><br>
                        <div class="scroll-reveal flex items-start gap-3 rounded-2xl p-4 mb-6"
                             style="background:rgba(200,235,255,0.45); border:1px solid rgba(100,180,255,0.3);">
                            <span class="material-symbols-outlined mt-0.5" style="color:#3a88c5; font-size:1.4rem; flex-shrink:0; font-variation-settings:'FILL' 1;">pool</span>
                            <div>
                                <p style="font-family:'Bubblegum Sans',cursive; font-size:14px; color:#2a5f8a; margin-bottom:2px;">¡El salón cuenta con alberca!</p>
                                <p style="font-family:'Itim',cursive; font-size:13px; color:#3a6e99; line-height:1.5;">Te recomendamos traer traje de baño y ropa de cambio  👙🩱</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </main>

        <!-- Footer con imagen local -->
        <div style="position:relative; width:100%; height:220px; overflow:hidden; background:#f8f9ff;">
            <img src="/images/background.jpg" alt=""
                 style="width:100%; height:100%; object-fit:cover; object-position:center bottom; display:block;" />
            <div style="position:absolute; top:0; left:0; right:0; height:60%; background:linear-gradient(to bottom, #f8f9ff 0%, transparent 100%); pointer-events:none; z-index:1;"></div>
        </div>

        <!-- Bottom nav mobile -->
        <nav class="fixed bottom-0 left-0 w-full md:hidden z-50 flex justify-around items-center px-4 pb-4 pt-2"
             style="background:rgba(255,255,255,0.88); backdrop-filter:blur(12px); border-top:1px solid rgba(251,211,77,0.3); border-radius:1.5rem 1.5rem 0 0;">
            <a href="/" class="flex flex-col items-center justify-center gap-1 py-1 px-3 rounded-full transition-all"
               style="color:#4d4635;">
                <span class="material-symbols-outlined" style="font-size:1.25rem; font-variation-settings:'FILL' 0;">mail</span>
                <span style="font-family:'Itim',cursive; font-size:10px;">Invitación</span>
            </a>
            <div class="flex flex-col items-center justify-center gap-1 py-1 px-5 rounded-full"
                 style="background:rgba(251,211,77,0.25); color:#735c00;">
                <span class="material-symbols-outlined" style="font-size:1.25rem; font-variation-settings:'FILL' 1;">location_on</span>
                <span style="font-family:'Itim',cursive; font-size:10px; font-weight:700;">Lugar</span>
            </div>
        </nav>

    </div>
</template>

<script setup>
import { onMounted, onUnmounted } from 'vue';

let revealObserver = null;

onMounted(() => {
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
.location-root {
    position: relative;
    min-height: 100vh;
    background-color: #f8f9ff;
    overflow-x: hidden;
}
@keyframes pin-bounce {
    0%, 100% { transform: translateY(0); }
    50%       { transform: translateY(-8px); }
}
.map-preview-link {
    display: block;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.map-preview-link:hover {
    transform: scale(1.01);
    box-shadow: 0 6px 20px rgba(115,92,0,0.15);
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
</style>

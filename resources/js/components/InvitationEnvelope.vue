<template>
    <div class="absolute inset-0 w-full h-full">
    <div class="absolute inset-0 w-full h-full bg-img-full z-0 flex flex-col items-center justify-center">
        <!-- Overlay sutil para dar profundidad sin tapar la imagen -->
        <div class="absolute inset-0 z-0" style="background: rgba(255,255,255,0.08);"></div>
        <!-- Interactive Envelope -->
        <div class="envelope-container relative z-10">
            <!-- Wrapper con animación de abeja flotando -->
            <div class="envelope-wrapper" :class="{ 'is-animating': isOpen }">
                <div class="envelope" :class="{ 'is-open': isOpen }" @click="openEnvelope">
                    <div class="envelope-flap flex justify-center"></div>
                    <div class="envelope-front-left"></div>
                    <div class="envelope-front-right"></div>
                    <div class="envelope-front-bottom"></div>

                    <!-- Inner Card Preview -->
                    <div class="card shadow-soft-amber p-4 text-center">
                        <span class="font-display-name text-headline-md text-primary mb-2">Naiara Sofía</span>
                        <span class="font-body-sm text-on-surface-variant">Estás invitado...</span>
                        <div class="flex justify-center items-center gap-2 mt-4">
                            <span class="w-1 h-1 rounded-full bg-primary-container"></span>
                            <span class="w-2 h-2 rounded-full bg-primary-container"></span>
                            <span class="w-1 h-1 rounded-full bg-primary-container"></span>
                        </div>
                    </div>

                    <!-- Front Text -->
                    <div
                        class="absolute inset-0 flex items-center justify-center z-20 pointer-events-none transition-opacity duration-300"
                        :style="{ opacity: isOpen ? 0 : 1 }"
                    ></div>
                </div>
            </div>

            <!-- Sombra que se achica cuando el sobre "sube" -->
            <div class="envelope-shadow"></div>

            <!-- Instructions -->
            <div
                class="absolute -bottom-16 left-0 right-0 text-center transition-opacity duration-300 animate-pulse"
                :style="{ opacity: isOpen ? 0 : 0.7 }"
            >
                <p class="font-label-sm text-on-surface-variant bg-white/60 backdrop-blur-md rounded-full py-2 px-6 inline-block">
                    Toca el sobre para abrir
                </p>
            </div>
        </div>
    </div>

    <!-- Countdown Overlay -->
    <Transition name="countdown-fade">
        <div
            v-if="showCountdown"
            class="absolute inset-0 z-[200] flex flex-col items-center justify-center"
            style="background: radial-gradient(ellipse at center, #fffde7 0%, #fff8e1 60%, #ffd54f33 100%); backdrop-filter: blur(8px);"
        >
            <div class="flex flex-col items-center gap-6">
                <div class="bee-countdown-emoji text-8xl select-none">🐝</div>
                <div
                    class="countdown-number font-bold text-primary leading-none select-none"
                    style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 96px; color: #735c00; text-shadow: 0 4px 24px rgba(115,92,0,0.18);"
                >
                    {{ countdown }}
                </div>
                <p style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 18px; color: #715b00; opacity: 0.75; letter-spacing: 0.05em;">
                    Preparando tu invitación...
                </p>
            </div>
        </div>
    </Transition>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const emit = defineEmits(['open']);

const isOpen = ref(false);
const showCountdown = ref(false);
const countdown = ref(3);

// Precargar audio para que no haya delay al dar click
const bgAudio = new Audio('/audio/InsideOut_trim.mp3');
bgAudio.preload = 'auto';
bgAudio.volume = 0.8;
bgAudio.playbackRate = 0.8;

function openEnvelope() {
    if (isOpen.value) return;

    isOpen.value = true;

    // Iniciar countdown inmediatamente al dar click
    showCountdown.value = true;
    countdown.value = 3;

    setTimeout(() => { countdown.value = 2; }, 1000);
    setTimeout(() => { countdown.value = 1; }, 2000);
    setTimeout(() => {
        showCountdown.value = false;
        // Reproducir audio al terminar el countdown
        bgAudio.play().catch(() => {});
        emit('open');
    }, 3000);
}
</script>

<style>
.bee-countdown-emoji {
    animation: bee-bounce 0.5s ease-in-out infinite alternate;
    display: inline-block;
    filter: drop-shadow(0 8px 16px rgba(115,92,0,0.2));
}
@keyframes bee-bounce {
    from { transform: translateY(0) rotate(-5deg); }
    to   { transform: translateY(-16px) rotate(5deg); }
}
.countdown-number {
    transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.2s ease;
    animation: pop-in 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
}
@keyframes pop-in {
    from { transform: scale(0.5); opacity: 0; }
    to   { transform: scale(1);   opacity: 1; }
}
.countdown-fade-enter-active,
.countdown-fade-leave-active {
    transition: opacity 0.4s ease;
}
.countdown-fade-enter-from,
.countdown-fade-leave-to {
    opacity: 0;
}
</style>

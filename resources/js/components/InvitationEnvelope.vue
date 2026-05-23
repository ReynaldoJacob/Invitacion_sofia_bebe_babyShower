<template>
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
</template>

<script setup>
import { ref } from 'vue';

const isOpen = ref(false);

function openEnvelope() {
    if (isOpen.value) return;

    isOpen.value = true;

    setTimeout(() => {
        // Aquí puedes navegar a la siguiente vista:
        // window.location.href = '/invitacion';
        console.log('Navegar a los detalles de la invitación');

        setTimeout(() => {
            isOpen.value = false;
        }, 3000);
    }, 1500);
}
</script>

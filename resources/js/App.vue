<template>
    <Transition name="page-fade" mode="out-in">
        <InvitationEnvelope v-if="currentView === 'envelope'" key="envelope" @open="currentView = 'invitation'" />
        <InvitationDetails v-else key="invitation" />
    </Transition>
</template>

<script setup>
import { ref } from 'vue';
import InvitationEnvelope from './components/InvitationEnvelope.vue';
import InvitationDetails from './components/InvitationDetails.vue';

const currentView = ref('envelope');
</script>

<style>
.page-fade-enter-active,
.page-fade-leave-active {
    transition: opacity 0.6s ease;
}
.page-fade-enter-from,
.page-fade-leave-to {
    opacity: 0;
}
</style>

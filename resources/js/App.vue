<template>
    <Transition name="page-fade" mode="out-in">
        <InvitationEnvelope v-if="currentView === 'envelope'" key="envelope" @open="onEnvelopeOpen" />
        <InvitationDetails v-else key="invitation" />
    </Transition>
</template>

<script setup>
import { ref } from 'vue';
import InvitationEnvelope from './components/InvitationEnvelope.vue';
import InvitationDetails from './components/InvitationDetails.vue';

const alreadyOpened = sessionStorage.getItem('invitation_opened') === '1';
const currentView = ref(alreadyOpened ? 'invitation' : 'envelope');

function onEnvelopeOpen() {
    sessionStorage.setItem('invitation_opened', '1');
    currentView.value = 'invitation';
}
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

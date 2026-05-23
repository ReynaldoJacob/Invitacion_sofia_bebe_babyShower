<template>
    <Transition name="page-fade" mode="out-in">
        <InvitationEnvelope
            v-if="currentView === 'envelope'"
            key="envelope"
            :guest-name="guestName"
            @open="onEnvelopeOpen"
        />
        <InvitationDetails
            v-else
            key="invitation"
            :guest-name="guestName"
            :link-id="linkId"
        />
    </Transition>
</template>

<script setup>
import { ref } from 'vue';
import { useRoute } from 'vue-router';
import InvitationEnvelope from './components/InvitationEnvelope.vue';
import InvitationDetails from './components/InvitationDetails.vue';

const route = useRoute();
const guestName = route.query.nombre || '';
const linkId    = route.query.link_id || '';

// Cada link_id tiene su propio estado: así el sobre siempre se muestra la primera vez
const sessionKey   = linkId ? `invitation_opened_${linkId}` : 'invitation_opened';
const alreadyOpened = sessionStorage.getItem(sessionKey) === '1';
const currentView   = ref(alreadyOpened ? 'invitation' : 'envelope');

function onEnvelopeOpen() {
    sessionStorage.setItem(sessionKey, '1');
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

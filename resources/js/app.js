import './bootstrap';
import { createApp, defineComponent, h } from 'vue';
import { createRouter, createWebHistory, RouterView } from 'vue-router';
import HomeApp from './App.vue';
import EventLocation from './components/EventLocation.vue';
import ConfirmAttendance from './components/ConfirmAttendance.vue';
import AdminPanel from './components/AdminPanel.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component: HomeApp },
        { path: '/lugar', component: EventLocation },
        { path: '/rsvp', component: ConfirmAttendance },
        { path: '/admin', component: AdminPanel },
    ],
});

const Shell = defineComponent({ render: () => h(RouterView) });
createApp(Shell).use(router).mount('#app');

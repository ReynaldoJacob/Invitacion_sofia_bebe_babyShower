import './bootstrap';
import { createApp, defineComponent, h } from 'vue';
import { createRouter, createWebHistory, RouterView } from 'vue-router';
import HomeApp from './App.vue';
import EventLocation from './components/EventLocation.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component: HomeApp },
        { path: '/lugar', component: EventLocation },
    ],
});

const Shell = defineComponent({ render: () => h(RouterView) });
createApp(Shell).use(router).mount('#app');

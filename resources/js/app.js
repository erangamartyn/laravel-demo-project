import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from 'vue';

import Follow from "./components/Follow.vue";

const app = createApp({
    components: {
        Follow,
    },
});

app.mount("#app");






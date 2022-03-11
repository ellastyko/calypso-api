require('./bootstrap');

import  { createApp } from 'vue';
import VueCookies from 'vue-cookies'
import store from './store/index';
import components from "./components";
import PrimeVue from 'primevue/config';

const app = createApp({
    components
});

app.use(
    store,
    VueCookies,
    PrimeVue
);

app.mount("#app");


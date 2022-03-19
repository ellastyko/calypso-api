import router from "./router";

require('./bootstrap');

import  { createApp } from 'vue';

import VueCookies from 'vue-cookies'
import Store from './store/index';
import components from "./components";

// PrimeVue
import PrimeVue from 'primevue/config';
import 'primevue/resources/themes/bootstrap4-light-blue/theme.css';
import 'primevue/resources/primevue.css';
import 'primeicons/primeicons.css';

const app = createApp({
    components
});

app.use(
    Store,
    VueCookies,
    PrimeVue,
    router
);

app.mount("#app");


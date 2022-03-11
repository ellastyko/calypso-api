require('./bootstrap');

import  { createApp } from 'vue';
import VueCookies from 'vue-cookies'
import store from './store/index';


const app = createApp({
    components
});

app.use(
    store,
    VueCookies
);

app.mount("#app");


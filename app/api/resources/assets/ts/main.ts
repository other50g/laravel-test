import Vue from 'vue';
import App from './App.vue';

import router from './router';

import bootstrap from './bootstrap';

bootstrap();

const app = new Vue({
    el: '#app',
    router,
    render: h => h(App)
})

import './bootstrap';
import Vue from 'vue';
import router from './router';

import App from './layouts/App.vue';

new Vue({
    router,
    render: h => h(App),
}).$mount('#app');

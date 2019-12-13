require('./bootstrap');

window.Vue = require('vue');

Vue.component('component', require('./components/Component.vue').default);
Vue.component('reniec', require('./components/Reniec.vue').default);
Vue.component('registro', require('./components/Registro.vue').default);
Vue.component('tablaregistro', require('./components/Tablaregistro.vue').default);

const app = new Vue({
    el: '#app',
});
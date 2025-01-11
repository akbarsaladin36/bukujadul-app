import Vue from 'vue';
import router from './router'
import 'bootstrap';

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    router,
});

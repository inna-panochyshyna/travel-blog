
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import BootstrapVue from 'bootstrap-vue';

Vue.use(VueRouter);
Vue.use(BootstrapVue);

import App from './components/App'
import CarouselMain from './components/CarouselMain'
import About from './components/About'
import Posts from './components/Posts'
import Post from './components/Post'
import Contact from './components/Contact'


const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '',
            name: 'home',
            component: CarouselMain
        },
        {
            path: '/about',
            name: 'about',
            component: About
        },
        {
            path: '/posts',
            name: 'posts',
            component: Posts
        },
        {
            path: '/posts/:id',
            name: 'post',
            component: Post
        },
        {
            path: '/contact',
            name: 'contact',
            component: Contact
        }
    ],
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('about-component', require('./components/AboutUs.vue'));
// Vue.component('contact-component', require('./components/Contact.vue'));

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
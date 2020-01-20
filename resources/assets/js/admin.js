
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import BootstrapVue from 'bootstrap-vue';
import VueGoodTablePlugin from 'vue-good-table';
import 'vue-good-table/dist/vue-good-table.css';
import CKEditor from '@ckeditor/ckeditor5-vue';

Vue.use(VueRouter);
Vue.use(BootstrapVue);
Vue.use(VueGoodTablePlugin);
Vue.use( CKEditor );

Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');

import Admin from './components/dashboard/Admin'
import UserMain from './components/dashboard/UserMain'
import UserPosts from './components/dashboard/posts/UserPosts'
import UserPostCreate from './components/dashboard/posts/UserPostCreate'
import UserPostShow from './components/dashboard/posts/UserPostShow'
import UserComments from './components/dashboard/comments/UserComments'
import UserCommentShow from './components/dashboard/comments/UserCommentShow'
import AdminMain from './components/dashboard/AdminMain'
import AdminUsers from './components/dashboard/users/AdminUsers'
import AdminUserShow from './components/dashboard/users/AdminUserShow'
import AdminCategories from './components/dashboard/categories/AdminCategories'
import AdminCategoriesCreate from './components/dashboard/categories/AdminCategoriesCreate'
import AdminPosts from './components/dashboard/posts/AdminPosts'
import AdminPostShow from './components/dashboard/posts/AdminPostShow'
import AdminComments from './components/dashboard/comments/AdminComments'
import AdminCommentShow from './components/dashboard/comments/AdminCommentShow'
import AdminMessages from './components/dashboard/messages/AdminMessages'
import AdminMessageShow from './components/dashboard/messages/AdminMessageShow'


const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/dashboard',
            name: 'main',
            component: UserMain
        },
        {
            path: '/dashboard/posts',
            name: 'userPosts',
            component: UserPosts
        },
        {
            path: '/dashboard/posts/create',
            name: 'createPost',
            component: UserPostCreate
        },
        {
            path: '/dashboard/posts/show/:id',
            name: 'showPost',
            component: UserPostShow
        },
        {
            path: '/dashboard/comments',
            name: 'userComments',
            component: UserComments
        },
        {
            path: '/dashboard/comments/show/:id',
            name: 'showComment',
            component: UserCommentShow
        },
        {
            path: '/dashboard/admin',
            name: 'mainAdmin',
            component: AdminMain
        },
        {
            path: '/dashboard/admin/users',
            name: 'adminUsers',
            component: AdminUsers
        },
        {
            path: '/dashboard/admin/users/show/:id',
            name: 'showUser',
            component: AdminUserShow
        },
        {
            path: '/dashboard/admin/categories',
            name: 'adminCategories',
            component: AdminCategories
        },
        {
            path: '/dashboard/admin/categories/create',
            name: 'adminCategoriesCreate',
            component: AdminCategoriesCreate
        },
        {
            path: '/dashboard/admin/posts',
            name: 'adminPosts',
            component: AdminPosts
        },
        {
            path: '/dashboard/admin/posts/show/:id',
            name: 'showPostAdmin',
            component: AdminPostShow
        },
        {
            path: '/dashboard/admin/comments',
            name: 'adminComments',
            component: AdminComments
        },
        {
            path: '/dashboard/admin/comments/show/:id',
            name: 'showCommentAdmin',
            component: AdminCommentShow
        },
        {
            path: '/dashboard/admin/messages',
            name: 'adminMessages',
            component: AdminMessages
        },
        {
            path: '/dashboard/admin/messages/show/:id',
            name: 'showMessageAdmin',
            component: AdminMessageShow
        },
    ],
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('about-component', require('./components/AboutUs.vue'));
// Vue.component('contact-component', require('./components/Contact.vue'));

const admin = new Vue({
    el: '#admin',
    components: { Admin },
    router,
});

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import VeeValidate from 'vee-validate';


window.Vue = require('vue');
Vue.use(VeeValidate);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('articles', require('./components/Articles.vue'));
Vue.component('durations', require('./components/Durations.vue'));
Vue.component('events', require('./components/Events.vue'));
Vue.component('subjects', require('./components/Subjects.vue'));
Vue.component('timetables', require('./components/Timetables.vue'));
Vue.component('assignments', require('./components/Assignments.vue'));
Vue.component('exams', require('./components/Exams.vue'));
Vue.component('books', require('./components/Books.vue'));
Vue.component('users', require('./components/Users.vue'));
Vue.component('roles', require('./components/Roles.vue'));
Vue.component('profile', require('./components/Profile.vue'));
Vue.component('eduyears', require('./components/Eduyears.vue'));
Vue.component('rooms', require('./components/Rooms.vue'));
Vue.component('settings', require('./components/Settings.vue'));



const app = new Vue({
    el: '#app'
});

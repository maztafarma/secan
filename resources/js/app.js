/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.moment = require('moment');
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });


window.onload = function () {

    if (document.getElementById('seoManager'))
        require('./cms/seo');

    if (document.getElementById('bannerManager'))
        require('./cms/banner');

    if (document.getElementById('newsManager'))
        require('./cms/news');

    if (document.getElementById('videoManager'))
        require('./cms/video');

    if (document.getElementById('tagManager'))
        require('./cms/tag');

    if (document.getElementById('categoryManager'))
        require('./cms/category');

    if (document.getElementById('doctorManager'))
        require('./cms/doctor');

}

window.showLoading = () => {
    HoldOn.open({
        theme: "sk-circle"
    });
}

window.hideLoading = () => {
    HoldOn.close();
}

window.notify = (title, text, type) => {
    new PNotify({
        title: title,
        text: text,
        type: type,
        styling: 'bootstrap3'
    });
}


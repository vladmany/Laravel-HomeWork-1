/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// ES6 Modules or TypeScript

window.Vue = require('vue');

// window.swal = require('sweetalert2');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('adminpanel-users', require('./components/adminPanel/Users.vue').default);
Vue.component('adminpanel-genres', require('./components/adminPanel/Genres.vue').default);
Vue.component('adminpanel-books', require('./components/adminPanel/Books.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

//Add class for errors
$('input',$('.invalid-feedback').parent()).addClass('is-invalid');
$('textarea',$('.invalid-feedback').parent()).addClass('is-invalid');


//Preview uploaded images
if($('.img-preview').css('background-image') != 'none')
    $('.img-preview').removeClass('d-none');

$('.img-input-prev').change(function () {
    var input = $(this)[0];
    if (input.files && input.files[0]) {
        if (input.files[0].type.match('image.*')) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.img-preview').css('background-image', 'url(' + e.target.result + ')');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    if($('.img-preview').css('background-image'))
        $('.img-preview').removeClass('d-none');
});

$('.book-body').change(function () {
    var input = $(this)[0];
    if (input.files && input.files[0]) {
        let name = input.files[0].name.toString();
        let extension = name.slice(name.lastIndexOf('.'));
        if (extension === '.fb2') {
            var reader = new FileReader();
            reader.onload = function (e) {
                let text = e.target.result;
                let parser = new DOMParser();
                let xmlDoc = parser.parseFromString(text,"text/xml");
                let description = $('description', xmlDoc);
                let title_info = $('title-info', description);
                let book = {};
                book.title = $('book-title', title_info).text().trim();
                $('.book-title').val(book.title);
                book.annotation = $('annotation', title_info).text().trim();
                $('.book-annotation').val(book.annotation);
                book.author = $('first-name', $('author', title_info)).text().trim() + ' ' + $('last-name', $('author', title_info)).text().trim();
                $('.book-author').val(book.author);
                book.year = $('date', title_info).text().trim();
                $('.book-year').val(book.year);
            }
            reader.readAsText(input.files[0]);
        }
    }
});

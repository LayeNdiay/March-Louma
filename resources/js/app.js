/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue'
// window.Vue = Vue;
require('./bootstrap');


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('carousel', require('./components/carousel.vue').default);
Vue.component('carousel-slide', require('./components/carouselSlide.vue').default);
Vue.component('lightbox', require('./components/Lightbox.vue').default);

Vue.component('lightbox-image', require('./components/LightboxImage.vue').default);
Vue.component('search', require('./components/Search.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.config.ignoredElements =["appDetails"]

const app = new Vue({
    el: '#app',
    data() {
        return {
            parent:true,
            original:null,
            id: null,
            i:0,
        }

    },
    mounted () {
        
        this.original = document.querySelector("#original").cloneNode(true);
        this.parent =document.querySelector("#detail")
        
        
    },
    methods : {
        addDetails: function(){
            this.id= "copy" + this.i++
        let clone =  this.original.cloneNode(true)
            clone.id=this.id
            this.parent.appendChild(clone)
        },
        deleteDetail : function() {
                $("#detail").on("click",".supprimer" ,function () {
                $(this).parent().parent().remove();
            })
        }
    },






});

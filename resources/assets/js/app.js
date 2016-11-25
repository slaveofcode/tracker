
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){
    $('#input-tracker').focus();
});

const app = new Vue({
    el: '#input-tracker',
    data: {
        tracker_name: ''
    },
    methods: {
        create: function(event){
            if (event.keyCode == 13) {
                $.post({
                    url: '/tracker/create',
                    data: {
                        name: this.tracker_name
                    },
                    success: function(r){
                        if (r.created) {
                            // redirect to track/<r.tracker> using vue
                        }
                    },
                    dataType: 'json'
                });
            }
        }
    }
});
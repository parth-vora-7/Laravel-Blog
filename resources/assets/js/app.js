
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

/*Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});*/

import Echo from "laravel-echo"

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: 'http://blog.local:6001'
});

window.Echo.channel('new-comment')
    .listen('NewCommentEvent', (data) => {
    	var ele = $('.comment-container:first h3');
    	if(ele.length) {
			ele.after('<p class="text-center text-warning">A new comment has been posted. Please reload the page to view it.</p>');
    	}
});

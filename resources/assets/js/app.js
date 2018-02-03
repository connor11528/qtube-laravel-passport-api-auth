
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

// Routing
import router from './routes'

router.beforeEach((to, from, next) => {
    window.scrollTo(0,0);
    next(true);
});

// Progress bar
import VueProgressBar from 'vue-progressbar'

const options = {
	color: '#bffaf3',
	failedColor: '#874b4b',
	thickness: '5px',
	transition: {
		speed: '0.2s',
		opacity: '0.6s',
		termination: 300
	},
	autoRevert: true,
	location: 'left',
	inverse: false
};

Vue.use(VueProgressBar, options);

const app = new Vue({
    router,
    el: '#app'
});

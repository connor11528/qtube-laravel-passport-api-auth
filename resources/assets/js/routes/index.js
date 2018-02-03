import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router);

import HomePage from '../components/pages/HomePage.vue'
import SubscriptionPage from '../components/pages/SubscriptionPage'
import TrendingPage from '../components/pages/TrendingPage'

export default new Router({
	// mode: 'history', // to enable html5 history api
	routes: [
		{
			path: '/',
			name: 'HomePage',
			component: HomePage
		},
		{
			path: '/trending',
			name: 'TrendingPage',
			component: TrendingPage
		},
		{
			path: '/subscriptions',
			name: 'SubscriptionPage',
			component: SubscriptionPage
		}
	]
})
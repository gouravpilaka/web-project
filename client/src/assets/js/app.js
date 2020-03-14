new Vue({
	     el: "#app",
	     data: {
	        message: 'Hello Vue from PHP!'
	     }
	 });
	 
	 const Home = { template: '<div> Home page </div>' };
     const About = { template: '<div> About page </div>' };
     
     const routes = [
		 { path: '', component: Home },
		 { path: '/about', component: About },
		 { path: '*', component: Home }
		];
		
		
	const router = new VueRouter({
	 mode: 'history',
	 routes: routes
	 });
		 
	 const app = new Vue({
		 router: router
		 }).$mount('#app');
		 
		 
 
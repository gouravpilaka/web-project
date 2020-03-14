var app = new Vue({
	el: "#root",
	data: {
		showingAddModal: false,
		showingEditModal: false,
		showingDeleteModal: false,
		errorMessage: "",
		successMessage: "",
		users: [],
		newUser: {username: "", email: "", mobile: "",pass: "", user_type: ""},
		clickedUser: {}
	},

	mounted: function(){
		console.log("mounted");
		this.getAllUsers();
	},

	methods: {
		getAllUsers: function(){
			axios.get("api.php?action=read&table=user")
			.then(function(response){
				if(response.data.error){
					app.errorMessage = response.data.message; 
				} else{
					app.users = response.data.users;
				}
			});
		},

		saveUser: function(){
			//console.log(app.newUser);
			var formData = app.toFormData(app.newUser);

			axios.post("api.php?action=create&table=user", formData)
			.then(function(response){
				
				app.newUser = {username: "", email: "", mobile: "" , user_type: ""};

				if(response.data.error){
					app.errorMessage = response.data.message; 
				} else{
					app.getAllUsers();
				}
			});
		},

		updateUser: function(){
			//console.log(app.newUser);
			var formData = app.toFormData(app.clickedUser);

			axios.post("api.php?action=update&table=user", formData)
			.then(function(response){				
				app.clickedUser = {};
				if(response.data.error){
					app.errorMessage = response.data.message; 
				} else{
					app.successMessage = response.data.message; 
					app.getAllUsers();
				}
			});
		},

		deleteUser: function(){
			//console.log(app.newUser);
			var formData = app.toFormData(app.clickedUser);

			axios.post("api.php?action=delete&table=user", formData)
			.then(function(response){				
				app.clickedUser = {};
				if(response.data.error){
					app.errorMessage = response.data.message; 
				} else{
					app.successMessage = response.data.message; 
					app.getAllUsers();
				}
			});
		},

		selectUser(user){
			//console.log(user);
			app.clickedUser = user;
		},

		toFormData: function(obj){
			var form_data = new FormData();
		      for ( var key in obj ) {
		          form_data.append(key, obj[key]);
		      } 
		      return form_data;
		},

		clearMessage: function(){
			app.errorMessage = "";
			app.successMessage = "";
		}
	}
});
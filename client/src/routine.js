var app = new Vue({
	el: "#root",
	data: {
		showingAddModal: false,
		showingEditModal: false,
		showingDeleteModal: false,
		errorMessage: "",
		successMessage: "",
		routines: [],
		newRoutine: {name: "", name: "", description: "",description: ""},
		clickedRoutine: {}
	},

	mounted: function(){
		console.log("mounted");
		this.getAllRoutines();
	},

	methods: {
		getAllRoutines: function(){
			axios.get("api.php?action=read&table=routine")
			.then(function(response){
				if(response.data.error){
					app.errorMessage = response.data.message; 
				} else{
					app.routines = response.data.routine;
				}
			});
		},

		saveRoutine: function(){
			//console.log(app.newUser);
			var formData = app.toFormData(app.newRoutine);

			axios.post("api.php?action=create&table=routine", formData)
			.then(function(response){
				
				app.newRoutine = {name: "", description: ""};

				if(response.data.error){
					app.errorMessage = response.data.message; 
				} else{
					app.getAllRoutines();
				}
			});
		},

		updateRoutine: function(){
			var formData = app.toFormData(app.clickedRoutine);

			axios.post("api.php?action=update&table=routine", formData)
			.then(function(response){				
				app.clickedRoutine = {};
				if(response.data.error){
					app.errorMessage = response.data.message; 
				} else{
					app.successMessage = response.data.message; 
					app.getAllRoutines();
				}
			});
		},

		deleteRoutine: function(){
			var formData = app.toFormData(app.clickedRoutine);

			axios.post("api.php?action=delete&table=routine", formData)
			.then(function(response){				
				app.clickedRoutine = {};
				if(response.data.error){
					app.errorMessage = response.data.message; 
				} else{
					app.successMessage = response.data.message; 
					app.getAllRoutines();
				}
			});
		},

		selectRoutine(routine){
			//console.log(user);
			app.clickedRoutine = routine;
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
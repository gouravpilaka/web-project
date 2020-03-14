var app = new Vue({
	el: "#root",
	data: {
		showingAddModal: false,
		showingEditModal: false,
		showingDeleteModal: false,
		errorMessage: "",
		successMessage: "",
		exercises: [],
		newExercise: {name: "", name: "", description: "",description: ""},
		clickedExercise: {}
	},

	mounted: function(){
		console.log("mounted");
		this.getAllExercises();
	},

	methods: {
		getAllExercises: function(){
			axios.get("api.php?action=read&table=exercise")
			.then(function(response){
				if(response.data.error){
					app.errorMessage = response.data.message; 
				} else{
					app.exercises = response.data.exercise;
				}
			});
		},

		saveExercise: function(){
			//console.log(app.newUser);
			var formData = app.toFormData(app.newExercise);

			axios.post("api.php?action=create&table=exercise", formData)
			.then(function(response){
				
				app.newExercise = {name: "", description: ""};

				if(response.data.error){
					app.errorMessage = response.data.message; 
				} else{
					app.getAllExercises();
				}
			});
		},

		updateExercise: function(){
			//console.log(app.newUser);
			var formData = app.toFormData(app.clickedExercise);

			axios.post("api.php?action=update&table=exercise", formData)
			.then(function(response){				
				app.clickedExercise = {};
				if(response.data.error){
					app.errorMessage = response.data.message; 
				} else{
					app.successMessage = response.data.message; 
					app.getAllExercises();
				}
			});
		},

		deleteExercise: function(){
			//console.log(app.newUser);
			var formData = app.toFormData(app.clickedExercise);

			axios.post("api.php?action=delete&table=exercise", formData)
			.then(function(response){				
				app.clickedExercise = {};
				if(response.data.error){
					app.errorMessage = response.data.message; 
				} else{
					app.successMessage = response.data.message; 
					app.getAllExercises();
				}
			});
		},

		selectExercise(exercise){
			//console.log(user);
			app.clickedExercise = exercise;
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
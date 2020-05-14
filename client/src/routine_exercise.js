var app = new Vue({
	el: "#root"
	data: {
		showingAddModal: false,
		showingEditModal: false,
		showingDeleteModal: false,
		errorMessage: "",
		successMessage: "",
		routines: [],
		exercises: [],
		routine_exercises: [],
		newRoutineExercise: {routine: "", exercise: ""},
		clickedRoutineExercise: {}
	},

	mounted: function(){
		console.log("mounted");
		this.getAllRoutinesExercise();
		this.getAllRoutines();
		this.getAllExercises();
	},

	methods: {
		getAllRoutinesExercise: function(){
			axios.get("api.php?action=read&table=routine_exercise")
			.then(function(response){
				if(response.data.error){
					app.errorMessage = response.data.message; 
				} else{
					app.routine_exercises = response.data.routine_exercise;
				}
			});
		},
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

		saveRoutineExercise: function(){
			//console.log(app.newUser);
			var formData = app.toFormData(app.newRoutineExercise);

			axios.post("api.php?action=create&table=routine_exercise", formData)
			.then(function(response){
				
				app.newRoutineExercise = {routine: "", exercise: ""};

				if(response.data.error){
					app.errorMessage = response.data.message; 
				} else{
					app.getAllRoutinesExercise();
				}
			});
		},

		updateRoutineExercise: function(){
			var formData = app.toFormData(app.clickedRoutineExercise);

			axios.post("api.php?action=update&table=routine_exercise", formData)
			.then(function(response){				
				app.clickedRoutineExercise = {};
				if(response.data.error){
					app.errorMessage = response.data.message; 
				} else{
					app.successMessage = response.data.message; 
					app.getAllRoutinesExercise();
				}
			});
		},

		deleteRoutineExercise: function(){
			var formData = app.toFormData(app.clickedRoutineExercise);

			axios.post("api.php?action=delete&table=routine_exercise", formData)
			.then(function(response){				
				app.clickedRoutineExercise = {};
				if(response.data.error){
					app.errorMessage = response.data.message; 
				} else{
					app.successMessage = response.data.message; 
					app.getAllRoutinesExercise();
				}
			});
		},

		selectRoutineExercise (routineExercise){
			//console.log(user);
			app.clickedRoutineExercise = routineExercise;
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

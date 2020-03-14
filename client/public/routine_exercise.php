<?php
	session_start();
    include ("connect.php");
	include ("checksession.php");
?>
<!DOCTYPE html>
<head>
	<title>My fitness App</title>
	<link type="text/css" rel="stylesheet" href="../src/assets/css/style.css"/>
	<title>Fitness App</title>
</head>
<body>

	<div class="jumbotron" id="root">
		<div class="container">
			<h3 class="display-3">Welcome, <?php echo $row['username']; ?>!</h3>

		</div>
		<div class="container">
			<!-- Example row of columns -->
			<div class="row">
				<div class="">
					<br>
					<ul class="list-group">
						<li class="list-group-item">
							<a href="users.php" class="" >Users</a>
						</li>
						<?php
						if ($_SESSION['user_type']=="admin"){

						?>
						<li class="list-group-item">
							<a href="exercise.php" class="">Exercises</a>
						</li>
						<?php
						}
						?>
						<li class="list-group-item">
							<a href="routine.php" class="">Routine</a>
						</li>	
						<li class="list-group-item">
							<a href="routine_exercise.php" class="active">Routine Exercises</a>
						</li>			
						<li class="list-group-item">
							<a href="logout.php" class=""><span class="glyphicon glyphicon-log-out"></span> Logout</a>
						</li>
					</ul>
				</div>
				<div class="">
					    <br>
                        <h4 class="fleft">List of Routine Exercises</h4>
					    <br>

						<button class="fright addNew" @click="showingAddModal = true;">
							Add New
						</button>
						<div class="clear"></div>
						<p class="errorMessage" v-if="errorMessage">
							{{errorMessage}}
						</p>

						<p class="successMessage" v-if="successMessage">
							{{successMessage}}
						</p>

						<table class="table stripped">
							<tr>
								<th>ID</th>
								<th>Routine</th>
								<th>Exercise</th>
								
								<th>Action</th>
							</tr>
							<tr v-for="routine_exercise in routine_exercises">
								<td>{{routine_exercise.id}}</td>
								<td>{{routine_exercise.routine_name}}</td>
								<td>{{routine_exercise.exercise_name}}</td>
								<td>
								<button @click="showingEditModal = true; selectRoutine(routine)">
									Edit
								</button>
								<button @click="showingDeleteModal = true; selectRoutine(routine)" class="btn-delete">
									Delete
								</button></td>
							</tr>
						</table>

					

					<div class="modal" id="addModal" v-if="showingAddModal">
						<div class="modalContainer">
							<div class="modalHeading">
								<p class="fleft">
									Add New Routine
								</p>
								<button class="fright close" @click="showingAddModal = false;">
									x
								</button>
								<div class="clear"></div>
							</div>
							<div class="modalContent">
								<table class="form">
									<tr>
										<th>Routine</th>
										<th> : </th>
										<td>
										<select type="text" class="routines" name="" v-model="newRoutineExercise.routine">
											 <option v-for="routine in routines" v-bind:value="routine.id">
										      {{ routine.name }}
										    </option>
												
										</select>
										
										 
										</td>
									</tr>

									<tr>
										<th>Exercise</th>
										<th> : </th>
										<td>
										<select type="text" class="exercises" name="" v-model="newRoutineExercise.exercise">
											<option v-for="exercise in exercises" v-bind:value="exercise.id">
										      {{ exercise.name }}
										    </option>
										</select>
										</td>
									</tr>
	
									<tr>
										<th></th>
										<th></th>
										<td>
										<button @click="showingAddModal = false; saveRoutineExercise();">
											Save
										</button></td>
									</tr>

								</table>
							</div>
						</div>
					</div>

					<div class="modal" id="editModal" v-if="showingEditModal">
						<div class="modalContainer">
							<div class="modalHeading">
								<p class="fleft">
									Edit This Routine
								</p>
								<button class="fright close" @click="showingEditModal = false;">
									x
								</button>
								<div class="clear"></div>
							</div>
							<div class="modalContent">
								<table class="form">
									<tr>
										<th>Routine</th>
										<th> : </th>
										<td>
										<select type="text" class="routines" name="" v-model="clickedRoutineExercise.routine"  v-for="routine in routines">
											<option v-for="routine in routines" v-bind:value="routine.name">
										      {{ routine.name }}
										    </option>
												
										</select>
										</td>
									</tr>

									<tr>
										<th>Exercise</th>
										<th> : </th>
										<td>
										<select type="text" class="exercises" name="" v-model="clickedRoutineExercise.exercise">
											<option v-for="exercise in exercises" v-bind:value="exercise.name">
										      {{ exercise.name }}
										    </option>
										</select>
										</td>
									</tr>

									<tr>
										<th></th>
										<th></th>
										<td>
										<button @click="showingEditModal = false; updateRoutineExercise()">
											Update
										</button></td>
									</tr>

								</table>
							</div>
						</div>
					</div>

					<div class="modal" id="deleteModal" v-if="showingDeleteModal">
						<div class="modalContainer">
							<div class="modalHeading">
								<p class="fleft">
									Are you sure?
								</p>
								<button class="fright close" @click="showingDeleteModal = false;">
									x
								</button>
								<div class="clear"></div>
							</div>
							<div class="modalContent">
								<p>
									You are going to delete '{{clickedRoutineExercise.name}}'.
								</p>
								<br>
								<br>
	
								<button @click="showingDeleteModal = false; deleteRoutineExercise()" class="btn-delete">
									Yes
								</button>
								<button @click="showingDeleteModal = false;">
									No
								</button>
							</div>
						</div>
					</div>

				</div>

			</div>

			<hr>

		</div>

	</div>
	<script src="../src/assets/js/vue.js"></script>
	<script src="../src/assets/js/axios.js"></script>
	<script src="../src/routine_exercise.js"></script>

</body>
</html>
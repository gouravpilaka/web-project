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
							<a href="exercise.php" class="active">Exercises</a>
						</li>
						<?php
						}
						?>
						<li class="list-group-item">
							<a href="routine.php" class="">Routines</a>
						</li>		
						<li class="list-group-item">
							<a href="routine_exercise.php" class="">Routine Exercises</a>
						</li>		
						<li class="list-group-item">
							<a href="logout.php" class=""><span class="glyphicon glyphicon-log-out"></span> Logout</a>
						</li>
					</ul>
				</div>
				<div class="">
					    <br>
                        <h4 class="fleft">List of Exercises</h4>
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
								<th>Name</th>
								<th>Description</th>
								<th>Action</th>
							</tr>
							<tr v-for="exercise in exercises">
								<td>{{exercise.id}}</td>
								<td>{{exercise.name}}</td>
								<td>{{exercise.description}}</td>
								<td>
								<button @click="showingEditModal = true; selectExercise(exercise)">
									Edit
								</button>
								<button @click="showingDeleteModal = true; selectExercise(exercise)" class="btn-delete">
									Delete
								</button></td>
							</tr>
						</table>

					

					<div class="modal" id="addModal" v-if="showingAddModal">
						<div class="modalContainer">
							<div class="modalHeading">
								<p class="fleft">
									Add New Exercise
								</p>
								<button class="fright close" @click="showingAddModal = false;">
									x
								</button>
								<div class="clear"></div>
							</div>
							<div class="modalContent">
								<table class="form">
									<tr>
										<th>name</th>
										<th> : </th>
										<td>
										<input type="text" name="" v-model="newExercise.name">
										</td>
									</tr>

									<tr>
										<th>Description</th>
										<th> : </th>
										<td>
										<input type="text" name="" v-model="newExercise.description">
										</td>
									</tr>

									
									<tr>
										<th></th>
										<th></th>
										<td>
										<button @click="showingAddModal = false; saveExercise();">
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
									Edit This User
								</p>
								<button class="fright close" @click="showingEditModal = false;">
									x
								</button>
								<div class="clear"></div>
							</div>
							<div class="modalContent">
								<table class="form">
									<tr>
										<th>Name</th>
										<th> : </th>
										<td>
										<input type="text" name="" v-model="clickedExercise.name">
										</td>
									</tr>

									<tr>
										<th>Description</th>
										<th> : </th>
										<td>
										<input type="text" name="" v-model="clickedExercise.description">
										</td>
									</tr>

									<tr>
										<th></th>
										<th></th>
										<td>
										<button @click="showingEditModal = false; updateExercise()">
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
									You are going to delete '{{clickedExercise.name}}'.
								</p>
								<br>
								<br>
								<br>
								<br>
								<br>
								<button @click="showingDeleteModal = false; deleteExercise()" class="btn-delete">
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
	<script src="../src/exercise.js"></script>

</body>
</html>
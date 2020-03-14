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
							<a href="users.php" class="active" >Users</a>
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
                        <h4 class="fleft">List of users</h4>
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
								<th>Username</th>
								<th>Email</th>
								<th>Mobile</th>
								<th>Action</th>
							</tr>
							<tr v-for="user in users">
								<td>{{user.id}}</td>
								<td>{{user.username}}</td>
								<td>{{user.email}}</td>
								<td>{{user.mobile}}</td>
								<td>
								<button @click="showingEditModal = true; selectUser(user)">
									Edit
								</button>
								<button @click="showingDeleteModal = true; selectUser(user)" class="btn-delete">
									Delete
								</button></td>
							</tr>
						</table>

					

					<div class="modal" id="addModal" v-if="showingAddModal">
						<div class="modalContainer">
							<div class="modalHeading">
								<p class="fleft">
									Add New User
								</p>
								<button class="fright close" @click="showingAddModal = false;">
									x
								</button>
								<div class="clear"></div>
							</div>
							<div class="modalContent">
								<table class="form">
									<tr>
										<th>Username</th>
										<th> : </th>
										<td>
										<input type="text" name="" v-model="newUser.username">
										</td>
									</tr>

									<tr>
										<th>Email</th>
										<th> : </th>
										<td>
										<input type="text" name="" v-model="newUser.email">
										</td>
									</tr>

									<tr>
										<th>Mobile</th>
										<th> : </th>
										<td>
										<input type="text" name="" v-model="newUser.mobile">
										</td>
									</tr>
									
									<tr>
										<th>User Type</th>
										<th> : </th>
										<td>
										<select type="text" name="" v-model="newUser.user_type">
											<option value="admin">admin</option>
											<option value="user">user</option>								
										</select>
										</td>
									</tr>
									
									<tr>
										<th>Password</th>
										<th> : </th>
										<td>
										<input type="text" name="" v-model="newUser.pass">
										</td>
									</tr>
									

									<tr>
										<th></th>
										<th></th>
										<td>
										<button @click="showingAddModal = false; saveUser();">
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
										<th>Username</th>
										<th> : </th>
										<td>
										<input type="text" name="" v-model="clickedUser.username">
										</td>
									</tr>

									<tr>
										<th>Email</th>
										<th> : </th>
										<td>
										<input type="text" name="" v-model="clickedUser.email">
										</td>
									</tr>

									<tr>
										<th>Mobile</th>
										<th> : </th>
										<td>
										<input v-on:keyup.13="showingEditModal = false; updateUser()" type="text" name="" v-model="clickedUser.mobile">
										</td>
									</tr>
									
									<tr>
										<th>User Type</th>
										<th> : </th>
										<td>
										<select type="text" name="" v-model="clickedUser.user_type">
											<option value="admin">admin</option>
											<option value="user">user</option>
										</select>
										</td>
									</tr>
									
									<tr>
										<th>Password</th>
										<th> : </th>
										<td>
										<input type="text" name="" v-model="clickedUser.pass">
										</td>
									</tr>

									<tr>
										<th></th>
										<th></th>
										<td>
										<button @click="showingEditModal = false; updateUser()">
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
									You are going to delete '{{clickedUser.username}}'.
								</p>
								<br>
								<br>
								<br>
								<br>
								<br>
								<button @click="showingDeleteModal = false; deleteUser()" class="btn-delete">
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
	<script src="../src/users.js"></script>

</body>
</html>
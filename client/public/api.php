<?php
session_start();
include ("connect.php");
$res = array('error' => false);
$user_id = $_SESSION['user'];
$action = 'read';
if(isset($_GET['action'])){
	$action = $_GET['action'];
}

if(isset($_GET['table'])){
	$table = $_GET['table'];
}

if($table == "user"){
	if($action == 'read'){
				
		$result = $conn->query("SELECT * FROM `user`");
		$users = array();
		
		if($_SESSION['user_type'] == "admin"){
			$result = $conn->query("SELECT * FROM `user`");
		}else{
			$result = $conn->query("SELECT * FROM `user` where id = $user_id");
		}
		
		//echo "SELECT * FROM `user where id = $user_id";
	
		while($row = $result->fetch_assoc()){
			array_push($users, $row);
		}
	
		$res['users'] = $users;
	}

	if($action == 'create'){
	
		$username = $_POST['username'];
		$email = $_POST['email'];
		$mobile = $_POST['mobile'];
		$pass = $_POST['pass'];
		$user_type= $_POST['user_type'];
	
		$result = $conn->query("INSERT INTO `user` (`username`, `email`, `mobile`, `pass`, user_type) VALUES ('$username', '$email', '$mobile', '$pass', '$user_type') ");
		
		if($result){
			$res['message'] = "User added successfully";
		} else{
			$res['error'] = true;
			$res['message'] = "Could not insert user";
		}
	}
	
	if($action == 'update'){
		$id = $_POST['id'];
		$username = $_POST['username'];
		$email = $_POST['email'];
		$mobile = $_POST['mobile'];
		$pass = $_POST['pass'];
		$user_type= $_POST['user_type'];
	
		$result = $conn->query("UPDATE `user` SET `username` = '$username', `email` = '$email', `mobile` = '$mobile',`pass` = '$pass', user_type= '$user_type' WHERE `id` = '$id'");
		
		if($result){
			$res['message'] = "User updated successfully";
		} else{
			$res['error'] = true;
			$res['message'] = "Could not update user";
		}
	
	}
	
	if($action == 'delete'){
		$id = $_POST['id'];
		
	
		$result = $conn->query("DELETE FROM `user` WHERE `id` = '$id'");
		
		if($result){
			$res['message'] = "User deleted successfully";
		} else{
			$res['error'] = true;
			$res['message'] = "Could not delete user";
		}
	
	}
}

if($table == "exercise"){
	if($action == 'read'){
		$result = $conn->query("SELECT * FROM `exercise`");
		$exercise = array();
	
		while($row = $result->fetch_assoc()){
			array_push($exercise, $row);
		}
	
		$res['exercise'] = $exercise;
	}

	if($action == 'create'){
	
		$name = $_POST['name'];
		$description = $_POST['description'];
	
		$result = $conn->query("INSERT INTO `exercise` (`name`, `description`) VALUES ('$name', '$description') ");
		
		if($result){
			$res['message'] = "Exercise added successfully";
		} else{
			$res['error'] = true;
			$res['message'] = "Could not insert Exercise";
		}
	}
	
	if($action == 'update'){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$description = $_POST['description'];
	
		$result = $conn->query("UPDATE `exercise` SET `name` = '$name', `description` = '$description' WHERE `id` = '$id'");
		
		if($result){
			$res['message'] = "Exercise updated successfully";
		} else{
			$res['error'] = true;
			$res['message'] = "Could not update Exercise";
		}
	
	}
	
	if($action == 'delete'){
		$id = $_POST['id'];
		
	
		$result = $conn->query("DELETE FROM `exercise` WHERE `id` = '$id'");
		
		if($result){
			$res['message'] = "Exercise deleted successfully";
		} else{
			$res['error'] = true;
			$res['message'] = "Could not delete Exercise";
		}
	
	}
}

if($table == "routine"){
	if($action == 'read'){
		if($_SESSION['user_type'] == "admin"){
			$result = $conn->query("SELECT r.id,r.name,r.user_id,r.description,u.username FROM `routine` r join user u on u.id = r.user_id");
		}else{
			$result = $conn->query("SELECT r.id,r.name,r.user_id,r.description,u.username FROM `routine` r join user u on u.id = r.user_id where user_id = $user_id");
		}
		
		$routine = array();
	
		while($row = $result->fetch_assoc()){
			array_push($routine, $row);
		}
	
		$res['routine'] = $routine;
	}

	if($action == 'create'){
	
		$name = $_POST['name'];
		$description = $_POST['description'];
	    
		$result = $conn->query("INSERT INTO `routine` (`name`, `description`,user_id) VALUES ('$name', '$description',$user_id) ");
		
		if($result){
			$res['message'] = "Routine added successfully";
		} else{
			$res['error'] = true;
			$res['message'] = "Could not insert Exercise";
		}
	}
	
	if($action == 'update'){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$description = $_POST['description'];
	
		$result = $conn->query("UPDATE `routine` SET `name` = '$name', `description` = '$description' WHERE `id` = '$id'");
		
		if($result){
			$res['message'] = "Routine updated successfully";
		} else{
			$res['error'] = true;
			$res['message'] = "Could not update Exercise";
		}
	
	}
	
	if($action == 'delete'){
		$id = $_POST['id'];
		
	
		$result = $conn->query("DELETE FROM `routine` WHERE `id` = '$id'");
		
		if($result){
			$res['message'] = "Exercise deleted successfully";
		} else{
			$res['error'] = true;
			$res['message'] = "Could not delete Exercise";
		}
	
	}
}

if($table == "routine_exercise"){
	if($action == 'read'){
		if($_SESSION['user_type'] == "admin"){
			$result = $conn->query("SELECT re.id,re.routine,re.exercise,r.name as routine_name,e.name as exercise_name FROM `routine_exercise` re join routine r on r.id = re.routine join exercise e on e.id = re.exercise");
		}else{
			$result = $conn->query("SELECT re.id,re.routine,re.exercise,r.name as routine_name,e.name as exercise_name FROM `routine_exercise` re join routine r on r.id = re.routine join exercise e on e.id = re.exercise where r.user_id = $user_id");
			
			
		}
		
		//echo "SELECT re.id,re.routine,re.exercise,r.name as routine_name,e.name as exercise_name FROM `routine_exercise` re join routine r on r.id = re.routine join exercise e on e.id = re.exercise where r.user_id = $user_id";
		
		$routine = array();
	
		while($row = $result->fetch_assoc()){
			array_push($routine, $row);
		}
	
		$res['routine_exercise'] = $routine;
	}

	if($action == 'create'){
	
		$routine = $_POST['routine'];
		$exercise = $_POST['exercise'];
	    
		$result = $conn->query("INSERT INTO `routine_exercise` (`routine`, exercise) VALUES ('$routine', '$exercise') ");
		
		if($result){
			$res['message'] = "Routine added successfully";
		} else{
			$res['error'] = true;
			$res['message'] = "Could not insert Exercise";
		}
	}
	
	if($action == 'update'){
		$id = $_POST['id'];
		$routine = $_POST['routine'];
		$exercise = $_POST['exercise'];
	
		$result = $conn->query("UPDATE `routine_exercise` SET `routine` = '$routine', `exercise` = '$exercise' WHERE `id` = '$id'");
		
		if($result){
			$res['message'] = "Exercise updated successfully";
		} else{
			$res['error'] = true;
			$res['message'] = "Could not update Exercise";
		}
	
	}
	
	if($action == 'delete'){
		$id = $_POST['id'];
		
	
		$result = $conn->query("DELETE FROM `routine_exercise` WHERE `id` = '$id'");
		
		if($result){
			$res['message'] = "Exercise deleted successfully";
		} else{
			$res['error'] = true;
			$res['message'] = "Could not delete Exercise";
		}
	
	}
}



$conn->close();

header("Content-type: application/json");
echo json_encode($res);
die();
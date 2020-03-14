<?php
$conn = new mysqli("localhost", "root", "Audinissan1983!", "vuelogin");
if($conn->connect_error){
	die("Could not connect to database!");
}
?>
<?php
require_once('connect.php');
 
function get_exercise($conn , $term){ 
 $query = "SELECT * FROM exercise WHERE exercise_name LIKE '%".$term."%' ORDER BY exercise_name ASC";
 $result = mysqli_query($conn, $query); 
 $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
 return $data; 
}
 
if (isset($_GET['term'])) {
 $getexercise = get_exercise($conn, $_GET['term']);
 $exerciseList = array();
 foreach($getexercise as $exercise){
 $exerciseList[] = $exercise['exercise_name'];
 }
 echo json_encode($exerciseList);
}
?>

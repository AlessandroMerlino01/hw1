<?php
 require_once 'dbconfig.php';
 $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
 $query = "SELECT * FROM contenents";
 $res = mysqli_query($conn, $query);

 $array_result = array();
 while($row = mysqli_fetch_assoc($res)){
    array_push($array_result, $row);
}
echo json_encode($array_result);
?>
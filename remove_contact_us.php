<?php 
    include 'auth.php';
    if (!$userid = checkAuth()) exit;

    include 'dbconfig.php';
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    $mexid = mysqli_real_escape_string($conn, $_POST["messageid"]);

    $in_query = "DELETE FROM contactus WHERE id = $mexid";

    $res = mysqli_query($conn, $in_query);
    mysqli_close($conn);
?>
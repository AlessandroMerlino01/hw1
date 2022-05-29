<?php 
    include 'auth.php';
    if (!$userid = checkAuth()) exit;

    include 'dbconfig.php';
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    $userid = mysqli_real_escape_string($conn, $userid);
    $postid = mysqli_real_escape_string($conn, $_POST["postid"]);

    $in_query = "INSERT INTO preferiti(user, contenent) VALUES('$userid', '$postid')";

    $res = mysqli_query($conn, $in_query);
    mysqli_close($conn);
    
?>

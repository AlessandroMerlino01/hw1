<?php
    require_once 'dbconfig.php';
    session_start();
    echo json_encode($_SESSION['hw1_user_id']);
?>
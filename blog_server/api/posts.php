<?php 
    header("Content-Type: application/json");

    //Load configuration files
    require_once('../config/config.php');
    require_once('../config/database.php');

    //Define configuration options
    $allowedMethodts = ['GET'];
    $maxPostsPage = 4;

    //Implement basic pagination
    $page = isset($_GET['page']) ?(int) $_GET['page'] : 1;

?>
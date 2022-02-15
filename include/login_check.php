<?php 

if(!isset($_SESSION['userId'])){
    header( 'location:'.$base_url.'login');
    exit();
}


?>
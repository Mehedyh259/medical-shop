<?php  
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "db_pms";

$conn = mysqli_connect ($servername, $username, $password, $db_name);

if(!$conn){
    die("connection failed".mysqli_connect_error());
}
 date_default_timezone_set('Asia/Dhaka');

 $base_url = 'http://localhost/mehedy/';





?>
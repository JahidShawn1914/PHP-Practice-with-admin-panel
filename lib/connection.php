<?php
// Database connection
$host = 'localhost';
$username = 'root';
$password = '';    
$database = 'news641';

$conn = mysqli_connect($host, $username, $password, $database);
if ($conn -> connect_error) {
    die($conn -> error);
}
else {
}
?>
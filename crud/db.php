<?php
$conn = new mysqli("localhost", "root", "", "crud_db");
if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 
?>
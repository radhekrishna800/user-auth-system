<?php
$host = 'localhost';
$db = 'user_auth';
$user = 'root';
$pass = ''; // Leave blank if no password is set

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

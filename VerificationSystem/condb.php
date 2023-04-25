<?php
$server = "localhost";
$user = "root";
$pass = "";
$database = "verification_system";

$conn = new Mysqli($server, $user, $pass, $database);

if (!$conn) {
    die("<script>alert('Connection Failed.')</script>");
}
?>
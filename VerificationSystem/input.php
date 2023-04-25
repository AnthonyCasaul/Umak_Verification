<?php
include 'condb.php';

$id = $_POST['id'];

$input = mysqli_query($conn, "DELETE FROM `input` ") or die('query failed');
$insert = mysqli_query($conn, "INSERT INTO `input`(input) VALUES ('$id') ") or die('query failed');

header('location: editStaff.php')
?>
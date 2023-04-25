<?php
include 'condb.php';

$account_id = $_POST['id'];


$delete = mysqli_query($conn, "DELETE FROM `staff_id` ") or die('query failed');
$insert = mysqli_query($conn, "INSERT INTO `staff_id`(id) VALUES ('$account_id') ") or die('query failed');

header('location: recentAct.php' )
?>
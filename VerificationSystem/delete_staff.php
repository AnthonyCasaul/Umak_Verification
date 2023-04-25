<?php
include 'condb.php';

$staff_id = mysqli_query($conn, "SELECT * FROM `staff_id`") or die('query failed');
$staff = $staff_id->fetch_assoc();
$account_id = $staff['id'];

$delete = mysqli_query($conn, "DELETE FROM `accounts` WHERE account_id = '$account_id'") or die('query failed');

header('location: admin_staff.php');
?>
<?php
include 'condb.php';
session_start();
$username = $_SESSION['username'];
$student_id = $_POST['id'];

//for storing the id of the student
$input = mysqli_query($conn, "DELETE FROM `validator` ") or die('query failed');
$insert = mysqli_query($conn, "INSERT INTO `validator`(validator) VALUES ('$student_id') ") or die('query failed');

//for getting the id of the student
$validator = mysqli_query($conn, "SELECT * FROM validator") or die('query failed');
$row1 = $validator->fetch_assoc();
$student_ID = $row1['validator'];

//for getting the accounts using the $username variable
$select = mysqli_query($conn, "SELECT * FROM `accounts` WHERE Email = '$username'") or die('query failed');
$row = $select->fetch_assoc();
$tag = $row['account_tag'];
$username = $row['account_username'];
$Email = $row['Email'];

//for validating if the user can View or Edit
if ($tag == 'View'){
    header('location: studentinfoRev.php');
}
else if($tag == 'Edit'|| $tag == 'Admin'){
    header('location: studentinfoRev.php');
}

$select1 = mysqli_query($conn, "SELECT * FROM `student_data` WHERE id = '$student_ID'") or die('query failed');
$row1 = $select1->fetch_assoc();
$studentId = $row1['student_id'];
$lname = $row1['student_lname'];
$fname = $row1['student_fname'];

$view = 'View';

$insert1 = mysqli_query($conn, "INSERT INTO `activity_history`(activity_date, staff_username, staff_email, student_id, student_lname, student_fname, recent_activity) 
VALUES (NOW(),'$username','$Email','$studentId','$lname','$fname','$view') ") or die('query failed');

?>
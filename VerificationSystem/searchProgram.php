<?php
include 'condb.php';
// Assuming you have a database connection established

// Get the program name from the request parameter
$program = $_POST["program"];

// Prepare a SQL statement to count the occurrences of the program in the database
$sql = "SELECT COUNT(*) AS count FROM student_data WHERE program = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $program);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

// Return the count as the response
echo $count;
?>
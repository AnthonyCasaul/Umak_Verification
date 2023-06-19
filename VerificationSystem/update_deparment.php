<?php
// Retrieve the selected value from the AJAX request

include 'condb.php';

$selectedValue = strtoupper($_POST['deptvalue']);
// $existvalue = $_POST['programexist'];

$query = "SELECT * FROM deparment";
$result = mysqli_query($conn, $query);


$options = array();

// Check if the query returned any rows
if ($result->num_rows > 0) {
    // Loop through the rows and add options to the array
    while ($row = $result->fetch_assoc()) {
            if($row['department'] != $selectedValue)
            {
                $options[$row['id']] = $row['department'];
            }
        
         
       
    }
}

// Close the database connection
$conn->close();

// Return the new options as JSON
echo json_encode($options);
?>

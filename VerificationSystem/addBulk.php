<?php
include 'condb.php';
session_start();
$username = $_SESSION['username'];

//getting the staff account tag
$navBar = mysqli_query($conn, "SELECT * FROM `accounts` WHERE Email = '$username'") or die('query failed');
$rowNavBar = $navBar->fetch_assoc();
$account_tag = $rowNavBar['account_tag'];
$Admin = "Admin";

if(isset($_POST['importSubmit'])){
    

  $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
  

  if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
      
   
      if(is_uploaded_file($_FILES['file']['tmp_name'])){





          
    
          $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
   
          $VerifiyColumn= fgetcsv($csvFile);


            // if($VerifiyColumn[0] == "student_id" && $VerifiyColumn[1] == "lastname" && $VerifiyColumn[2] == "firstname" && $VerifiyColumn[3] == "initials" && $VerifiyColumn[4] == "suffix" && $VerifiyColumn[5] == "bday" && $VerifiyColumn[6] == "address" && $VerifiyColumn[7] == "contact" && $VerifiyColumn[8] == "gender" && $VerifiyColumn[9] == "date_graduate" && $VerifiyColumn[10] == "department" && $VerifiyColumn[11] == "program" && $VerifiyColumn[12] == "degree" && $VerifiyColumn[13] == "sem"&& $VerifiyColumn[14] == "acadyr"&& $VerifiyColumn[15] == "major"&& $VerifiyColumn[16] == "guardian"&& $VerifiyColumn[17] == "guardian_contact"&& $VerifiyColumn[18] == "guardian_relationship"){
                while(($line = fgetcsv($csvFile)) !== FALSE)
                {
                      $studentID = $line[0];
                      $lname = $line[1];
                      $fname = $line[2];
                      $mname = $line[3];
                      $birthday = $line[16];
                      $address = $line[13];
                      $contact = $line[14];
                      $gender = $line[18];
                      $dGrad = $line[23];
                      $dept = $line[5];
                      $program = $line[6];
                      $sem = $line[19];
                      $acadYr = $line[20];
                      $major = $line[7];
                      $gname = $line[15];

                      $result = $conn->query("SELECT * FROM student_data WHERE 
                        student_id = '$studentID' AND 
                        student_lname = '$lname' AND 
                        student_fname = '$fname' AND 
                        student_mname = '$mname' AND 
                        student_birthday = '$birthday' AND 
                        student_address = '$address' AND 
                        student_contact = '$contact' AND 
                        student_gender = '$gender' AND 
                        date_graduated = '$dGrad' AND 
                        department = '$dept' AND 
                        program = '$program' AND 
                        semester = '$sem' AND 
                        academic_year = '$acadYr' AND 
                        major = '$major' AND 
                        guardian_name = '$gname'");

                      if ($result->num_rows == 0) {
                        
                        $conn->query("INSERT INTO student_data(student_id, student_lname, student_fname, student_mname, student_birthday, student_address, student_contact, student_gender, date_graduated, department, program, semester, academic_year, major, guardian_name) 
                                      VALUES 
                                      ('$studentID', '$lname', '$fname', '$mname', '$birthday', '$address', '$contact', '$gender', '$dGrad', '$dept', '$program', '$sem', '$acadYr', '$major', '$gname')");
                      } else {
                       
                        // echo "Data already exists in the database.";
                      }

               
                  // $conn->query("INSERT INTO student_data(student_id, student_lname, student_fname, student_mname, student_birthday, student_address, student_contact, student_gender, date_graduated, department, program, semester, academic_year, major, guardian_name) 
                  // VALUES 
                  // ('$studentID', '$lname', '$fname', '$mname', '$birthday', '$address', '$contact', '$gender', '$dGrad', '$dept', '$program', '$sem', '$acadYr', '$major', '$gname')");
               }
               echo '<script>window.alert("File Succesfully Uploaded")</script>';
           
           
              // }

            // else
            // {
            //   echo '<script>window.alert("Upload Error! Check Column")</script>';
             
            // }

          
         
          fclose($csvFile);
          
          
      }else{
        echo '<script>window.alert("Upload Error!")</script>';

      }
  }else{
    echo '<script>window.alert("Upload Error! ")</script>';

  }
}
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    />
    <link rel="stylesheet" href="css/addBulk.css" />
    <link rel="icon" href="img/UMakLogo.png" />
    <title>UMAK Verification System</title>
  </head>
  <body>
    <!-- START OF NAV BAR -->
    <div class="menu-bar">
      <div class="logoText">
        <img src="img/UMakLogo.png" alt="" class="umakLogo">
        <h1 class="logo">UMak Verification System</span></h1>
      </div>
      <ul>
      <?php 
         if($account_tag == $Admin){
          echo '
          <li><a href="dashboard.php">REPORT</a></li>
          <li>
            <a href="admin_staff.php">STAFFS ▼</a>
  
            <div class="dropdown-menu">
              <ul>
                <li><a href="admin_staff.php">View Staffs</a></li>
                <li><a href="addStaff.php">Add Staffs</a></li>
                <li><a href="staffactivity.php">Show Staff Activities</a></li>
              </ul>
            </div>
          </li>';
         }
        ?>
        
        <li>
          <a href="records.php">RECORDS ▼</a>

          <div class="dropdown-menu">
            <ul>
              <li><a href="records.php">View Records</a></li>
              <?php 
                if($account_tag == $Admin){
                echo '
              <li><a href="addRecord.php">Add Records</a></li>
              <li><a href="addBulk.php">Add Bulk</a></li>
              <li>
                <a href="#">Add Category</a>
                <div class="dropdown-menu-1">
                  <ul>
                    <li><a href="addDCD/addDept.php">Add Department</a></li>
                    <li><a href="addDCD/addProg.php">Add Program</a></li>
                    <li><a href="addDCD/addDeg.php">Add Degree</a></li>
                  </ul>
                </div>
              </li>';
            }
              ?>
            </ul>
          </div>
        </li>
        <li>
          <form action="index.php" method="post">
            <button type="submit" name="logout" class="logout">LOG OUT</button>
          </form>
        </li>
      </ul>
    </div>
    <!-- END OF NAV BAR -->

    <div class="content">
      <h1 class="head">UPLOAD FILE</h1>
      <div class="centerDiv">
        <h2>SELECT A FILE TO UPLOAD</h2>
        <div class="upload-wrapper">
          <img src="img/csv.png" alt="" class="uploadIcon" id="upload-icon">
        <form action="addBulk.php" method="post" enctype="multipart/form-data">
          <input type="file" name="file" accept=".csv" multiple>
          <button type="submit" name="importSubmit"class="uploadBtn">UPLOAD</button>
        </form>
      </div>
      
    </div>
    <footer></footer>
    <!-- <script>

		// Get the upload icon and upload text elements
		var uploadIcon = document.getElementById('upload-icon');
    // Get the upload button element
    var uploadButton = document.getElementById('uploadButton');

    // Disable the upload button initially
    uploadButton.disabled = true;

    uploadButton.addEventListener('click', function() {
    // Submit the form if a file has been selected
    if (input.files.length > 0) {
    // submit the form
    this.form.submit();
     }
    });
		// Add a click event listener to the upload icon
		uploadIcon.addEventListener('click', function() {
			// Create a file input element
			var input = document.createElement('input');
      input.type = 'file';
      input.accept = '.csv'; // only accept CSV files

			// Add a change event listener to the file input element
			input.addEventListener('change', function() {
				// Get the selected file
				var file = this.files[0];
        
				// If a file was selected
				if (file) {
					// Hide the upload icon
					uploadIcon.style.display = 'none';

					// Set the upload text to the file name
					uploadText.textContent = file.name;

          // Enable the upload button
          uploadButton.disabled = false;
				} else {
          // Show the upload icon
          uploadIcon.style.display = 'block';

          // Clear the upload text
          uploadText.textContent = '';

          // Disable the upload button
          uploadButton.disabled = true;
        }
			});

			// Trigger a click event on the file input element
			input.click();
		});
	</script> -->
  </body>
</html>

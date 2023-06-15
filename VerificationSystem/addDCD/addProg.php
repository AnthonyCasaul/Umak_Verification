<?php
include '../condb.php';

session_start();
$username = $_SESSION['username'];

//getting the staff account tag
$navBar = mysqli_query($conn, "SELECT * FROM `accounts` WHERE Email = '$username'") or die('query failed');
$rowNavBar = $navBar->fetch_assoc();
$account_tag = $rowNavBar['account_tag'];
$Admin = "Admin";

$displayDept = mysqli_query($conn, "SELECT department FROM deparment");

if (isset($_POST['awit'])){
 $department = $_POST['department'];

 $iddeparment = mysqli_query($conn, "SELECT id FROM deparment WHERE department= '$department'");
 $iddept = mysqli_fetch_assoc($iddeparment);
 $iddept =  $iddept['id'];
 $program = $_POST['program']??'';
 $major = $_POST['major']??'';
 
$query = "SELECT * FROM ccis_program WHERE program = '$program'";
$result = mysqli_query($conn,$query);

if (mysqli_num_rows($result) > 0) {
  $idprogram = mysqli_fetch_assoc($result);
  $idprogram = $idprogram['id'];
  $addmajor = "INSERT INTO ccis (program, major) VALUES ('$idprogram','$major')";
  $result = mysqli_query($conn, $addmajor);

  if ($result) {
      echo '<script>alert("SUCCESSFULLY ADDED");</script>';
  } else {
      echo '<script>alert("Failed to add major");</script>';
  }
} else {
  $addprogram = "INSERT INTO ccis_program (program, department_id) VALUES ('$program','$iddept')";
  mysqli_query($conn, $addprogram);

  // Getting the id of the new program
  $GetID = "SELECT * FROM ccis_program WHERE program = '$program'";
  $GetResult = mysqli_query($conn, $GetID);
  $ProgramID = mysqli_fetch_assoc($GetResult);
  $ProgramID = $ProgramID['id'];

  $addmajor = "INSERT INTO ccis (program, major) VALUES ('$ProgramID','$major')";
  $result = mysqli_query($conn, $addmajor);

  if ($result) {
      echo '<script>alert("SUCCESSFULLY ADDED");</script>';
  } else {
      echo '<script>alert("Failed to add major");</script>';
  }
}

}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="template.css" />
    <link rel="stylesheet" href="css/program.css" />
    <link rel="icon" href="../img/UMakLogo.png" />
    <title>Document</title>
  </head>
  <body>
    <!-- START OF NAV BAR -->
    <div class="menu-bar">
      <div class="logoText">
        <img src="../img/UMakLogo.png" alt="" class="umakLogo">
        <h1 class="logo">UMak Verification System</span></h1>
      </div>
      <ul>
      <?php 
         if($account_tag == $Admin){
          echo '
          <li><a href="../dashboard.php">REPORT</a></li>
          <li>
            <a href="../admin_staff.php">STAFFS ▼</a>
  
            <div class="dropdown-menu">
              <ul>
                <li><a href="../admin_staff.php">View Staffs</a></li>
                <li><a href="../addStaff.php">Add Staffs</a></li>
                <li><a href="../staffactivity.php">Show Staff Activities</a></li>
              </ul>
            </div>
          </li>';
         }
        ?>
        
        <li>
          <a href="../records.php">RECORDS ▼</a>

          <div class="dropdown-menu">
            <ul>
              <li><a href="../records.php">View Records</a></li>
              <?php 
                if($account_tag == $Admin){
                echo '
              <li><a href="../addRecord.php">Add Records</a></li>
              <li><a href="../addBulk.php">Add Bulk</a></li>
              <li><a href="../addDCD.php">Add Category</a></li>';
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
    <div class="topContainer">
        <button class="back" onclick="goBack()">BACK</button>

        <div class="deptText">
            <img class="boxImg" src="../img/degree.png" alt="">
            <p>ADD PROGRAM</p>
        </div>
    </div>
    
    <div class="display">
      <div class="leftPannel">
      <div class="h1">CHOOSE A DEPARTMENT</div>
    <?php
      if(mysqli_num_rows($displayDept) > 0){
        while($row = mysqli_fetch_assoc($displayDept)){
          $dept = strtoupper($row['department']);
          echo '<div class="eachDiv" style="cursor: pointer;" onclick="displayPrograms(\''.$dept.'\')">'.$dept.'</div>';
        }
      }
    ?>
    </div>
    <form action="addProg.php" method="post" class="form">
      <div class="program">
        <div class="header" id="program-header">ENTER PROGRAM</div>
        <input type="hidden" name="department" id="department">
        <input type="text" name="program" readonly class="disabled-input" onclick="showPrompt()" oninput="validateInputs()">
      </div>
      <div class="major">
        <div class="header">ENTER MAJOR</div>
        <input type="text" name="major" readonly class="disabled-input" onclick="showPrompt()" oninput="validateInputs()">
      </div>
      <input type="submit" name="awit" value="SAVE" id="submitButton" disabled>
    </form>

<script>
  function displayPrograms(dept) {
    var programHeader = document.getElementById("program-header");
    var programInput = document.getElementsByName("program")[0];
    var majorInput = document.getElementsByName("major")[0];
    var submitButton = document.getElementById("submitButton");

    // Check if the program header text was changed
    if (programHeader.textContent !== "ENTER PROGRAM FOR " + dept) {
      programInput.readOnly = false;
      majorInput.readOnly = false;
      programInput.classList.add("enabled-input");
      majorInput.classList.add("enabled-input");
      submitButton.disabled = false;
    } else {
      programInput.readOnly = true;
      majorInput.readOnly = true;
      programInput.classList.remove("enabled-input");
      majorInput.classList.remove("enabled-input");
      submitButton.disabled = true;
    }

    // Update the program header text and department value
    programHeader.textContent = "ENTER PROGRAM FOR " + dept;
    document.getElementById("department").value = dept;
  }

  function showPrompt() {
    var programHeader = document.getElementById("program-header");
    var departmentValue = document.getElementById("department").value;

    if (programHeader.textContent === "ENTER PROGRAM" && departmentValue === "") {
      window.alert("Please choose a department first.");
    }
  }

  function validateInputs() {
    var programInput = document.getElementsByName("program")[0];
    var majorInput = document.getElementsByName("major")[0];
    var submitButton = document.getElementById("submitButton");

    if (programInput.value.trim() === "" || majorInput.value.trim() === "") {
      submitButton.disabled = true;
    } else {
      submitButton.disabled = false;
    }
  }
  //BACK BUTTON
  function goBack() {window.history.back();}
</script>






    <script src="../js/addCategory.js"></script>
    <script src="js/addProg.js"></script>

 <footer></footer>
</body>
</html>
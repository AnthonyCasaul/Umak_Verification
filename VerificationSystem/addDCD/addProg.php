<?php
include '../condb.php';

session_start();
$username = $_SESSION['username'];

//getting the staff account tag
$navBar = mysqli_query($conn, "SELECT * FROM `accounts` WHERE Email = '$username'") or die('query failed');
$rowNavBar = $navBar->fetch_assoc();
$account_tag = $rowNavBar['account_tag'];
$Admin = "Admin";

$displayProg = mysqli_query($conn, "SELECT DISTINCT(program) FROM student_data");

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/template.css" />
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
      <div class="departmentDiv">
        <p class="header">CHOOSE A DEPARTMENT</p>
        <select id="department" name="department"   required>
                <option value="">--Select--</option>
                <option value="CBFS">CBFS</option>
                <option value="CTHM">CTHM</option>
                <option value="IGS">IGS/CGS/CCAPS</option>
                <option value="COS">COS</option>
                <option value="COE">COE</option>
                <option value="CCSCE">CCSE</option>
                <option value="IIT">IIT/COT/ITRED/CTM</option>
                <option value="CCIS">CCIS</option>
                <option value="CGPP">CGPP</option>
                <option value="CAL">CAL</option>
                <option value="COASH">COAHS</option>
                <option value="CHK">CHK</option>
                <option value="CMLI">CMLI</option>
                <option value="SOL">SOL</option>
              </select>
      </div>
      <!-- SHOW EXISTING PROGRAM -->
      <div class="program">
      <p class="header">EXISTING PROGRAM</p> 
      <div>
        <p id="programs"></p>
      </div>
      </div>
      <!-- FORM -->
        <form action="" class="inputForm">
          <section>
            <label for="">PROGRAM:</label>
            <div class="inputs-container">
              <input type="text" id="program">
            </div>
          </section>
          <section>
            <label for="">MAJOR:</label>
            <div class="inputs-container">
              <input type="text" id="major">
            </div>
        </section>
        <input type="submit" value="SAVE">
      </form>

    </div>
    </div>

    <script>
      //Back Button Function
    function goBack() {
      window.history.back();
    }
</script>
    <script src="../js/addCategory.js"></script>

 <footer></footer>
</body>
</html>
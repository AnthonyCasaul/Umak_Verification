<?php
include 'condb.php';
session_start();

$username = $_SESSION['username']??'';

//getting the staff account tag
$select1 = mysqli_query($conn, "SELECT * FROM `accounts` WHERE Email = '$username'") or die('query failed');
$row1 = $select1->fetch_assoc();
$account_tag = $row1['account_tag']??'';
$Admin = "Admin";

$viewer = "View";
$editor = "Edit";
$added  = "Add";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="systems.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <div class="box verification" onclick="redirectToVerification()">
            <img src="img/verification.png" alt="">
            <h2 class="vs">VERIFICATION <br> SYSTEM</h2>
        </div>
        <div class="box formRequest" onclick="redirectToFormRequest()">
            <img src="img/formrequest.png" alt="">
            <h2 class="fr">FORM <br> REQUEST</h2>
        </div>
        <div class="box blank">
            <img src="img/picture.png" alt="">
            <h2 class="fr">BLANK <br> BOX</h2>
        </div>
        <div class="box blank">
            <img src="img/picture.png" alt="">
            <h2 class="fr">BLANK <br> BOX</h2>
        </div>
        
    </div>

    <footer></footer>

    <script>
    function redirectToVerification() {
        // Redirect the user to the verification page
        window.location.href = "dashboard.php";
    }
  
    function redirectToFormRequest() {
        // Redirect the user to the form request page
        window.location.href = "formrequest.html";
    }
</script>

</body>
</html>
<?php
include 'condb.php';

session_start();
$username = $_SESSION['username'];

//getting the staff account tag
$navBar = mysqli_query($conn, "SELECT * FROM `accounts` WHERE Email = '$username'") or die('query failed');
$rowNavBar = $navBar->fetch_assoc();
$account_tag = $rowNavBar['account_tag'];
$Admin = "Admin";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/addDCD.css" />
    <link rel="icon" href="img/UMakLogo.png" />
    <title>Document</title>
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
              <li><a href="addDCD.php">Add Category</a></li>';
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
    <button class="back" onclick="goBack()">BACK</button>
    <div class="content">
    <a href="addDCD/addDept.php">
      <div class="box dept">
        <img class="boxImg" src="img/enterprise.png" alt="">
        <p>ADD DEPARTMENT</p>
        </div>
    </a>
    <a href="addDCD/addProg.php">
      <div class="box prog">
        <img class="boxImg" src="img/school.png" alt="">
        <p>ADD PROGRAM</p>
      </div>
    </a>
    <a href="addDCD/addDeg.php">
      <div class="box deg">
        <img class="boxImg" src="img/degree.png" alt="">
        <p>ADD DEGREE</p>
      </div></a>
    </div>
    <script>
      function goBack(){
        window.history.back();
      }
    </script>

 <footer></footer>
</body>
</html>
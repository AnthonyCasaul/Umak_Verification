<?php
include 'condb.php';
session_start();

$username = $_SESSION['username'];

$select = mysqli_query($conn, "SELECT * FROM `accounts`") or die('query failed');

//getting the staff account tag
$navBar = mysqli_query($conn, "SELECT * FROM `accounts` WHERE Email = '$username'") or die('query failed');
$rowNavBar = $navBar->fetch_assoc();
$account_tag = $rowNavBar['account_tag'];
$Admin = "Admin";

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="admin_staff.css">
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

    <div class="container">
    <?php
        if(mysqli_num_rows($select) > 0){
			while($row = mysqli_fetch_assoc($select)){
                $id = $row['account_id'];
                $lname = ucfirst(strtolower($row['Last_Name']));
                $fname = ucfirst(strtolower($row['First_Name']));
                $username = $row['account_username'];
                $password = $row['account_password'];
                $program = strtoupper($row['Program_in_Charge']);
                $tag = $row['account_tag'];
                
                 
                echo '<div class="box">
                        <img src="img/userpic.png" class="usericon">
                            <div class="sName">
                                <p class="surname"><b>'.$lname.'</b>,</p>
                                <p class="fname">'.$fname.'</p>
                            </div>
                            <hr class="line">
                            <div class="belowBox">
                                <p class="text"><b>USERNAME</b></p>
                                <p class="php">'.$username.'</p>
                                <p class="text"><b>PASSWORD</b></p>
                                <p class="php">'.$password.'</p>
                                <p class="text"><b>PROGRAM IN CHARGE</b></p>
                                <p class="php">'.$program.'</p>
                                <p class="text"><b>Role</b></p>
                                <p class="php">'.$tag.'</p>
                            </div>
                            <div class="boxbutton">
                                <form method="post" action="staff_validator.php">
                                <input type="hidden" name="id" value="' . $id . '">
                                <a href="recentAct.php">
                                <button type="submit" class="btn showact_button">SHOW ACTIVITY</button>
                                </a>
                                </form>
                                  <form method="post" action="input.php">
                                  <input type="hidden" name="id" value="'. $id .'">
                                <a href="editStaff.php">
                                <button type="submit" class="btn editact_button">EDIT</button>
                                </a>
                            </div>
                                </form>
                        </div>';
    ?>


    <?php
   }    
  }
  else{
      echo "<div class='no_data'>No Data Found</div>";
  }

  ?>
    <footer>
    </footer>
</body>    
</html>
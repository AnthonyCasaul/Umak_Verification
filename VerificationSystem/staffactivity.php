<?php
include 'condb.php';

session_start();
$username = $_SESSION['username'];

//getting the staff account tag
$navBar = mysqli_query($conn, "SELECT * FROM `accounts` WHERE Email = '$username'") or die('query failed');
$rowNavBar = $navBar->fetch_assoc();
$account_tag = $rowNavBar['account_tag'];
$Admin = "Admin";

$select = mysqli_query($conn, "SELECT * FROM `activity_history`") or die('query failed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Activity</title>
<link rel="stylesheet" href="css/staffactivity.css">
<link rel="icon" href="img/UMakLogo.png" />

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
    
      <!-- Staff Activity container -->
      <div class="container1">
        <button class="back" onclick="window.location.href='admin_staff.php';"> BACK</button>  
        <div class="staffactivitytext"><h2>STAFF ACTIVITY</h2> </div>
    </div>

      <!--table part-->
    
      <div class="container2">
        
        <div class="staffactivitytable">
            <table class="table1">
              <tbody>
                <tr>
                    <th>DATE</th>
                    <th>USERNAME</th>
                    <th>EMAIL</th>
                    <th>STUDENT ID</th>
                    <th>STUDENT NAME</th>    
                    <th>RECENT ACTIVITIES</th>
                </tr>
              </tbody>
               <?php
if(mysqli_num_rows($select) > 0){
			while($row = mysqli_fetch_assoc($select)){
                $id = $row['id'];
                $date = $row['activity_date'];
                $username = $row['staff_username'];
                $email = $row['staff_email'];
                $studentid = strtoupper($row['student_id']);
                $student_lname = $row['student_lname'];
                $student_fname = $row['student_fname'];
                $student_name = ucwords(strtolower($student_lname . ', '.$student_fname));
                $activity = $row['recent_activity'];

                echo '
              <tbody>
              <tr>
              <td>'.$date.'</td>
              <td>'.$username.'</td>
              <td>'.$email.'</td>
              <td>'.$studentid.'</td>
              <td>'.$student_name.'</td>
              <td>'.$activity.'ed</td>
              </tr>
              </tbody>';
      }
} 
else{
            echo "<div class='no_data'>No Data Found</div>";
        }
?>
            </table>
        </div>
      </div>
      <footer></footer>
</body>
    
</html>
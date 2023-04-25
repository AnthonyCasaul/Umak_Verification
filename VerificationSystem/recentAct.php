<?php
include 'condb.php';
session_start();
$username = $_SESSION['username'];
$navBar = mysqli_query($conn, "SELECT * FROM `accounts` WHERE Email = '$username'") or die('query failed');
$rowNavBar = $navBar->fetch_assoc();
$account_tag = $rowNavBar['account_tag'];
$Admin = "Admin";

$View = "View";
$Edit = "Edit";

$staff_id = mysqli_query($conn, "SELECT * FROM `staff_id`") or die('query failed');
$staff = $staff_id->fetch_assoc();
$account_id = $staff['id'];

$select1 = mysqli_query($conn, "SELECT * FROM `accounts` WHERE account_id = '$account_id' ") or die('query failed');
$tags = $select1->fetch_assoc();
$tag = $tags['account_tag'];

$select = mysqli_query($conn, "SELECT * FROM `accounts` WHERE account_id = '$account_id' ") or die('query failed');
if(mysqli_num_rows($select) > 0){
			while($row = mysqli_fetch_assoc($select)){
                $id = $row['account_id'];
                $lname = ucfirst(strtolower($row['Last_Name']));
                $fname = ucfirst(strtolower($row['First_Name']));
                $username = $row['account_username'];
                $password = $row['account_password'];
                $program = strtoupper($row['Program_in_Charge']);
                $email = $row['Email'];
                $contact = $row['Contact'];
              }
}

$select1 = mysqli_query($conn, "SELECT * FROM `activity_history` WHERE staff_email = '$email'") or die('query failed');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="recentAct.css" />
    <link rel="icon" href="img/UMakLogo.png" />
    <title>UMak Verification System</title>
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

    <!--GRAY BACKGROUND-->
    <div class="content">
      <a href="admin_staff.php"><button class="back">BACK</button></a>
      <!--to align the div of TOP, TEXT, and TABLE into column-->
      <div class="contatiner">
        <!-- start div for TOP -->
        <div class="top">
          <!--First Box on the TOP-->
          <div class="top top-1">
            <img src="img/userpic.png" alt="" />
          </div>
          <!--Second Box on the TOP-->
          <div class="top top-2">
            <p class="name"><?php echo $lname.", ".$fname;?></p>
            <div class="flex">
              <p class="b username">USERNAME:</p>
              <p class="username-out"><?php echo $username;?></p>
            </div>
            <div class="flex">
              <p class="b password">PASSWORD:</p>
              <p class="password-out"><?php echo $password;?></p>
            </div>
          </div>
          <!--Third Box on the TOP-->
          <div class="top top-3">
            <div class="flex">
              <p class="b prog">PROGRAM<br />IN CHARGE</p>
              <p class="prog-out"><?php echo $program;?></p>
            </div>
            <div class="flex">
              <p class="b email">EMAIL:</p>
              <p class="email-out"><?php echo $email;?></p>
            </div>
            <div class="flex">
              <p class="b contact">CONTACT:</p>
              <p class="contact-out"><?php echo $contact;?></p>
            </div>
          </div>
          <!--Fourth Box on the TOP-->
          <div class="top top-4">
            <p class="b access">ACCESS</p>
            <div class="rButtons">
              <div class="radDiv">
                <?php 
                  if ($tag == $View){ 
                    echo "VIEWER";
                  } 
                  else if($tag == $Edit){
                    echo "EDITOR";
                  }
                ?>
              </div>
              <button class="profileBtn prof-edit">EDIT PROFILE</button>
              <form method="post" action="delete_staff.php">
              <button type="submit" class="profileBtn prof-delete">DELETE PROFILE</button>
              </form>
            </div>
          </div>
        </div>
        <!-- end div for TOP -->
        <div class="text">RECENT ACTIVITIES</div>
        <div class="table-container">
          <table>
            <tbody>
                <tr>
                    <th>DATE</th>
                    <th>USERNAME</th>
                    <th>EMAIL</th>
                    <th>STUDENT ID</th>
                    <th>LAST NAME</th>                    
                    <th>FIRST NAME</th>
                    <th>RECENT ACTIVITIES</th>
                </tr>
              </tbody>
               <?php
if(mysqli_num_rows($select1) > 0){
			while($row1 = mysqli_fetch_assoc($select1)){
                $id = $row1['id'];
                $date = $row1['activity_date'];
                $username = $row1['staff_username'];
                $email = $row1['staff_email'];
                $studentid = $row1['student_id'];
                $student_lname = ucfirst(strtolower($row1['student_lname']));
                $student_fname = ucfirst(strtolower($row1['student_fname']));
                $activity = $row1['recent_activity'];

                echo '
              <tbody>
              <tr>
              <td>'.$date.'</td>
              <td>'.$username.'</td>
              <td>'.$email.'</td>
              <td>'.$studentid.'</td>
              <td>'.$student_lname.'</td>
              <td>'.$student_fname.'</td>
              <td>'.$activity.'ed'.'</td>
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
    </div>
    <footer></footer>
  </body>
</html>

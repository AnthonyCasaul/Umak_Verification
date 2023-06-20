<?php
include 'condb.php';
// error_reporting(E_ERROR | E_PARSE);

session_start();
$username = $_SESSION['username'];

//getting the staff account tag
$select1 = mysqli_query($conn, "SELECT * FROM `accounts` WHERE Email = '$username'") or die('query failed');
$row1 = $select1->fetch_assoc();
$account_tag = $row1['account_tag'];
$Admin = "Admin";
  
if(isset($_POST['submit'])){

   $id = "";
   $lName = mysqli_real_escape_string($conn, $_POST['lname']);
   $fName = mysqli_real_escape_string($conn, $_POST['fname']);
   $mName = mysqli_real_escape_string($conn, $_POST['mname']);
   $uName = mysqli_real_escape_string($conn, $_POST['uname']);
   $pass = mysqli_real_escape_string($conn, $_POST['password']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $contact = mysqli_real_escape_string($conn, $_POST['contact']);
   $program = mysqli_real_escape_string($conn, $_POST['program']);
   $tag = mysqli_real_escape_string($conn, $_POST['tag']);

   $select = mysqli_query($conn, "SELECT * FROM `accounts` WHERE Email = '$email'") or die('query failed');

    if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist'; 
    }
   else{
      $insert = mysqli_query($conn, "INSERT INTO `accounts`(account_id, Last_Name, First_Name, MIddle_Name, account_username, account_password, Email, Contact, Program_in_Charge, account_tag) 
      VALUES('$id','$lName', '$fName', '$mName', '$uName', '$pass', '$email', '$contact', '$program', '$tag')") or die('query failed');
      $message[] = 'You Have Succesfully Created an Account';    
      header('location:admin_staff.php');
    }
}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="addStaff.css">
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
        <div class="mainField">
                <img src="img/userpic.png" class="icon2">  
            <?php
                if(isset($message)){
                    foreach($message as $message){
                        echo '<div class="message">'.$message.'</div>';
                    }
                }
            ?>
            <div class="userForm">
                <form action="" method="post" enctype="multipart/form-data"> 
                  <div class="labelInput">

                    <div class="name">
                      <div class="fRows lname">
                        <label for="">LAST NAME</label>
                        <input type="text" name="lname">
                      </div>
                      <div class="fRows fname">
                        <label for="">FIRST NAME</label>
                        <input type="text" name="fname">
                      </div>
                      <div class="fRows mname">
                        <label for="">MIDDLE NAME</label>
                        <input type="text" name="mname">
                      </div>
                    </div>

                    <div class="userPass">
                      <div class="tRows Div">
                        <label for="">USERNAME</label>
                        <input type="text" name="uname">
                      </div>
                      <div class="tRows Div">
                        <label for="">PASSWORD</label>
                        <input type="password" name="password">
                      </div>
                    </div>

                    <div class="credentials">
                      <div class="tRows Div">
                        <label for="">EMAIL</label>
                        <input type="text" name="email">
                      </div>
                      <div class="tRows Div">
                        <label for="">CONTACT</label>
                        <input type="text" name="contact">
                      </div>
                    </div>
                    <label for="" class="PiC">PROGRAM IN CHARGE</label>
                    <select id="department" name="program"   required>
                      <option value="" selected disabled>--Select--</option>
                      <option value="cbfs">CBFS</option>
                      <option value="cthm">CTHM</option>
                      <option value="igs">IGS/CGS/CCAPS</option>
                      <option value="cos">COS</option>
                      <option value="coe">COE</option>
                      <option value="ccsce">CCSE</option>
                      <option value="iit">IIT/COT/ITRED/CTM</option>
                      <option value="ccis">CCIS</option>
                      <option value="cgpp">CGPP</option>
                      <option value="cal">CAL</option>
                      <option value="coahs">COAHS</option>
                      <option value="chk">CHK</option>
                      <option value="cmli">CMLI</option>
                      <option value="sol">SOL</option>
                    </select>
                  </div>
                  <div class="btns">
                  <button class="cancel hoverBtns" onclick="window.location.href='admin_staff.php';">CANCEL</button>
                    <div class="radioBtns">
                      <div class="EVbtns">
                        <input type="radio" id="view" name="tag" value="View" class="radio"><label for=""> VIEW</label>
                      </div>
                      <div class="EVbtns">
                        <input type="radio" id="edit" name="tag" value="Edit" class="radio"><label for=""> EDIT</label>
                      </div>
                    </div>
                    <input class="hoverBtns" type="submit" name="submit" placeholder="SAVE" value="SAVE"/>
                  </div>
                  </form>

                
                 
            </div>
        </div>
        
    </div>
    </body>

    <footer> </footer>
</html>
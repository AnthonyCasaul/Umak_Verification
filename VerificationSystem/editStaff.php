<?php
include 'condb.php';
//error_reporting(E_ERROR | E_PARSE);

session_start();
$username = $_SESSION['username'];

//getting the staff account tag
$navBar = mysqli_query($conn, "SELECT * FROM `accounts` WHERE Email = '$username'") or die('query failed');
$rowNavBar = $navBar->fetch_assoc();
$account_tag = $rowNavBar['account_tag'];
$Admin = "Admin";

$select1 = mysqli_query($conn, "SELECT * FROM `input`") or die('query failed');
if(mysqli_num_rows($select1) > 0){
			while($row1 = mysqli_fetch_assoc($select1)){
                $input = $row1['input'];

            }
        }


$select = mysqli_query($conn, "SELECT * FROM `accounts` WHERE account_id = '$input' ") or die('query failed');
$row = $select->fetch_assoc();

$sID = $row['account_id'];
$lName = $row['Last_Name'];
$fName = $row['First_Name'];
$mName = $row['MIddle_Name'];
$uName = $row['account_username'];
$pass = $row['account_password'];
$email = $row['Email'];
$contact = $row['Contact'];
$program = $row['Program_in_Charge'];
$tag = $row['account_tag'];

if(isset($_POST['update'])){
    $lName1 = mysqli_real_escape_string($conn, $_POST['lname']);
    $fName1 = mysqli_real_escape_string($conn, $_POST['fname']);
    $mName1 = mysqli_real_escape_string($conn, $_POST['mname']);
    $uName1 = mysqli_real_escape_string($conn, $_POST['uname']);
    $pass1 = mysqli_real_escape_string($conn, $_POST['password']);
    $email1 = mysqli_real_escape_string($conn, $_POST['email']);
    $contact1 = mysqli_real_escape_string($conn, $_POST['contact']);
    $program1 = mysqli_real_escape_string($conn, $_POST['program']);
    $tag1 = mysqli_real_escape_string($conn, $_POST['tag']);

    $update = mysqli_query($conn, 
    "UPDATE `accounts` SET  
    Last_Name = '$lName1',
    First_Name = '$fName1',
    Middle_Name = '$mName1',
    account_username = '$uName1',
    account_password = '$pass1',
    Email = '$email1',
    Contact = '$contact1',
    Program_in_Charge = '$program1',
    account_tag = '$tag1' WHERE account_id = '$input'")
    or die('query failed');
    header('location: admin_staff.php');
}
if(isset($_POST['cancel'])){
header('location: admin_staff.php');
}

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="img/UMakLogo.png" />
        <title>UMAK Verification System</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="editStaff.css">
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
                        <input type="text" name="lname" value="<?php echo $lName?>">
                      </div>
                      <div class="fRows fname">
                        <label for="">FIRST NAME</label>
                        <input type="text" name="fname" value="<?php echo $fName?>">
                      </div>
                      <div class="fRows mname">
                        <label for="">MIDDLE NAME</label>
                        <input type="text" name="mname" value="<?php echo $mName?>">
                      </div>
                    </div>

                    <div class="userPass">
                      <div class="tRows Div">
                        <label for="">USERNAME</label>
                        <input type="text" name="uname" value="<?php echo $uName?>">
                      </div>
                      <div class="tRows Div">
                        <label for="">PASSWORD</label>
                        <input type="password" name="password" value="<?php echo $pass?>">
                      </div>
                    </div>

                    <div class="credentials">
                      <div class="tRows Div">
                        <label for="">EMAIL</label>
                        <input type="text" name="email" value="<?php echo $email?>">
                      </div>
                      <div class="tRows Div">
                        <label for="">CONTACT</label>
                        <input type="text" name="contact" value="<?php echo $contact?>">
                      </div>
                    </div>
                    <label for="" class="PiC">PROGRAM IN CHARGE</label>
                    <select id="department" name="program">
                      <option value="" selected disabled><?php echo '<b>'.$program.'</b>'?></option>
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
                    <div class="btns">
                      <button class="cancel hoverBtns" type="submit" name="cancel">CANCEL</button>
                        <div class="radioBtns">
                          <div class="EVbtns">
                            <input type="radio" id="view" name="tag" value="CAA" class="radio"<?php if($tag=="CAA"){echo "checked";}?>><label for=""> CAA</label>
                          </div>
                          <div class="EVbtns">
                            <input type="radio" id="edit" name="tag" value="UR" class="radio"<?php if($tag=="UR"){echo "checked";}?>><label for=""> UR</label>
                          </div>
                        </div>
                      <input class="hoverBtns" type="submit" name="submit" placeholder="SAVE" value="SAVE"/>
                    </div>
              </div>
              </form>
            </div>
        </div>
        
    </div>
    
    </body>

    <footer> </footer>
    <!-- <script>
      function btnCancel(){
        window.location.href="admin_staff.php";
      }
    </script> -->
</html>
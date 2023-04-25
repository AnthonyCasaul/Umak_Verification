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
        <title>UMak Verification System</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/editStaff.css">
        <link rel="icon" href="img/UMakLogo.png" />
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
                <table>
                <form action="" method="post" enctype="multipart/form-data"> 
                        <tr>
                            <td><label for="">LAST NAME</label></td>
                            <td><input type="text" name="lname" value="<?php echo $lName?>"></td>
                        </tr>
                        <tr>
                            <td><label for="">FIRST NAME</label></td>
                            <td><input type="text" name="fname" value="<?php echo $fName?>"></td>
                        </tr>
                        <tr>
                            <td><label for="">MIDDLE NAME</label></td>
                            <td><input type="text" name="mname" value="<?php echo $mName?>"></td>
                        </tr>
                        <tr>
                            <td><label for="">USERNAME</label></td>
                            <td><input type="text" name="uname" value="<?php echo $uName?>"></td>
                        </tr>
                        <tr>
                            <td><label for="">PASSWORD</label></td>
                            <td><input type="text" name="password" value="<?php echo $pass?>"></td>
                        </tr>
                        <tr>
                            <td><label for="">EMAIL</label></td>
                            <td><input type="text" name="email" value="<?php echo $email?>"></td>
                        </tr>
                        <tr>
                            <td><label for="">CONTACT</label></td>
                            <td><input type="text" name="contact" value="<?php echo $contact?>"></td>
                        </tr>
                        <tr>
                            <td><label for="">PROGRAM IN CHARGE</label></td>
                            <td><input type="text" name="program" value="<?php echo $program?>"></td>
                        </tr>
                        <tr>
                            <td align="right">
                                <div class="EVbuttons">
                                <label for="view">VIEW</label>
                                <input type="radio" id="view" name="tag" value="View" <?php if ($tag == "View"){ echo "checked";} ?>></div>
                            </td>
                            <td>
                                <div class="EVbuttons">
                                <input type="radio" id="edit" name="tag" value="Edit"<?php if ($tag == "Edit"){ echo "checked";} ?>>
                                <label for="edit">EDIT</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><button type="submit" class="cancel" name="cancel">CANCEL</button></td>
                            <td><input type="submit" name="update" placeholder="SAVE" value="SAVE"/></td>
                        </tr>
                    </form>
                </table> 
                </div>

                
                 
            </div>
        </div>
        
    </div>
    </body>

    <footer> </footer>
</html>
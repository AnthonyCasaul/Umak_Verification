<?php
include '../condb.php';

session_start();
$username = $_SESSION['username'];

//getting the staff account tag
$navBar = mysqli_query($conn, "SELECT * FROM `accounts` WHERE Email = '$username'") or die('query failed');
$rowNavBar = $navBar->fetch_assoc();
$account_tag = $rowNavBar['account_tag'];
$Admin = "Admin";

$displayDept = mysqli_query($conn, "SELECT DISTINCT(department) FROM deparment");

if (isset($_POST['save'])){
      $input = $_POST['input'];
     foreach($input as $key)
     {
      $department = mysqli_query($conn, "SELECT * FROM deparment WHERE department = UPPER('$key')") or die('query failed');
      $count = mysqli_num_rows($department);
  
      
      if ($count == 0) {
          $insertQuery = "INSERT INTO deparment (department) VALUES (UPPER('$key'))";
          $insertStatement = mysqli_query($conn, $insertQuery);

          // echo "Inserted $key into department table.<br>";
      } else {
          // echo "$key already exists in department table.<br>";
      }
    
     };

}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="template.css" />
    <link rel="stylesheet" href="css/dept.css" />
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
            <img class="boxImg" src="../img/enterprise.png" alt="">
            <p>ADD DEPARTMENT</p>
        </div>
    </div>
    <div class="display">
    <div class="leftPannel">
      <div class="h1">DEPARTMENTS</div>
      <?php
        if(mysqli_num_rows($displayDept) > 0){
			    while($row = mysqli_fetch_assoc($displayDept)){
            $dept = strtoupper($row['department']);

              echo '<div class="eachDiv">'.$dept.'</div>';
          }
        }
      ?>
      </div>
        <form action="" method= "post" class="form">
          <section>
          <div class="header">DEPARTMENT CODE</div>
            <input type="text" id="how-many" name="department">
          </section>
          <section>
          <div class="header">DEPARTMENT NAME</div>
            <div id="inputs-container">
              <input type="text" class="deptInput">
            </div>
        </section>
        <input type="submit" value="SAVE" name="save">
      </form>
    </div>
    </div>

    <script>
      //Back Button Function
    function goBack() {
      window.history.back();
    }
</script>

 <footer></footer>
</body>
</html>
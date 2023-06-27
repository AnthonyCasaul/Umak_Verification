<?php
include 'condb.php';

session_start();
$username = $_SESSION['username'];

//getting the staff account tag
$navBar = mysqli_query($conn, "SELECT * FROM `accounts` WHERE Email = '$username'") or die('query failed');
$rowNavBar = $navBar->fetch_assoc();
$account_tag = $rowNavBar['account_tag'];
$Admin = "Admin";

$select = mysqli_query($conn, "SELECT * FROM `student_data`") or die('query failed');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="records.css" />
    <link
      rel="shortcut icon"
      href="img/favicon-32x32.png"
      type="image/x-icon"
    />
    <link rel="icon" href="img/UMakLogo.png" />
    <title>UMAK Verification System</title>
  </head>
  <body onload="updateResult()">
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
    if ($account_tag == $Admin) {
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

    <!-- RECORDS -->
    <div class="container__body">

      <!-- search -->
      <div class="SFBar" id="search">
        <div class="search-input">
          <button onclick="searchFunction()" class="search-btn1"><img class="search-img" src="img/searchIcon.png" alt=""></button>
          <input type="text" placeholder="Search" onkeydown="searchFunction()" name="searchName" id="searchName" class="input"/>
        </div>
      <!-- search -->

      <!-- filter -->

        <div class="selector" id="select">
          <img src="img/filterLogo.png" class="logoFil" />
          <div class="degreeDrop">
            <div class="divider">
            <label>DEGREE</label>
            <select name="degree" id="degree">
              <option value="all">All</option>
              <option value="Non-Baccalaureate Degree">Non-Baccalaureate Degree</option>
              <option value="Baccalaureate Degree">Baccalaureate Degree</option>
              <option value="Post Baccalaureate Degree">Post Baccalaureate Degree</option>
              <option value="Graduate Degree">Graduate's Degree</option>
            </select>
          </div>
          </div>

          <div class="programDrop">
            <div class="divider">
            <label>DEPARTMENT</label>
            <select name="deparment" id="department">
              <option value="all">All</option>

              <?php

              $query = "SELECT * FROM deparment";
              $result = mysqli_query($conn, $query);

              while ($row = mysqli_fetch_assoc($result)){
                $department = $row['department'];
                $deplower = strtolower($department);
                echo  "<option value='".$deplower."'>".$department."</option>";

              }
              ?>
            </select>
            </div>
          </div>
           <div class="yearDrop">
            <div class="divider">
            <label>YEAR GRADUATED</label>
            <select id="year" name="year">
              <option value="all" >ALL</option>
              <?php
              $queryacademic = "SELECT DISTINCT(academic_year) FROM student_data";
              $academicV = mysqli_query($conn,$queryacademic);
              
                while($rowacademic = mysqli_fetch_assoc($academicV)){
                    $rowyr =$rowacademic['academic_year'];
                    echo "<option value='".$rowyr."' >".$rowyr."</option>";
                    
                }
              
              
              
              ?>
            </select>
              </div>
          </div>
          </div>
        </div>      
<div id="result"></div>
<!-- <div id="searchResults"></div> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<!-- <script src="ddlYear.js"></script> -->


<script>
        // Get filter elements and result element
const department = document.getElementById("department");
const degree = document.getElementById("degree");
const result = document.getElementById("result");
const year = document.getElementById("year");
// const search = document.getElementById("search");


// Add event listener to filter elements
department.addEventListener("change", updateResult);
degree.addEventListener("change", updateResult);
year.addEventListener("change", updateResult);
// search.addEventListener("input", updateResult);

function updateResult() {
  // Get selected value

  const departmentValue = department.value;
  const degreeValue = degree.value;
  const yearValue = year.value;
  // const searchValue = search.value;
 

  // Send AJAX request to PHP file
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "fetch.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = () => {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      // Update result element with fetched data
      result.innerHTML = xhr.responseText;
    }
  };
  xhr.send(`department=${departmentValue}&degree=${degreeValue}&year=${yearValue}`);
}

function searchFunction() {
    const searchInput = $('#searchName').val();
    const result = document.getElementById('result');
    console.log(searchInput);

    $.ajax({
    type: "POST",
    url: "search.php",
    data: {"search": searchInput},
    success: function(result){
      console.log(result);
    $('#result').html(result);
    }
});	
}
</script>
  </body>
  <footer></footer>
</html>


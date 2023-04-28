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

 $countStudent = mysqli_query($conn, "SELECT COUNT(*) as total_row FROM student_data") or die('query failed');
 $row = $countStudent->fetch_assoc();
 $countStaff = mysqli_query($conn, "SELECT COUNT(*) as total_row FROM accounts") or die('query failed');
 $row1 = $countStaff->fetch_assoc();
 $countStaffEdit = mysqli_query($conn, "SELECT COUNT(*) as total_row FROM accounts WHERE account_tag = '$editor'") or die('query failed');
 $row2 = $countStaffEdit->fetch_assoc();
 $countStaffView = mysqli_query($conn, "SELECT COUNT(*) as total_row FROM accounts WHERE account_tag = '$viewer'") or die('query failed');
 $row3 = $countStaffView->fetch_assoc();
 $countEdited = mysqli_query($conn, "SELECT COUNT(*) as total_row FROM activity_history WHERE recent_activity = '$editor'") or die('query failed');
 $row4 = $countEdited->fetch_assoc();
 $countAdded = mysqli_query($conn, "SELECT COUNT(*) as total_row FROM activity_history WHERE recent_activity = '$added'") or die('query failed');
 $row5 = $countAdded->fetch_assoc();

$department = array("CCIS","cbfs");
$departmentV = array();

for ($x = 0;$x < count($department);$x++){

  $ccis = mysqli_query($conn, "SELECT * FROM student_data WHERE department = '$department[$x]'");
  $ccisV = mysqli_num_rows($ccis);
  $departmentV[] = $ccisV;

  //array_push($departmentV,$ccisV);
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/dashboard.css" />
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

   <div class="content">
      <div class="headingTxt">REPORTS</div>
      <div class="container">
        <div class="sideBar">
          <div class="tStaff">
            <div class="tStaffImg">
              <img src="img/staffIcon.png" alt="" />
            </div>
            <div class="tStaffTxt">
              <div class="tStaffNum tNum"><?php echo $row1['total_row']; ?></div>
              <div class="tStaffg tText">Total Staffs</div>
            </div>
          </div>
          <div class="viewEdit">
            <div class="tView">
              <div class="tViewTxt">
                <div class="tViewNum tNum"><?php echo $row2['total_row']; ?></div>
                <div class="tViewg tText">can Edit</div>
              </div>
            </div>

            <div class="tEdit">
              <div class="tEditTxt">
                <div class="tEditNum tNum"><?php echo $row3['total_row']; ?></div>
                <div class="tEditg tText">can View</div>
              </div>
            </div>
          </div>
          <div class="donutContainer">
            <div class="donutPlaceholder"><canvas id="myChart" width="100%" ></canvas></div>
          </div>
        </div>

        <div class="main-content">
          <div class="top-div">
            <div class="total totalAdd tDiv">
              <div class="tAddImg tImg">
                <img src="img/add.png" alt="" />
              </div>
              <div class="tAddTxt">
                <div class="viewMore"></div>
                <div class="tNum tAddNumR"><?php echo $row5['total_row']; ?></div>
                <div class="tText tAddt">Total Added Records</div>
              </div>
            </div>

            <div class="total totalEdit tDiv">
              <div class="tEditImg tImg">
                <img src="img/edit.png" alt="" />
              </div>
              <div class="tEditTxt">
                <div class="viewMore"></div>
                <div class="tNum tEditNumR"><?php echo $row4['total_row']; ?></div>
                <div class="tText tEditt">Total Edited Records</div>
              </div>
            </div>

            <div class="total tAlumni">
              <div class="tAlumniNum tNum"><?php echo $row['total_row']; ?></div>
              <div class="tAlumniTxt tText">TOTAL ALUMNI RECORDS</div>
            </div>
          </div>
  
        <!-- DONUT CHART -->
        <script>
          var xValues = ["Can Edit", "Can View"];
            var yValues = [<?php echo $row2['total_row']; ?>, <?php echo $row3['total_row']?>];
            var barColors = [
            "#e1cd19",
            "#1967e1"
                            
            ];
                            
            new Chart("myChart", {
            type: "doughnut",
            data: {
              labels: xValues,
              datasets: [{
              backgroundColor: barColors,
              data: yValues
              }]
            },
            options: {
              title: {
              display: true,
              text: ""
              }
            }
            });
        </script>

          <!-- CALLER -->
          <div class="bot-div barContainer">
            <div class="btnDiv">
              <button class="btn btnDept" id="colBtn" onclick="showCol()">COLLEGES</button>
              <button class="btn btnDept" id="deptBtn" onclick="showDept()">DEPARTMENT</button>
              <button class="btn btnDeg" id="degBtn" onclick="showDeg()">DEGREE</button>
              <button class="btn btnYear" id="yrBtn" onclick="showYr()">YEAR</button>
              <div class="searchProg">
                <img src="img/searchIcon.png" alt="" class="searchImg">
                <input type="text" placeholder="Search Program" oninput="showResults()">
              </div>
            </div>
            <div id="searchResults" style="display: none;">
              <p>1000</p>
              <h3>N0. OF ALUMNI</h3>
            </div>

            <!-- DISPLAY -->
            <div class="barPlaceholder" id="barPlaceholder">
              <canvas id="colGraph" class="graph" style="display:block"></canvas>
              <canvas id="deptGraph" class="graph" style="display:none"></canvas>
              <canvas id="degGraph" class="graph" style="display:none"></canvas>
              <canvas id="yrGraph" class="graph" style="display:none"></canvas>
              <canvas id="progGraph" class="graph" style="display:none"></canvas>
            </div>

          </div>
        </div>
      </div>
    </div>

    <!-- SEARCH RESULT -->
    <script>
      function showResults() {
        var input = document.querySelector('input[type="text"]');
        var results = document.getElementById('searchResults');
        if (input.value.length > 0) {
          results.style.display = "block";
        } else {
          results.style.display = "none";
        }
      }
    </script>

    <!-- FUNCTIONS FOR BUTTONS TO DISPLAY -->
    <script src="js/displayGraph.js"> </script>

    <!-- DISPLAY FOR COLLEGES -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

      <script>
        const ctx = document.getElementById('colGraph');

        new Chart(ctx, {
          type: 'bar',
          data: {
            labels: ['CCIS','CBFS','CHK','COAHS'],
            datasets: [{
              label: 'Total Alumni by Colleges',
              data: [<?php echo $departmentV[0]; ?>,<?php echo $departmentV[1]; ?>,<?php echo $departmentV[0]; ?>,<?php echo $departmentV[1]; ?> ],
              backgroundColor: ['#e1cd19','#9d9712','#1967e1','#073755']
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      </script>
      
    <!-- DISPLAY FOR DEPARTMENT -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

      <script>
        const cty = document.getElementById('deptGraph');

        new Chart(cty, {
          type: 'bar',
          data: {
            labels: ['CCIS','CBFS','CHK','COAHS'],
            datasets: [{
              label: 'Total Alumni by Colleges',
              data: [<?php echo $departmentV[0]; ?>,<?php echo $departmentV[1]; ?>,<?php echo $departmentV[0]; ?>,<?php echo $departmentV[1]; ?> ],
              backgroundColor: ['#000','#9d9712','#1967e1','#073755']
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      </script>
    
    <footer></footer>
  </body>
</html>

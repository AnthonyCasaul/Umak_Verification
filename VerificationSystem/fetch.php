<style>
  @media screen and (max-height: 657px) {

  .container__body{
    height: 550px;
    font-size: 15px;
  }
  .rcrdPage {
    height: 500px;
  }
  .showact_button{
    margin-right:20px;
  }
  .content-table th,
  .content-table td{
    font-size: 15px;
  }
  .search-input{
    height:40px;
    padding: 3px;
  }
}
</style>
<?php
$server = "localhost";
$user = "root";
$pass = "";
$database = "verification_system";

$db = new Mysqli($server, $user, $pass, $database);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Get filter values from POST request or set default values
$department = isset($_POST["department"]) ? $_POST["department"] : "all";
$degree = isset($_POST["degree"]) ? $_POST["degree"] : "all";
$year = isset($_POST["year"]) ? $_POST["year"] : "all";
// $search = isset($_POST["search"]);

// Build query based on filter values
$sql = "SELECT * FROM student_data WHERE 1=1";
if ($department !== "all") {
  $sql .= " AND department='$department'";
}
if ($degree !== "all") {
  $sql .= " AND degree='$degree'";
}
if ($year !== "all") {
  $sql .= " AND academic_year='$year'";
}
// if ($search !== "all") {
//   $sql .= " AND student_lname LIKE '%$search%'";
// }
if($year === "all" && $degree === "all" && $department == "all")
$sql = "SELECT * FROM student_data" ;


// Fetch data from database
$result = $db->query($sql);

// Fetch the data as an array of objects
$filteredData = array();
while ($row = $result->fetch_object()) {
    $filteredData[] = $row;
}

// Close the database connection
$db->close();


echo '<div class="rcrdPage">
        <table class="content-table">
          <thead>
            <tr>
              <th>ID NUMBER</th>
              <th>STUDENT NAME</th>
              <th>PROGRAM</th>
              <th>ACADEMIC YEAR</th>
              <th></th>
            </tr>
          </thead>';
 echo "<tr>";
    foreach ($filteredData as $item) {
      $id = $item->id;
      $name = $item->student_lname.', '.$item->student_fname.' '.$item->student_mname;
  echo '<tbody>
              <tr>
              <td>'.$item->student_id.'</>
              <td>'.ucfirst(strtolower($name)).'</td>
              <td class="leftAlign">'.$item->program.'</td>
              <td>'.$item->academic_year.'</td>
              <td class="btns">
                  <form method="post" action="validator.php">
                  <input type="hidden" name="id" value="'.$id.'">
                  <a href="studentInfo.php">
                  <button type="submit" class="showact_button">VIEW</button>
                  </a>
                  </form>
              </td>
              </tr>
              </a>
              </form>
              </tbody>';
}

?>
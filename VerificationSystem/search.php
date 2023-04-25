<?php
include 'condb.php';
$search = $_POST['search'];

$select = mysqli_query($conn, "SELECT * FROM student_data WHERE student_lname LIKE '%$search%' OR student_fname LIKE '%$search%'");

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
if ($select->num_rows > 0) {
    while($row = $select->fetch_assoc()) {
        $id = $row['id'];
        $name = $row['student_lname'].', '.$row['student_fname'].' '.$row['student_mname'];
        echo '<tbody>
              <tr>
              <td>'.$row['student_id'].'</>
              <td>'.ucfirst(strtolower($name)).'</td>
              <td class="leftAlign">'.$row['program'].'</td>
              <td>'.$row['academic_year'].'</td>
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
} else {
    echo "0 results"."</div></div>";
}
?>
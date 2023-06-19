<?php
require __DIR__ ."/vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;
include('condb.php');
session_start();
$date = date("F j, Y");
$fname = strtoupper($_POST['fname']);
$mname = strtoupper($_POST['mname']);
$lname = strtoupper($_POST['lname']);
$program = $_POST['program'];
$major = $_POST['major'];

$department1 = $_POST['department'];
$dgrad = $_POST['dgrad'];
$gender = strtoupper($_POST['gender']);
$dategrad = date("F j, Y", strtotime($dgrad));

$iddeparment = mysqli_query($conn, "SELECT * FROM deparment WHERE department= '$department1'");
 $iddept = mysqli_fetch_assoc($iddeparment);
 $department = $iddept['department_name'];

if ($gender == 'MALE'){
    $fullname = "MR. ".$fname . " " .$mname ." ". $lname ;
    $lastname = "MR. " . $lname;
    $pronouns = "him";
}
else{
    $fullname = "MS. ".$fname . " " .$mname ." ". $lname ;
    $lastname = "MS. " . $lname;
    $pronouns = "her";
}


$pm = $program . " ". $major;



$options = new Options;
$options->set('isRemoteEnabled', true);
$options->setChroot(__DIR__);

$dompdf = new Dompdf($options);
$dompdf->setPaper("A4", "portrait");

$html = file_get_contents("certificate_template.html");
$html = str_replace(["{{ name }}","{{ course }}","{{ date }}","{{ major }}","{{ dateofgraduation }}","{{ surname }}", "{{ pronouns }}"], [$fullname,$pm,$date,$department,$dategrad,$lastname,$pronouns], $html);



$dompdf->loadhtml($html);
$dompdf->render();
$dompdf->addInfo("Title","Alumni_Certification");
$dompdf->stream("Alumni_Certification.pdf",["Attachment"=>0])

?>
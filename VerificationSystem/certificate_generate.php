<?php
require __DIR__ ."/vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;
include('condb.php');
session_start();







$options = new Options;
$options->set('isRemoteEnabled', true);
$options->setChroot(__DIR__);

$dompdf = new Dompdf($options);
$dompdf->setPaper("A4", "portrait");

$html = file_get_contents("certificate_template.html");
// $html = str_replace(["{{ name }}", "{{ date }}"], [$name, $date], $html);



$dompdf->loadhtml($html);
$dompdf->render();
$dompdf->addInfo("Title","Alumni_Certification");
$dompdf->stream("Alumni_Certification.pdf",["Attachment"=>0])

?>
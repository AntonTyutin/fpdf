<?php
require('mysql_report.php');

$pdf = new PDF('L','pt','A3');
$pdf->SetFont('Arial','',11.5);
$pdf->connect('localhost','root','','db');
$attr = array('titleFontSize'=>18, 'titleText'=>'this would be the title');
$pdf->mysql_report("SELECT * FROM registered_users ORDER BY USER LIMIT 100",false,$attr);
$pdf->Output();
?>

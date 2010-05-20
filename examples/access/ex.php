<?php
require('access.php');

$conn=odbc_connect('COFFEE','','');
if(!$conn)
	die('Connection failed');
$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',14);
$sql='SELECT COFFEE_NAME, ROAST_TYPE, QUANTITY FROM COFFEE_INVENTORY ORDER BY QUANTITY DESC';
$col=array('COFFEE_NAME'=>50, 'ROAST_TYPE'=>40, 'QUANTITY'=>100);
$pdf->Table($sql,$col);
$pdf->Output();
?>

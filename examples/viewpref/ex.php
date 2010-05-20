<?php
require('viewpref.php');

$pdf=new PDF_ViewPref();
$pdf->SetDisplayMode('fullpage');
$pdf->DisplayPreferences('HideMenubar,HideToolbar,HideWindowUI');
$pdf->AddPage();
$pdf->SetFont('Arial','',16);
$pdf->Write(6,'Only the document should appear, no interface elements.');
$pdf->Output();
?>

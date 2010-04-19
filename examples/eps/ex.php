<?php
require('fpdf_eps.php');

$pdf=new PDF_EPS();

// Page 1: AI
$pdf->AddPage();
$pdf->ImageEps('pelican.ai', 15, 70, 180);

// Page 2: EPS, with link
$pdf->AddPage();
$lnk = $pdf->AddLink();
$pdf->ImageEps('bug.eps', 30, 20, 150, 0, $lnk);

// Page 3: AI
$pdf->AddPage();
$pdf->SetLink($lnk);
$pdf->ImageEps('tiger.ai', 10, 50, 190);

$pdf->Output();
?>

<?php
require('cube.php');

$a = 50;
$b = 50;
$c = 50;
$scale = .6;
$alfax = 20;
$alfay = 20;
$alfaz = 20;

$pdf = new PDF_Cube();
$pdf->AddPage();
$pdf->Cube($a, $b, $c, $scale, $alfax, $alfay, $alfaz);
$pdf->Output();
?>

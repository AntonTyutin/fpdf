<?php
require('clipping.php');

$pdf = new PDF_Clipping();
$pdf->AddPage();

//example of clipped cell
$pdf->SetFont('Arial','',14);
$pdf->SetX(72);
$pdf->ClippedCell(60,6,'These are clipping examples',1);

//example of clipping text
$pdf->SetFont('Arial','B',120);
//set the outline color
$pdf->SetDrawColor(0);
//set the outline width (note that only its outer half will be shown)
$pdf->SetLineWidth(2);
//draw the clipping text
$pdf->ClippingText(40,55,'CLIPS',true);
//fill it with the image
$pdf->Image('clips.jpg',40,10,130);
//remove the clipping
$pdf->UnsetClipping();

//example of clipping rectangle
$pdf->ClippingRect(45,65,116,20,true);
$pdf->Image('clips.jpg',40,10,130);
$pdf->UnsetClipping(); 

//example of clipping ellipse
$pdf->ClippingEllipse(61,104,16,10,true);
$pdf->Image('clips.jpg',40,10,130);
$pdf->UnsetClipping(); 

//example of clipping circle
$pdf->ClippingCircle(103,104,10,true);
$pdf->Image('clips.jpg',40,10,130);
$pdf->UnsetClipping();

//example of clipping polygon
$pdf->ClippingPolygon(array(145,94,160,114,130,114),true);
$pdf->Image('clips.jpg',40,10,130);
$pdf->UnsetClipping(); 

//example of clipping rounded rectangle
$pdf->ClippingRoundedRect(45,125,116,20,5,true);
$pdf->Image('clips.jpg',40,100,130);
$pdf->UnsetClipping();

$pdf->Output();
?>

<?php
require('image_alpha.php');

$pdf=new PDF_ImageAlpha();
$pdf->AddPage();
$pdf->SetFont('Arial','',16);
$pdf->MultiCell(0,8, str_repeat('Hello World! ', 180));

// A) provide image + separate 8-bit mask (best quality!)

// first embed mask image (w, h, x and y will be ignored, the image will be scaled to the target image's size)
$maskImg = $pdf->Image('mask.png', 0,0,0,0, '', '', true); 
// embed image, masked with previously embedded mask
$pdf->Image('image.png',55,10,100,0,'','', false, $maskImg);

// B) use alpha channel from PNG (alpha channel converted to 7-bit by GD, lower quality)
$pdf->ImagePngWithAlpha('image_with_alpha.png',55,100,100);

// C) same as B), but using Image() method that recognizes the alpha channel
$pdf->Image('image_with_alpha.png',55,190,100);

$pdf->Output();
?>

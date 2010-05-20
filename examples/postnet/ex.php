<?php
require('postnet.php');

$pdf = new PDF_POSTNET("P","pt");
$pdf->AddPage();
$pdf->SetFont("Arial","",10);

// ParseZipCode examples
//$stringToParse = "Ann Arbor, MI 48109-110asdf"; // returns "48109"
//$stringToParse = "Ann Arbor, MI 48109-110"; // returns "48109"
//$stringToParse = "Ann Arbor, MI 481091109"; // returns "91109"
//$stringToParse = "Ann Arbor, MI 48109-1109asdf"; // returns "48109-1109"
//$stringToParse = "Cambridge, MA 0192"; // returns empty string
//$stringToParse = "Cambridge, MA 02139"; // perfect, returns "01239"
$stringToParse = "Ann Arbor, MI 48109-1109"; // perfect, returns "48109-1109"

$zipcode = $pdf->ParseZipCode($stringToParse);
$pdf->POSTNETBarCode(40,40,$zipcode);
$pdf->Text(40,90,$zipcode);

$pdf->Output();
?>

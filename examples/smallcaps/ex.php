<?php
require('smallcaps.php');

$pdf=new PDF_SmallCaps();
$pdf->AddPage();
$pdf->SetFont('Courier','',30);
for ($i = 30; $i>4; $i--) {
	$pdf->SetFontSize($i);
	$pdf->CellSmallCaps(180,8,"The Code and Text Editor",0,1);
}
$pdf->SetFontSize(10);
$pdf->MultiCellSmallCaps(180,6,'The Code and Text Editor is a word processing utility where you enter, display, and edit code or text.'.
	' It is referred to as either the Text Editor or the Code Editor, based on its content.'.
	' If it contains only text without an associated language, it is referred to as the Text Editor.'.
	' If it contains source code associated with a language, it is referred to as the Code Editor.'.
	' Because it is most often used for editing code, though, we will refer to it as the Code Editor.');
$pdf->Output();
?>

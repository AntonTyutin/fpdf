<?php
require('fpdf.php');

class PDF extends FPDF
{
function subWrite($h, $txt, $link='', $subFontSize=12, $subOffset=0)
{
	// resize font
	$subFontSizeold = $this->FontSizePt;
	$this->SetFontSize($subFontSize);
	
	// reposition y
	$subOffset = ((($subFontSize - $subFontSizeold) / $this->k) * 0.3) + ($subOffset / $this->k);
	$subX        = $this->x;
	$subY        = $this->y;
	$this->SetXY($subX, $subY - $subOffset);

	//Output text
	$this->Write($h, $txt, $link);

	// restore y position
	$subX        = $this->x;
	$subY        = $this->y;
	$this->SetXY($subX,  $subY + $subOffset);

	// restore font size
	$this->SetFontSize($subFontSizeold);
}
}
?>

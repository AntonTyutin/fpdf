<?php
/*
Author     : Antoine Michéa
Web        : saturn-share.org
Program    : dashed_rect.php
License    : GPL v2
Description: Allows to draw a dashed rectangle. Parameters are:
             x1, y1 : upper left corner of the rectangle.
             x2, y2 : lower right corner of the rectangle.
             width  : dash thickness (1 by default).
             nb     : number of dashes per line (15 by default).
Date       : 2003-01-07
*/

require('fpdf.php');

class PDF_DashedRect extends FPDF
{
	function DashedRect($x1, $y1, $x2, $y2, $width=1, $nb=15)
	{
		$this->SetLineWidth($width);
		$longueur=abs($x1-$x2);
		$hauteur=abs($y1-$y2);
		if($longueur>$hauteur) {
			$Pointilles=($longueur/$nb)/2; // length of dashes
		}
		else {
			$Pointilles=($hauteur/$nb)/2;
		}
		for($i=$x1;$i<=$x2;$i+=$Pointilles+$Pointilles) {
			for($j=$i;$j<=($i+$Pointilles);$j++) {
				if($j<=($x2-1)) {
					$this->Line($j,$y1,$j+1,$y1); // upper dashes
					$this->Line($j,$y2,$j+1,$y2); // lower dashes
				}
			}
		}
		for($i=$y1;$i<=$y2;$i+=$Pointilles+$Pointilles) {
			for($j=$i;$j<=($i+$Pointilles);$j++) {
				if($j<=($y2-1)) {
					$this->Line($x1,$j,$x1,$j+1); // left dashes
					$this->Line($x2,$j,$x2,$j+1); // right dashes
				}
			}
		}
	}
}
?>

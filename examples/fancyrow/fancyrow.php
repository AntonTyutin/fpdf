<?php
require('mc_table.php');

class PDF_FancyRow extends PDF_MC_Table
{
	function FancyRow($data, $border=array(), $align=array(), $style=array(), $maxline=array())
	{
		//Calculate the height of the row
		$nb = 0;
		for($i=0;$i<count($data);$i++) {
			$nb = max($nb, $this->NbLines($this->widths[$i],$data[$i]));
		}
		if (count($maxline)) {
			$_maxline = max($maxline);
			if ($nb > $_maxline) {
				$nb = $_maxline;
			}
		}
		$h = 5*$nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++) {
			$w=$this->widths[$i];
			// alignment
			$a = isset($align[$i]) ? $align[$i] : 'L';
			// maxline
			$m = isset($maxline[$i]) ? $maxline[$i] : false;
			//Save the current position
			$x = $this->GetX();
			$y = $this->GetY();
			//Draw the border
			if ($border[$i]==1) {
				$this->Rect($x,$y,$w,$h);
			} else {
				$_border = strtoupper($border[$i]);
				if (strstr($_border, 'L')!==false) {
					$this->Line($x, $y, $x, $y+$h);
				}
				if (strstr($_border, 'R')!==false) {
					$this->Line($x+$w, $y, $x+$w, $y+$h);
				}
				if (strstr($_border, 'T')!==false) {
					$this->Line($x, $y, $x+$w, $y);
				}
				if (strstr($_border, 'B')!==false) {
					$this->Line($x, $y+$h, $x+$w, $y+$h);
				}
			}
			// Setting Style
			if (isset($style[$i])) {
				$this->SetFont('', $style[$i]);
			}
			$this->MultiCell($w, 5, $data[$i], 0, $a, 0, $m);
			//Put the position to the right of the cell
			$this->SetXY($x+$w, $y);
		}
		//Go to the next line
		$this->Ln($h);
	}
}
?>

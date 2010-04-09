<?php
require('fpdf.php');

class PDF extends FPDF
{
function Table($sql,$col)
{
	global $conn;

	//Query
	$res=odbc_do($conn,$sql);
	if(!$res)
		die('SQL error');

	//Header
	$this->SetFillColor(255,0,0);
	$this->SetTextColor(255);
	$this->SetDrawColor(128,0,0);
	$this->SetLineWidth(.3);
	$this->SetFont('','B');
	$tw=0;
	foreach($col as $label=>$width)
	{
		$tw+=$width;
		$this->Cell($width,7,$label,1,0,'C',1);
	}
	$this->Ln();

	//Rows
	$this->SetFillColor(224,235,255);
	$this->SetTextColor(0);
	$this->SetFont('');
	$fill=false;
	while(odbc_fetch_row($res))
	{
		foreach($col as $field=>$width)
			$this->Cell($width,6,odbc_result($res,$field),'LR',0,'L',$fill);
		$this->Ln();
		$fill=!$fill;
	}
	$this->Cell($tw,0,'','T');
}
}
?>

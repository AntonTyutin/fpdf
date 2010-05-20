<?php
require('rotation.php');

class PDF_Clock extends PDF_Rotate
{

function hour_scale($x, $y, $r)
{
	$this->SetLineWidth(0.5);
	$this->SetDrawColor(0,0,139);
	for($i=0;$i<12;$i++) {
		$this->Rotate(30*$i,$x,$y);
		$this->Line($x+$r-.5,$y,$x+$r-5,$y);
	}
	$this->Rotate(0);
}

function min_scale($x, $y, $r)
{
	$this->SetLineWidth(0.3);
	$this->SetDrawColor(0,0,139);
	for($i=0;$i<60;$i++) {
		$this->Rotate(6*$i,$x,$y);
		$this->Line($x+$r-3.6,$y,$x+$r-1.8,$y);
	}
	$this->Rotate(0);
}

function hour_hand($x, $y, $r, $hour, $min)
{
	$angle=90-30*($hour+$min/60);
	$this->Rotate($angle,$x,$y);
	$this->SetDrawColor(65,105,225);
	$this->Line($x,$y,$x+$r,$y);
	$this->Rotate(0);
}

function min_hand($x, $y, $r, $min, $sec)
{
	$angle=90-6*($min+$sec/60);
	$this->Rotate($angle,$x,$y);
	$this->SetDrawColor(0,255,0);
	$this->Line($x,$y,$x+$r,$y);
	$this->Rotate(0);
}

function sec_hand($x, $y, $r, $sec)
{
	$angle=90-6*$sec;
	$this->Rotate($angle,$x,$y);
	$this->SetDrawColor(255,0,0);
	$this->Line($x,$y,$x+$r,$y);
	$this->Rotate(0);
}

function sec_hand2($x, $y, $r, $sec)
{
	$angle=-90-6*$sec;
	$this->Rotate($angle,$x,$y);
	$this->SetDrawColor(255,0,0);
	$this->Line($x,$y,$x+$r,$y);
	$this->Rotate(0);
}

function Clock($x, $y, $r)
{
	$this->SetLineWidth(0.50);
	$this->SetFillColor(255,255,0);
	$this->Circle($x,$y,$r,'DF');
	$this->hour_scale($x,$y,$r);
	$this->min_scale($x,$y,$r);

	$a=@getdate();
	$hour=$a['hours'];
	$min=$a['minutes'];
	$sec=$a['seconds'];

	//Hours
	$this->SetLineWidth(1.50);
	$this->hour_hand($x,$y,0.6*$r,$hour,$min);

	//Minutes
	$this->SetLineWidth(1.10);
	$this->min_hand($x,$y,0.85*$r,$min,$sec);

	//Seconds
	$this->SetLineWidth(0.30);
	$this->sec_hand($x,$y,0.88*$r,$sec);
	$this->SetLineWidth(1);
	$this->sec_hand2($x,$y,0.2*$r,$sec);
	$this->SetFillColor(255,0,0);
	$this->Circle($x,$y,1.5,'F');
}
}

?>

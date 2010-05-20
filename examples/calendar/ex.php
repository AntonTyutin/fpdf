<?php
require("pdfUSACalendar.php");

class MyCalendar extends PDF_USA_Calendar
{

function printDay($date)
{
	// add logic here to customize a day
	$this->JDtoYMD($date,$year,$month,$day);
	if ($month == 1 && $day == 10)
		{
		$this->SetXY($this->x, $this->y + $this->squareHeight / 2);
		$this->SetFont("Arial", "B", 10);
		$this->Cell($this->squareWidth,5,"Happy Birthday!", 0,0, "C");
		}
}

function isHoliday($date)
{
	// insert your favorite holidays here
	$this->JDtoYMD($date, $year, $month, $day);
	if ($date == easter_days($year) + $this->MDYtoJD(3,21,$year))
		{
		$noSchool = false;
		return "Easter";
		}
	if ($date == easter_days($year) + $this->MDYtoJD(3,21,$year) - 2)
		{
		$noSchool = false;
		return "Good Friday";
		}
	$jewishDate = explode("/", jdtojewish(gregoriantojd($month,$day,$year)));
	$month = $jewishDate[0];
	$day = $jewishDate[1];
	if ($month == 1 && $day == 1)
		return "Rosh Hashanah";
	if ($month == 1 && $day == 2)
		return "Rosh Hashanah";
	if ($month == 1 && $day == 10)
		return "Yom Kippur";
	if ($month == 3 && $day == 25)
		return "Chanukkah";
	if ($month == 8 && $day == 15)
		return "Passover";
	// call the base class for USA holidays
	return parent::isHoliday($date);
}

} // class MyCalendar extends PDF_USA_Calendar

// MyCalendar shows how to customize your calendar with Easter, some select Jewish holidays and a birthday
// Supports any size paper FPDF does
$pdf = new MyCalendar("L", "Letter");
// you can set margins and line width here. PDF_USA_Calendar uses the current settings.
$pdf->SetMargins(7,7);
$pdf->SetAutoPageBreak(false, 0);
// set fill color for non-weekend holidays
$greyValue = 190;
$pdf->SetFillColor($greyValue,$greyValue,$greyValue);
// print the calendar for a whole year
$year = gmdate("Y");
for ($month = 1; $month <= 12; ++$month)
	{
	$date = $pdf->MDYtoJD($month, 1, $year);
	$pdf->printMonth($date);
	}
$pdf->Output();
?>

<?php
require('fpdf.php');

class PDF_POSTNET extends FPDF
{
	// PUBLIC PROCEDURES

	// draws a bar code for the given zip code using pdf lines
	// triggers error if zip code is invalid
	// x,y specifies the lower left corner of the bar code
	function POSTNETBarCode($x, $y, $zipcode)
	{
		// Save nominal bar dimensions in user units
		// Full Bar Nominal Height = 0.125"
		$FullBarHeight = 9 / $this->k;
		// Half Bar Nominal Height = 0.050"
		$HalfBarHeight = 3.6 / $this->k;
		// Full and Half Bar Nominal Width = 0.020"
		$BarWidth = 1.44 / $this->k;
		// Bar Spacing = 0.050"
		$BarSpacing = 3.6 / $this->k;

		$FiveBarSpacing = $BarSpacing * 5;

		// 1 represents full-height bars and 0 represents half-height bars
		$BarDefinitionsArray = Array(
			1 => Array(0,0,0,1,1),
			2 => Array(0,0,1,0,1),
			3 => Array(0,0,1,1,0),
			4 => Array(0,1,0,0,1),
			5 => Array(0,1,0,1,0),
			6 => Array(0,1,1,0,0),
			7 => Array(1,0,0,0,1),
			8 => Array(1,0,0,1,0),
			9 => Array(1,0,1,0,0),
			0 => Array(1,1,0,0,0));
			
		// validate the zip code
		$this->_ValidateZipCode($zipcode);

		// set the line width
		$this->SetLineWidth($BarWidth);

		// draw start frame bar
		$this->Line($x, $y, $x, $y - $FullBarHeight);
		$x += $BarSpacing;

		// draw digit bars
		for($i = 0; $i < 5; $i++)
		{
			$this->_DrawDigitBars($x, $y, $BarSpacing, $HalfBarHeight, 
				$FullBarHeight, $BarDefinitionsArray, $zipcode{$i});
			$x += $FiveBarSpacing;
		}
		// draw more digit bars if 10 digit zip code
		if(strlen($zipcode) == 10)
		{
			for($i = 6; $i < 10; $i++)
			{
				$this->_DrawDigitBars($x, $y, $BarSpacing, $HalfBarHeight, 
					$FullBarHeight, $BarDefinitionsArray, $zipcode{$i});
				$x += $FiveBarSpacing;
			}
		}
		
		// draw check sum digit
		$this->_DrawDigitBars($x, $y, $BarSpacing, $HalfBarHeight, 
			$FullBarHeight, $BarDefinitionsArray, 
			$this->_CalculateCheckSumDigit($zipcode));
		$x += $FiveBarSpacing;

		// draw end frame bar
		$this->Line($x, $y, $x, $y - $FullBarHeight);

	}

	// Reads from end of string and returns first matching valid
	// zip code of form DDDDD or DDDDD-DDDD, in that order.
	// Returns empty string if no zip code found.
	function ParseZipCode($stringToParse)
	{
		// check if string is an array or object
		if(is_array($stringToParse) || is_object($stringToParse))
		{
			return "";
		}

		// convert parameter to a string
		$stringToParse = strval($stringToParse);

		$lengthOfString = strlen($stringToParse);
		if ( $lengthOfString < 5 ) {
			return "";
		}
		
		// parse the zip code backward
		$zipcodeLength = 0;
		$zipcode = "";
		for ($i = $lengthOfString-1; $i >= 0; $i--)
		{
			// conditions to continue the zip code
			switch($zipcodeLength)
			{
			case 0:
			case 1:
			case 2:
			case 3:
				if ( is_numeric($stringToParse{$i}) ) {
					$zipcodeLength += 1;
					$zipcode .= $stringToParse{$i};
				} else {
					$zipcodeLength = 0;
					$zipcode = "";
				}
				break;
			case 4:
				if ( $stringToParse{$i} == "-" ) {
					$zipcodeLength += 1;
					$zipcode .= $stringToParse{$i};
				} elseif ( is_numeric($stringToParse{$i}) ) {
					$zipcodeLength += 1;
					$zipcode .= $stringToParse{$i};
					break 2;
				} else {
					$zipcodeLength = 0;
					$zipcode = "";
				}
				break;
			case 5:
			case 6:
			case 7:
			case 8:
				if ( is_numeric($stringToParse{$i}) ) {
					$zipcodeLength = $zipcodeLength + 1;
					$zipcode = $zipcode . $stringToParse{$i};
				} else {
					$zipcodeLength = 0;
					$zipcode = "";
				}
				break;
			case 9:
				if ( is_numeric($stringToParse{$i}) ) {
					$zipcodeLength = $zipcodeLength + 1;
					$zipcode = $zipcode . $stringToParse{$i};
					break;
				} else {
					$zipcodeLength = 0;
					$zipcode = "";
				}
				break;
			}
		}

		// return the parsed zip code if found
		if ( $zipcodeLength == 5 || $zipcodeLength == 10 ) {
			// reverse the zip code
			return strrev($zipcode);
		} else {
			return "";
		}

	}

	// PRIVATE PROCEDURES

	// triggers user error if the zip code is invalid
	// valid zip codes are of the form DDDDD or DDDDD-DDDD
	// where D is a digit from 0 to 9, returns the validated zip code
	function _ValidateZipCode($zipcode)
	{
		$functionname = "ValidateZipCode Error: ";

		// check if zipcode is an array or object
		if(is_array($zipcode) || is_object($zipcode))
		{
			trigger_error($functionname.
				"Zip code may not be an array or object.", E_USER_ERROR);
		}

		// convert zip code to a string
		$zipcode = strval($zipcode);

		// check if length is 5
		if ( strlen($zipcode) != 5 && strlen($zipcode) != 10 ) {
			trigger_error($functionname.
				"Zip code must be 5 digits or 10 digits including hyphen. len:".
				strlen($zipcode)." zipcode: ".$zipcode, E_USER_ERROR);
		}

		if ( strlen($zipcode) == 5 ) {
			// check that all characters are numeric
			for ( $i = 0; $i < 5; $i++ ) {
				if ( is_numeric( $zipcode{$i} ) == false ) {
					trigger_error($functionname.
						"5 digit zip code contains non-numeric character.",
						E_USER_ERROR);
				}
			}
		} else {
			// check for hyphen
			if ( $zipcode{5} != "-" ) {
				trigger_error($functionname.
					"10 digit zip code does not contain hyphen in right place.",
					E_USER_ERROR);
			}
			// check that all characters are numeric
			for ( $i = 0; $i < 10; $i++ ) {
				if ( is_numeric($zipcode{$i}) == false && $i != 5 ) {
					trigger_error($functionname.
						"10 digit zip code contains non-numeric character.",
						E_USER_ERROR);
				}
			}
		}

		// return the string
		return $zipcode;
	}

	// takes a validated zip code and 
	// calculates the checksum for POSTNET
	function _CalculateCheckSumDigit($zipcode)
	{
		// calculate sum of digits
		if( strlen($zipcode) == 10 ) {
			$sumOfDigits = $zipcode{0} + $zipcode{1} + 
				$zipcode{2} + $zipcode{3} + $zipcode{4} + 
				$zipcode{6} + $zipcode{7} + $zipcode{8} + 
				$zipcode{9};
		} else {
			$sumOfDigits = $zipcode{0} + $zipcode{1} + 
				$zipcode{2} + $zipcode{3} + $zipcode{4};
		}

		// return checksum digit
		if( ($sumOfDigits % 10) == 0 )
			return 0;
		else
			return 10 - ($sumOfDigits % 10);
	}

	// Takes a digit and draws the corresponding POSTNET bars.
	function _DrawDigitBars($x, $y, $BarSpacing, $HalfBarHeight, $FullBarHeight,
		$BarDefinitionsArray, $digit)
	{
		// check for invalid digit
		if($digit < 0 && $digit > 9)
			trigger_error("DrawDigitBars: invalid digit.", E_USER_ERROR);
		
		// draw the five bars representing a digit
		for($i = 0; $i < 5; $i++)
		{
			if($BarDefinitionsArray[$digit][$i] == 1)
				$this->Line($x, $y, $x, $y - $FullBarHeight);
			else
				$this->Line($x, $y, $x, $y - $HalfBarHeight);
			$x += $BarSpacing;
		}
	}

}
?>

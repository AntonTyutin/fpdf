<?php

/***************************************************************************
 *                              cube.php
 *                            -------------------
 *   creado               : Viernes, 2 de Julio de 2004
 *   copyright            : (C) 2004 LUCIANO SALVINO
 *
 *   $Id: cube.php,v 1.3.1 02/07/2004 17:44:00 psotfx Exp $
 *
 ***************************************************************************/

require('fpdf.php');

class PDF_Cube extends FPDF
{

function Cube($a=10, $b=10, $c=10, $scale=1, $alfax=10, $alfay=10, $alfaz=10) {

	$x = ($this->w-$this->rMargin)/2-($a/2);
	$y = ($this->h-$this->tMargin)/2-($b/2);

	$cubo = array(
		array($x+$a,$y+$b,$c),
		array($x+$a,$y+$b,-$c),
		array($x-$a,$y+$b,-$c),
		array($x-$a,$y+$b,$c),
		array($x+$a,$y-$b,$c),
		array($x+$a,$y-$b,-$c),
		array($x-$a,$y-$b,-$c),
		array($x-$a,$y-$b,$c)
	);

	$senx = sin($alfax*M_PI/180);
	$cosx = cos($alfax*M_PI/180);
	$seny = sin($alfay*M_PI/180);
	$cosy = cos($alfay*M_PI/180);
	$senz = sin($alfaz*M_PI/180);
	$cosz = cos($alfaz*M_PI/180);
	$a = $cosy*$cosz;
	$b = $cosy*$senz;
	$c = -$seny;
	$d = $senx*$seny*$cosz-$cosx*$senz;
	$e = $senx*$seny*$senz+$cosx*$cosz;
	$f = $senx*$cosy;
	$g = $cosx*$seny*$cosz+$senx*$senz;
	$h = $cosx*$seny*$senz-$senx*$cosz;
	$k = $cosx*$cosy;

	for ($i=0; $i<count($cubo); $i++) {
	   $cubo[$i][0] = ($a*$cubo[$i][0]+$b*$cubo[$i][1]+$c*$cubo[$i][2])*$scale;
	   $cubo[$i][1] = ($d*$cubo[$i][0]+$e*$cubo[$i][1]+$f*$cubo[$i][2])*$scale;
	   $cubo[$i][2] = ($g*$cubo[$i][0]+$h*$cubo[$i][1]+$k*$cubo[$i][2])*$scale;
	}

	/*Tapa inferior*/
	$this->Line($cubo[0][0],$cubo[0][1],$cubo[1][0],$cubo[1][1]);
	$this->Line($cubo[1][0],$cubo[1][1],$cubo[2][0],$cubo[2][1]);
	$this->Line($cubo[2][0],$cubo[2][1],$cubo[3][0],$cubo[3][1]);
	$this->Line($cubo[3][0],$cubo[3][1],$cubo[0][0],$cubo[0][1]);

	/*Tapa superior*/
	$this->Line($cubo[4][0],$cubo[4][1],$cubo[5][0],$cubo[5][1]);
	$this->Line($cubo[5][0],$cubo[5][1],$cubo[6][0],$cubo[6][1]);
	$this->Line($cubo[6][0],$cubo[6][1],$cubo[7][0],$cubo[7][1]);
	$this->Line($cubo[7][0],$cubo[7][1],$cubo[4][0],$cubo[4][1]);

	/*Laterales*/
	$this->Line($cubo[0][0],$cubo[0][1],$cubo[4][0],$cubo[4][1]);
	$this->Line($cubo[1][0],$cubo[1][1],$cubo[5][0],$cubo[5][1]);
	$this->Line($cubo[2][0],$cubo[2][1],$cubo[6][0],$cubo[6][1]);
	$this->Line($cubo[3][0],$cubo[3][1],$cubo[7][0],$cubo[7][1]);

}

}
?>

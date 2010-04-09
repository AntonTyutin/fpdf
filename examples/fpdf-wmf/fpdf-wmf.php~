<?php
/****************************************************************************
* Software: FPDF_WMF                                                        *
* Version:  0.4                                                             *
* Date:     2009-08-01                                                      *
* Author:   Martin HALL-MAY                                                 *
* License:  FPDF                                                            *
****************************************************************************/

require('fpdf.php');

class FPDF_WMF extends FPDF
{
	var $formobjects=array(); // array of Form Objects
	var $gdiObjectArray;      // array of GDI objects (pens, brushes, etc.)

	// Play back a WMF file
	// Placement and sizing of the image works as with Image()
	function ImageWMF($file, $x, $y, $w=0, $h=0, $link='')
	{
		// Put a WMF image on the page
		if(!isset($this->formobjects[$file]))
		{
			// First use of image, get info
			$info=$this->_parsewmf($file);
			$info['i']=count($this->formobjects)+1;
			$this->formobjects[$file]=$info;
		}
		else
		{
			$info=$this->formobjects[$file];
		}

		// Automatic dimensions if necessary
		// WMF units are twips (1/20pt)
		// divide by 20 to get points
		// divide by k to get user units
		if($w==0 && $h==0)
		{
			$w = abs($info['w'])/(20*$this->k);
			$h = abs($info['h'])/(20*$this->k);
		}
		if($w==0)
			$w = abs($h*$info['w']/$info['h']);
		if($h==0)
			$h = abs($w*$info['h']/$info['w']);

		$sx = $w*$this->k / $info['w'];
		$sy = -$h*$this->k / $info['h'];
		$this->_out(sprintf('q %F 0 0 %F %F %F cm /FO%d Do Q', $sx, $sy, $x*$this->k-$sx*$info['x'], (($this->h-$y)*$this->k)-$sy*$info['y'], $info['i']));

		if($link)
			$this->Link($x,$y,$w,$h,$link);
	}

	function _parsewmf($file)
	{
		$this->gdiObjectArray = array();

		$a=unpack('stest',"\1\0");
		if ($a['test']!=1)
			$this->Error('Big-endian architectures are not supported');

		$f=fopen($file,'rb');
		if(!$f)
			$this->Error('Can\'t open image file: '.$file);

		// check for Aldus placeable metafile header
		$key = unpack('Lmagic', fread($f, 4));
		$headSize = 18 - 4; // WMF header minus four bytes already read
		if ($key['magic'] == (int)0x9AC6CDD7)
			$headSize += 22; // Aldus header

		// strip headers
		fread($f, $headSize);

		// define some state variables
		$wo=null; // window origin
		$we=null; // window extent
		$polyFillMode = 0;
		$nullPen = false;
		$nullBrush = false;

		$endRecord = false;

		$data = '';

		// read the records
		while (!feof($f) && !$endRecord)
		{
			$recordInfo = unpack('Lsize/Sfunc', fread($f, 6));

			// size of record given in WORDs (= 2 bytes)
			$size = $recordInfo['size'];

			// func is number of GDI function
			$func = $recordInfo['func'];

			// parameters are read as one block and processed
			// as necessary by the case statement below.
			// the data are stored in little-endian format and are unpacked using:
			// s - signed 16-bit int
			// S - unsigned 16-bit int (or WORD)
			// L - unsigned 32-bit int (or DWORD)
			// NB. parameters to GDI functions are stored in reverse order
			// however structures are not reversed,
			// e.g. POINT { int x, int y } where x=3000 (0x0BB8) and y=-1200 (0xFB50)
			// is stored as B8 0B 50 FB
			if ($size > 3)
			{
				$parms = fread($f, 2*($size-3));
			}

			// process each record.
			// function numbers are defined in wingdi.h
			switch ($func)
			{
				case 0x020b:  // SetWindowOrg
					// do not allow window origin to be changed
					// after drawing has begun
					if (!$data)
						$wo = array_reverse(unpack('s2', $parms));
					break;

				case 0x020c:  // SetWindowExt
					// do not allow window extent to be changed
					// after drawing has begun
					if (!$data)
						$we = array_reverse(unpack('s2', $parms));
					break;

				case 0x02fc:  // CreateBrushIndirect
					$brush = unpack('sstyle/Cr/Cg/Cb/Ca/Shatch', $parms);
					$brush['type'] = 'B';
					$this->_AddGDIObject($brush);
					break;

				case 0x02fa:  // CreatePenIndirect
					$pen = unpack('Sstyle/swidth/sdummy/Cr/Cg/Cb/Ca', $parms);

					// convert width from twips to user unit
					$pen['width'] /= (20 * $this->k);
					$pen['type'] = 'P';
					$this->_AddGDIObject($pen);
					break;

				// MUST create other GDI objects even if we don't handle them
				// otherwise object numbering will get out of sequence
				case 0x06fe: // CreateBitmap
				case 0x02fd: // CreateBitmapIndirect
				case 0x00f8: // CreateBrush
				case 0x02fb: // CreateFontIndirect
				case 0x00f7: // CreatePalette
				case 0x01f9: // CreatePatternBrush
				case 0x06ff: // CreateRegion
				case 0x0142: // DibCreatePatternBrush
					$dummyObject = array('type'=>'D');
					$this->_AddGDIObject($dummyObject);
					break;

				case 0x0106:  // SetPolyFillMode
					$polyFillMode = unpack('smode', $parms);
					$polyFillMode = $polyFillMode['mode'];
					break;

				case 0x01f0:  // DeleteObject
					$idx = unpack('Sidx', $parms);
					$idx = $idx['idx'];
					$this->_DeleteGDIObject($idx);
					break;

				case 0x012d:  // SelectObject
					$idx = unpack('Sidx', $parms);
					$idx = $idx['idx'];
					$obj = $this->_GetGDIObject($idx);

					switch ($obj['type'])
					{
						case 'B':
							$nullBrush = false;

							if ($obj['style'] == 1) // BS_NULL, BS_HOLLOW
							{
								$nullBrush = true;
							}
							else
							{
								$data .= sprintf("%.3F %.3F %.3F rg\n",$obj['r']/255,$obj['g']/255,$obj['b']/255);
							}
							break;

						case 'P':
							$nullPen = false;
							$dashArray = array(); 

							// dash parameters are my own - feel free to change them
							switch ($obj['style'])
							{
								case 0: // PS_SOLID
									break;
								case 1: // PS_DASH
									$dashArray = array(3,1);
									break;
								case 2: // PS_DOT
									$dashArray = array(0.5,0.5);
									break;
								case 3: // PS_DASHDOT
									$dashArray = array(2,1,0.5,1);
									break;
								case 4: // PS_DASHDOTDOT
									$dashArray = array(2,1,0.5,1,0.5,1);
									break;
								case 5: // PS_NULL
									$nullPen = true;
									break;
							}

							if (!$nullPen)
							{
								$data .= sprintf("%.3F %.3F %.3F RG\n",$obj['r']/255,$obj['g']/255,$obj['b']/255);
								$data .= sprintf("%.2F w\n",$obj['width']*$this->k);
							}

							if (!empty($dashArray))
							{
								$s = '[';
								for ($i=0; $i<count($dashArray);$i++)
								{
									$s .= $dashArray[$i] * $this->k;
									if ($i != count($dashArray)-1)
										$s .= ' ';
								}
								$s .= '] 0 d';
								$data .= $s."\n";
							}

							break;
					}
					break;

				case 0x0325: // Polyline
				case 0x0324: // Polygon
					$coords = unpack('s'.($size-3), $parms);
					$numpoints = $coords[1];

					for ($i = $numpoints; $i > 0; $i--)
					{
						$px = $coords[2*$i];
						$py = $coords[2*$i+1];

						if ($i < $numpoints)
							$data .= $this->LineTo($px, $py);
						else
							$data .= $this->MoveTo($px, $py);
					}

					if ($func == 0x0325)
					{
						$op = 's';
					}
					else if ($func == 0x0324)
					{
						if ($nullPen)
						{
							if ($nullBrush)
								$op = 'n';  // no op
							else
								$op = 'f';  // fill
						}
						else
						{
							if ($nullBrush)
								$op = 's';  // stroke
							else
								$op = 'b';  // stroke and fill
						}

						if ($polyFillMode==1 && ($op=='b' || $op=='f')) 
							$op .= '*';  // use even-odd fill rule
					}

					$data .= $op."\n";
					break;

				case 0x0538: // PolyPolygon
					$coords = unpack('s'.($size-3), $parms);

					$numpolygons = $coords[1];

					$adjustment = $numpolygons;

					for ($j = 1; $j <= $numpolygons; $j++)
					{
						$numpoints = $coords[$j + 1];

						for ($i = $numpoints; $i > 0; $i--)
						{
							$px = $coords[2*$i   + $adjustment];
							$py = $coords[2*$i+1 + $adjustment];

							if ($i == $numpoints)
								$data .= $this->MoveTo($px, $py);
							else
								$data .= $this->LineTo($px, $py);
						}

						$adjustment += $numpoints * 2;
					}

					if ($nullPen)
					{
						if ($nullBrush)
							$op = 'n';  // no op
						else
							$op = 'f';  // fill
					}
					else
					{
						if ($nullBrush)
							$op = 's';  // stroke
						else
							$op = 'b';  // stroke and fill
					}

					if ($polyFillMode==1 && ($op=='b' || $op=='f')) 
						$op .= '*';  // use even-odd fill rule

					$data .= $op."\n";

					break;

				case 0x0000:
					$endRecord = true;
					break;
			}
		}

		fclose($f);
		return array('x'=>$wo[0],'y'=>$wo[1],'w'=>$we[0],'h'=>$we[1],'data'=>$data);
	}

	function MoveTo($x, $y)
	{
		return "$x $y m\n";
	}

	// a line must have been started using MoveTo() first
	function LineTo($x, $y)
	{
		return "$x $y l\n";
	}

	function _AddGDIObject($obj)
	{
		// find next available slot
		$idx = 0;
		if (!empty($this->gdiObjectArray))
		{
			$empty = false;
			$i = 0;

			while (!$empty)
			{
				$empty = !isset($this->gdiObjectArray[$i]);
				$i++;
			}
			$idx = $i-1;
		}

		$this->gdiObjectArray[$idx] = $obj;
	}

	function _GetGDIObject($idx)
	{
		return $this->gdiObjectArray[$idx];
	}

	function _DeleteGDIObject($idx)
	{
		unset($this->gdiObjectArray[$idx]);
	}

	function _putformobjects()
	{
		reset($this->formobjects);
		while(list($file,$info)=each($this->formobjects))
		{
			$this->_newobj();
			$this->formobjects[$file]['n']=$this->n;
			$this->_out('<</Type /XObject');
			$this->_out('/Subtype /Form');
			$this->_out('/BBox ['.$info['x'].' '.$info['y'].' '.($info['w']+$info['x']).' '.($info['h']+$info['y']).']');
			if ($this->compress)
				$this->_out('/Filter /FlateDecode');
			$data=($this->compress) ? gzcompress($info['data']) : $info['data'];
			$this->_out('/Length '.strlen($data).'>>');
			$this->_putstream($data);
			unset($this->formobjects[$file]['data']);
			$this->_out('endobj');
		}
	}

	function _putxobjectdict()
	{
		parent::_putxobjectdict();
		foreach($this->formobjects as $formobject)
			$this->_out('/FO'.$formobject['i'].' '.$formobject['n'].' 0 R');
	}

	function _putresources()
	{
		$this->_putformobjects();
		parent::_putresources();
	}
}

?>
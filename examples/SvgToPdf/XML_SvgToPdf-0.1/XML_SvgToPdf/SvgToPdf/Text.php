<?php


class XML_SvgToPDF_Text  extends XML_SvgToPDF_Base { 
    function writePDF(&$pdf,$data) {
        // set up font.. 
         
        $font = strtolower($this->style['font-family']);
        
        static $map = array(
            'times new roman' => 'times'
        );
        if (isset($map[$font])) {
            $font = $map[$font];
        }
            
        
        
        $weight =  '';
        if ($this->style['font-weight'] == 'bold') {
            $weight .=  'B';
        }
        if (@$this->style['font-style'] == 'italic') {
            $weight .=  'I';
        }
        
        if (@$this->style['text-decoration'] == 'underline') {
            $weight .=  'U';
        }
        // size..
        $size = $this->style['font-size'] * 0.8;
        
        $pdf->setFont($font,$weight,$size);
     
        switch(@$this->style['text-anchor']) {
            case 'middle':
                $align = 'M';
                break;
            default:
                $align = 'L';
            
        }
        
     
     
     
        $yoffset = 0;
        $x =  $this->x   + @$this->xx;
        $y =  $this->y  + @$this->yy;
        foreach($this->children as $c) {
            $xx = isset($c->x) ? $c->x + @$this->xx : $x;
            $yy = isset($c->y) ? $c->y + @$this->yy : $y;
              
            $val = @$c->content;
            
            if (isset($c->args)) {
                
                $args = array();
                foreach($c->args as $v) {
                    if ($v == 'page') {
                        $args[] = $pdf->PageNo();
                        continue;
                    }
                    if ($v == 'nb') {
                        $args[] = '{nb}';
                        continue;
                    }
                    $args[] = $this->getValue($data,trim($v));
                }
                
                $val = vsprintf($val,$args);
            }
          
            
            $yoffset += $this->multiLine($pdf,explode("\n",$val),
                    $xx/ 3.543307,
                    ($yy / 3.543307) + $yoffset,
                    ($size / 3.543307) + 1,
                    $align
                );
            
             
        }
        
        // now daraw
    
    }
    
    function getValue($data,$v) {
        if ($v{strlen($v)-1}  != ')') {
            $data = (array) $data;
            return @$data[$v];
        }
        // method !!!
        if (!is_object($data)) {
            return '';
        }
        $method = substr($v,0,-2);
        if (is_callable(array($data,$method))) {
            return $data->$method();
        }
        //echo 
        //print_r($data);
        
        //exit;
        return "no method $method in ".get_class($data);
    
    
    }
    
    
    function breakLines(&$pdf,$str,$x,$y,$h,$align) {
        // do the estimation...
        $len = strlen($str);
 
        $total = $pdf->getStringWidth($str . '      ');
         
        $charsize = $total/$len;
        
        $max_chars = floor(($this->maxWidth / 3.543307) / $charsize);
        //echo "LEN: $len, $total, $charsize, $max_chars";
        $lines = explode("\n",wordwrap($str,$max_chars));
         
        return $this->multiLine($pdf,$lines,$x,$y,$h,$align);
    }
    
    function multiLine(&$pdf,$lines,$x,$y,$h,$align) {
        // now dealing with mm
        XML_SvgToPDF::debug("MULTILINE " .implode("\n",$lines) . " $x, $y, $h");
        $yoffset  = 0;
        foreach ($lines as $l=>$v) {
            if (@$this->maxWidth && ($pdf->getStringWidth($v) > ($this->maxWidth / 3.543307))) {
                $yoffset += $this->breakLines($pdf,$v,$x,$y + ($l * $h) + $yoffset, $h,$align);
                continue;
            }
            XML_SvgToPDF::debug("TEXT: $x,$y, $l * $h + $yoffset,$v");
            $xoffset = 0;
            if ($align == 'M') { // center
                $xoffset = -1 * ($pdf->getStringWidth($v) / 2);
            }
            $pdf->text(
                $xoffset + $x ,
                $y + ($l * $h) + $yoffset ,
                $v);
                
        }
        return   ($l * $h) + $yoffset;
        
    }
        
        
     

}
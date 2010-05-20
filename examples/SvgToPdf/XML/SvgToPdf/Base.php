<?php

/*
The base node includes:
    fromNode - convert the XML_Tree node into object with vars
        (and parse styles)
    
    // iternate tree with writePDF
    writePDF($pdf,$data) 
    childrenWritePDF($pdf,$data)  

    // shift coordinates of group dynamic elements 
    // so the x is relative to the block corner.
    shiftChildren($x,$y) {
    shift($x,$y) 
    
    // find a dynamic block and calculate how much data it can hold.
    // so you know how many pages are needed.
    calcPerPage()
*/

class XML_SvgToPDF_Base { 

    function fromNode($node) {
        
        if ($node->attributes) {
            foreach($node->attributes as $k=>$v) {
                if (strpos($k,':')) {
                    $kk = explode(':',$k);
                    $k = $kk[1];
                }
                $this->$k = $v;
                if (preg_match('/[0-9]+mm$/',$v)) {
                    $v = str_replace('mm','',$v);
                    $v = $v * 3.543307;
                
                    $this->$k = $v;
                    continue;
                }
                
            }
        }
        
        if (isset($this->style)) {
            $s = explode(';',$this->style);
            foreach($s as $ss) {
                if (!strlen(trim($ss))) {
                    continue;
                }
                if (strpos($ss,':') === false) {
                    $style[$ss] = true;
                    continue;
                }
                $sss = explode(':',$ss);
                if (preg_match('/[0-9]+pt$/',$sss[1])) {
                    $sss[1] =  str_replace('pt','',$sss[1]);
                }
                $style[$sss[0]] = $sss[1];
            }
            $this->style = $style;
        }
                
        
        if ($node->content) {
            $this->content = trim($node->content);
        }
        if ($node->children) {
            $this->children = $node->children;
        }
    }
    
    function writePDF(&$pdf,&$data) {
        $this->childrenWritePDF($pdf,$data);
    }
    
    function childrenWritePDF(&$pdf,&$data) {
        if (!@$this->children) {
            return;
        }
        foreach(array_keys($this->children) as $k) {
            if (!$this->children[$k]) {
                continue;
            }
            if (!method_exists($this->children[$k],'writePDF')) {
                echo "OOPS unknown object? <PRE>" ; print_r($this->children[$k]); exit;
            }
            $this->children[$k]->writePDF($pdf,$data);
        }
    }
    
    function shiftChildren($x,$y) {
        if (!@$this->children) {
            return;
        }
        foreach(array_keys($this->children) as $k) {
            if (!$this->children[$k]) {
                continue;
            }
            $this->children[$k]->shift($x,$y);
        }
    }
    
    function shift($x,$y) {
        //XML_SvgToPDF::debug('shift');
        //XML_SvgToPDF::debug(array($x,$y));
        //XML_SvgToPDF::debug($this);
        if (isset($this->x)) {
            
            $this->x -= $x;
        }
        if (isset($this->y)) {
            $this->y -= $y;
        }
        //XML_SvgToPDF::debug($this);
        $this->shiftChildren($x,$y);
    }
    function calcPerPage() {
    
        foreach($this->children as $n) {
            if (!$n) {
                continue;
            }
            if (!is_a($n, 'XML_SvgToPDF_G')) {
                continue;
            }
            if (!isset($n->settings)) {
                continue;
            }
            
            $rows  = isset($n->settings['rows']) ? $n->settings['rows'] : 1;
            $cols  = isset($n->settings['cols']) ? $n->settings['cols'] : 1;
            return array($n->settings['dynamic'], $rows * $cols);
            
            
        }
        return array('',0);
    
    
    
    
    }
    
    
    
    
}
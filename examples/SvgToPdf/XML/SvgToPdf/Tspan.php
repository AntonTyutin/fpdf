<?php

/* the actual text container..

does a quick bit of parsing to see if it a {template}var ..
*/ 

class XML_SvgToPDF_Tspan extends XML_SvgToPDF_Base { 

    function fromNode($node) {
        parent::fromNode($node);
        static $trans = false;
        if (!$trans) {
            $trans = array_flip(get_html_translation_table(HTML_ENTITIES));
        }
        if (@$this->content) {
            if (strpos($this->content,'&') !== false) {
                
                $this->content= strtr($this->content, $trans);
                $this->content = str_replace('&apos;',"'",$this->content);
            }
            
            if (false === strpos($this->content,'{')) {
                return;
            }
            preg_match_all('/\{([a-z_]+(\(\))?)\}/i',$this->content,$matches);
            
            //if (false !== strpos($this->content,'(')) {
                
            //    echo "<PRE>";print_R($matches);
            //    exit;
            //}
            
            $this->args = $matches[1];
            foreach($this->args as $v) {
                $this->content  = str_replace('{'.$v.'}', '%s',$this->content);
            }
            //$this->content = preg_replace('/\{('.implode('|',$matches[1]).')\}/','%s',$this->content);
        }
        
    }
            



}
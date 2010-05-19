<?php
require_once 'XML/Tree/Morph.php';
require_once 'XML/SvgToPdf/Base.php';
require_once 'XML/SvgToPdf/G.php';
require_once 'XML/SvgToPdf/Rect.php';
require_once 'XML/SvgToPdf/Text.php';
require_once 'XML/SvgToPdf/Tspan.php';
require_once 'XML/SvgToPdf/Path.php';

class XML_SvgToPDF_SVG   extends XML_SvgToPDF_Base { }


class XML_SvgToPDF {

    function debug($s,$e=0) {
        // echo "<PRE>".print_R($s,true). "</PRE>";if ($e) { exit; }
    }
    function construct($svg, $data=array()) {
        $t = new XML_SvgToPDF;


        $x = new XML_Tree_Morph(
                    $svg,
                    array(
                       'debug' => 0,
                       'filter' => array(
                           'svg'    => array(&$t, 'buildObject'),
                           'text'    => array(&$t, 'buildObject'),
                           'tspan'   => array(&$t, 'buildObject'),
                           'rect'   => array(&$t, 'buildObject'),
                           'g'   =>  array(&$t, 'buildObject'),
                           'path'   =>  array(&$t, 'buildObject'),
                           'sodipodi:namedview' =>  array(&$t, 'buildNull'),
                           'defs' =>  array(&$t, 'buildNull'),
                        )
                    )
                 );
        $tree = $x->getTreeFromFile();
        $tree = $t->buildobject($tree);


        $orientation =  ($tree->width > $tree->height) ? 'L' : 'P';

        $pdf=new FPDF($orientation ,'mm','A4');
        $pdf->open();
        $pdf->setAutoPageBreak(false);
        $pdf->AliasNbPages();
        // convert data to array.
        if (is_object($data)) {
            $data = (array) $data;
        }


        // no data page..
        if (empty($data)) {
            $pdf->addPage();
            $tree->writePDF($pdf,$data);
            $t->debug($tree);
            return $pdf;
        }
        // work out how many pages...
        list($var,$perpage) = $tree->calcPerPage();

		if($var=='')
			die('No dynamic group found');
		if(!isset($data[$var]))
			die('Incorrect dynamic group name');

        $alldata = $data[$var];
        $page = 0;
        while (count($alldata)) {
            $page++;
            $t->debug("<B>PAGE $page<B>");
            $page_data =  array_splice ( $alldata, 0,$perpage);
            $data[$var] = $page_data;
            $pdf->addPage();
            $tree->writePDF($pdf,$data);
        }
        $t->debug($tree);
        return $pdf;
    }

    function buildNull($node) {
        return;
    }
    function buildObject($node) {
        $class = 'XML_SvgToPDF_'.$node->name;
        //echo "look for $class?";
        if (!class_exists($class)) {
            return;
        }
        $r = new $class;
        $r->fromNode($node);
        return $r;
    }




}

<?php
require_once '../src/fpdf.php';

class Test extends PHPUnit_Framework_TestCase
{
    function testFpdfConstructor()
    {
        $this->assertTrue(is_object(new FPDF));
    }
}

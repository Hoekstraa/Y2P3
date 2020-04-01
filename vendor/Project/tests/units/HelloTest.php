<?php
namespace vendor\Project\tests\units;

//require_once 'path/to/atoum.phar';

include_once 'C:\xampp\htdocs\Y2P3\vendor\Project\HelloTest.php';

use mageekguy\atoum;
use vendor\project;

/*
 * Test class for Vendor\Project\HelloWorld
 *
 * Note that they had the same name that the tested class
 * and that it derives frim the atoum class
 */
class HelloTest extends atoum\test
{
    /*
     * This method is dedicated to the getHiAtoum() method
     */
    public function testGetHiAtoum ()
    {
        $this
            // creation of a new instance of the tested class
            ->given($this->newTestedInstance)

            ->then

            // we test that the getHiAtoum method returns
            // a string...
            ->string($this->testedInstance->getHiAtoum())
            // ... and that this string is the one we want,
            // namely 'Hi atoum !'
            ->isEqualTo('Hi atoum !')
        ;
    }
}
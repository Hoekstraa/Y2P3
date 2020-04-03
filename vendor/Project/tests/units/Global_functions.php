<?php


namespace vendor\Project\tests\units;

include_once dirname(__FILE__) . '/../../Global_functions.php';

use mageekguy\atoum;
use vendor\project;

class Global_functions extends atoum\test
{
    /*
     * This method is dedicated to the getHiAtoum() method
     */
    public function testhihi()
    {
        $this
            // creation of a new instance of the tested class
            ->given($this->newTestedInstance)

            ->then

            // we test that the getHiAtoum method returns
            // a string...
            ->string($this->testedInstance->hihi())
            // ... and that this string is the one we want,
            // namely 'Hi atoum !'
            ->isEqualTo('HI')
        ;
    }
}
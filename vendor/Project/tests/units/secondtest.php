<?php

namespace vendor\Project\tests\units;
include_once 'C:\xampp\htdocs\Y2P3\vendor\Project\secondtest.php';

use mageekguy\atoum;
use vendor\project;

class secondtest extends atoum\test
{
    public function testhihi(){
        $this
            // creation of a new instance of the tested class
            ->given($this->newTestedInstance)

            ->then

            // we test that the getHiAtoum method returns
            // a string...
            ->string($this->testedInstance->hihi())
            // ... and that this string is the one we want,
            ->isEqualTo('hi Test')
        ;
    }
}
<?php


namespace Vendor\Project\tests\units;

include_once dirname(__FILE__) . '/../../Global_functions.php';

use atoum;
use Faker\Factory;
use Faker\Generator;

class Global_functions extends atoum
{

    public function testban(){
        $faker = Factory::create();
        $IP = $faker->ipv4;
        $MAC = $faker->macAddress;
        $Session_banned = "GE9Rr1eyAz3HyyYrUPhZHwMXZenSU78Wobgu2b4kIWwMpFRGASIfEOBAmVVV7cE0ayZ0JafbDaOzlsRSBRHP4XmCTPCMaEyHSUj7";


        $this
            ->given($this->newTestedInstance())
            ->when($this->testedInstance->Ban($IP,$MAC,$Session_banned))
            ->then
            ->boolean($this->testedInstance->BannedCheckForBannedPage($IP,$MAC,$Session_banned))
            ->isTrue()

        ;
    }

}
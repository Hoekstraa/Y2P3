<?php


namespace Vendor\Project\tests\units;

include_once dirname(__FILE__) . '/../../Global_functions.php';

use atoum;
use Faker\Factory;
use Faker\Generator;

class Global_functions extends atoum
{
    //tests the ban function
    public function testban(){

        //creates fake information
        $faker = Factory::create();
        $IP = $faker->ipv4;
        $MAC = $faker->macAddress;
        $Session_banned = "GE9Rr1eyAz3HyyYrUPhZHwMXZenSU78Wobgu2b4kIWwMpFRGASIfEOBAmVVV7cE0ayZ0JafbDaOzlsRSBRHP4XmCTPCMaEyHSUj7";


        $this
            //first testcase
            ->given($this->newTestedInstance())
                ->boolean($this->testedInstance->BannedCheckForBannedPage($IP,$MAC,$Session_banned))
                ->isFalse()

            //second testcase
            ->given($this->newTestedInstance())
            ->when($this->testedInstance->Ban($IP,$MAC,$Session_banned))
            ->then
                ->boolean($this->testedInstance->BannedCheckForBannedPage($IP,$MAC,$Session_banned))
                    ->isTrue()
        ;

    }

    //test the checkIfAdmin function
    public  function testcheckIfAdmin(){

        //creates fake infromation
        $faker = Factory::create();
        $IP = $faker->ipv4;
        $MAC = $faker->macAddress;

        $this
            //first test case
            ->given($this->newTestedInstance())
            ->then
                ->boolean($this->testedInstance->CheckIfAdmin($IP,$MAC))
                    ->isFalse()

            //second testcase
            ->given($this->newTestedInstance())
                ->when($this->testedInstance->makeAdmin($IP,$MAC))
            ->then
                ->boolean($this->testedInstance->CheckIfAdmin($IP,$MAC))
                    ->isTrue()
        ;
    }

    //tests the GetTitle function
    public function testGetTitle(){
        $this
            //first testcase
            ->given($this->newTestedInstance())
            ->then
                ->string($this->testedInstance->GetTitle("/Project2.3/login.php"))
                    ->isEqualTo("Login")

            //second testcase
            ->given($this->newTestedInstance())
            ->then
                ->string($this->testedInstance->GetTitle("/Project2.3/register.php"))
                    ->isEqualTo("Registreren")
        ;
    }

}
<?php

namespace Vendor\Project\tests\units;

include_once dirname(__FILE__) . '/../../advisorConsultant.php';

use atoum;
use Faker\Factory;
use Faker\Generator;

class advisorConsultant extends atoum
{

    public function testvalidateInformation(){

        $faker = Factory::create();
        $validsubject = $faker->text(30);
        $invalidsubject = $faker->text(3000);
        $invalidquestion = $faker->text(5000);
        $validquestion = $faker->text(500);
        $harmfullinput = "<sripts>jkfjl</scrips>";

        $date = $faker->date('now');

        $this

            ->given($this->newTestedInstance())
                ->boolean($this->testedInstance->validateInformation($validsubject,$validquestion,$date))
                    ->isTrue()

            ->given($this->newTestedInstance())
                ->boolean($this->testedInstance->validateInformation($invalidsubject,$validquestion,$date))
                    ->isFalse()

            ->given($this->newTestedInstance())
                ->boolean($this->testedInstance->validateInformation($validsubject,$invalidquestion,$date))
                    ->isFalse()

            ->given($this->newTestedInstance())
                ->boolean($this->testedInstance->validateInformation($validsubject,$harmfullinput,$date))
                    ->isTrue()

            ->given($this->newTestedInstance())
                ->boolean($this->testedInstance->validateInformation($harmfullinput,$validquestion,$date))
                    ->isTrue()
        ;
    }


}
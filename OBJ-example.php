<?php
require_once("header.php");
?>


<div class="container pt-5 mt-5">
    <div class="row">
        <div class="col-12"> <h1>SSP Object Oriented Programming</h1></div>
        <hr class="pb-5">
        <div class="col-12">
        <?php
        class Person {
            public $first_name = "";
            public $last_name = "";
            public $hair;
            public $birthdate;

            public function getAge(){
                $date = new DateTime($this->birthdate);
                $now = new DateTime();
                $age = $now->diff($date);
                return $age->y;
            }
        }

        $person1 = new Person ();
        $person1->first_name = "Peter";
        $person1->last_name = "Vigilante";
        $person1->hair = "Brown";
        $person1->birthdate = "1971-04-31";


        print_r($person1);
        echo $person1 -> getAge();

        echo "<hr>";

        $taylor = new Person ();
        $taylor->first_name = "Taylor";
        $taylor->last_name = "Field";
        $taylor->hair = "Blond";
        $taylor->birthdate = "1994-11-26";

    
        echo $taylor -> first_name . " is " . $taylor -> getAge();
        
        ?>


        </div>
    </div>
</div>

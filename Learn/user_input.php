<?php

class weapon
{
    public $platform;
    public $chamber;
    public $serial;
    public $datafields = ["platform", "chamber", "serial"];
    public function weaponInfo()
    {
        foreach ($this->datafields as $field){
            //echo "$field current value is ". $this->$field. "\n";
            $data = readline("$field ;");
            $this->$field = $data;
        }
    }

}

class arsenal
{
    protected $weapons = array();
    public function add_weapon(weapon $weapon)
    {
        $this->weapons[] = $weapon;
    }

    public function build()
    {
        $finished = false;
        while ($finished == false) {
            $currentWeapon = new weapon();
            $currentWeapon->weaponInfo();
            $this->add_weapon($currentWeapon);

            echo "\nAdd other weapon? y/n\n";
            $answer = readline();
            if ($answer == "n") {
                $finished = true;
            }
        }
    }
}


$myGuns = new arsenal();
$myGuns->build();


print_r($myGuns);
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
//
//class Glock extends weapon
//{
//    public $platform = "G43";
//    public $datafields = ["platform", "chamber", "serial", "variant"];
//}
//$g = new Glock();
//$g->weaponInfo();
//print_r($g);
//exit;

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

    public function save_arsenal()
    {
        echo "Where do you want to save?\n";
        $destination = readline();

        $saveData = serialize($this);
        file_put_contents($destination, $saveData);

        //if(is_file($destination)){

       // }
    }

    public static function load_arsenal()
    {
        $file_location = readline();
        $c = file_get_contents($file_location);
        return unserialize($c);
    }
}
//
//
//$myGuns = new arsenal();
//$myGuns->build();
//
//
//print_r($myGuns);
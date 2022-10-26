<?php
/*
 * I want to make a list of weapons that I have. For each weapon that I have, certain important characteristics should
 * be recorded about those weapons.
 */

// Let's start with defining an object class that handles our individual weapons.
class weapon
{
    // This is how we'll list things that we care about.
    public $platform;
    public $chamber;
    public $serial;
    // And an auxiliary item that helps the user interact with our class.
    public $datafields = ["platform", "chamber", "serial", "type"];
    /*
     * Question; if we're enumerating what we care about with our datafields variable, do we really need to set them up
     * as their own public variables?
     */

    // Now we want to be able to interact with our class by way of a function that we set up. We can call these
    // by using -> functionName()
    public function weaponInfo()
    {
        // We're starting by saying for each thing we listed in the datafields array, make a field variable
        foreach ($this->datafields as $field){
            // Make a data variable that the user sets, note the readline function can take a prompt argument.
            $data = readline("$field: ");
            // This builds an associative array out of what we just did where the datafield is the key and the data is
            // the value of that key.
            $this->$field = $data;
        }
    }
}

// Now I want to work on making a class extension
class blade extends weapon
{
 /*
 * It's worth noting that if we want all the same shit we cared about in the general weapons class, we must enumerate
 * them in our $datafields array. That being said, I can use all the same functions that I defined in the weapon class.
 *
 * Here I'm making a class that allows me to use all the same functions we defined but asks for a different set of info.
 */
    public $type;
    public $profile;
    public $length;
    public $datafields = ["type", "profile", "length"];
}




// Let's try making a class that creates a list of weapons and their information
class arsenal
{
    /*
     * All we're doing is making a new empty array. This will eventually become our list of weapons in the arsenal.
     *
     * At this point I need more information on public, private, and protected class properties..
     */
    protected $weapons = array();

    /*
     * This is saying that we want to take the array of information from the above class and store it as an item in the
     * new array. Also called a multidimensional array.
     *
     * I also need to better understand the declaration here, I think we're saying for this function to operate, the
     * given variable $weapon must be a class object defined by our weapon class or an extension thereof.
     */
    public function addWeapon(weapon $weapon)
    {
        $this->weapons[] = $weapon;
    }

    // Now lets make a function that lets us build up an arsenal
    public function buildArsenal()
    {
        // This will help track when a user is done building an arsenal
        $finished = false;
        // This is our building loop
        while($finished == false){
            // Makes a new weapon class object
            $currentWeapon = new weapon;
            // Gives the user an idea of what's going on
            echo "\nWhat is this weapon?\n";
            /*
             * Because we're dealing with a weapon class object, we can call this function. Now we're having the user
             * tell the program about the weapon. We don't need to echo anything because we did that when we defined the
             * function using each enumerated field as a prompt.
             */
            $currentWeapon->weaponInfo();
            /*
             * Now we're interacting with the arsenal class object, because we're already inside our class definition we
             * can use $this to call a previously defined function in the class we're currently in.
             */
            $this->addWeapon($currentWeapon);

            // Now it's time to get froggy. We're going to have the user tell US whether to continue looping.
            echo "\nAdd another weapon? y/n\n";
            // We've used echo to ask the user if we need to loop then we're storing the answer in a variable.
            $answer = readline();
            // If the user said no, we're done, so we can set $finished to true and not loop again.
            if ($answer == "n") {
                $finished = true;
            }
            // If the user said yes, we go back through the loop for another weapon.
            if ($answer == "y") {
                $finished = false;
            }
            /*
             * This took some tinkering to get down correctly. For as long as we're not getting an answer we're looking
             * for, I wanted to get the user stuck until we did. Answering with y allows the user to break this while
             * loop and keep going through our first loop. And answering with n sets $finished to true, breaks this
             * loop and doesn't trigger the first loop, thus ending the cycle.
             */
            while ($answer != "n" and $answer != "y"){
                echo "\nYou have made a typo. Please answer with y or n.\n";
                $answer = readline();
                if ($answer == "n"){
                    $finished = true;
                }
            }
        }

        // Now to change gears and interact with our object class extension
        echo "\nDo you have any non-firearm weapons?\n";
        // We'll start the same way we started above.
        $finished = false;
        while ($finished == false) {
            // Rather than using 2 if statements and a nested while loop, I suspect I can use a switch statement.
            // First we'll see if the user wants to add any blades by using this while loop and looking for the answer.
            $answer = readline();
            if ($answer == "n") {
                $finished = true;
            }
            // If yes, we'll make our blade class object, get its info, and add it to our arsenal class object
            if ($answer == "y") {
                echo "\nWhat is it?\n";
                $currentWeapon = new blade;
                $currentWeapon->weaponInfo();
                $this->addWeapon($currentWeapon);
            }
            // And this loop just aks the user if we need to go through it again.
            echo "\nAnything else?\n";
            while ($answer != "n" and $answer != "y"){
                echo "\nYou have made a typo. Please answer with y or n.\n";
                if ($answer == "n") {
                    $finished = true;
                }
            }
        }
    }


    // I want to review how these next two functions work.
    public function saveArsenal()
    {
        echo "Where do you want to save?\n";
        $destination = readline();

        $saveData = serialize($this);
        file_put_contents($destination, $saveData);
    }

    public static function loadArsenal()
    {
        $file_location = readline();
        $c = file_get_contents($file_location);
        return unserialize($c);
    }
}

// Time to put it all together.

echo "Let's build your arsenal!\n";
// Make a new arsenal class object called edc.
$edc = new arsenal();
// Have the user build this new arsenal
$edc->buildArsenal();
// And now to check our results.
print_r($edc);

// Now I want to know if calling buildArsenal a second time erases the first build
//echo "\nrepeat\n";
//$edc->buildArsenal();
//print_r($edc);
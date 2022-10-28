<?php

require_once __DIR__. "/making_classes.php";


/*
 * Let's play around with our new classes. We'll start by having a user create an arsenal checking our work.
 * Then we'll save that arsenal to a file. I want to be able to pause our program here so I can check to see if it
 * actually save.
 * Then I want to clear our memory by unsetting the arsenal, I want to pause again to check our work.
 * Finally, I want to load the arsenal from file and check that.
 */

// First, let's make a new arsenal class object to work with.
// $edc = new arsenal();
// $edc->buildFromPrompt();

// First check
// print_r($edc);

// $edc->saveToFile();
// unset($edc);

// Second check: I can see our save file and our print_r populated with an error saying it was undefined.
// echo "$edc";

/*
 * I know the save file is good, hut I can't seem to load it into this new edc arsenal object, it just returns empty and
 * I understand why. Well it turns out it was because the function DOES get the file and read it, but I wasn't setting
 * it to anything because I misunderstood the word "return". I was storing it in memory but not giving it a name to call
 * it by.
 */
$edc2 = arsenal::loadFromFile();

print_r($edc2);
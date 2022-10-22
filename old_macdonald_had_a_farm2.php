<?php
/* old macdonald's farm 2
 *
 * This version introduces you to associative arrays
 *
 * An associative array names the arrays with words instead of numbers
 *
 * Trying to call an array item by a number will not work here.
*/

$animalsAndSounds = [

	"dog" => "bark",
	"duck" => "quack",
	"cat" => "hiss",
    "budgie" => "chirp"
];

/*
 * This bit I stole from stackoverflow to shuffle associative arrays, though it seems to work, I'm not particularly sure
 * how or why.
 *
 * It seems as though I'm making my own function called shuffle_ass
 */
function shuffle_ass(&$array){
    // It looks like I'm just making an empty auxiliary array for the new order.
    $aux = array();
    // This seems to be making a keys array based on the keys used in the original array.
    $keys = array_keys($array);
    // Now that I have a simple keys array, this just shuffles it.
    shuffle($keys);
    // This is where I start getting lost, I see that I'm using the keys array to make a key variable.
    foreach($keys as $key) {
        // Here I think I'm telling it that the keys in the new array should be the same keys from the old one.
        $aux[$key] = $array[$key];
        // I really have no idea what's happening here at all.
        unset($array[$key]);
    }
    // Here I think I'm just overwriting the new array over the old one.
    $array = $aux;
};

// Now I'm using this new function to shuffle the associative array.
shuffle_ass($animalsAndSounds);

/*
 * This is just a counter of how many times we're going to loop. This will later be used to compare things in the seen
 * animals array. It's important for this to be outside the foreach loop because we don't want to keep resetting it to 0
 */
$x = 0;
/*
 * This will stay set to 0 until we come across a duck, at which point it will set to whatever the value of x is at the
 * time. This is how we'll keep track of when the duck shows up.
 */
$y = 0;

// This lets us know if we've found the duck yet, since we haven't started the loop we'll leave the default as false.
$foundDuck = false;

foreach ($animalsAndSounds as $animal => $sound) {

	$lyrics = <<<END_LYRICS
Old MACDONALD had a farm
E-I-E-I-O
And on his farm he had a $animal
E-I-E-I-O
With a $sound $sound here
And a $sound $sound there
Here a $sound, there a $sound
Everywhere a $sound $sound
Old MacDonald had a farm
E-I-E-I-O
END_LYRICS;

	echo $lyrics. "\n\n\n";

    /*
     * We're putting each animal we've been through into a non-associative array. This will let us use an integer to
     * track numerical order of the seen animals.
     */
    $seenAnimals[] = $animal;

    /*
     * This is where we're using the x variable to check if we're on the budgie, if we are we're checking to see of the
     * previous animal was the cat. If both of these statements are true, it echos the string and breaks from the loop
     */
    if ($seenAnimals[$x] == 'budgie' && $seenAnimals[$x-1] == 'cat'){
        echo "\nThe cat ate the bird!\n";
        break;
    }

    if ($animal == 'duck') {
        $foundDuck = true;
        $y = $x;
    }
    // All this does is let us identify the next loop.
    $x++;
}

if ($foundDuck){
    echo "\nWe found the duck!\nIt was animal #$y!\n";
} else {
    echo "\nWe did not find the duck.\n";
}

echo "\nSo far we've seen:\n";
print_r($seenAnimals);

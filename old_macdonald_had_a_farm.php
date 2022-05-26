<?php
/* old macdonald's farm
 *
 * This script introduces you to arrays, conditional statements, heredoc, and for loops
 *
 * It does this by taking a list of animals and sounds they make, and looping over those
 * lists to output the lyrics to Old MacDonald Had a Farm.
*/


/*
 * You can think of array like an aisle in the warehouse
 *
 * This creates an array called animals, and it has 3 bins in that array:
 * 0 => cat
 * 1 => dog
 * 2 => duck
*/
$animals = ["cat", "dog", "duck", "budgie"];

// watch how that works
echo $animals[1]. " is the second animal in the array\n";

$sounds = ["hiss", "wuff", "quack", "chirp"];

if ( count($animals) != count($sounds) ) {
	die("For this to work, you must have an equal number of sounds and animals.");
}

for ($x = 0; $x < count($animals); $x++ ) {
	
	$animal = $animals[$x];
	$sound = $sounds[$x];



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
}

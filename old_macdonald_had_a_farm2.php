<?php
/* old macdonald's farm 2
 *
 * This version introduces you to associative arrays
 *
 * An associative array names the arrays with words instead of numbers
*/

$animalsAndSounds = [

	"dog" => "bark",
	"duck" => "quack",
	"cat" => "hiss"
];

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
}

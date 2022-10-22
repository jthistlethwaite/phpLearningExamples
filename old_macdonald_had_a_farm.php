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

// watch how that works, you can call an array item by what's in the bin as well using ''
echo $animals[1]. " is the second animal in the array\n";


// Here we're just making a second array for animal sounds.
$sounds = ["hiss", "wuff", "quack", "chirp"];

/*
 * We can perform several actions on arrays such as shuffling, pushing (which appends a new item onto the array),
 * and popping (which removes an item from the array).
 */
shuffle($animals);


/*
 * Here we're setting a failure message by having it count how many animals we have and how many sounds we have. If we
 * have equal numbers of each, this if statement will not trigger, but if we don't it kills the entire program and
 * prints the message in the die function.
 */
if ( count($animals) != count($sounds) ) {
	die("For this to work, you must have an equal number of sounds and animals.");
}


/*
 * This is a for loop. What it does is repeat itself until whatever you're trying to do is completed. The () set
 * conditions for the beginning of the loop, how to know if the loop needs to run, and what to do after each iteration
 * of the loop.
 *
 * In this case our first statement creates a new variable x and sets it equal to 0. Our next statement is a test to see
 * if the loop needs to run, so what we're saying here is if x is less than the total count of animals the loop runs.
 * Our third statement will run after each iteration of the loop, in this case we're increasing the value of x by 1.
 * We could also write this as "$x = $x+1" but instead this shorthand served the same purpose.
 *
 * The reason we're using less than is due to how array keys work and how the count function works. Array keys begin
 * from 0 but count starts at 1. In this example, eventually x will equal 3 which is our last animal and the loop will
 * run because 3 is less than what the count function will return 4. After that iteration x will be equal to 4 at which
 * point the loop will not run and the program will move on to code written outside the for loop.
 */
for ($x = 0; $x < count($animals); $x++ ) {

    /*
     * What we're doing here is saying the variables animal and sound is equal to something in the arrays animals and
     * sounds. We're also using our new x variable as a key to call whatever array item we're on at the time of the loop
     *
     * So for the first loop, this is saying $animal = animals[0]. Remember, arrays start with item 0 rather than 1.
     * On the next iteration it will be $animal = animals[1] because of our x++ statement, and so on until our test
     * statement is no longer true.
     */
	$animal = $animals[$x];
	$sound = $sounds[$x];

    /*
     * Here we're making a new empty array called seenAnimals, then we're taking whatever animal we're on and appending
     * it to this array. This give us a list of what animals we've looped through.
     */
    $seenAnimals[] = $animal;


    /*
     * This is an example of HEREDOC syntax. You start it with <<< followed by whatever you identify it, in this case we
     * used "END_LYRICS". To close the heredoc you tag the end with the identifier and semicolon. In this way, we're
     * creating a complex variable for lyrics inside our for loop where animal and sound variable are nested and get
     * replaced each time the loop iterates.
     *
     * I need more information about these and how they can be used, it seems that php treats this in a similar way to html
     * treats <pre></pre> tags.
     */
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
     * Now we have an if statement that breaks the loop. We're saying that if we're on the budgie, and the cat came just
     * beforehand, print the echo statement to our screen and then break from the loop. It's worth noting that 2 equal
     * are important here because = will set the variable and return a true if successful whereas == checks to see if
     * they are equal and not set the variable at all.
     */
    if (($seenAnimals[$x] == 'budgie') && ($seenAnimals[$x-1] == 'cat')) {
        echo "The cat ate the bird\n";
        break;
    }
    /*
     * Note: because this echo statement is within our for loop, this will print the lyrics for each animal to our
     * terminal.
     */


}

echo "So far we've seen:\n";
print_r($seenAnimals);
/*
 * It's worth noting that because we shuffled the animals array but did not modify the sounds array, when this runs the
 * sounds will not correctly match the animals in the lyrics. This is where associative arrays come in handy. More on
 * this in old_macdonald_had_a_farm2.php
 */

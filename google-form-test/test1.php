<?php

/**
 * 
 (PHP or JavaScript) Write a short program that prints each number from 1 to 100 on a new line. 
 For each multiple of 3, print "Fizz" instead of the number. For each multiple of 5, print "Buzz" instead of the number. 
 For numbers which are multiples of both 3 and 5, print "FizzBuzz" instead of the number. *
 */

for ($index = 1; $index <= 100; $index++) {
    if ($index % 3 == 0 && $index % 5 == 0) {
        echo "FizzBuzz";
    } else if ($index % 3 == 0) {
        echo "Fizz";
    } elseif ($index % 5 == 0) {
        echo "Buzz";
    } else {
        echo $index;
    }
    echo "\n";
}

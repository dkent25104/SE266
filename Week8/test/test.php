<?php

$age = filter_input(INPUT_POST, 'age');

if ($age >= 18) {
    $result = "Woohoo, you are an adult! Go do whatever you want!";
} else {
    $result = "So sorry, you are still a child.  Go clean your room!";
}

echo $result;
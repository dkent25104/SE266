<?php

include './functions.php';

if (filter_input(INPUT_POST, 'id') != null) {

$idx = filter_input(INPUT_POST, 'id');

$result = vote($idx);

echo $result;
} else {
    $results = [];
    $results[0] = []; //characters
    $results[1] = []; //votes
    
    $votes = selectVotes();
    
    foreach ($votes as $vote) {
        array_push($results[0], $vote['DisneyCharacterName']);
        array_push($results[1], $vote['VoteCount']);     
    }
    
    echo json_encode($results);
}
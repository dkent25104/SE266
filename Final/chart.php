<?php

include './functions.php';

$results = [];
$results[0] = []; //regions
$results[1] = []; //population
$results[2] = []; //colors

$regions = getRegion();

foreach ($regions as $region) {
    array_push($results[0], $region['CountryRegion']);
    array_push($results[1], $region['population']); 
    array_push($results[2], 'rgb(' . rand(0,255) . ',' . rand(0,255) . ',' . rand(0, 255) . ')');
}

echo json_encode($results);
<?php

INCLUDE_ONCE __DIR__ . '/dbconnect.php';

$db = getDatabase();

function isPostRequest() {
    return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
}

function isGetRequest() {
    return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'GET' );
}

function getTopTen() {
    global $db;
    $stmt = $db->prepare("SELECT * FROM CountryDetails ORDER BY CountryPopulation DESC LIMIT 10;");
    
    $results = array();
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    return $results;
}

function searchCountries($name, $region) {
    global $db;
    $query = "SELECT * FROM CountryDetails WHERE 0=0";
    $binds = array();
    
    if ($name != "")
    {
        $query .= " AND CountryName LIKE :name";
        $binds['name'] = "%" . $name . "%";
    }
    if ($region != "")
    {
        $query .= " AND CountryRegion LIKE :region";
        $binds['region'] = $region;
    }
   
    $query = $db->prepare($query);
    $results = array();
    if ($query->execute($binds) && $query->rowCount() > 0) {
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    return $results;
}

function getOneCountry($id) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM CountryDetails WHERE CountryDetailID = :id");
    
    $binds = array(
        ":id" => $id
    );
    
    $results = array();
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    return $results;
}

function getRegion() {
    global $db;
    $stmt = $db->prepare("SELECT CountryRegion, SUM(CountryPopulation) AS population FROM CountryDetails GROUP BY CountryRegion;");
    
    $results = array();
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    return $results;
}

function regionList() {
    global $db;
    $stmt = $db->prepare("SELECT DISTINCT CountryRegion FROM CountryDetails ORDER BY CountryRegion ASC");
    
    $results = array();
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    return $results;
}

function updateCountry($id, $population, $size) {
    global $db;
    $stmt = $db->prepare("UPDATE CountryDetails SET CountryPopulation = :population, CountrySize = :size WHERE CountryDetailID = :id");
    
    $binds = array(
        ":id" => $id,
        ":population" => $population,
        ":size" => $size
    );
    
    $results = false;
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = true;
    }
    
    return $results;
}
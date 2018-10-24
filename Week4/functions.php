<?php

INCLUDE_ONCE __DIR__ . '/dbconnect.php';
/**
 * A method to check if a Post request has been made.
 *    
 * @return boolean
 */
function isPostRequest() {
    return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
}

function isGetRequest() {
    return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'GET' );
}

function getAllData() {
    $db = getDatabase(); 
    $stmt = $db->prepare("SELECT * FROM corps");

    $results = array();
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    return $results;
}

function sortData($column, $radio) {
    $db = getDatabase(); 
    $stmt = $db->prepare("SELECT * FROM corps ORDER BY $column $radio");
    
    $results = array();
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    return $results;
}

function searchData($column, $searchWord) {
    $db = getDatabase(); 
    $stmt = $db->prepare("SELECT * FROM corps WHERE $column LIKE :searchWord");
    
    $binds = array(
        ":searchWord" => "%" . $searchWord . "%"
    );
    
    $results = array();
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    return $results;
}

function getColumns() {
    $columns = ["corp", "incorp_dt", "email", "zipcode", "owner", "phone"];
    return $columns;
}

function numRows($results) {
    $numRows = 0;
    foreach ($results as $row):
        $numRows++;
    endforeach;
    
    return $numRows;
}
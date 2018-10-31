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

function IsValidUser($uname, $pword) {
    $db = getDatabase(); 
    $stmt = $db->prepare("SELECT * FROM users WHERE uname = :uname AND pword = :pword");

    $binds = array(
        ":uname" => $uname,
        ":pword" => $pword
    );
    
    $results = false;
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = true;
    } else {
        $results = false;
    }
    
    return $results;
}

function searchData($school, $city, $state) {
    $db = getDatabase(); 
    $query = "SELECT * FROM schools WHERE 0=0";
    $binds = array();
    
    if ($school != "")
    {
        $query .= " AND school LIKE :school";
        $binds['school'] = "%" . $school . "%";
    }
    if ($city != "")
    {
        $query .= " AND city LIKE :city";
        $binds['city'] = "%" . $city . "%";
    }
    if ($state != "")
    {
        $query .= " AND state LIKE :state";
        $binds['state'] = "%" . $state . "%";
    }
   
    $query = $db->prepare($query);
    $results = array();
    if ($query->execute($binds) && $query->rowCount() > 0) {
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    return $results;
}
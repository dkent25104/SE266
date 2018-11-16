<?php

INCLUDE_ONCE __DIR__ . '/dbconnect.php';

$db = getDatabase();

function isPostRequest() {
    return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
}

function isGetRequest() {
    return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'GET' );
}

function addProject($name) {
//uses SQL Insert statement to add a record to the project database
    global $db;
    $stmt = $db->prepare("INSERT INTO projects (name, totalTime, working, clockIn) VALUES (:name, '0', 0, 0);");

    $binds = array(
        ":name" => $name
    );
    
    $results = false;
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = true;
    } else {
        $results = false;
    }
    
    return $results;
}

function editProject($name, $id) {
//uses SQL Update statement to update project name
    global $db;
    $stmt = $db->prepare("UPDATE projects Set name = :name WHERE id = :id;");

    $binds = array(
        ":name" => $name,
        ":id" => $id
    );
    
    $results = false;
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = true;
    } else {
        $results = false;
    }
    
    return $results;
}

function deleteProject($id) {
//uses SQL Delete statement to delete a project from the database
    global $db;
    $stmt = $db->prepare("DELETE FROM projects WHERE id = :id;");

    $binds = array(
        ":id" => $id
    );
    
    $results = false;
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = true;
    } else {
        $results = false;
    }
    
    return $results;
}

function getCurrentTime() {
//returns the current time to be used when calculating time spent on projects
    date_default_timezone_set('America/New_York');
    return date("Y-m-d g:i:s");
}

function timeSpent($strTimeIn, $strTimeOut) {
//calculates the time between the clock in and clock out
    $timeIn = strtotime($strTimeIn);
    $timeOut = strtotime($strTimeOut);
    
    $interval = $timeOut - $timeIn;
    
    $timeSpent = date('i', $interval);
    
    return $timeSpent;
}

function getAllProjects() {
//an array of all the projects stored in the database
    global $db;
    $stmt = $db->prepare("SELECT * FROM projects;");
    
    $results = array();
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    return $results;
}

function getOneProject($id) {
//returns one project based on id of project
    global $db;
    $stmt = $db->prepare("SELECT * FROM projects WHERE id = :id;");
    
    $binds = array(
        ":id" => $id
    );
    
    $results = array();
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    return $results;
}

function searchProjects($name) {
//searches project names based on search input
    global $db;
    $stmt = $db->prepare("SELECT * FROM projects WHERE name LIKE :name;");
    
    $binds = array(
        ":name" => "%" . $name . "%"
    );
    
    $results = array();
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    return $results;
}

function checkWorking() {
//checks if any projects are clocked in
    global $db;
    $stmt = $db->prepare("SELECT * FROM projects;");
    
    $results = array();
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    $answer = false;
    foreach ($results as $row) {
        if ($row['working'] == 1) { $answer = true; }
    } 

    return $answer;
}

function clockIn($clockIn, $id) {
//updates project in database and sets working = true and clockIn = the current time
    global $db;
    $stmt = $db->prepare("UPDATE projects Set working = 1, clockIn = :clockIn WHERE id = :id;");

    $binds = array(
        ":clockIn" => $clockIn,
        ":id" => $id
    );
    
    $results = false;
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = true;
    } else {
        $results = false;
    }
    
    return $results;
}

function clockOut($timeSinceClockIn, $id) {
//updates project in database and sets working = false, totalTime += timeSpent(), timeSinceClockIn = timeSpent(), and clockIn is then erased
    global $db;
    $stmt = $db->prepare("UPDATE projects Set totalTime = totalTime + :totalTime, working = 0, clockIn = 0 WHERE id = :id;");

    $binds = array(
        ":totalTime" => $timeSinceClockIn,
        ":id" => $id
    );
    
    $results = false;
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = true;
    } else {
        $results = false;
    }
    
    return $results;
}

?>
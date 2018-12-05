<?php

INCLUDE_ONCE __DIR__ . '/dbconnect.php';

$db = getDatabase();

function getCurrentTime() {
    date_default_timezone_set('America/New_York');
    return date("Y-m-d g:i:s");
}

function getVoterIP() {
    //whether ip is from share internet
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   
      {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
      }
    //whether ip is from proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
      {
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
      }
    //whether ip is from remote address
    else
      {
        $ip_address = $_SERVER['REMOTE_ADDR'];
      }
    return $ip_address;
}

function selectCharacters() {
    global $db;
    $stmt = $db->prepare("SELECT * FROM DisneyCharacters;");
    
    $results = array();
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    return $results;
}

function selectVotes() {
    global $db;
    $stmt = $db->prepare("SELECT DisneyCharacterName, COUNT(*) AS VoteCount
FROM DisneyCharacters c LEFT OUTER JOIN DisneyVotes v ON c.DisneyCharacterID=v.DisneyCharacterID
GROUP BY DisneyCharacterName ORDER BY c.DisneyCharacterID;");
    
    $results = array();
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    return $results;
}

function vote($id) {
    global $db;
    $stmt = $db->prepare("INSERT INTO DisneyVotes (DisneyCharacterID, VoterIP, VoterDateTime) VALUES (:id, :ip, :date);");

    $binds = array(
        ":id" => $id,
        ":ip" => getVoterIP(),
        ":date" => getCurrentTime()
    );
    
    $results = false;
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = true;
    } else {
        $results = false;
    }
    
    return $results;
}
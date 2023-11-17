<?php
include 'query.php';
  if($_SERVER["REQUEST_METHOD"]==="POST"){
    $body = json_decode(file_get_contents('php://input'));
    $serializedChats = serialize($body);
    $usercookie = $_COOKIE["phpSessionCookie"]; 
    $userID = explode(":",base64_decode($usercookie))[1]; 
    $date = date("Y-m-d"); 
    $result = queryDatabaseWithParameters($mysqli, "INSERT INTO `chats` (`BenutzerID`,`Nachrichten`,`Datum`) VALUES (?,?,?)", array($userID, $serializedChats, $date), 'iss');
  }  
?>
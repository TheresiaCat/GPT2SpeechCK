<?php
include 'query.php';
  if($_SERVER["REQUEST_METHOD"]==="POST"){
    $body = json_decode(file_get_contents('php://input')); 
    if(isset($body ->id )){
      $currentChatId = $body -> id;
    }
    unset($body->id); // dass nicht doppelt gespeichert wird serealized chats
    $serializedChats = serialize($body);
    $usercookie = $_COOKIE["phpSessionCookie"]; 
    $userID = explode(":",base64_decode($usercookie))[1]; 
    $date = date("Y-m-d");
    if(isset($currentChatId)){
      $overwriteresult = queryDatabaseWithParameters($mysqli, "UPDATE `chats` SET `Nachrichten` = ? WHERE `ChatID` = ? AND `BenutzerID` = ?", array($serializedChats, $currentChatId, $userID), 'sii');
      echo $currentChatId; 
    }
    else {
      $newresult = queryDatabaseWithParameters($mysqli, "INSERT INTO `chats` (`BenutzerID`,`Nachrichten`,`Datum`) VALUES (?,?,?)", array($userID, $serializedChats, $date), 'iss');
      $currentChatIdResult = queryDatabaseWithParameters($mysqli, "SELECT max(ChatId) FROM chats WHERE `BenutzerID`= ?", array($userID), 'i');
      echo ($currentChatIdResult -> fetch_array()[0]);
    }
     
  }
?>
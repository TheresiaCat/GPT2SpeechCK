<link rel="stylesheet" href="../style.css">
<?php
include 'query.php';
session_start();

$result = queryDatabaseWithParameters($mysqli, "SELECT * FROM chats WHERE BenutzerID = ? ORDER BY ChatID DESC LIMIT 1 ", array($_SESSION['userid']), 's');

$serializedContent = mysqli_fetch_array($result);

$unserializedContent = unserialize($serializedContent['Nachrichten']); 
//print_r($unserializedContent->user);

$length = count($unserializedContent->user); 

for ($i = 0; $i<$length; $i++){
    print_r('<div id="user-bubble">'); 
    echo $unserializedContent->user[$i]; 
    print_r('</div><div id="bot-bubble">');
    echo $unserializedContent->bot[$i];
    print_r('</div>');
}
print_r('<form action="index.php"><input type="submit" value="Back to Chat"></form>');
?>


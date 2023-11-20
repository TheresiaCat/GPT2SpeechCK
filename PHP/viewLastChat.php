<link rel="stylesheet" href="../mystyle.css">
<?php
include 'query.php';
session_start();

$result = queryDatabaseWithParameters($mysqli, "SELECT * FROM chats WHERE BenutzerID = ? ORDER BY ChatID DESC LIMIT 1 ", array($_SESSION['userid']), 's');

if($result->num_rows != 0){
    $serializedContent = mysqli_fetch_array($result);
    $unserializedContent = unserialize($serializedContent['Nachrichten']);
    $length = count($unserializedContent->user);

    for ($i = 0; $i<$length; $i++){
        print_r('<div class="lc" id="user-bubble">'); 
        echo $unserializedContent->user[$i]; 
        print_r('</div>');

        print_r('<div class="lc"id="bot-bubble">');
        echo $unserializedContent->bot[$i];
        print_r('</div>');
    }
}
else{
    print_r('<p>No Messages<p>');  
}
 
print_r('<form class="sidebar-container" action="index.php"><input type="submit" value="Back to Chat"></form>');
?>


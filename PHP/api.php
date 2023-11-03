<?php
header("Access-Control-Allow-Origin: http://localhost:3000");

session_start(); // Starte die PHP-Session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['demoMessage'])) {
        $demomessage = $_POST['demoMessage'];
        $_SESSION['savedMessage'] = $demomessage; // Speichere die Nachricht in der Session
    }
}

//Ausgabe von Bot 
echo $_SESSION['savedMessage'];
session_destroy();

?>
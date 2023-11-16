<?php
include 'query.php';

$username = $_POST['username'];
$password = $_POST['password'];
//$_SESSION["test"].=$username;
//die($_SESSION["test"]); 
$mysqli = connectToDatabase();

$result = queryDatabaseWithParameters($mysqli, "SELECT * FROM BENUTZER WHERE BENUTZERNAME = ? AND PASSWORT = ?", array($username, $password), 'ss');
$counter = $result->num_rows;

if ($counter == 1) {
    session_start();

    //autologout nach 10 minuten
    $_SESSION['logged_in'] = true; 
    $_SESSION['last_activity'] = time(); 
    $_SESSION['expire_time'] = 600;
    $_SESSION['loginToken'] = "angemeldet";

    $row = mysqli_fetch_array($result);
    $_SESSION['userid'] = $row['BenutzerID'];

    header("Location: /"); // Weiterleitung zur index.html
    exit(); // Wichtig, um sicherzustellen, dass der Code nach der Weiterleitung nicht weiter ausgeführt wird
} else {
    die("Fehler"); 
    header("Location: /login.html");
    exit();
}
?>

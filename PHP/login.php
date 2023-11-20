<?php
include 'query.php';

$username = $_POST['username'];
$password = $_POST['password'];

$result = queryDatabaseWithParameters($mysqli, "SELECT * FROM BENUTZER WHERE BENUTZERNAME = ? AND PASSWORT = ?", array($username, $password), 'ss');
$counter = $result->num_rows;

if ($counter == 1) {
    session_start();
     
    $_SESSION['logged_in'] = true; 

    $row = mysqli_fetch_array($result);
    $_SESSION['userid'] = $row['BenutzerID'];

    $cookie = base64_encode($row['Benutzername'].":".$row['BenutzerID']); 
    setcookie("phpSessionCookie", $cookie, time()+60*60*24*30, "/");

    header("Location: ../PHP/"); // Weiterleitung zur index.html
    exit(); // Wichtig, um sicherzustellen, dass der Code nach der Weiterleitung nicht weiter ausgeführt wird
} else {
    print_r('<link rel="stylesheet" href="../mystyle.css">');
    print_r('<div class="container">
            <p>Ooopsies! Wrong login credentials.<p>
                <form action="../login.html">
                    <input type="submit" value="login again">
                </form>
                <form action="../register.html" method="GET">
                    <input type="submit" value="register" id="Register my Acc"></input>
                </form>
            </div>');
    exit();
}
?>

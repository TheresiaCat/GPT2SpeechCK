<?php include 'query.php';
    $username = $_GET['username'];
    $mysqli = connectToDatabase();

    //userAlreadyExist returned true/false, bei true in if
    if(userAlreadyExists($username, $mysqli)) {
        header("location: ../login.html");
    }
    else {
        $userData = array($_GET['username'], $_GET['password']);
        queryDatabaseWithParameters($mysqli,"INSERT INTO BENUTZER (`Benutzername`, `Passwort`) VALUES (?,?)" , $userData, 'ss');
        header("location: ../login.html"); 
    }


?>


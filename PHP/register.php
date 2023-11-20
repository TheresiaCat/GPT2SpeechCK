<?php include 'query.php';
    $username = $_POST['username'];
    $mysqli = connectToDatabase();

    //userAlreadyExist returned true/false, bei true in if
    if(userAlreadyExists($username, $mysqli)) {
        print_r('<link rel="stylesheet" href="../mystyle.css">'); 
        print_r('<div class="container">
        <p>Opsies. This user already exists.<p>
        <form action="../login.html">
			<input type="submit" value="Go to login">
		</form>
		<form action="../register.html" method="GET">
			<input type="submit" value="register" id="register"></input>
		</form>
        </div>
        ');
    }
    else {
        $userData = array($_POST['username'], $_POST['password']);
        queryDatabaseWithParameters($mysqli,"INSERT INTO BENUTZER (`Benutzername`, `Passwort`) VALUES (?,?)" , $userData, 'ss');
        header("location: ../login.html"); 
    }


?>


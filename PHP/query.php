
<?php
//Use to open a connection to the database

    function connectToDatabase() {
        $host = "localhost"; 
        $benutzername = "root"; 
        $passwort = ""; 
        $datenbank = "gpt2speechdb"; 

        // Verbindung zur Datenbank herstellen
        $mysqli = new mysqli($host, $benutzername, $passwort, $datenbank);

        // Überprüfen, ob die Verbindung erfolgreich war
        if ($mysqli->connect_errno) {
            die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
        }

        return $mysqli;
    }
    $mysqli = connectToDatabase();

    
    //prüfe verbindung 
    /*
        if ($mysqli->ping()) {
            echo "Verbindung erfolgreich hergestellt!";
        } else {
            die("Verbindung fehlgeschlagen: " . $mysqli->error);
        }
    */

    //queries database without parameters
    function queryDatabase($mysqli, $queryString) {

        $statement = $mysqli->prepare($queryString);

        $statement->execute();

        $result = $statement->get_result();

        return $result;

    }

    function queryDatabaseWithParameters($mysqli, $queryString, $parameters, $parameterSquence) { 

        $statement = $mysqli->prepare($queryString);

        $statement->bind_param($parameterSquence, ...$parameters);

        $statement->execute();

        $result = $statement->get_result();

        return $result;

    }
?>
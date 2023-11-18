<?php
include 'query.php';
session_start();
queryDatabaseWithParameters($mysqli, "DELETE FROM BENUTZER WHERE BENUTZERID = ?", array($_SESSION['userid']), 'i');
session_destroy();

header("Location: index.php");
?>
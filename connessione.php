<?php
// Variabili da settare
$servername = "localhost";
$username = "root"; // --> root (a casa mia: marco)
$password = ""; // --> "" !!! (a casa mia: password)
$db = "dircol"; // Nome del database

$conn = new mysqli($servername, $username, $password, $db);
if ($conn->connect_error) {
    die("Connessione al Database $db non riuscita: " . $conn->connect_error);
}

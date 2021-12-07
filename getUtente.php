<?php
// Attenzione: Non inserire commenti in HTML!!
include_once('connessione.php');
include_once('utente.php');
include_once('listeCollegate.php');
include_once('funzioni.php');

$listaUtenti = caricaListaUtenti();
if (isset($_POST["utente"])) {
    // $Utente = new Utente('', '', '', '', 0);
    $Utente = $listaUtenti->ricercaUtente($_POST["utente"])->dato;
    // if ($Utente != null && strcmp($Utente->Username, '') != 0) {
    $data["Username"] = $Utente->getUsername();
    $data["Nome"] = $Utente->getNome();
    $data["Cognome"] = $Utente->getCognome();
    $data["Commento"] = $Utente->getCommento();
    $data["Voto"] = $Utente->getVoto();
    echo json_encode($data);
    // } else {
    // }
}
mysqli_close($conn);

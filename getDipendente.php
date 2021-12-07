<?php
// Attenzione: Non inserire commenti in HTML!!
include_once('connessione.php');

if (isset($_POST["matricola"])) {
    $strSQL = "SELECT * FROM dipendenti WHERE Matricola = '" . $_POST["matricola"] . "'";
    $risultato = mysqli_query($conn, $strSQL);
    while ($riga = mysqli_fetch_array($risultato)) {
        // $leftVar["nome_che_voglio] = $rightVar["nome_campo_tabella"];
        $data["Matricola"] = $riga["Matricola"];
        $data["Cognome"] = $riga["Cognome"];
        $data["Nome"] = $riga["Nome"];
        $data["CodiceFiscale"] = $riga["CodiceFiscale"];
        $data["Qualifica"] = $riga["Qualifica"];
        $data["PuntoVendita"] = $riga["PuntoVendita"];
    }
    echo json_encode($data);
}
mysqli_close($conn);

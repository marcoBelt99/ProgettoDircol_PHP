<?php
// Attenzione: Non inserire commenti in HTML!!
include_once('connessione.php');

if (isset($_POST["puntovendita"])) {
    $strSQL = "SELECT * FROM puntivendita WHERE CodPV = '" . $_POST["puntovendita"] . "'";
    $risultato = mysqli_query($conn, $strSQL);
    while ($riga = mysqli_fetch_array($risultato)) {
        // $leftVar["nome_che_voglio] = $rightVar["nome_campo_tabella"];
        $data["CodPV"] = $riga["CodPV"];
        $data["Indirizzo"] = $riga["Indirizzo"];
        $data["Telefono"] = $riga["Telefono"];
        $data["Citta"] = $riga["Citta"];
        $data["DataInizio"] = $riga["DataInizio"];
        $data["Nazione"] = $riga["Nazione"];
    }
    echo json_encode($data);
}
mysqli_close($conn);

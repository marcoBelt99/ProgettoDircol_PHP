<?php
// Attenzione: Non inserire commenti in HTML!!
include_once('connessione.php');

if (isset($_POST["codmodello"])) {
    $strSQL = "SELECT * FROM modelli WHERE CodModello = '" . $_POST["codmodello"] . "'";
    $risultato = mysqli_query($conn, $strSQL);
    while ($riga = mysqli_fetch_array($risultato)) {
        // $leftVar["nome_che_voglio] = $rightVar["nome_campo_tabella"];
        $data["CodModello"] = $riga["CodModello"];
        $data["Nome"] = $riga["Nome"];
        $data["Descrizione"] = $riga["Descrizione"];
        $data["PrezzoListino"] = $riga["PrezzoListino"];
        $data["Genere"] = $riga["Genere"];
        $data["Collezione"] = $riga["Collezione"];
    }
    echo json_encode($data);
}
mysqli_close($conn);

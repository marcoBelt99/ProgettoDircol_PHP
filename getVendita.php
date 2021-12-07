<?php
// Attenzione: Non inserire commenti in HTML!!
include_once('connessione.php');

if (isset($_POST["vendita"])) {
    $strSQL = "SELECT * FROM vendite WHERE ID = '" . $_POST["vendita"] . "'";
    $risultato = mysqli_query($conn, $strSQL);
    while ($riga = mysqli_fetch_array($risultato)) {
        // $leftVar["nome_che_voglio] = $rightVar["nome_campo_tabella"];
        $data["ID_Vendita"] = $riga["ID"];
        $data["DataVendita"] = $riga["DataVendita"];
        $data["PrezzoVendita"] = $riga["PrezzoVendita"];
        $data["Matricola_Vendita"] = $riga["Matricola"];
        $data["IDCapo_Vendita"] = $riga["IDCapo"];
    }
    echo json_encode($data);
}
mysqli_close($conn);

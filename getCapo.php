<?php
// Attenzione: Non inserire commenti in HTML!!
include_once('connessione.php');

//getCapo.php
if (isset($_POST["id"])) {
    $strSQL = "SELECT * FROM capi WHERE ID = '" . $_POST["id"] . "'";
    $risultato = mysqli_query($conn, $strSQL);
    while ($riga = mysqli_fetch_array($risultato)) {
        // $leftVar["nome_che_voglio] = $rightVar["nome_campo_tabella"];
        $data["ID"] = $riga["ID"];
        $data["Taglia"] = $riga["Taglia"];
        $data["Colore"] = $riga["Colore"];
        $data["CodPV"] = $riga["PuntoVendita"];
        $data["CodModello"] = $riga["CodModello"];
    }
    echo json_encode($data);
}
mysqli_close($conn);
?>


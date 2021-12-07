<?php
// Questa pagina serve per mostrare in maniera dinamica i dati di un dipendente. E' collegata alla funzione Ajax in 'aggiorna.php'
include_once('connessione.php');
include_once('funzioni.php');
?>

<!DOCTYPE html>
<html>

<head>
</head>

<body>

    <?php
    $q = intval($_GET['q']);
    ?>
     <!-- TABELLA VENDITE -->
    <!-- Costruisco la tabella di visualizzazione della query -->
    <!-- Intestazione della tabella -->
    <table id='table-center5' class="table">
        <thead>
            <tr>
                <th>ID Vendita</th>
                <th>Data Vendita</th>
                <th>Prezzo Vendita</th>
                <th>Matricola</th>
                <th>Id Capo</th>
            </tr>
        </thead>
        <!-- Corpo della tabella -->
        <tbody>
            <?php
            // Comando SQL
            $strSQL = "SELECT * FROM vendite WHERE ID = '$q' ORDER BY ID, DataVendita;"; // Semplice Query di visualizzazione
            $risultato = mysqli_query($conn, $strSQL);

            while ($riga = mysqli_fetch_array($risultato)) {
            ?>
                <!-- Riga della tabella -->
                <tr>
                    <!-- Singolo elemento della riga -->
                    <td>
                        <?php
                        echo $riga['ID'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $riga['DataVendita'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $riga['PrezzoVendita'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $riga['Matricola'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $riga['IDCapo'];
                        ?>
                    </td>
                </tr>
                <!-- Alla fine di tutto, quando lavoro col PHP devo sempre mettere questo -->
            <?php
            } // chiudo il while aperto prima (QUANDO LAVORO CON LE TABELLE LO DEVO CHIUDERE SEMPRE PRIMA DEL TBODY)
            ?>
        </tbody>
    </table>

    <!-- FINE TABELLA VENDITE -->

</body>

</html>
<?php
mysqli_close($conn);
?>
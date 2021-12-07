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
    <!-- TABELLA PUNTI VENDITA -->
    <table id='table-center4' class="table">
        <thead>
            <tr>
                <th>Codice PV</th>
                <th>Indirizzo</th>
                <th>Telefono</th>
                <th>Città</th>
                <th>Data inizio</th>
                <th>Nazione</th>
            </tr>
        </thead>
        <!-- Corpo della tabella -->
        <tbody>
            <?php
            // Comando SQL
            $strSQL = "SELECT * FROM puntivendita WHERE CodPV = '$q'"; // Semplice Query di visualizzazione
            $risultato = mysqli_query($conn, $strSQL);
            while ($riga = mysqli_fetch_array($risultato)) {
            ?>
                <!-- Riga della tabella -->
                <tr>
                    <!-- Singolo elemento della riga -->
                    <td>
                        <?php
                        echo $riga['CodPV'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $riga['Indirizzo'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $riga['Telefono'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $riga['Citta'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $riga['DataInizio'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $riga['Nazione'];
                        ?>
                    </td>
                </tr>
                <!-- Alla fine di tutto, quando lavoro col PHP devo sempre mettere questo -->
            <?php
            } // chiudo il while aperto prima
            ?>
        </tbody>
    </table>
    <!-- FINE TABELLA PUNTI VENDITA -->


</body>

</html>
<?php
mysqli_close($conn);
?>
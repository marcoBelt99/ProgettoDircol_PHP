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
     <!-- TABELLA MODELLI -->
    <table id='table-center3' class="table">
        <thead>
            <tr>
                <th>Codice modello</th>
                <th>Nome</th>
                <th>Descrizione</th>
                <th>Prezzo di listino</th>
                <th>Genere</th>
                <th>Collezione</th>
            </tr>
        </thead>
        <!-- Corpo della tabella -->
        <tbody>
            <?php
            // Comando SQL
            $strSQL = "SELECT * FROM modelli WHERE CodModello = '$q' ORDER BY CodModello"; // Semplice Query di visualizzazione
            $risultato = mysqli_query($conn, $strSQL);
            while ($riga = mysqli_fetch_array($risultato)) {
            ?>
                <!-- Riga della tabella -->
                <tr>
                    <!-- Singolo elemento della riga -->
                    <td>
                        <?php
                        echo $riga['CodModello'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $riga['Nome'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $riga['Descrizione'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $riga['PrezzoListino'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $riga['Genere'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $riga['Collezione'];
                        ?>
                    </td>
                </tr>
                <!-- Alla fine di tutto, quando lavoro col PHP devo sempre mettere questo -->
            <?php
            } // chiudo il while aperto prima
            ?>

        </tbody>
    </table>
    <!-- FINE TABELLA MODELLI -->

</body>

</html>
<?php
mysqli_close($conn);
?>
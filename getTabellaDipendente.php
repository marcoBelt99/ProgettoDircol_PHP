<?php
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
    <table id='table-center' class="table">
        <thead class="tabella_txtHint">
            <tr>
                <th>Cognome</th>
                <th>Nome</th>
                <th>Codice fiscale</th>
                <th>Qualifica</th>
                <th>Punto vendita</th>
            </tr>
        </thead>
        <!-- Corpo della tabella -->
        <tbody>
            <?php
            // Comando SQL
            $strSQL = "SELECT * FROM dipendenti WHERE Matricola = '$q' ORDER BY Matricola; "; // Semplice Query di prelevamento di una tupla della tabella
            $risultato = mysqli_query($conn, $strSQL);

            while ($riga = mysqli_fetch_array($risultato)) {
            ?>
                <!-- Riga della tabella -->
                <tr>
                    <!-- Singolo elemento della riga -->
                    <td>
                        <?php
                        echo $riga['Cognome'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $riga['Nome'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $riga['CodiceFiscale'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $riga['Qualifica'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $riga['PuntoVendita'];
                        ?>
                    </td>
                </tr>
                <!-- Alla fine di tutto, quando lavoro col PHP devo sempre mettere questo -->
            <?php
            } // chiudo il while aperto prima



            ?>
            </form>
        </tbody>
    </table>
    <!-- FINE TABELLA DIPENDENTI -->

</body>

</html>
<?php
mysqli_close($conn);
?>
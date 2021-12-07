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
    <!-- TABELLA CAP -->
    <table id='table-center' class="table">
        <thead class="tabella_txtHint">
            <tr>
                <th>ID capo</th>
                <th>Taglia</th>
                <th>Colore</th>
                <th>Punto Vendita</th>
                <th>Modello</th>
            </tr>
        </thead>
        <!-- Corpo della tabella -->
        <tbody>
            <?php
            // Comando SQL
            $strSQL = "SELECT * FROM capi WHERE ID = '$q' ORDER BY ID; "; // Semplice Query di prelevamento di una tupla della tabella
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
                        echo $riga['Taglia'];
                        ?>
                    </td>
                    <td>
                       <input type="color" name="Colore" value="<?= htmlspecialchars($riga['Colore']) ?>" disabled> 
                    </td>
                    <td>
                        <?php
                        echo $riga['PuntoVendita'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $riga['CodModello'];
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
    <!-- FINE TABELLA CAPI -->

</body>

</html>
<?php
mysqli_close($conn);
?>
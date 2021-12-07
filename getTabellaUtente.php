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
    // $q = intval($_GET['q']); // intero
    $q = $_GET['q']; // stringa
    $listaUtenti = caricaListaUtenti();
    ?>
    <!-- TABELLA MODELLI -->
    <table id='table-center3' class="table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Commento</th>
                <th>Voto</th>
            </tr>
        </thead>
        <!-- Corpo della tabella -->
        <tbody>
            <?php
            $risultato = $listaUtenti->ricercaUtente($q);
            ?>
            <!-- Riga della tabella -->
            <tr>
                <!-- Singolo elemento della riga -->
                <td>
                    <?php
                    echo $risultato->dato->getUsername();
                    ?>
                </td>
                <td>
                    <?php
                    echo $risultato->dato->getNome();
                    ?>
                </td>
                <td>
                    <?php
                    echo $risultato->dato->getCognome();
                    ?>
                </td>
                <td>
                    <?php
                    echo $risultato->dato->getCommento();
                    ?>
                </td>
                <td>
                    <?php
                    echo $risultato->dato->getVoto();
                    ?>
                </td>
            </tr>

        </tbody>
    </table>
    <!-- FINE TABELLA MODELLI -->

</body>

</html>
<?php
mysqli_close($conn);
?>
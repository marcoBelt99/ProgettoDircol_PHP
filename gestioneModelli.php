<?php
include_once('funzioni.php');
include_once('connessione.php');
include_once('utente.php');
include_once('listeCollegate.php');

?>

<html>

<head>
    <?php
    head();
    ?>
    <title>Gestione Modelli</title>
    <!-- Do lo stile alle card -->
    <style type="text/css">
        .card {
            border: 1px solid #7952b3;
            box-shadow: 5px 5px 5px #5e0add;
        }

        .card hr {
            color: #7952b3;
        }

        .card-body {
            border: 1px solid #7952b3;
        }

        .list-group-item {
            border: 1px solid #7952b3;
        }
    </style>

</head>

<body>
    <?php
    navbar();
    ?>


    <!-- Volendo lo posso fare anche così: https://www.codeply.com/go/hs12dUxHnQ -->
    <h2>Modelli d'abbigliamento</h2>
    <!-- Inizio del card-deck -->
    <div class="card-deck">
        <?php
        // Mi salvo il nome del percorso
        $Path = "immagini/fotoModelli/";
        // Comando SQL
        $strSQL = "SELECT * FROM modelli ORDER BY Nome;"; // Semplice Query di visualizzazione
        $risultato = mysqli_query($conn, $strSQL);
        $contaCardPerRiga = 1;
        while ($riga = mysqli_fetch_array($risultato)) {
        ?>
            <div class="card" style="width: 18rem;" class="stileCard">
                <?php
                // Ottengo il nome dell'immagine
                $Immagine = $riga["Immagine"];
                ?>
                <!-- Scrivo il nome del percorso -->
                <img src='<?php echo $Path . $Immagine ?>' class="card-img-top" alt="Card image cap">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"> <?php echo $riga['Nome']; ?> </h5>
                    <p class="card-text"> <?php echo $riga['Descrizione'];  ?></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"> <?php echo $riga['PrezzoListino'] . " €"; ?>
                    </li>
                    <li class="list-group-item"><?php echo $riga['Genere']; ?>
                    </li>
                    <li class="list-group-item"> <?php echo $riga['Collezione']; ?>
                    </li>
                </ul>
                <div class="card-body d-flex flex-column">
                    <a href="#" class="btn btn-primary mt-auto">Acquista capo</a>
                    <a href="#" class="card-link">Lascia una recensione</a>
                </div>
            </div>
            <?php
            // Voglio visualizzare solo 4 card per ogni riga
            if ($contaCardPerRiga == 4) {
            ?>
                <!-- Finisco l'attuale card-deck -->
    </div>
    <br>
    <br>
    <!-- E ne inizio uno nuovo -->
    <div class="card-deck">
<?php
                // Ricomincia a contare
                $contaCardPerRiga = 0;
            }
            // Ho appena stampato una card per questa riga, incremento il contatore (Se sono entrato nell'if precedente, con questo conteggio ripartirò sempre da 1)
            $contaCardPerRiga++;
        }
?>
    </div>
    <!-- Fine card deck -->
    <?php
    footer();
    ?>
</body>

</html>
<!-- Includo le istruzioni per la connessione scritte nel file: 'connessione.php' 
     Includo le istruzioni per le funzioni, da richiamare in ogni pagina
-->
<?php
include_once('connessione.php');
include_once('funzioni.php');
?>
<!-- Inizio pagina HTML -->
<!DOCTYPE html>
<html lang="it">

<head>
    <?php
    head(); // Richiamo la funzione head
    ?>
    <title>Interrogazioni</title>
</head>

<body>

    <!-- Inizio istruzioni vere e proprie -->

    <?php
    navbar(); // Richiamo la funzione navbar
    ?>






















    <!-- FORM 1 -->
    <!-- Provare con codice modello: 2 taglia: L -->
    <h2>Elenco dei capi disponibili per ciascun punto vendita</h2>
    <!-- Con questo form vado a prendere in input dall'utente il codice del modello e la taglia, per poi elaborare il tutto successivamente -->
    <div class="d-flex justify-content-center">
        <fieldset>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>#query1" class="formOperazioniDML">
                <div class="form-group">
                    <p>
                        <label for="Modello">Scegli il modello dall'elenco: &nbsp;&nbsp;&nbsp;</label>
                        <select name="Modello">
                            <option value="">---</option>
                            <?php
                            // Comando SQL
                            $strSQL = "SELECT DISTINCT CodModello FROM capi ORDER BY CodModello;"; // Raccolgo solo il codice del modello dalla tabella capi
                            $risultato = $risultato = mysqli_query($conn, $strSQL);
                            while ($riga = mysqli_fetch_array($risultato)) {
                                echo "<option value=\"" . $riga["CodModello"] . "\">" . $riga["CodModello"] . "</option> \n";
                            }
                            ?>
                        </select>
                    </p>
                    <p>
                    </p>
                    <p>
                        <label for="Taglia">Seleziona una taglia dall'elenco: &nbsp;&nbsp;&nbsp;</label>
                        <select name="Taglia">
                            <option value="">---</option>
                            <?php
                            $numTaglie = count($taglie); // Conto il numero di elementi dell'array $taglie
                            for ($i = 0; $i < $numTaglie; $i++) {
                                echo '<option value="' . $taglie[$i] . '">' . $taglie[$i] . '</option>'; // Creo le options per la select
                            }
                            ?>
                        </select>
                    </p>
                    <p>
                        <input type="submit" name="invioQuery1" value="Cerca" />&nbsp;
                        <input type="reset" name="annulla" value="Annulla" />
                    </p>
                </div>
            </form>
        </fieldset>
    </div>



    <!-- QUERY 1: Elenco dei capi disponibili per ciascun punto vendita -->
    <?php
    $modello = null;
    $taglia = null;
    if (isset($_POST['invioQuery1'])) {
        // Acquisisco modello e taglia dal form HTML e me li salvo in queste due variabili
        if (isset($_POST["Modello"]) && !empty($_POST["Modello"]) &&  strcmp($_POST["Modello"], $stringaControllo) != 0)
            $modello = $_POST["Modello"];
        else {
    ?>
            <div class="container divMessaggio" id="divInserisciModello_Capi">
                <!-- "d-flex justify-content-center" -->
                <div class="alert alert-warning alert-dismissible">
                    <strong>Attenzione!</strong> Devi selezionare un modello
                </div>
            </div>
        <?php

        }
        if (isset($_POST["Taglia"]) && !empty($_POST["Taglia"]) && strcmp($_POST["Taglia"], $stringaControllo) != 0)
            $taglia = $_POST["Taglia"];
        else {
        ?>
            <div class="container divMessaggio" id="divInserisciTaglia_Capi">
                <!-- "d-flex justify-content-center" -->
                <div class="alert alert-warning alert-dismissible">
                    <strong>Attenzione!</strong> Devi selezionare una taglia
                </div>
            </div>
            <?php
        }
        if ($modello != null && $taglia != null) { // Comando SQL 
            $strSQL = "SELECT PuntoVendita, ID, Taglia, Colore, CodModello
                   FROM capi
                   WHERE CodModello = '$modello' AND Taglia = '$taglia'
                   ORDER BY PuntoVendita;";
            $risultato = mysqli_query($conn, $strSQL);
            $numRighe = mysqli_affected_rows($conn);

            if ($risultato) { // controllo corretto risultato
                if ($numRighe > 0) {
            ?>
                    <!-- Intestazione della tabella -->
                    <table id='table-center' class="table">
                        <thead>
                            <tr>
                                <th>Punto vendita</th>
                                <th>Codice capo</th>
                                <th>Taglia</th>
                                <th>Colore</th>
                                <th>Modello</th>
                            </tr>
                        </thead>
                        <?php
                        while ($riga = mysqli_fetch_array($risultato)) {
                        ?>
                            <!-- Corpo della tabella -->
                            <tbody>
                                <!-- Riga della tabella -->
                                <tr>
                                    <!-- Singolo elemento della riga -->
                                    <td>
                                        <?php
                                        echo $riga['PuntoVendita'];
                                        ?>
                                    </td>
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
                                        echo $riga['CodModello'];
                                        ?>
                                    </td>
                                </tr>
                                <!-- Alla fine di tutto, quando lavoro col PHP devo sempre chiudere eventuali parentesi graffe aperte in precedeza
                        (QUANDO LAVORO CON LE TABELLE LO DEVO CHIUDERE SEMPRE PRIMA DEL TBODY)
                    -->
                            <?php
                        } // chiusura while($riga)
                    } // chiusura if $numRighe
                    else {
                            ?>
                            <div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5 class="text-info">Non sono ancora presenti capi di modello <u> <?php echo " $modello "  ?> </u> e di taglia <u><?php echo " $taglia "  ?> </u>.</h5>
                            </div>

                        <?php
                    }
                } // chiusura if $risultato
                else {
                        ?>
                        <div class="container divMessaggio">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Errore nel comando SQL: Query 1!</strong>
                            </div>
                        </div>
                <?php
                } // fine else comando sql
            } // chiusura if comando sql

        } // chiusura if(isset)
        else {
                ?>
                <div class="container divMessaggio">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Attenzione!</strong> Selezionare dei dati validi
                    </div>
                </div>
            <?php
        }
            ?>
                            </tbody>
                    </table>



                    <br>
                    <br>
                    <br>












































                    <!-- QUERY2: -->
                    <h2>Volume totale di vendite di un determinato punto vendita in un dato periodo di tempo.</h2>
                    <div class="d-flex justify-content-center">
                        <fieldset>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>#query2-3" class="formOperazioniDML">
                                <div class="form-group">
                                    <p>
                                        <label for="codPV">Scegli il punto vendita dall'elenco: &nbsp;&nbsp;&nbsp;</label>
                                        <select name="codPV">
                                            <option value="">---</option>
                                            <?php
                                            // Comando SQL
                                            $strSQL = "SELECT DISTINCT CodPV FROM puntivendita ORDER BY CodPV;"; // Raccolgo solo il codice del modello dalla tabella capi
                                            $risultato = $risultato = mysqli_query($conn, $strSQL);
                                            while ($riga = mysqli_fetch_array($risultato)) {
                                                echo "<option value=\"" . $riga["CodPV"] . "\">" . $riga["CodPV"] . "</option> \n";
                                            }
                                            ?>
                                        </select>
                                    </p>
                                    <p>
                                        <label for="dataInizio">Inserisci la data di inizio: &nbsp;&nbsp;&nbsp;</label>
                                        <input type="date" name="dataInizio" id="">
                                    </p>
                                    <p>
                                        <label for="dataFine">Inserisci la data di fine: &nbsp;&nbsp;&nbsp;</label>
                                        <input type="date" name="dataFine" id="">
                                    </p>
                                    <p>
                                        <input type="submit" name="invioQuery2" value="Invia" />&nbsp;
                                        <input type="reset" name="annulla" value="Annulla" />
                                    </p>
                                </div>
                            </form>
                        </fieldset>
                    </div>

                    <div class="d-flex justify-content-center">
                        <div class="row">
                            <?php
                            // Variabili che mi servono
                            $puntoVendita = null;
                            $dataInizio = null;
                            $dataFine = null;

                            // Controlli sulle variabili
                            if (isset($_POST["invioQuery2"])) {
                                // Controllo il punto vendita
                                if (isset($_POST["codPV"]) && !empty($_POST["codPV"]) && strcmp($stringaControllo, $_POST["codPV"] != 0)) {
                                    $puntoVendita = $_POST["codPV"];
                                } else {
                            ?>
                                    <div class="container divMessaggio">
                                        <div class="alert alert-warning alert-dismissible">
                                            <strong>Attenzione!</strong> Devi selezionare un punto vendita
                                        </div>
                                    </div>
                                <?php
                                }

                                // Controllo la data di inizio
                                if (isset($_POST["dataInizio"]) && !empty($_POST["dataInizio"])) {
                                    $dataInizio = $_POST["dataInizio"];
                                } else {
                                ?>
                                    <div class="container divMessaggio" id="">
                                        <div class="alert alert-warning alert-dismissible">
                                            <strong>Attenzione!</strong> Devi inserire la data di inizio periodo
                                        </div>
                                    </div>
                                <?php
                                }

                                // Controllo la data di fine
                                if (isset($_POST["dataFine"]) && !empty($_POST["dataFine"])) {
                                    $dataFine = $_POST["dataFine"];
                                } else {
                                ?>
                                    <div class="container divMessaggio" id="">
                                        <div class="alert alert-warning alert-dismissible">
                                            <strong>Attenzione!</strong> Devi inserire la data di fine periodo
                                        </div>
                                    </div>
                                    <?php
                                }



                                // Comando SQL 1 per la query 2
                                if (($puntoVendita != null) && ($dataInizio != null) && ($dataFine != null)) {
                                    $strSQL = "SELECT COUNT(*) AS NumeroVendite
                        FROM vendite INNER JOIN capi ON vendite.IDCapo = capi.ID
                        WHERE capi.puntovendita = '$puntoVendita'
                        AND DataVendita BETWEEN '$dataInizio' AND '$dataFine';";
                                    $risultato = mysqli_query($conn, $strSQL);
                                    // Controllo corretto risultato
                                    if ($risultato) {
                                        $numRighe = mysqli_affected_rows($conn);
                                        // Ottengo un solo risultato con mysqli_fetch_assoc(), e non un array associativo
                                        $dato = mysqli_fetch_assoc($risultato);
                                        if ($dato["NumeroVendite"] != 0) {
                                    ?>
                                            <div class="col">
                                                <h5 style="white-space: nowrap;">Numero delle vendite</h5>
                                                <table class="table table-center stileTabelle">
                                                    <thead>
                                                        <th>Numero delle vendite</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php echo "<td>" . $dato["NumeroVendite"] . " </td>"; ?>
                                                    </tbody>
                                                </table>

                                            <?php
                                        } // fine if $numRighe risultato
                                        else {
                                            ?>
                                            </div>
                                            <div class="alert alert-info alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <h5 class="text-info">Non sono ancora state effettuate vendite nel punto vendita <u> <?php echo " $puntoVendita ";  ?> </u> nel periodo selezionato (dal: &nbsp;<u> <?php echo " $dataInizio ";  ?> </u> al: &nbsp;<u> <?php echo " $dataFine ";  ?> </u> ).</h5>
                                            </div>

                                        <?php
                                        }
                                    } // fine if $risultato
                                    else {
                                        ?>
                                        <div class="container divMessaggio">
                                            <div class="alert alert-danger alert-dismissible">
                                                <strong>Errore nel comando SQL: Numero delle vendite!</strong>
                                            </div>
                                        </div>
                                    <?php
                                    } // fine else $risultato
                                    ?>
                        </div> <!-- fine div col -->
                        <?php




                                    // Comando SQL2 per la QUERY 3
                                    $strSQL = "SELECT SUM(PrezzoVendita) AS Incasso
                                                    FROM vendite INNER JOIN capi ON vendite.IDCapo = capi.ID
                                                    WHERE capi.puntovendita = '$puntoVendita'
                                                    AND DataVendita BETWEEN '$dataInizio' AND '$dataFine';";
                                    $risultato = mysqli_query($conn, $strSQL);
                                    // Controllo corretto risultato
                                    if ($risultato) {
                                        $numRighe = mysqli_affected_rows($conn);
                                        // Ottengo un solo risultato con mysqli_fetch_assoc(), e non un array associativo
                                        $dato = mysqli_fetch_assoc($risultato);
                                        if ($dato["Incasso"] != 0) {
                        ?>
                                <!-- QUERY3: Inasso delle vendite -->
                                <div class="col">
                                    <h5>Incasso delle vendite</h5>
                                    <table class="table table-center stileTabelle">
                                        <thead>
                                            <th>Incasso delle vendite</th>
                                        </thead>
                                        <tbody>
                                            <?php echo "<td>" . $dato["Incasso"] . " €" . " </td>"; ?>
                                        </tbody>
                                    </table>
                                <?php
                                        } // fine if $numRighe risultato
                                    } // fine if $risultato
                                    else {
                                ?>
                                <div class="container divMessaggio">
                                    <div class="alert alert-danger alert-dismissible">
                                        <strong>Errore nel comando SQL: Incasso delle vendite!</strong>
                                    </div>
                                </div>

                        <?php
                                    } // fine else $risultato

                                } // fine if comando sql

                            } // fine if (isset) bottone principale
                            else {
                        ?>
                        <div class="container divMessaggio">
                            <div class="alert alert-warning alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Attenzione!</strong> Inserire dei dati.
                            </div>
                        </div>
                    <?php
                            } // fine else isset
                    ?>
                                </div> <!-- fine div col -->
                    </div> <!-- fine div row -->
                    </div>



                    <br>
                    <br>
                    <br>



                    <h2>Elenco dei capi presenti in un punto vendita ad una precisa data (a scopo di inventario) con la descrizione dei modelli a cui appartengono.</h2>
                    <div class="d-flex justify-content-center">
                        <fieldset>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>#query2-3" class="formOperazioniDML">
                                <div class="form-group">
                                    <p>
                                        <label for="puntovendita">Scegli il punto vendita dall'elenco: &nbsp;&nbsp;&nbsp;</label>
                                        <select name="puntovendita">
                                            <option value="">---</option>
                                            <?php
                                            // Comando SQL
                                            $strSQL = "SELECT DISTINCT CodPV FROM puntivendita ORDER BY CodPV;"; // Raccolgo solo il codice del modello dalla tabella capi
                                            $risultato = $risultato = mysqli_query($conn, $strSQL);
                                            while ($riga = mysqli_fetch_array($risultato)) {
                                                echo "<option value=\"" . $riga["CodPV"] . "\">" . $riga["CodPV"] . "</option> \n";
                                            }
                                            ?>
                                        </select>
                                    </p>
                                    <p>
                                        <input type="submit" name="invioQuery3" value="Invia" />&nbsp;
                                        <input type="reset" name="annulla" value="Annulla" />
                                    </p>
                                </div>
                            </form>
                        </fieldset>
                    </div>

                    <?php

                    // Variabili che mi servono
                    $puntoVendita = null;

                    if (isset($_POST["invioQuery3"])) {

                        // Controllo il punto vendita
                        if (isset($_POST["puntovendita"]) && !empty($_POST["puntovendita"]) && strcmp($_POST["puntovendita"], $stringaControllo) != 0)
                            $puntoVendita = $_POST["puntovendita"];
                        else {
                    ?>
                            <div class="container divMessaggio">
                                <div class="alert alert-warning alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong>Selezionare un punto vendita</strong>
                                </div>
                            </div>
                            <?php
                        }
                        // Comando SQL
                        if ($puntoVendita != null) {
                            $strSQL = "SELECT capi.ID, Modelli.Nome, modelli.Descrizione, capi.Taglia, capi.Colore
                                        FROM capi INNER JOIN modelli ON capi.CodModello = modelli.CodModello
                                        WHERE capi.PuntoVendita = '$puntoVendita';";
                            $risultato = mysqli_query($conn, $strSQL);

                            if ($risultato) {
                            ?>
                                <!-- Costruisco la tabella -->
                                <div class="d-flex justify-content-center">
                                    <table class="table table-center stileTabelle">
                                        <thead>
                                            <th>ID capo</th>
                                            <th>Nome Modello</th>
                                            <th>Descrizione Modello</th>
                                            <th>Taglia capo</th>
                                            <th>Colore capo</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($riga = mysqli_fetch_array($risultato)) {
                                            ?>
                                                <tr>
                                                    <!-- Singolo elemento della riga -->
                                                    <td>
                                                        <?php
                                                        echo $riga['ID'];
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
                                                        echo $riga['Taglia'];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <input type="color" name="Colore" value="<?= htmlspecialchars($riga['Colore']) ?>" disabled>
                                                    </td>
                                                </tr>
                                            <?php
                                            } // fine while
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php
                            } // fine if $risultato
                            else {
                            ?>
                                <div class="container divMessaggio">
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <strong>Errore nel comando SQL: Query 4</strong>
                                    </div>
                                </div>
                        <?php
                            } // fine else $risultato

                        } // fine if comando sql 

                    }    // fine if (isset)
                    else {
                        ?>
                        <div class="container divMessaggio">
                            <div class="alert alert-warning alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Attenzione!</strong> Inserire dei dati.
                            </div>
                        </div>
                    <?php

                    } // fine else isset
                    ?>



















                    <?php
                    footer(); // Richiamo la funzione per il piè di pagina
                    ?>
                    <!-- Chiusura della connessione al DataBase -->
                    <?php
                    mysqli_close($conn); //Make sure to close out the database connection
                    ?>

</body>

</html>



<!-- Javascript e JQuery nel documento corrente-->
<script>
    $(document).ready(function() {
        // Aggiungo a tutte le tabelle con id "#table-centerN" le classi contenute in addClass(...)
        $("#table-center").addClass("table mx-auto w-auto stileTabelle");

        // Applico a tutti gli h2 lo stile grassetto
        $("h2").css("font-weight", "bold");
        $("h2").css("text-align", "center");
        $("h5").css("text-align", "center");

    });
</script>
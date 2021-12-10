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
    <title>INSERIMENTO</title>
</head>

<body>
    <!-- Inizio istruzioni vere e proprie -->

    <?php
    navbar(); // Richiamo la funzione navbar
    ?>







    <!-- ############################################################################################################################################### -->
    <!-- ############################################################################################################################################### -->
    <!-- ############################################################################################################################################### -->
    <!-- CAPI  -->
    <!-- QUERY DI RACCOLTA DATI DA FORM -->
    <h2>Inserimento di un nuovo capo d'abbigliamento</h2>
    <!-- Con questo form vado a prendere in input dall'utente: Taglia, Colore, PuntoVendita, Modello, per poi elaborare il tutto successivamente -->
    <div class="d-flex justify-content-center">
        <fieldset>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>#formInserisciCapi" id="formInserisciCapi" class="formOperazioniDML">
                <!-- $ _SERVER [ 'PHP_SELF'] è una variabile d'ambiente supportata da tutte le piattaforme che indica il nome del file su cui è attualmente in esecuzione lo script PHP rispetto alla root del Web server.
                                                                                                        In pratica si tratta del nome della pagina corrente; lo puoi utilizzare quando il codice che processa i dati del form si trova nella stessa pagina in cui si trova il form -->
                <div class="form-group">

                    <p>
                        <label for="Taglia">Seleziona una taglia:&nbsp; </label>
                        <select name="Taglia" id="selectInserisciTaglia_Capi" onchange="hideDiv('divInserisciTaglia_Capi',this); showDiv('divInserisciTaglia_Capi',this)">
                            <option>---</option>
                            <?php
                            $numTaglie = count($taglie); // Conto il numero di elementi dell'array $taglie
                            for ($i = 0; $i < $numTaglie; $i++) {
                                echo '<option value="' . $taglie[$i] . '">' . $taglie[$i] . '</option>'; // Creo le options per la select
                            }
                            ?>
                        </select>
                    </p>

                    <p>
                        <label for="Colore">Colore del nuovo capo:&nbsp;</label>
                        <input type="color" name="Colore" id="inputInserisciColore" onchange="hideDiv('divInserisciColore',this); showDiv('divInserisciColore',this)"></input>
                    </p>

                    <!-- SELEZIONO IL PUNTO VENDITA DI INTERESSE (in ordine) -->
                    <p>
                        <label for="PuntoVendita">Punto vendita di interesse:&nbsp; </label>
                        <select name="PuntoVendita" id="selectInserisciPuntoVendita_Capi" onchange="hideDiv('divInserisciPuntoVendita_Capi',this); showDiv('divInserisciPuntoVendita_Capi',this)">
                            <option>---</option>
                            <?php
                            // Comando SQL. ( <strong>Ricorda</strong>: il .= è stato deprecato )
                            $strSQL = "SELECT DISTINCT CodPV FROM puntivendita ORDER BY CodPV;"; // Raccolgo il codice del punto vendita dalla tabella puntivendita
                            $risultato = mysqli_query($conn, $strSQL);
                            while ($riga = mysqli_fetch_array($risultato)) {
                                echo "<option value=\"" . $riga["CodPV"] . "\">" . $riga["CodPV"] . "</option> \n";
                            }
                            ?>
                        </select>
                    </p>

                    <!-- SELEZIONO IL CODICE DEL MODELLO DI INTERESSE (in ordine) -->
                    <p>
                        <label for="Modello">Codice modello del capo:&nbsp; </label>
                        <select name="Modello" id="selectInserisciModello_Capi" onchange="hideDiv('divInserisciModello_Capi',this); showDiv('divInserisciModello_Capi',this)">
                            <option>---</option>
                            <?php
                            // Comando SQL. ( <strong>Ricorda</strong>: il .= è stato deprecato )
                            $strSQL = "SELECT DISTINCT CodModello FROM modelli ORDER BY CodModello;"; // Raccolgo il codice del modello dalla tabella modelli
                            $risultato = mysqli_query($conn, $strSQL);
                            while ($riga = mysqli_fetch_array($risultato)) {
                                echo "<option value=\"" . $riga["CodModello"] . "\">" . $riga["CodModello"] . "</option> \n";
                            }
                            ?>
                        </select>
                    </p>

                    <br>
                    <input type="submit" name="InserisciCapo" value="Inserisci" id="elementoModello" />
                    <input type="reset" name="Annulla" value="Annulla" id="elementoModello" />
                </div>
            </form>

        </fieldset>
    </div>
    <!-- FINE QUERY DI RACCOLTA DATI DA FORM -->

    <!-- QUERY DI INSERIMENTO -->
    <?php

    // PER INSERIRE UN CAPO, DEVO ASSICURARMI DI AVERE PRIMA INSERITO ALMENO UN PUNTO VENDITA ED ALMENO UN MODELLO !
    // Dichiaro le variabili che mi servono
    $Taglia = null;
    $Colore = null;
    $PuntoVendita = null;
    $Modello = null;

    if (isset($_POST['InserisciCapo']) && isset($_POST["PuntoVendita"]) && isset($_POST["Modello"])) // isset — Determine if a variable is declared and is different than null
    {
        // Controllo di aver inserito la taglia
        if (isset($_POST['InserisciCapo']) && isset($_POST["Taglia"])  && !empty($_POST["Taglia"]) && (strcmp($_POST["Taglia"], $stringaControllo) != 0)) {
            $Taglia = $_POST["Taglia"];
        } else {
    ?>
            <div class="container divMessaggio" id="divInserisciTaglia_Capi">
                <!-- "d-flex justify-content-center" -->
                <div class="alert alert-warning alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Bottone che serve per chiudere il warning -->
                    <strong>Attenzione!</strong> Devi inserire una taglia
                </div>
            </div>
            <!-- <p class="text-warning testoOmbreggiato"></p> -->
        <?php
        }

        // Controllo di aver inserito il colore
        if (isset($_POST['InserisciCapo']) && isset($_POST["Colore"]) && !empty($_POST["Colore"])) {
            $Colore = $_POST["Colore"];
        } else {
        ?>
            <div class="container divMessaggio" id="divInserisciColore">
                <strong>Attenzione!</strong> Devi inserire il colore
            </div>
            </div>

            <!-- <p class="text-warning testoOmbreggiato">Devi inserire il colore</p> -->
        <?php
        }

        // Controllo di aver inserito il punto vendita
        if (isset($_POST['InserisciCapo']) && isset($_POST["PuntoVendita"]) && !empty($_POST["PuntoVendita"]) && (strcmp($_POST["PuntoVendita"], $stringaControllo) != 0)) {
            $PuntoVendita = $_POST["PuntoVendita"];
        } else {
        ?>
            <div class="container divMessaggio" id="divInserisciPuntoVendita_Capi">
                <div class="alert alert-warning alert-dismissible">
                    <strong>Attenzione!</strong> Devi inserire il punto vendita
                </div>
            </div>
            <!-- <p class="text-warning testoOmbreggiato">Devi inserire il punto vendita</p> -->
        <?php
        }


        // Controllo di aver inserito il modello
        if (isset($_POST['InserisciCapo']) && isset($_POST["Modello"]) && !empty($_POST["Modello"]) && (strcmp($_POST["Modello"], $stringaControllo) != 0)) {
            $Modello = $_POST["Modello"];
        } else {
        ?>
            <div class="container divMessaggio" id="divInserisciModello_Capi">
                <div class="alert alert-warning alert-dismissible">
                    <strong>Attenzione!</strong> Devi inserire il modello del capo
                </div>
            </div>
            <!-- <p class="text-warning testoOmbreggiato">Devi inserire il modello del capo</p> -->
            <?php
        }

        // COMANDO SQL  !! Per le stringhe devo usare gli apici !!
        if (($Taglia != null) && ($Colore != null) && $PuntoVendita != null && ($Modello != null)) {
            // Se li ho inseriti tutti, esegui la query di inserimento
            $strSQL = "INSERT INTO capi (Taglia, Colore, PuntoVendita, CodModello) VALUES ('$Taglia','$Colore','$PuntoVendita','$Modello')";
            $risultato = mysqli_query($conn, $strSQL);

            // Controllo del corretto inserimento
            if ($risultato) {
            ?>
                <!-- <p class="text-success testoOmbreggiato">Capo inserito correttamente</p> -->
                <div class="container divMessaggio">
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Capo inserito correttamente</strong>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <!-- <p class="text-danger testoOmbreggiato">Errore nell'inserimento del capo</p> -->
                <div class="container divMessaggio">
                    <div class="alert alert-danger alert-dismissible">
                        <strong>Errore nell'inserimento del capo</strong>
                    </div>
                </div>
        <?php
                echo $conn->error;
            }
        } // fine if comando SQL
        ?>

    <?php
    } // chiusura if(isset) bottone principale
    else {
    ?>
        <div class="container divMessaggio">
            <div class="alert alert-warning alert-dismissible">
                <!-- style="display:inline-block;" -->
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Attenzione! </strong>Compila tutti i campi.
                <br>
                <strong>Ricorda</strong>: devi prima aver inserito almeno un punto vendita ed un modello.
            </div>
        </div>
        <!-- <p class="text-warning testoOmbreggiato">Devi prima inserire almeno un punto vendita ed un modello!!</p> -->
    <?php
    } // chiusura else(isset)

    ?>
    <!-- FINE QUERY DI INSERIMENTO -->














    <!-- ############################################################################################################################################### -->
    <!-- ############################################################################################################################################### -->
    <!-- ############################################################################################################################################### -->
    <!--  MODELLI -->
    <!-- QUERY DI RACCOLTA DATI DA FORM -->
    <h2>Inserimento di un nuovo modello di capo d'abbigliamento</h2>
    <!-- Con questo form vado a prendere in input dall'utente: Nome, Descrizione, PrezzoListino, Genere, Collezione per poi elaborare il tutto successivamente -->
    <div class="d-flex justify-content-center">
        <fieldset>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>#formInserisciModelli" id="formInserisciModelli" class="formOperazioniDML">
                <!-- $ _SERVER [ 'PHP_SELF'] è una variabile d'ambiente supportata da tutte le piattaforme che indica il nome del file su cui è attualmente in esecuzione lo script PHP rispetto alla root del Web server.
                                                                                                    In pratica si tratta del nome della pagina corrente; lo puoi utilizzare quando il codice che processa i dati del form si trova nella stessa pagina in cui si trova il form -->
                <div class="form-group">
                    <p>
                        <label for="Immagine">Immagine del modello:&nbsp;</label>
                        <input type="file" name="Immagine" value="Inserire file" id="inputInserisciImmagineModelli" onchange="hideDiv('divInserisciImmagine_Modelli',this); showDiv('divInserisciImmagine_Modelli',this)"/>
                    </p>
                    <p>
                        <label for="Nome">Nome del modello:&nbsp;</label>
                        <input type="text" name="Nome" id="inputInserisciNomeModelli" onchange="hideDiv('divInserisciNome_Modelli',this); showDiv('divInserisciNome_Modelli',this)"></input>
                    </p>


                    <p>
                        <label for="Descrizione">Descrizione del modello:&nbsp;</label>
                    </p>
                    <p>
                        <textarea type="text" name="Descrizione" id="inputInserisciDescrizioneModelli" onchange="hideDiv('divInserisciDescrizione_Modelli',this); showDiv('divInserisciDescrizione_Modelli',this)"></textarea>
                    </p>

                    <p>
                        <label for="PrezzoListino">Prezzo di listino:&nbsp;</label>
                        <input type="number" step="0.01" name="PrezzoListino" id="inputInserisciPrezzoListinoModelli" onchange="hideDiv('divInserisciPrezzoListino_Modelli',this); showDiv('divInserisciPrezzoListino_Modelli',this)"></input>
                    </p>

                    <p>
                        <label for="Genere">Genere (M/F):&nbsp;</label>
                        <input type="text" name="Genere" id="inputInserisciGenereModelli" onchange="hideDiv('divInserisciGenere_Modelli',this); showDiv('divInserisciGenere_Modelli',this)"></input>
                    </p>

                    <p>
                        <label for="Collezione">Collezione:&nbsp;</label>
                        <input type="text" name="Collezione" id="inputInserisciCollezioneModelli" onchange="hideDiv('divInserisciCollezione_Modelli',this); showDiv('divInserisciCollezione_Modelli',this)"></input>
                    </p>

                    <br>
                    <input type="submit" name="InserisciModello" value="Inserisci" />
                    <input type="reset" name="Annulla" value="Annulla" />
                </div>
            </form>
        </fieldset>
    </div>
    <!-- FINE QUERY DI RACCOLTA DATI DA FORM -->

    <!-- QUERY DI INSERIMENTO -->
    <?php
    // Dichiaro le variabili che mi servono
    $Immagine = null;
    $Nome = null;
    $Descrizione = null;
    $PrezzoListino = null;
    $Genere = null;
    $Collezione = null;

    if (isset($_POST['InserisciModello'])) // isset — Determine if a variable is declared and is different than null
    {

        // Controllo di aver inserito correttamente l'immagine
        if (isset($_POST['InserisciModello']) && isset($_POST["Immagine"]) && (!empty($_POST["Immagine"]))) {
            $Immagine = $_POST["Immagine"];
        } else {
    ?>
            <div class="container divMessaggio" id="divInserisciImmagine_Modelli">
                <div class="alert alert-warning alert-dismissible">
                    <!-- style="display:inline-block;" -->
                    <strong>Attenzione: </strong>Devi inserire il percorso in cui è contenuta l'immagine
                </div>
            </div>
            <!-- <p class="text-warning testoOmbreggiato">Devi inserire il nome del modello</p> -->
        <?php
        }

        // Controllo di aver inserito il nome
        if (isset($_POST['InserisciModello']) && isset($_POST["Nome"]) && (!empty($_POST["Nome"]))) {
            $Nome = $_POST["Nome"];
        } else {
        ?>
            <div class="container divMessaggio" id="divInserisciNome_Modelli">
                <div class="alert alert-warning alert-dismissible">
                    <!-- style="display:inline-block;" -->
                    <strong>Attenzione: </strong>Devi inserire il nome del modello
                </div>
            </div>
            <!-- <p class="text-warning testoOmbreggiato">Devi inserire il nome del modello</p> -->
        <?php
        }

        // Controllo di aver inserito la descrizione
        if (isset($_POST['InserisciModello']) && isset($_POST["Descrizione"]) && (!empty($_POST["Descrizione"]))) {
            $Descrizione = $_POST["Descrizione"];
        } else {
        ?>

            <div class="container divMessaggio" id="divInserisciDescrizione_Modelli">
                <div class="alert alert-warning alert-dismissible">
                    <!-- style="display:inline-block;" -->
                    <strong>Attenzione: </strong>Devi inserire la descrizione del modello
                </div>
            </div>
            <!-- <p class="text-warning testoOmbreggiato">Devi inserire la descrizione del modello</p> -->
        <?php
        }

        // Controllo di aver inserito il prezzo di listino
        if (isset($_POST['InserisciModello']) && isset($_POST["PrezzoListino"]) && (!empty($_POST["PrezzoListino"]))) {
            $PrezzoListino = $_POST["PrezzoListino"];
        } else {
        ?>
            <div class="container divMessaggio" id="divInserisciPrezzoListino_Modelli">
                <div class="alert alert-warning alert-dismissible">
                    <!-- style="display:inline-block;" -->
                    <strong>Attenzione: </strong>Devi inserire il prezzo del modello
                </div>
            </div>
            <!-- <p class="text-warning testoOmbreggiato">Devi inserire il prezzo di listino del modello</p> -->
            <?php
        }

        // Controllo di aver inserito il genere
        if (isset($_POST['InserisciModello']) && isset($_POST["Genere"]) && (!empty($_POST["Genere"]))) {
            // Controllo di aver inserito un carattere
            if (($_POST["Genere"] == 'M') || ($_POST["Genere"] == 'm') || ($_POST["Genere"] == 'F') || ($_POST["Genere"] == 'f')) {
                $Genere = $_POST["Genere"];
            } else {
            ?>
                <div class="container divMessaggio">
                    <div class="alert alert-warning alert-dismissible">
                        <!-- style="display:inline-block;" -->
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Attenzione: </strong>Inserisci: M/F oppure m/f
                    </div>
                </div>
                <!--  <p class="text-warning">Inserisci: M/F oppure m/f</p> -->
            <?php
            }
        } else {
            ?>
            <div class="container divMessaggio" id="divInserisciGenere_Modelli">
                <div class="alert alert-warning alert-dismissible">
                    <!-- style="display:inline-block;" -->
                    <strong>Attenzione: </strong>Devi inserire il genere del modello
                </div>
            </div>
            <!-- <p class="text-warning testoOmbreggiato">Devi inserire il genere del modello</p> -->
        <?php
        }


        // Controllo di aver inserito la collezione
        if (isset($_POST['InserisciModello']) && isset($_POST["Collezione"]) &&  (!empty($_POST["Collezione"]))) {
            $Collezione = $_POST["Collezione"];
        } else {
        ?>
            <div class="container divMessaggio" id="divInserisciCollezione_Modelli">
                <div class="alert alert-warning alert-dismissible">
                    <!-- style="display:inline-block;" -->
                    <strong>Attenzione: </strong>Devi inserire la collezione del modello
                </div>
            </div>
            <!-- <p class="text-warning testoOmbreggiato">Devi inserire la collezione del modello</p> -->
            <?php
        }

        // COMANDO SQL  !! Per le stringhe devo usare gli apici !!
        if ( ($Immagine != null) && ($Nome != null) && ($Descrizione != null) && ($PrezzoListino != null) && ($Genere != null) && ($Collezione != null)) {
            // Ci metto solo i campi che mi interessano
            $strSQL = "INSERT INTO modelli (Immagine, Nome, Descrizione, PrezzoListino, Genere, Collezione) VALUES ('$Immagine', '$Nome','$Descrizione','$PrezzoListino','$Genere','$Collezione')";
            $risultato = mysqli_query($conn, $strSQL);
            // Controllo del corretto inserimento
            if ($risultato) {
            ?>
                <div class="container divMessaggio">
                    <div class="alert alert-success alert-dismissible">
                        <!-- style="display:inline-block;" -->
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Modello inserito correttamente </strong>
                    </div>
                </div>
                <!-- <p class="text-success testoOmbreggiato">Modello inserito correttamente</p> -->
            <?php
            } else {
            ?>
                <div class="container divMessaggio">
                    <div class="alert alert-danger alert-dismissible">
                        <!-- style="display:inline-block;" -->
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Errore nell'inserimento del modello </strong>
                    </div>
                </div>
                <!-- <p class="text-danger testoOmbreggiato">Errore nell'inserimento del modello</p> -->
        <?php
                echo $conn->error;
            }
            //  echo $_POST; // a scopo di debugging
        } // fine if comando SQL
        ?>
        <!-- Alla fine di tutto, quando lavoro col PHP devo sempre chiudere eventuali parentesi graffe aperte in precedeza -->
    <?php
    } // chiusura if(isset) bottone principale
    else {
    ?>
        <div class="container divMessaggio">
            <div class="alert alert-warning alert-dismissible">
                <!-- style="display:inline-block;" -->
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong> Attenzione! </strong>Compila tutti i campi.
            </div>
        </div>
        <!-- <p class="text-warning testoOmbreggiato">Compila tutti i campi.</p> -->
    <?php
    }
    ?>
    <!-- FINE QUERY DI INSERIMENTO -->





















    <!-- ############################################################################################################################################### -->
    <!-- ############################################################################################################################################### -->
    <!-- ############################################################################################################################################### -->
    <!--  PUNTI VENDITA  -->
    <!-- QUERY DI RACCOLTA DATI DA FORM -->
    <h2>Inserimento di una nuova filiale (Punto Vendita)</h2>
    <!-- Con questo form vado a prendere in input dall'utente: CodPV, Indirizzo, Telefono, Citta, DataInizio, Nazione per poi elaborare il tutto successivamente -->
    <div class="d-flex justify-content-center">
        <fieldset>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>#formInserisciPuntiVendita" id="formInserisciPuntiVendita" class="formOperazioniDML">
                <!-- $ _SERVER [ 'PHP_SELF'] è una variabile d'ambiente supportata da tutte le piattaforme che indica il nome del file su cui è attualmente in esecuzione lo script PHP rispetto alla root del Web server.
                                                                                                  In pratica si tratta del nome della pagina corrente; lo puoi utilizzare quando il codice che processa i dati del form si trova nella stessa pagina in cui si trova il form -->
                <div class="form-group">

                    <p>
                        <label for="Indirizzo">Indirizzo del nuovo Punto Vendita:&nbsp;</label>
                        <input type="text" name="Indirizzo" id="inputInserisciIndirizzo_PuntiVendita" onchange="hideDiv('divInserisciIndirizzo_PuntiVendita',this); showDiv('divInserisciIndirizzo_PuntiVendita',this)"></input>
                    </p>


                    <p>
                        <label for="Telefono">Telefono del nuovo Punto Vendita:&nbsp;</label>
                        <input type="text" name="Telefono" id="inputInserisciTelefono_PuntiVendita" onchange="hideDiv('divInserisciTelefono_PuntiVendita',this); showDiv('divInserisciTelefono_PuntiVendita',this)"></input>
                    </p>

                    <p>
                        <label for="Citta">Città del nuovo Punto Vendita:&nbsp;</label>
                        <input type="text" name="Citta" id="inputInserisciCitta_PuntiVendita" onchange="hideDiv('divInserisciCitta_PuntiVendita',this); showDiv('divInserisciCitta_PuntiVendita',this)"></input>
                    </p>

                    <p>
                        <label for="DataInizio">Data di inizio attività:&nbsp;</label>
                        <input type="date" name="DataInizio" id="inputInserisciDataInizio_PuntiVendita" onchange="hideDiv('divInserisciDataInizio_PuntiVendita',this); showDiv('divInserisciDataInizio_PuntiVendita',this)"></input>
                    </p>

                    <p>
                        <label for="Nazione">Nazione del nuovo Punto Vendita:&nbsp;</label>
                        <input type="text" name="Nazione" id="inputInserisciNazione_PuntiVendita" onchange="hideDiv('divInserisciNazione_PuntiVendita',this); showDiv('divInserisciNazione_PuntiVendita',this)"> </input>
                    </p>

                    <br>
                    <input type="submit" name="InserisciPV" value="Inserisci" />
                    <input type="reset" name="AnnullaPV" value="Annulla" />
                </div>
            </form>
        </fieldset>
    </div>
    <!-- FINE QUERY DI RACCOLTA DATI DA FORM -->

    <!-- QUERY DI INSERIMENTO -->
    <?php
    // Variabili che mi servono
    $Indirizzo = null;
    $Telefono = null;
    $Citta = null;
    $DataInizio = null;
    $Nazione = null;

    if (isset($_POST['InserisciPV'])) // isset — Determine if a variable is declared and is different than null
    {
        // Controllo indirizzo
        if (isset($_POST['InserisciPV']) && isset($_POST["Indirizzo"]) && !empty($_POST["Indirizzo"])) {
            $Indirizzo = $_POST["Indirizzo"];
        } else {
    ?>
            <div class="container divMessaggio" id="divInserisciIndirizzo_PuntiVendita">
                <div class="alert alert-warning alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
                    <strong>Attenzione!</strong> Devi inserire l'indirizzo
                </div>
            </div>
            <!-- <p class="text-warning">Devi inserire l'indirizzo</p> -->
        <?php
        }


        // Controllo telefono
        if (isset($_POST['InserisciPV']) && isset($_POST["Telefono"]) && !empty($_POST["Telefono"])) {
            $Telefono = $_POST["Telefono"];
        } else {
        ?>
            <div class="container divMessaggio" id="divInserisciTelefono_PuntiVendita">
                <div class="alert alert-warning alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
                    <strong>Attenzione!</strong> Devi inserire il telefono
                </div>
            </div>
            <!-- <p class="text-warning">Devi inserire il numero di telefono</p> -->
        <?php
        }

        // Controllo Citta
        if (isset($_POST['InserisciPV']) && isset($_POST["Citta"]) && !empty($_POST["Citta"])) {
            $Citta = $_POST["Citta"];
        } else {
        ?>
            <div class="container divMessaggio" id="divInserisciCitta_PuntiVendita">
                <div class="alert alert-warning alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
                    <strong>Attenzione!</strong> Devi inserire la citt&agrave;
                </div>
            </div>
            <!-- <p class="text-warning">Devi inserire la citt&agrave;</p> -->
        <?php
        }


        // Controllo DataInizio
        if (isset($_POST['InserisciPV']) && isset($_POST["DataInizio"]) && !empty($_POST["DataInizio"])) {
            $DataInizio = $_POST["DataInizio"];
        } else {
        ?>
            <div class="container divMessaggio" id="divInserisciDataInizio_PuntiVendita">
                <div class="alert alert-warning alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
                    <strong>Attenzione!</strong> Devi inserire la data di inizio attivit&agrave;
                </div>
            </div>
            <!-- <p class="text-warning">Devi inserire data di inizio attività</p> -->
        <?php
        }


        // Controllo Nazione
        if (isset($_POST['InserisciPV']) && isset($_POST["Nazione"]) && !empty($_POST["Nazione"])) {
            $Nazione = $_POST["Nazione"];
        } else {
        ?>
            <div class="container divMessaggio" id="divInserisciNazione_PuntiVendita">
                <div class="alert alert-warning alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
                    <strong>Attenzione!</strong> Devi inserire la nazione
                </div>
            </div>
            <!-- <p class="text-warning">Devi inserire la nazione</p> -->
            <?php
        }

        // COMANDO SQL 
        if (($Indirizzo != null) && ($Telefono != null) && ($Citta != null) && ($DataInizio != null) && ($Nazione != null)) {
            // Ci metto solo i campi che mi interessano
            $strSQL = "INSERT INTO puntivendita (Indirizzo, Telefono, Citta, DataInizio, Nazione) VALUES ('$Indirizzo','$Telefono','$Citta','$DataInizio','$Nazione')";
            $risultato = mysqli_query($conn, $strSQL);
            // Controllo del corretto inserimento
            if ($risultato) {
            ?>
                <div class="container divMessaggio">
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Punto vendita inserito correttamente</strong>
                    </div>
                </div>
                <!-- <p class=text-success>Punto vendita inserito correttamente</p> -->
            <?php
            } else {
            ?>
                <div class="container divMessaggio">
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Errore nell'inserimento del punto vendita</strong>
                    </div>
                </div>
                <!-- <p class=text-danger>Errore nell'inserimento del punto vendita</p>; -->
        <?php
                echo $conn->error;
            }
        } // fine if comando sql
    } // chiusura if(isset) bottone principale
    else {
        ?>
        <div class="container divMessaggio">
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Attenzione! </strong>Compila tutti i campi.
            </div>
        </div>
        <!-- <p class="text-warning">Inserire i vari campi della tabella Punti Vendita</p> -->
    <?php
    }

    ?>
    <!-- FINE QUERY DI INSERIMENTO -->
















    <!-- ############################################################################################################################################### -->
    <!-- ############################################################################################################################################### -->
    <!-- ############################################################################################################################################### -->
    <!--  DIPENDENTI   -->
    <!-- QUERY DI RACCOLTA DATI DA FORM -->
    <h2>Inserimento di un nuovo dipendente</h2>
    <!-- Con questo form vado a prendere in input dall'utente: Matricola, Cognome, Nome, CodiceFiscale, Qualifica, PuntoVendita dalla tabella dipendenti, per poi elaborare il tutto successivamente -->
    <div class="d-flex justify-content-center">
        <fieldset>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>#formInserisciDipendenti" id="formInserisciDipendenti" class="formOperazioniDML">
                <!-- $ _SERVER [ 'PHP_SELF'] è una variabile d'ambiente supportata da tutte le piattaforme che indica il nome del file su cui è attualmente in esecuzione lo script PHP rispetto alla root del Web server.
                                                                                                         In pratica si tratta del nome della pagina corrente; lo puoi utilizzare quando il codice che processa i dati del form si trova nella stessa pagina in cui si trova il form -->
                <div class="form-group">
                    <p>
                        <label for="Matricola">Matricola:&nbsp; </label>
                        <input type="text" name="Matricola" id="inputInserisciMatricolaDipendenti" onchange="hideDiv('divInserisciMatricola_Dipendenti',this); showDiv('divInserisciMatricola_Dipendenti',this)"></input>
                    </p>

                    <p>
                        <label for="Cognome">Cognome:&nbsp; </label>
                        <input type="text" name="Cognome" id="inputInserisciCognomeDipendenti" onchange="hideDiv('divInserisciCognome_Dipendenti',this); showDiv('divInserisciCognome_Dipendenti',this)"></input>
                    </p>


                    <p>
                        <label for="Nome">Nome:&nbsp; </label>
                        <input type="text" name="Nome" id="inputInserisciNomeDipendenti" onchange="hideDiv('divInserisciNome_Dipendenti',this); showDiv('divInserisciNome_Dipendenti',this)"></input>
                    </p>

                    <p>
                        <label for="CodiceFiscale">Codice Fiscale:&nbsp; </label>
                        <input type="text" name="CodiceFiscale" id="inputInserisciCodiceFiscaleDipendenti" onchange="hideDiv('divInserisciCodiceFiscale_Dipendenti',this); showDiv('divInserisciCodiceFiuscale_Dipendenti',this)"></input>
                    </p>

                    <p>
                        <label for="Qualifica">Qualifica:&nbsp; </label>
                        <input type="text" name="Qualifica" id="inputInserisciQualificaDipendenti" onchange="hideDiv('divInserisciQualifica_Dipendenti',this); showDiv('divInserisciQualifica_Dipendenti',this)"></input>
                    </p>

                    <!-- SELEZIONO IL PUNTO VENDITA DI INTERESSE (in ordine) -->
                    <p>
                        <label for="PuntoVendita">Punto vendita di interesse:&nbsp; </label>
                        <select name="PuntoVendita" id="selectInserisciPuntoVenditaDipendenti" onchange="hideDiv('divInserisciPuntoVendita_Dipendenti',this); showDiv('divInserisciPuntoVendita_Dipendenti',this)">
                            <option>---</option>
                            <?php
                            // Comando SQL. ( <strong>Ricorda</strong>: il .= è stato deprecato )
                            $strSQL = "SELECT DISTINCT CodPV FROM puntivendita ORDER BY CodPV;"; // Raccolgo il codice del punto vendita dalla tabella puntivendita
                            $risultato = mysqli_query($conn, $strSQL);
                            while ($riga = mysqli_fetch_array($risultato)) {
                                echo "<option value=\"" . $riga["CodPV"] . "\">" . $riga["CodPV"] . "</option> \n";
                            }
                            ?>
                        </select>
                    </p>


                    <input type="submit" name="InserisciDipendente" value="Inserisci" />
                    <input type="reset" name="Annulla" value="Annulla" />
                </div>
            </form>
        </fieldset>
    </div>
    <!-- FINE QUERY DI RACCOLTA DATI DA FORM -->

    <!-- QUERY DI INSERIMENTO -->
    <?php

    // Variabili che mi servono
    $Matricola = null;
    $Cognome =  null;
    $Nome =  null;
    $CodiceFiscale =  null;
    $Qualifica = null;
    $PuntoVendita =  null;
    // NON POSSO INSERIRE UN DIPENDENTE SENZA PRIMA AVER INSERITO UN PUNTO VENDITA
    if (isset($_POST['InserisciDipendente']) && isset($_POST["PuntoVendita"])) // isset — Determine if a variable is declared and is different than null
    {
        // Controllo la matricola
        if (isset($_POST['InserisciDipendente']) && isset($_POST["Matricola"]) && !empty($_POST["Matricola"])) {
            // La matricola deve essere lunga al massimo 6 caratteri
            if (strlen($_POST["Matricola"]) <= 6) {
                // Se è lunga al massimo 6 caratteri, allora:
                // Se per sbaglio inserisco la stessa matricola:
                // Seleziono tutte le matricole con una query 
                $temp_strSQL = "SELECT DISTINCT Matricola from dipendenti";
                $temp_risultato = mysqli_query($conn, $temp_strSQL);
                // Trasformo il risultato in un array associativo di righe
                $matricoleGiaInserite = array(); // (sarà un array bidimensionale) 
                while ($riga = mysqli_fetch_array($temp_risultato)) {
                    $matricoleGiaInserite[] = $riga;
                    // lo stampo a video
                    // print_r($matricoleGiaInserite);
                    // echo "<br>";
                }
                // Ricerco se per caso ci sono dei duplicati
                $numMatricole = count($matricoleGiaInserite);
                for ($i = 0; $i < $numMatricole; $i++) {

                    // Se la nuova matricola corrisponde alla matricola i-esima
                    if (strcmp($_POST["Matricola"], $matricoleGiaInserite[$i][0]) == 0) {
                        $_POST["Matricola"] = null;
    ?>
                        <div class="container divMessaggio">
                            <div class="alert alert-warning alert-dismissible">
                                <!-- style="display:inline-block;" -->
                                <strong>Attenzione! </strong>La matricola &egrave; gi&agrave; stata inserita!
                                <br>
                                Inseriscine un'altra
                            </div>
                        </div>
                <?php
                    } // fine if controllo uguaglianza matricole
                    else {
                        // Altrimenti: matricola lunga 6 caratteri, non uguale a nessun altra
                        $Matricola = $_POST["Matricola"];
                        continue; // altrimenti, passa alla prossima 
                    }
                } // fine for controllo esistenza matricola
            } // fine if controllo lunghezza matricola (6 caratteri)
            else {
                ?>
                <div class="container divMessaggio">
                    <div class="alert alert-warning alert-dismissible">
                        <!-- style="display:inline-block;" -->
                        <strong>Attenzione! </strong>La matricola deve essere lunga al massimo 6 caratteri
                    </div>
                </div>
                <!-- <p class="text-warning"></p> -->
            <?php
            }
        } else {
            ?>
            <div class="container divMessaggio" id="divInserisciMatricola_Dipendenti">
                <div class="alert alert-warning alert-dismissible">
                    <!-- style="display:inline-block;" -->
                    <strong>Attenzione! </strong>Devi inserire la matricola del dipendente
                </div>
            </div>
            <!-- <p class="text-warning"></p> -->
        <?php
        }

        // Controllo il cognome
        if (isset($_POST['InserisciDipendente']) && isset($_POST["Cognome"]) && !empty($_POST["Cognome"])) {
            $Cognome = $_POST["Cognome"];
        } else {
        ?>
            <div class="container divMessaggio" id="divInserisciCognome_Dipendenti">
                <div class="alert alert-warning alert-dismissible">
                    <!-- style="display:inline-block;" -->
                    <strong>Attenzione! </strong>Devi inserire il cognome del dipendente
                </div>
            </div>
            <!-- <p class="text-warning">Devi inserire il cognome del dipendente</p> -->
        <?php
        }


        // Controllo il nome
        if (isset($_POST['InserisciDipendente']) && isset($_POST["Nome"]) && !empty($_POST["Nome"])) {
            $Nome = $_POST["Nome"];
        } else {
        ?>
            <div class="container divMessaggio" id="divInserisciNome_Dipendenti">
                <div class="alert alert-warning alert-dismissible">
                    <!-- style="display:inline-block;" -->
                    <strong>Attenzione! </strong>Devi inserire il nome del dipendente
                </div>
            </div>
            <!-- <p class="text-warning">Devi inserire il nome del dipendente</p> -->
        <?php
        }


        // Controllo il codice fiscale
        if (isset($_POST['InserisciDipendente']) && isset($_POST["CodiceFiscale"]) && !empty($_POST["CodiceFiscale"])) {
            $CodiceFiscale = $_POST["CodiceFiscale"];
        } else {
        ?>
            <div class="container divMessaggio" id="divInserisciCodiceFiscale_Dipendenti">
                <div class="alert alert-warning alert-dismissible">
                    <!-- style="display:inline-block;" -->
                    <strong>Attenzione! </strong>Devi inserire il codice fiscale del dipendente
                </div>
            </div>
            <!-- <p class="text-warning">Devi inserire il codice fiscale del dipendente</p> -->
        <?php
        }


        // Controllo la qualifica
        if (isset($_POST['InserisciDipendente']) && isset($_POST["Qualifica"]) && !empty($_POST["Qualifica"])) {
            $Qualifica = $_POST["Qualifica"];
        } else {
        ?>
            <div class="container divMessaggio" id="divInserisciQualifica_Dipendenti">
                <div class="alert alert-warning alert-dismissible">
                    <!-- style="display:inline-block;" -->
                    <strong>Attenzione! </strong>Devi inserire la qualifica del dipendente
                </div>
            </div>
            <!-- <p class="text-warning">Devi inserire la qualifica del dipendente</p> -->
        <?php
        }


        // Controllo il punto vendita
        if (isset($_POST['InserisciDipendente']) && isset($_POST["PuntoVendita"]) && !empty($_POST["PuntoVendita"]) && (strcmp($_POST["PuntoVendita"], $stringaControllo) != 0)) {
            $PuntoVendita = $_POST["PuntoVendita"];
        } else {
        ?>
            <div class="container divMessaggio" id="divInserisciPuntoVendita_Dipendenti">
                <div class="alert alert-warning alert-dismissible">
                    <!-- style="display:inline-block;" -->
                    <strong>Attenzione! </strong>Devi inserire il punto vendita in cui lavora il dipendente
                </div>
            </div>
            <!-- <p class="text-warning">Devi inserire il punto vendita in cui lavora il dipendente</p> -->
            <?php
        }


        // COMANDO SQL  !! Per le stringhe devo usare gli apici !!
        if (($Matricola != null)  && ($Cognome != null) && ($Nome != null) && ($CodiceFiscale != null) && ($Qualifica != null) && ($PuntoVendita != null)) {
            // Ci metto solo i campi che mi interessano (escludo gli auto-increment)
            $strSQL = "INSERT INTO dipendenti (Matricola, Cognome, Nome, CodiceFiscale, Qualifica, PuntoVendita) VALUES ('$Matricola','$Cognome','$Nome','$CodiceFiscale', '$Qualifica', '$PuntoVendita')";
            $risultato = mysqli_query($conn, $strSQL);

            // Controllo del corretto inserimento
            if ($risultato) {
            ?>
                <div class="container divMessaggio">
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <!-- style="display:inline-block;" -->
                        <strong>Dipendente inserito correttamente </strong>
                    </div>
                </div>
                <!-- <p class=text-success>Dipendente inserito correttamente</p> -->
            <?php

            } else {
            ?>
                <div class="container divMessaggio">
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <!-- style="display:inline-block;" -->
                        <strong>Errore nell'inserimento del dipendente</strong>
                    </div>
                </div>

                <!-- <p class=text-danger>Errore nell'inserimento del dipendente</p> -->
        <?php
                echo $conn->error;
            }
        } // fine if comando sql
        ?>

        <!-- Alla fine di tutto, quando lavoro col PHP devo sempre chiudere eventuali parentesi graffe aperte in precedeza -->
    <?php
    } // chiusura if(isset)
    else {
    ?>
        <div class="container divMessaggio">
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <!-- style="display:inline-block;" -->
                <strong>Attenzione! </strong>Compila tutti i campi..
                <br>
                <strong>Ricorda</strong>: prima di inserire un dipendente deve esistere almeno un punto vendita.
            </div>
        </div>
        <!-- <p class="text-warning">Devi prima inserire tutti i campi e, soprattutto, almeno un punto vendita!!</p> -->
    <?php
    } //  chiusura else (isset)
    ?>
    <!-- FINE QUERY DI INSERIMENTO -->
















    <!-- ############################################################################################################################################### -->
    <!-- ############################################################################################################################################### -->
    <!-- ############################################################################################################################################### -->
    <!--  VENDITE  -->
    <!-- QUERY DI RACCOLTA DATI DA FORM -->
    <h2>Registrazione di una nuova vendita</h2>
    <!-- Con questo form vado a prendere in input dall'utente il codice del modello e la taglia, per poi elaborare il tutto successivamente -->
    <div class="d-flex justify-content-center">
        <fieldset>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>#formInserisciVendite" id="formInserisciVendite" class="formOperazioniDML">
                <!-- $ _SERVER [ 'PHP_SELF'] è una variabile d'ambiente supportata da tutte le piattaforme che indica il nome del file su cui è attualmente in esecuzione lo script PHP rispetto alla root del Web server.
                                                                                                         In pratica si tratta del nome della pagina corrente; lo puoi utilizzare quando il codice che processa i dati del form si trova nella stessa pagina in cui si trova il form -->
                <div class="form-group">

                    <p>
                        <label for="DataVendita">Data di vendita:&nbsp; </label>
                        <input type="date" name="DataVendita" id="inputInserisciDataVenditaVendite" onchange="hideDiv('divInserisciDataVendita_Vendite',this); showDiv('divInserisciDataVendita_Vendite',this)" />
                    </p>
                    <p>
                        <label for="Prezzo Vendita">Prezzo di vendita:&nbsp; </label>
                        <input type="number" step="0.01" name="PrezzoVendita" id="inputInserisciPrezzoVenditaVendite" onchange="hideDiv('divInserisciPrezzoVendita_Vendite',this); showDiv('divInserisciPrezzoVendita_Vendite',this)"></input>
                    </p>

                    <!-- SELEZIONO LA MATRICOLA DA INSERIRE (in ordine) -->
                    <p>
                        <label for="Matricola">Matricola agente di vendita:&nbsp; </label>
                        <select name="Matricola" id="selectInserisciMatricolaVendite" onchange="hideDiv('divInserisciMatricola_Vendite',this); showDiv('divInserisciMatricola_Vendite',this)">
                            <option>---</option>
                            <?php
                            // Comando SQL. ( <strong>Ricorda</strong>: il .= è stato deprecato )
                            $strSQL = "SELECT DISTINCT Matricola FROM dipendenti ORDER BY Matricola;"; // Raccolgo la matricola del capo dalla tabella dipendenti
                            $risultato = mysqli_query($conn, $strSQL);
                            while ($riga = mysqli_fetch_array($risultato)) {
                                echo "<option value=\"" . $riga["Matricola"] . "\">" . $riga["Matricola"] . "</option> \n";
                            }
                            ?>
                        </select>
                    </p>

                    <!-- SELEZIONO ID DEL CAPO DA INSERIRE (in ordine) -->
                    <p>
                        <label for="IDCapo">ID capo:&nbsp;</label>
                        <select name="IdCapo" id="selectInserisciIDCapoVendite" onchange="hideDiv('divInserisciIDCapo_Vendite',this); showDiv('divInserisciIDCapo_Vendite',this)">
                            <option>---</option>
                            <?php
                            // Comando SQL. ( <strong>Ricorda</strong>: il .= è stato deprecato )
                            $strSQL = "SELECT DISTINCT ID FROM capi ORDER BY ID;"; // Raccolgo gli ID dei capi dalla tabella capi
                            $risultato = mysqli_query($conn, $strSQL);
                            while ($riga = mysqli_fetch_array($risultato)) {
                                echo "<option value=\"" . $riga["ID"] . "\">" . $riga["ID"] . "</option> \n";
                            }
                            ?>
                        </select>
                    </p>
                    <!-- <p>
                   
                    <input type="text" name="IdCapo"></input>
                </p> -->

                    <input type="submit" name="Registra" value="Registra" />
                    <input type="reset" name="Annulla" value="Annulla" />
                </div>
            </form>
        </fieldset>
    </div>
    <!-- FINE QUERY DI RACCOLTA DATI DA FORM -->

    <!-- QUERY DI INSERIMENTO -->
    <?php
    // NON POSSO REGISTRARE UNA VENDITA SENZA PRIMA CONOSCERE LA MATRICOLA DELL'AGENTE DI VENDITA E L'ID DEL CAPO DA VENDERE
    // NON POSSO VENDERE QUALCOSA CHE NON HO ANCORA CREATO ^____^. chi vende cosa?

    // Variabili che mi servono
    // Acquisisco Prezzo di vendita, Matricola agente di vendita e Id capo dal form HTML e me li salvo in queste due variabili
    $PrezzoVendita = null;
    $Matricola = null;
    $IdCapo = null;
    $DataVendita = null;
    if ((isset($_POST['Registra'])) && (isset($_POST['Matricola'])) && (isset($_POST['IdCapo']))) // isset — Determine if a variable is declared and is different than null
    {

        // $DataVendita = date('Y')."-".date('m')."-".date('d'); // Provo a raccogliere la data di oggi (DA ERRORE)
        //$DataVendita = date('d-m-Y');

        // Controllo prezzo di vendita
        if ((isset($_POST['Registra'])) && (isset($_POST["PrezzoVendita"])) && (!empty($_POST["PrezzoVendita"]))) {
            $PrezzoVendita = $_POST["PrezzoVendita"];
        } else {
    ?>
            <div class="container divMessaggio" id="divInserisciPrezzoVendita_Vendite">
                <div class="alert alert-warning alert-dismissible">
                    <!-- style="display:inline-block;" -->
                    <strong>Attenzione! </strong>Devi inserire il prezzo di vendita
                </div>
            </div>

            <!-- <p class="text-warning">Devi inserire il prezzo di vendita</p> -->
        <?php
        }


        // Controllo matricola
        if ((isset($_POST['Registra'])) && (isset($_POST["Matricola"])) && (!empty($_POST["Matricola"])) && (strcmp($_POST["Matricola"], $stringaControllo) != 0)) {
            $Matricola = $_POST["Matricola"];
        } else {
        ?>
            <div class="container divMessaggio" id="divInserisciMatricola_Vendite">
                <div class="alert alert-warning alert-dismissible">
                    <!-- style="display:inline-block;" -->
                    <strong>Attenzione! </strong>Devi inserire la matricola del dipendente (agente di vendita)
                </div>
            </div>
            <!-- <p class="text-warning">Devi inserire la matricola dell'agente di vendita</p> -->
            <!-- nella select matricola dell'agente che vende, potrei farmi una query in cui vado a prendermi solo i dipendenti la cui qualifica è 'venditore' -->
        <?php
        }


        // Controllo IdCapo
        if ((isset($_POST['Registra'])) && (isset($_POST["IdCapo"])) && (!empty($_POST["IdCapo"])) && (strcmp($_POST["IdCapo"], $stringaControllo) != 0)) {
            $IdCapo = $_POST["IdCapo"];
        } else {
        ?>
            <div class="container divMessaggio" id="divInserisciIDCapo_Vendite">
                <div class="alert alert-warning alert-dismissible">
                    <!-- style="display:inline-block;" -->
                    <strong>Attenzione! </strong>Devi inserire l'ID del capo che si vuole vendere
                </div>
            </div>
            <!-- <p class="text-warning">Devi inserire </p> -->
        <?php
        }

        // Controllo data di vendita
        if ((isset($_POST['Registra'])) && (isset($_POST["DataVendita"])) && (!empty($_POST["DataVendita"]))) {
            $DataVendita = $_POST["DataVendita"];
        } else {
        ?>
            <div class="container divMessaggio" id="divInserisciDataVendita_Vendite">
                <div class="alert alert-warning alert-dismissible">
                    <!-- style="display:inline-block;" -->
                    <strong>Attenzione! </strong>Devi inserire la data di vendita
                </div>
            </div>
            <!-- <p class="text-warning">Devi inserire la data di vendita</p> -->
            <?php
        }

        if (($PrezzoVendita != null) && ($Matricola != null) && ($IdCapo != null) && ($DataVendita != null)) {   // Comando SQL  !! Per le stringhe devo usare gli apici !!
            // Ci metto solo i campi che mi interessano
            $strSQL = "INSERT INTO vendite (DataVendita, PrezzoVendita, Matricola, IDCapo) VALUES ('$DataVendita','$PrezzoVendita','$Matricola','$IdCapo')";
            $risultato = mysqli_query($conn, $strSQL);
            // Controllo del corretto inserimento
            if ($risultato) {
            ?>
                <div class="container divMessaggio">
                    <div class="alert alert-success alert-dismissible">
                        <!-- style="display:inline-block;" -->
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Vendita registrata correttamente</strong>
                    </div>
                </div>
                <!-- <p class=text-success>Vendita registrata correttamente</p> -->
            <?php
            } else {
            ?>
                <div class="container divMessaggio">
                    <div class="alert alert-danger alert-dismissible">
                        <!-- style="display:inline-block;" -->
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Errore nell'inserimento della vendita</strong>
                    </div>
                </div>
                <!-- <p class=text-danger>Errore nell'inserimento della vendita</p> -->
        <?php
                echo $conn->error;
            }
        } // fine if comando SQL
        ?>

        <!-- Alla fine di tutto, quando lavoro col PHP devo sempre chiudere eventuali parentesi graffe aperte in precedeza -->
    <?php
    } // chiusura if(isset)
    else {
    ?>
        <div class="container divMessaggio">
            <div class="alert alert-warning alert-dismissible">
                <!-- style="display:inline-block;" -->
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Attenzione! </strong>Compila tutti i campi..
                <br>
                <strong>Ricorda</strong>: devi prima inserire almeno un dipendente ed un capo d'abbigliamento.
            </div>
        </div>
        <!-- <p class="text-warning">Devi prima inserire almeno un dipendente ed un capo d'abbigliamento</p> -->
    <?php
    } // fine else (isset)
    ?>
    <!-- FINE QUERY DI INSERIMENTO -->

    <?php
    footer(); // Richiamo la funzione per il piè di pagina
    ?>
    <!-- Chiusura della connessione al DataBase -->
    <?php
    mysqli_close($conn); //Make sure to close out the database connection
    ?>


</body>

</html>


<!-- Uso codice Javascript e JQuery nel documento corrente -->
<script>
    $("h2").css("font-weight", "bold");
    $("h2").css("text-align", "center");
    $("h2").css("margin-top", "25px");
    $("h2").css("margin-bottom", "5px");
    $("p").css("text-align", "center");
    $("p.testoOmbreggiato").css("text-shadow", "2px 2px 5px white");
    $("fieldset").css("align", "center");
</script>


<!-- <strong>Ricorda</strong>: Il name deve essere indipendente per ogni oggetto (anche per ogni bottone, altrimenti ne premo uno ed è come se ne premessi tantissimi - tutti quelli che hanno quel name-) -->

<!-- Se tutti i dati sono inseriti in un form, allora togli la scritta in text-warning -->
<script>
    /*
    function nascondiDivWarning(ID_divDaNascondere, ID_inputDaControllare) {
        // Ottengo il valore dell'input
        input = document.getElementById(ID_inputDaControllare).val();

        if (input != "" || input != "---" || input != null) {
            // Il campo non è vuoto, dunque nascondi il div
            $("#ID_divDaNascondere").hide();
            console.log("Sono dentro il ramo vero")
        } else {
            console.log("Sono dentro il ramo falso");
            $("#ID_divDaNascondere").show();
        }
    }
    */

    function hideDiv(divID, input) {
        // Voglio nascondere il div di interesse quando l'input risulta pieno
        // Se input != stringa vuota oppure input != "---" oppure input != null
        if (input.value != "" || input.value != "---" || input.value != null) {
            document.getElementById(divID).style.display = 'none';
        } else {
            document.getElementById(divID).style.display = 'block';
        }
    }

    function showDiv(divID, input) {
        // Voglio mostrare il div di interesse quando l'input risulta vuoto
        // Se input != stringa vuota oppure input != "---" oppure input != null
        if (input.value == "" || input.value == "---" || input.value == null) {
            document.getElementById(divID).style.display = 'block';
        } else {
            document.getElementById(divID).style.display = 'none';
        }
    }
</script>
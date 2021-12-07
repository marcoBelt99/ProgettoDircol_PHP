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
    <title>AGGIORNAMENTO</title>


</head>

<body>

    <!-- Inizio istruzioni vere e proprie -->

    <?php
    navbar(); // Richiamo la funzione navbar
    ?>
















    <!-- ############################################################################################################################################### -->
    <!-- ############################################################################################################################################### -->
    <!-- ############################################################################################################################################### -->
    <!-- CAPI -->
    <!-- QUERY DI RACCOLTA DATI DA FORM -->
    <h2>Aggiornamento di un capo</h2>
    <!-- Con questo form vado a prendere in input dall'utente: Taglia, Colore, PuntoVendita, Modello, per poi elaborare il tutto successivamente -->
    <div class="d-flex justify-content-center">
        <fieldset>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>#formAggiornaCapi" id="formAggiornaCapi" class="formOperazioniDML">
                <!-- $ _SERVER [ 'PHP_SELF'] è una variabile d'ambiente supportata da tutte le piattaforme che indica il nome del file su cui è attualmente in esecuzione lo script PHP rispetto alla root del Web server.
                                                                                                  In pratica si tratta del nome della pagina corrente; lo puoi utilizzare quando il codice che processa i dati del form si trova nella stessa pagina in cui si trova il form -->
                <div class="form-group">

                    <!-- SELEZIONO L'ID DEL CAPO DI INTERESSE per poi fare l'aggiornamento -->
                    <p>
                        <label for="ID">ID del capo da modificare:&nbsp;</label>
                        <select name="ID" id="ID_Capi" onchange="hideDiv('divAggiornaID_Capi',this); showDiv('divAggiornaID_Capi',this)">
                            <option>---</option>
                            <?php
                            // Comando SQL. ( Ricorda: il .= è stato deprecato )
                            $strSQL = "SELECT DISTINCT ID FROM capi ORDER BY ID;"; // Raccolgo CodModello dalla tabella modelli
                            $risultato = mysqli_query($conn, $strSQL);
                            while ($riga = mysqli_fetch_array($risultato)) {
                                echo "<option value=\"" . $riga["ID"] . "\">" . $riga["ID"] . "</option> \n";
                            }
                            ?>
                        </select>
                    </p>

                    <!-- SELEZIONO UNA TAGLIA -->
                    <p>
                        <label for="Taglia">Seleziona una taglia:&nbsp; </label>
                        <select name="Taglia" id="Taglia_Capi" onchange="hideDiv('divAggiornaTaglia_Capi',this); showDiv('divAggiornaTaglia_Capi',this)">
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
                        <label for="Colore">Colore:&nbsp;</label>
                        <input type="color" name="Colore" id="Colore_Capi" onchange="hideDiv('divAggiornaColore_Capi',this); showDiv('divAggiornaColore_Capi',this)"></input>
                    </p>

                    <!-- SELEZIONO IL PUNTO VENDITA DI INTERESSE (in ordine) -->
                    <p>
                        <label for="CodPV">Punto vendita di interesse:&nbsp; </label>
                        <select name="CodPV" id="CodPV_Capi" onchange="hideDiv('divAggiornaPuntoVendita_Capi',this); showDiv('divAggiornaPuntoVendita_Capi',this)">
                            <option>---</option>
                            <?php
                            // Comando SQL. ( Ricorda: il .= è stato deprecato )
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
                        <label for="CodModello">Codice modello del capo:&nbsp; </label>
                        <select name="CodModello" id="CodModello_Capi" onchange="hideDiv('divAggiornaModello_Capi',this); showDiv('divAggiornaModello_Capi',this)">
                            <option>---</option>
                            <?php
                            // Comando SQL. ( Ricorda: il .= è stato deprecato )
                            $strSQL = "SELECT DISTINCT CodModello FROM modelli ORDER BY CodModello;"; // Raccolgo il codice del modello dalla tabella modelli
                            $risultato = mysqli_query($conn, $strSQL);
                            while ($riga = mysqli_fetch_array($risultato)) {
                                echo "<option value=\"" . $riga["CodModello"] . "\">" . $riga["CodModello"] . "</option> \n";
                            }
                            ?>
                        </select>
                    </p>

                    <br>
                    <input type="submit" name="AggiornaCapo" value="Aggiorna" id="elementoModello" />
                    <input type="reset" name="Annulla" value="Annulla" id="elementoModello" />
                </div>
            </form>
        </fieldset>
    </div>
    <!-- FINE QUERY DI RACCOLTA DATI DA FORM -->

    <!-- QUERY DI AGGIORNAMENTO -->
    <?php
    // PER AGGIORNARE UN CAPO, DEVO ASSICURARMI DI AVERE PRIMA INSERITO ALMENO UN PUNTO VENDITA ED ALMENO UN MODELLO !
    $ID = null;
    $Taglia = null;
    $Colore = null;
    $PuntoVendita = null;
    $Modello = null;

    if (isset($_POST['AggiornaCapo']) && isset($_POST["CodPV"]) && isset($_POST["CodModello"])) // isset — Determine if a variable is declared and is different than null
    {

        /**  */
        // Controllo di aver immesso l'id
        if (isset($_POST["ID"]) && !empty($_POST["ID"]) && (strcmp($_POST["ID"], $stringaControllo) != 0)) {
            /* isset($_POST["AggiornaCapo"]) && */
            $ID = $_POST["ID"];
        } else {
    ?>
            <div class="container divMessaggio" id="divAggiornaID_Capi">
                <!-- "d-flex justify-content-center" -->
                <div class="alert alert-warning alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  -->
                    <strong>Attenzione! </strong> Devi inserire l'ID di un capo.
                </div>
            </div>

            <!-- <p class="text-warning">Devi immettere l'id del capo</p> -->
        <?php
            // if ($_POST["ID"] == null) {
            //     echo "ID capo null";
            // }
        }

        // Controllo di aver immesso la taglia
        if (isset($_POST['AggiornaCapo']) && isset($_POST["Taglia"])  && !empty($_POST["Taglia"]) && (strcmp($_POST["Taglia"], $stringaControllo) != 0)) {
            $Taglia = $_POST["Taglia"];
        } else {
        ?>
            <div class="container divMessaggio" id="divAggiornaTaglia_Capi">
                <!-- "d-flex justify-content-center" -->
                <div class="alert alert-warning alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  -->
                    <strong>Attenzione! </strong> Devi inserire una taglia.
                </div>
            </div>
            <!-- <p class="text-warning testoOmbreggiato">Devi immettere una taglia</p> -->
        <?php

            // if ($_POST["Taglia"] == null) {
            //     echo "Taglia capo null";
            // }
        }

        // Controllo di aver immesso il colore
        if (isset($_POST['AggiornaCapo']) && isset($_POST["Colore"]) && !empty($_POST["Colore"])) {
            $Colore = $_POST["Colore"];
        } else {
        ?>
            <div class="container divMessaggio" id="divAggiornaColore_Capi">
                <!-- "d-flex justify-content-center" -->
                <div class="alert alert-warning alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  -->
                    <strong>Attenzione! </strong> Devi inserire un colore
                </div>
            </div>
            <!-- <p class="text-warning testoOmbreggiato">Devi immettere il colore</p> -->
        <?php
            // if ($_POST["Colore"] == null) {
            //     echo "Colore capo null";
            // }
        }

        // Controllo di aver immesso il punto vendita
        if (isset($_POST['AggiornaCapo']) && isset($_POST["CodPV"]) && !empty($_POST["CodPV"]) && (strcmp($_POST["CodPV"], $stringaControllo) != 0)) {
            /**  */
            $PuntoVendita = $_POST["CodPV"];
        } else {
        ?>
            <div class="container divMessaggio" id="divAggiornaPuntoVendita_Capi">
                <!-- "d-flex justify-content-center" -->
                <div class="alert alert-warning alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  -->
                    <strong>Attenzione! </strong> Devi inserire un punto vendita.
                </div>
            </div>
            <!-- <p class="text-warning testoOmbreggiato">Devi immettere il punto vendita</p> -->
        <?php
            // if ($_POST["CodPV"] == null) {
            //     echo "CodPV capo null";
            // }
        }

        // Controllo di aver immesso il modello
        if (isset($_POST['AggiornaCapo']) && isset($_POST["CodModello"]) && !empty($_POST["CodModello"]) && (strcmp($_POST["CodModello"], $stringaControllo) != 0)) {
            /**  */
            $Modello = $_POST["CodModello"];
        } else {
        ?>
            <div class="container divMessaggio" id="divAggiornaModello_Capi">
                <!-- "d-flex justify-content-center" -->
                <div class="alert alert-warning alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  -->
                    <strong>Attenzione! </strong> Devi inserire un modello per il capo.
                </div>
            </div>
            <!-- <p class="text-warning testoOmbreggiato">Devi immettere il modello del capo</p> -->
            <?php
            // if ($_POST["CodModello"] == null) {
            //     echo "Modello capo null";
            // }
        }


        // Comando SQL  !! Per le stringhe devo usare gli apici !!
        if (($ID != null) && ($Taglia != null) && ($Colore != null) && $PuntoVendita != null && ($Modello != null)) {
            $strSQL = "UPDATE capi 
                SET Taglia = '$Taglia', Colore = '$Colore', PuntoVendita = '$PuntoVendita', CodModello = '$Modello'
                WHERE ID = '$ID'";
            $risultato = mysqli_query($conn, $strSQL);

            // Controllo del corretto inserimento
            if ($risultato) {
            ?>
                <div class="container divMessaggio">
                    <!-- "d-flex justify-content-center" -->
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Capo aggiornato correttamente </strong>
                    </div>
                </div>
                <!-- <p class=text-success></p> -->
            <?php
            } else {
            ?>
                <div class="container divMessaggio">
                    <!-- "d-flex justify-content-center" -->
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Errore nell'aggiornamento del capo </strong>
                    </div>
                </div>
                <!-- <p class=text-danger></p> -->
        <?php
                echo $conn->error;
            }
        } // fine if comando SQL
        // else {
        //     
        ?>
        <!-- <p class="text-danger">Tutti o alcuni valori sono NULL</p> -->
    <?php
        // }
    } // chiusura if(isset) bottone principale
    else {
    ?>
        <div class="container divMessaggio">
            <!-- "d-flex justify-content-center" -->
            <div class="alert alert-warning alert-dismissible">
                <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  -->
                <strong>Attenzione! </strong> Compila tutti i campi.
                <br>
                <strong>Ricorda</strong>: Devi prima inserire almeno un punto vendita ed un modello.
            </div>
        </div>
        <!-- <p class="text-warning"></p> -->
    <?php
    } // chiusura else(isset)
    ?>
    <!-- FINE QUERY DI AGGIORNAMENTO -->






    <br>
    <br>
    <br>







    <!-- ############################################################################################################################################### -->
    <!-- ############################################################################################################################################### -->
    <!-- ############################################################################################################################################### -->
    <!--  MODELLI -->
    <!-- QUERY DI RACCOLTA DATI DA FORM -->
    <h2>Aggiornamento di un modello (di capo d'abbigliamento)</h2>
    <!-- Con questo form vado a prendere in input dall'utente: Nome, Descrizione, PrezzoListino, Genere, Collezione per poi elaborare il tutto successivamente -->
    <div class="d-flex justify-content-center">
        <fieldset>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>#formAggiornaModelli" id="formAggiornaModelli" class="formOperazioniDML">
                <!-- $ _SERVER [ 'PHP_SELF'] è una variabile d'ambiente supportata da tutte le piattaforme che indica il nome del file su cui è attualmente in esecuzione lo script PHP rispetto alla root del Web server.
                                                                                                  In pratica si tratta del nome della pagina corrente; lo puoi utilizzare quando il codice che processa i dati del form si trova nella stessa pagina in cui si trova il form -->
                <div class="form-group">

                    <!-- SELEZIONO IL CODICE DEL MODELLO DI INTERESSE per poi fare l'aggiornamento -->
                    <p>
                        <label for="CodModello">Codice Modello da modificare:&nbsp;</label>
                        <select name="CodModello" id="CodModello_Modelli" onchange="hideDiv('divAggiornaModello_Modelli',this); showDiv('divAggiornaModello_Modelli',this)">
                            <option>---</option>
                            <?php
                            // Comando SQL. ( Ricorda: il .= è stato deprecato )
                            $strSQL = "SELECT DISTINCT CodModello FROM modelli ORDER BY CodModello;"; // Raccolgo CodModello dalla tabella modelli
                            $risultato = mysqli_query($conn, $strSQL);
                            while ($riga = mysqli_fetch_array($risultato)) {
                                echo "<option value=\"" . $riga["CodModello"] . "\">" . $riga["CodModello"] . "</option> \n";
                            }
                            ?>
                        </select>
                    </p>

                    <p>
                        <label for="Nome">Nome del modello:&nbsp;</label>
                        <input type="text" name="Nome" id="Nome_Modelli" onchange="hideDiv('divAggiornaNome_Modelli',this); showDiv('divAggiornaNome_Modelli',this)"></input>
                    </p>


                    <p>
                        <label for="Descrizione">Descrizione del modello:&nbsp;</label>
                        <input type="text" name="Descrizione" id="Descrizione_Modelli" onchange="hideDiv('divAggiornaDescrizione_Modelli',this); showDiv('divAggiornaDescrizione_Modelli',this)"></input>
                    </p>

                    <p>
                        <label for="PrezzoListino">Prezzo di listino:&nbsp;</label>
                        <input type="number" step="0.01" name="PrezzoListino" id="PrezzoListino_Modelli" onchange="hideDiv('divAggiornaPrezzoListino_Modelli',this); showDiv('divAggiornaPrezzoListino_Modelli',this)"></input>
                    </p>

                    <p>
                        <label for="Genere">Genere (M/F):&nbsp;</label>
                        <input type="text" name="Genere" id="Genere_Modelli" onchange="hideDiv('divAggiornaGenere_Modelli',this); showDiv('divAggiornaGenere_Modelli',this)"></input>
                    </p>

                    <p>
                        <label for="Collezione">Collezione:&nbsp;</label>
                        <input type="text" name="Collezione" id="Collezione_Modelli" onchange="hideDiv('divAggiornaCollezione_Modelli',this); showDiv('divAggiornaCollezione_Modelli',this)"></input>
                    </p>

                    <br>
                    <input type="submit" name="AggiornaModello" value="Aggiorna" />
                    <input type="reset" name="Annulla" value="Annulla" />
                </div>
            </form>
        </fieldset>
    </div>
    <!-- FINE QUERY DI RACCOLTA DATI DA FORM -->

    <!-- QUERY DI AGGIORNAMENTO -->
    <?php
    // Dichiaro le variabili che mi servono
    $CodModello = null;
    $Nome = null;
    $Descrizione = null;
    $PrezzoListino = null;
    $Genere = null;
    $Collezione = null;
    if (isset($_POST['AggiornaModello'])) // isset — Determine if a variable is declared and is different than null
    {
        // Controllo di aver inserito il codice del modello
        if (isset($_POST['AggiornaModello']) && isset($_POST["CodModello"]) && !empty($_POST["CodModello"]) && (strcmp($_POST["CodModello"], $stringaControllo) != 0)) {
            $CodModello = $_POST["CodModello"];
        } else {
    ?>
            <div class="container divMessaggio" id="divAggiornaModello_Modelli">
                <!-- "d-flex justify-content-center" -->
                <div class="alert alert-warning alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  -->
                    <strong>Attenzione! </strong> Devi inserire il codice di un modello.
                </div>
            </div>
            <!-- <p class="text-warning">Devi immettere il codice del modello</p> -->
        <?php
            // if ($_POST["CodModello"] == null) {
            //     echo "CodModello Modello NULL";
            // }
        }

        // Controllo di aver immesso il nome
        if (isset($_POST['AggiornaModello']) && isset($_POST["Nome"]) && (!empty($_POST["Nome"]))) {
            $Nome = $_POST["Nome"];
        } else {
        ?>
            <div class="container divMessaggio" id="divAggiornaNome_Modelli">
                <!-- "d-flex justify-content-center" -->
                <div class="alert alert-warning alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  -->
                    <strong>Attenzione! </strong> Devi inserire un nome per il modello.
                </div>
            </div>
            <!-- <p class="text-warning testoOmbreggiato">Devi immettere il nome del modello</p> -->
        <?php
            // if ($_POST["Nome"] == null) {
            //     echo "Nome Modello NULL";
            // }
        }

        // Controllo di aver immesso la descrizione
        if (isset($_POST['AggiornaModello']) && isset($_POST["Descrizione"]) && (!empty($_POST["Descrizione"]))) {
            $Descrizione = $_POST["Descrizione"];
        } else {
        ?>
            <div class="container divMessaggio" id="divAggiornaDescrizione_Modelli">
                <!-- "d-flex justify-content-center" -->
                <div class="alert alert-warning alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  -->
                    <strong>Attenzione! </strong> Devi inserire una descrizione per il modello.
                </div>
            </div>
            <!-- <p class="text-warning testoOmbreggiato">Devi immettere la descrizione del modello</p> -->
        <?php
            // if ($_POST["Descrizione"] == null) {
            //     echo "Descrizione Modello NULL";
            // }
        }

        // Controllo di aver immesso il prezzo di listino
        if (isset($_POST['AggiornaModello']) && isset($_POST["PrezzoListino"]) && (!empty($_POST["PrezzoListino"]))) {
            $PrezzoListino = $_POST["PrezzoListino"];
        } else {
        ?>
            <div class="container divMessaggio" id="divAggiornaPrezzoListino_Modelli">
                <!-- "d-flex justify-content-center" -->
                <div class="alert alert-warning alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  -->
                    <strong>Attenzione! </strong> Devi inserire un prezzo di listino per il modello.
                </div>
            </div>
            <!-- <p class="text-warning testoOmbreggiato">Devi immettere il prezzo di listino del modello</p> -->
            <?php
            // if ($_POST["PrezzoListino"] == null) {
            //     echo "PrezzoListino Modello NULL";
            // }
        }

        // Controllo di aver immesso il genere
        if (isset($_POST['AggiornaModello']) && isset($_POST["Genere"]) && (!empty($_POST["Genere"]))) {
            // Controllo di aver inserito un carattere
            if (($_POST["Genere"] == 'M') || ($_POST["Genere"] == 'm') || ($_POST["Genere"] == 'F') || ($_POST["Genere"] == 'f')) {
                $Genere = $_POST["Genere"];
            } else {
            ?>
                <div class="container divMessaggio">
                    <!-- "d-flex justify-content-center" -->
                    <div class="alert alert-warning alert-dismissible">
                        <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  -->
                        <strong>Attenzione! </strong>Inserisci: M/F oppure m/f.
                    </div>
                </div>
                <!-- <p class="text-warning"></p> -->
            <?php
            }
        } else {
            ?>
            <div class="container divMessaggio" id="divAggiornaGenere_Modelli">
                <!-- "d-flex justify-content-center" -->
                <div class="alert alert-warning alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  -->
                    <strong>Attenzione! </strong> Devi inserire un genere per il modello.
                </div>
            </div>
            <!-- <p class="text-warning testoOmbreggiato">Devi immettere il genere del modello</p> -->
        <?php
        }

        // Controllo di aver inserito la collezione
        if (isset($_POST['AggiornaModello']) && isset($_POST["Collezione"]) &&  (!empty($_POST["Collezione"]))) {
            $Collezione = $_POST["Collezione"];
        } else {
        ?>
            <div class="container divMessaggio" id="divAggiornaCollezione_Modelli">
                <!-- "d-flex justify-content-center" -->
                <div class="alert alert-warning alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  -->
                    <strong>Attenzione! </strong> Devi inserire una collezione per il modello.
                </div>
            </div>
            <!-- <p class="text-warning testoOmbreggiato">Devi immettere la collezione del modello</p> -->
            <?php
        }

        // COMANDO SQL  !! Per le stringhe devo usare gli apici !!
        if (($CodModello != null) && ($Nome != null) && ($Descrizione != null) && ($PrezzoListino != null) && ($Genere != null) && ($Collezione != null)) {
            $strSQL = "UPDATE modelli 
                SET Nome = '$Nome', Descrizione = '$Descrizione', PrezzoListino = '$PrezzoListino', Genere = '$Genere',Collezione = '$Collezione' 
                WHERE CodModello = '$CodModello'";
            $risultato = mysqli_query($conn, $strSQL);
            // Controllo del corretto inserimento
            if ($risultato) {
            ?>
                <div class="container divMessaggio">
                    <!-- "d-flex justify-content-center" -->
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Modello aggiornato correttamente</strong>
                    </div>
                </div>
                <!-- <p class="text-success"></p> -->
            <?php
            } else {
            ?>
                <div class="container divMessaggio">
                    <!-- "d-flex justify-content-center" -->
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Errore nell'aggiornamento del modello</strong>
                    </div>
                </div>
                <!-- <p class="text-danger"></p> -->
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
            <!-- "d-flex justify-content-center" -->
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Attenzione! </strong> Compila tutti i campi.
            </div>
        </div>
    <?php
    } // chiusura else(isset)
    ?>
    <!-- FINE QUERY DI AGGIORNAMENTO -->










    <br>
    <br>
    <br>






    <!-- ############################################################################################################################################### -->
    <!-- ############################################################################################################################################### -->
    <!-- ############################################################################################################################################### -->
    <!--  PUNTI VENDITA  -->
    <!-- QUERY DI RACCOLTA DATI DA FORM -->
    <h2>Aggiornamento di una filiale (Punto Vendita)</h2>
    <!-- Con questo form vado a prendere in input dall'utente: CodPV, Indirizzo, Telefono, Citta, DataInizio, Nazione per poi elaborare il tutto successivamente -->
    <div class="d-flex justify-content-center">
        <fieldset>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>#formAggiornaPuntiVendita" id="formAggiornaPuntiVendita" class="formOperazioniDML">
                <!-- $ _SERVER [ 'PHP_SELF'] è una variabile d'ambiente supportata da tutte le piattaforme che indica il nome del file su cui è attualmente in esecuzione lo script PHP rispetto alla root del Web server.
                                                                                                  In pratica si tratta del nome della pagina corrente; lo puoi utilizzare quando il codice che processa i dati del form si trova nella stessa pagina in cui si trova il form -->
                <div class="form-group">

                    <!-- SELEZIONO IL PUNTO VENDITA D'INTERESSE -->
                    <p>
                        <label for="CodPV">Punto vendita da modificare:&nbsp; </label>
                        <select name="CodPV" id="CodPV_PuntiVendita" onchange="hideDiv('divAggiornaPuntoVendita_PuntiVendita',this); showDiv('divAggiornaPuntoVendita_PuntiVendita',this)">
                            <option>---</option>
                            <?php
                            // Comando SQL. ( Ricorda: il .= è stato deprecato )
                            $strSQL = "SELECT DISTINCT CodPV FROM puntivendita ORDER BY CodPV;"; // Raccolgo il codice del punto vendita dalla tabella puntivendita
                            $risultato = mysqli_query($conn, $strSQL);
                            while ($riga = mysqli_fetch_array($risultato)) {
                                echo "<option value=\"" . $riga["CodPV"] . "\">" . $riga["CodPV"] . "</option> \n";
                            }
                            ?>
                        </select>
                    </p>


                    <p>
                        <label for="Indirizzo">Indirizzo del Punto Vendita:&nbsp;</label>
                        <input type="text" name="Indirizzo" id="Indirizzo_PuntiVendita" onchange="hideDiv('divAggiornaIndirizzo_PuntiVendita',this); showDiv('divAggiornaIndirizzo_PuntiVendita',this)"></input>
                    </p>


                    <p>
                        <label for="Telefono">Telefono Punto Vendita:&nbsp;</label>
                        <input type="text" name="Telefono" id="Telefono_PuntiVendita" onchange="hideDiv('divAggiornaTelefono_PuntiVendita',this); showDiv('divAggiornaTelefono_PuntiVendita',this)"></input>
                    </p>

                    <p>
                        <label for="Citta">Città del Punto Vendita:&nbsp;</label>
                        <input type="text" name="Citta" id="Citta_PuntiVendita" onchange="hideDiv('divAggiornaCitta_PuntiVendita',this); showDiv('divAggiornaCitta_PuntiVendita',this)"></input>
                    </p>

                    <p>
                        <label for="DataInizio">Data di inizio attività:&nbsp;</label>
                        <input type="date" name="DataInizio" id="DataInizio_PuntiVendita" onchange="hideDiv('divAggiornaDataInizio_PuntiVendita',this); showDiv('divAggiornaDataInizio_PuntiVendita',this)"></input>
                    </p>

                    <p>
                        <label for="Nazione">Nazione del Punto Vendita:&nbsp;</label>
                        <input type="text" name="Nazione" id="Nazione_PuntiVendita" onchange="hideDiv('divAggiornaNazione_PuntiVendita',this); showDiv('divAggiornaNazione_PuntiVendita',this)"></input>
                    </p>

                    <br>
                    <input type="submit" name="AggiornaPV" value="Aggiorna" />
                    <input type="reset" name="AnnullaPV" value="Annulla" />
                </div>
            </form>


        </fieldset>
    </div>
    <!-- FINE QUERY DI RACCOLTA DATI DA FORM -->

    <!-- QUERY DI AGGIORNAMENTO -->
    <?php
    // Variabili che mi servono
    $CodPV = null;
    $Indirizzo = null;
    $Telefono = null;
    $Citta = null;
    $DataInizio = null;
    $Nazione = null;
    if (isset($_POST['AggiornaPV'])) // isset — Determine if a variable is declared and is different than null
    {
        // Controllo il codice del punto vendita
        if ((isset($_POST["CodPV"])) && (!empty($_POST["CodPV"])) && (strcmp($_POST["CodPV"], $stringaControllo) != 0)) {
            $CodPV = $_POST["CodPV"];
        } else {
    ?>
            <div class="container divMessaggio" id="divAggiornaPuntoVendita_PuntiVendita">
                <!-- "d-flex justify-content-center" -->
                <div class="alert alert-warning alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  -->
                    <strong>Attenzione! </strong> Devi inserire il codice di un punto vendita.
                </div>
            </div>
            <!-- <p class="text-warning">Devi immettere il codice del punto vendita</p> -->
        <?php
        }

        // Controllo indirizzo
        if (isset($_POST['AggiornaPV']) && isset($_POST["Indirizzo"]) && !empty($_POST["Indirizzo"])) {
            $Indirizzo = $_POST["Indirizzo"];
        } else {
        ?>
            <div class="container divMessaggio" id="divAggiornaIndirizzo_PuntiVendita">
                <!-- "d-flex justify-content-center" -->
                <div class="alert alert-warning alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  -->
                    <strong>Attenzione! </strong> Devi inserire l'indirizzo del un punto vendita.
                </div>
            </div>
            <!-- <p class="text-warning">Devi immettere l'indirizzo</p> -->
        <?php
        }

        // Controllo telefono
        if (isset($_POST['AggiornaPV']) && isset($_POST["Telefono"]) && !empty($_POST["Telefono"])) {
            $Telefono = $_POST["Telefono"];
        } else {
        ?>
            <div class="container divMessaggio" id="divAggiornaTelefono_PuntiVendita">
                <!-- "d-flex justify-content-center" -->
                <div class="alert alert-warning alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  -->
                    <strong>Attenzione! </strong> Devi inserire il numero di telefono del punto vendita.
                </div>
            </div>
            <!-- <p class="text-warning">Devi immettere il numero di telefono</p> -->
        <?php
        }

        // Controllo Citta
        if (isset($_POST['AggiornaPV']) && isset($_POST["Citta"]) && !empty($_POST["Citta"])) {
            $Citta = $_POST["Citta"];
        } else {
        ?>
            <div class="container divMessaggio" id="divAggiornaCitta_PuntiVendita">
                <!-- "d-flex justify-content-center" -->
                <div class="alert alert-warning alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  -->
                    <strong>Attenzione! </strong> Devi inserire la citt&agrave; del punto vendita.
                </div>
            </div>
            <!-- <p class="text-warning">Devi immettere la citt&agrave;</p> -->
        <?php
        }


        // Controllo DataInizio
        if (isset($_POST['AggiornaPV']) && isset($_POST["DataInizio"]) && !empty($_POST["DataInizio"])) {
            $DataInizio = $_POST["DataInizio"];
        } else {
        ?>
            <div class="container divMessaggio" id="divAggiornaDataInizio_PuntiVendita">
                <!-- "d-flex justify-content-center" -->
                <div class="alert alert-warning alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  -->
                    <strong>Attenzione! </strong> Devi inserire la data di inizio del punto vendita.
                </div>
            </div>
            <!-- <p class="text-warning">Devi immettere data di inizio attività</p> -->
        <?php
        }


        // Controllo Nazione
        if (isset($_POST['AggiornaPV']) && isset($_POST["Nazione"]) && !empty($_POST["Nazione"])) {
            $Nazione = $_POST["Nazione"];
        } else {
        ?>
            <div class="container divMessaggio" id="divAggiornaNazione_PuntiVendita">
                <!-- "d-flex justify-content-center" -->
                <div class="alert alert-warning alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  -->
                    <strong>Attenzione! </strong> Devi inserire la nazione del punto vendita.
                </div>
            </div>
            <!-- <p class="text-warning">Devi immettere la nazione</p> -->
            <?php
        }

        // COMANDO SQL 
        if (($CodPV != null) && ($Indirizzo != null) && ($Telefono != null) && ($Citta != null) && ($DataInizio != null) && ($Nazione != null)) {
            // Ci metto solo i campi che mi interessano
            $strSQL = "UPDATE puntivendita 
                       SET CodPV = '$CodPV', Indirizzo = '$Indirizzo', Telefono = '$Telefono', Citta = '$Citta', DataInizio = '$DataInizio', Nazione = '$Nazione'
                       WHERE CodPV = '$CodPV' ";

            $risultato = mysqli_query($conn, $strSQL);
            // Controllo del corretto inserimento
            if ($risultato) {
            ?>
                <div class="container divMessaggio">
                    <!-- "d-flex justify-content-center" -->
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Punto vendita aggiornato correttamente</strong>
                    </div>
                </div>
                <!-- <p class=text-success></p> -->
            <?php
            } else {
            ?>
                <div class="container divMessaggio">
                    <!-- "d-flex justify-content-center" -->
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Errore nell'aggiornamento del punto vendita</strong>
                    </div>
                </div>

                <!-- <p class=text-danger></p>; -->
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
            <!-- "d-flex justify-content-center" -->
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Attenzione! </strong> Compilare tutti i campi.
            </div>
        </div>
    <?php
    } // fine else isset
    ?>
    <!-- FINE QUERY DI AGGIORNAMENTO -->








    <br>
    <br>
    <br>









    <!-- ############################################################################################################################################### -->
    <!-- ############################################################################################################################################### -->
    <!-- ############################################################################################################################################### -->
    <!--  DIPENDENTI  -->
    <!-- QUERY DI RACCOLTA DATI DA FORM -->
    <h2>Aggiornamento di un dipendente</h2>
    <!-- Con questo form vado a prendere in input dall'utente: Matricola, Cognome, Nome, CodiceFiscale, Qualifica, PuntoVendita dalla tabella dipendenti, per poi elaborare il tutto successivamente -->
    <div class="d-flex justify-content-center">
        <fieldset>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>#formAggiornaDipendenti" id="formAggiornaDipendenti" class="formOperazioniDML">
                <!-- $ _SERVER [ 'PHP_SELF'] è una variabile d'ambiente supportata da tutte le piattaforme che indica il nome del file su cui è attualmente in esecuzione lo script PHP rispetto alla root del Web server.
                                                                                                         In pratica si tratta del nome della pagina corrente; lo puoi utilizzare quando il codice che processa i dati del form si trova nella stessa pagina in cui si trova il form -->
                <div class="form-group">


                    <p>
                        <label for="Matricola">Scegli la matricola tra quelle esistenti:&nbsp; </label>
                        <!-- SELEZIONO LA MATRICOLA DEL DIPENDENTE DI INTERESSE (in ordine) -->
                        <select name="Matricola" id="Matricola_Dipendenti" onchange="hideDiv('divAggiornaMatricola_Dipendenti',this); showDiv('divAggiornaMatricola_Dipendenti',this)">
                            <option>---</option>
                            <?php
                            // Comando SQL. ( Ricorda: il .= è stato deprecato )
                            $strSQL = "SELECT DISTINCT Matricola FROM dipendenti ORDER BY Matricola;"; // Raccolgo il codice del modello dalla tabella modelli
                            $risultato = mysqli_query($conn, $strSQL);
                            while ($riga = mysqli_fetch_array($risultato)) {
                                echo "<option value=\"" . $riga["Matricola"] . "\">" . $riga["Matricola"] . "</option> \n";
                            }
                            ?>
                        </select>
                    </p>
                </div>



                </p>

                <p>
                    <label for="Cognome">Cognome:&nbsp; </label>
                    <input type="text" name="Cognome" id="Cognome_Dipendenti" onchange="hideDiv('divAggiornaCognome_Dipendenti',this); showDiv('divAggiornaCognome_Dipendenti',this)"></input>
                </p>


                <p>
                    <label for="Nome">Nome:&nbsp; </label>
                    <input type="text" name="Nome" id="Nome_Dipendenti" onchange="hideDiv('divAggiornaNome_Dipendenti',this); showDiv('divAggiornaNome_Dipendenti',this)"></input>
                </p>

                <p>
                    <label for="CodiceFiscale">Codice Fiscale:&nbsp; </label>
                    <input type="text" name="CodiceFiscale" id="CodiceFiscale_Dipendenti" onchange="hideDiv('divAggiornaCodiceFiscale_Dipendenti',this); showDiv('divAggiornaCodiceFiscale_Dipendenti',this)"></input>
                </p>

                <p>
                    <label for="Qualifica">Qualifica:&nbsp; </label>
                    <input type="text" name="Qualifica" id="Qualifica_Dipendenti" onchange="hideDiv('divAggiornaQualifica_Dipendenti',this); showDiv('divAggiornaQualifica_Dipendenti',this)"></input>
                </p>

                <!-- SELEZIONO IL PUNTO VENDITA DI INTERESSE (in ordine) -->
                <p>
                    <label for="CodPV">Punto vendita di interesse:&nbsp; </label>
                    <select name="CodPV" id="CodPV_Dipendenti" onchange="hideDiv('divAggiornaPuntoVendita_Dipendenti',this); showDiv('divAggiornaPuntoVendita_Dipendenti',this)">
                        <option>---</option>
                        <?php
                        // Comando SQL. ( Ricorda: il .= è stato deprecato )
                        $strSQL = "SELECT DISTINCT CodPV FROM puntivendita ORDER BY CodPV;"; // Raccolgo il codice del punto vendita dalla tabella puntivendita
                        $risultato = mysqli_query($conn, $strSQL);
                        while ($riga = mysqli_fetch_array($risultato)) {
                            echo "<option value=\"" . $riga["CodPV"] . "\">" . $riga["CodPV"] . "</option> \n";
                        }
                        ?>
                    </select>
                </p>

                <br>
                <input type="submit" name="AggiornaDipendente" value="Aggiorna" />
                <input type="reset" name="Annulla" value="Annulla" onclick="nascondiElemento('txtHint')" />
    </div>
    </form>
    </fieldset>
    </div>
    <!-- FINE QUERY DI RACCOLTA DATI DA FORM -->

    <!-- QUERY DI AGGIORNAMENTO -->
    <?php
    $Matricola = null;
    $Cognome =  null;
    $Nome =  null;
    $CodiceFiscale =  null;
    $Qualifica = null;
    $CodPV =  null;
    if (isset($_POST['AggiornaDipendente'])) // isset — Determine if a variable is declared and is different than null
    {
        // Controllo la matricola
        if ((isset($_POST['AggiornaDipendente'])) && (isset($_POST['Matricola'])) && (strcmp($_POST["Matricola"], $stringaControllo) != 0)) {
            $Matricola = $_POST["Matricola"];
        } else {
    ?>

            <div class="container divMessaggio" id="divAggiornaMatricola_Dipendenti">
                <!-- "d-flex justify-content-center" -->
                <div class="alert alert-warning alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  -->
                    <strong>Attenzione! </strong> Devi inserire la matricola.
                </div>
            </div>
            <!-- <p class="text-warning">Devi immettere la matricola</p> -->
        <?php
        }

        // Acquisisco: Matricola, Cognome, Nome, CodiceFiscale, Qualifica, PuntoVendita dal form HTML e me li salvo in queste due variabili
        // Controllo il cognome
        if (isset($_POST['AggiornaDipendente']) && isset($_POST["Cognome"]) && !empty($_POST["Cognome"])) {
            $Cognome = $_POST["Cognome"];
        } else {
        ?>
            <div class="container divMessaggio" id="divAggiornaCognome_Dipendenti">
                <!-- "d-flex justify-content-center" -->
                <div class="alert alert-warning alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  -->
                    <strong>Attenzione! </strong> Devi inserire il cognome del dipendente.
                </div>
            </div>
            <!-- <p class="text-warning">Devi inserire il cognome del dipendente</p> -->
        <?php
        }


        // Controllo il nome
        if (isset($_POST['AggiornaDipendente']) && isset($_POST["Nome"]) && !empty($_POST["Nome"])) {
            $Nome = $_POST["Nome"];
        } else {
        ?>
            <div class="container divMessaggio" id="divAggiornaNome_Dipendenti">
                <!-- "d-flex justify-content-center" -->
                <div class="alert alert-warning alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  -->
                    <strong>Attenzione! </strong> Devi inserire il nome del dipendente.
                </div>
            </div>
            <!-- <p class="text-warning">Devi inserire il nome del dipendente</p> -->
        <?php
        }


        // Controllo il codice fiscale
        if (isset($_POST['AggiornaDipendente']) && isset($_POST["CodiceFiscale"]) && !empty($_POST["CodiceFiscale"])) {
            $CodiceFiscale = $_POST["CodiceFiscale"];
        } else {
        ?>
            <div class="container divMessaggio" id="divAggiornaCodiceFiscale_Dipendenti">
                <!-- "d-flex justify-content-center" -->
                <div class="alert alert-warning alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  -->
                    <strong>Attenzione! </strong> Devi inserire il codice fiscale del dipendente.
                </div>
            </div>
            <!-- <p class="text-warning">Devi inserire il codice fiscale del dipendente</p> -->
        <?php
        }


        // Controllo la qualifica
        if (isset($_POST['AggiornaDipendente']) && isset($_POST["Qualifica"]) && !empty($_POST["Qualifica"])) {
            $Qualifica = $_POST["Qualifica"];
        } else {
        ?>
            <div class="container divMessaggio" id="divAggiornaCodiceFiscale_Dipendenti">
                <!-- "d-flex justify-content-center" -->
                <div class="alert alert-warning alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  -->
                    <strong>Attenzione! </strong> Devi inserire il codice fiscale del dipendente.
                </div>
            </div>
            <!-- <p class="text-warning">Devi inserire la qualifica del dipendente</p> -->
        <?php
        }


        // Controllo il punto vendita
        if (isset($_POST['AggiornaDipendente']) && isset($_POST["CodPV"]) && !empty($_POST["CodPV"]) && (strcmp($_POST["CodPV"], $stringaControllo) != 0)) {
            $CodPV = $_POST["CodPV"];
        } else {
        ?>
            <div class="container divMessaggio" id="divAggiornaPuntoVendita_Dipendenti">
                <!-- "d-flex justify-content-center" -->
                <div class="alert alert-warning alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  -->
                    <strong>Attenzione! </strong> Devi inserire il punto vendita in cui lavora il dipendente.
                </div>
            </div>
            <?php
        }


        // Comando SQL
        if (($Matricola != null) && ($Cognome != null) && ($Nome != null) && ($CodiceFiscale != null) && ($Qualifica != null) && ($CodPV != null)) {
            $strSQL = "UPDATE dipendenti 
                   SET Cognome = '$Cognome', Nome = '$Nome', CodiceFiscale = '$CodiceFiscale', Qualifica = '$Qualifica', PuntoVendita = '$CodPV'
                   WHERE Matricola = '$Matricola'";

            $risultato = mysqli_query($conn, $strSQL);

            // Controllo del corretto inserimento
            if ($risultato) {
            ?>
                <div class="container divMessaggio">
                    <!-- "d-flex justify-content-center" -->
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Dipendente aggiornato correttamente </strong>
                    </div>
                </div>
                <!-- <p class=text-success>Dipendente aggiornato correttamente</p> -->
            <?php

            } else {
            ?>
                <div class="container divMessaggio">
                    <!-- "d-flex justify-content-center" -->
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Errore nell'aggiornamento del dipendente</strong>
                    </div>
                </div>
                <!-- <p class=text-danger></p> -->
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
            <!-- "d-flex justify-content-center" -->
            <div class="alert alert-success alert-dismissible">
                <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
                <strong>Attenzione! </strong> Compila tutti i campi.
                <br>
                <strong>Ricorda: </strong> Devi esistere almeno un punto vendita.
            </div>
        </div>
        <!-- <p class="text-warning">!!</p> -->
    <?php
    } //  chiusura else (isset)
    ?>
    <!-- FINE QUERY DI AGGIORNAMENTO -->









    <br>
    <br>
    <br>









    <!-- ############################################################################################################################################### -->
    <!-- ############################################################################################################################################### -->
    <!-- ############################################################################################################################################### -->
    <!--  VENDITE  -->
    <!-- QUERY DI RACCOLTA DATI DA FORM -->
    <h2>Aggiornamento di una vendita</h2>
    <!-- Con questo form vado a prendere in input dall'utente il codice del modello e la taglia, per poi elaborare il tutto successivamente -->
    <div class="d-flex justify-content-center">
        <fieldset>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>#formAggiornaVendite" id="formAggiornaVendite" class="formOperazioniDML">
                <!-- $ _SERVER [ 'PHP_SELF'] è una variabile d'ambiente supportata da tutte le piattaforme che indica il nome del file su cui è attualmente in esecuzione lo script PHP rispetto alla root del Web server.
                                                                                                         In pratica si tratta del nome della pagina corrente; lo puoi utilizzare quando il codice che processa i dati del form si trova nella stessa pagina in cui si trova il form -->
                <div class="form-group">

                    <!-- SELEZIONO L'ID DELLA VENDITA DA AGGIORNARE (in ordine) -->
                    <p>
                        <label for="ID">ID della vendita</label>
                        <select name="ID_Vendite" id="ID_Vendite">
                            <option>---</option>
                            <?php
                            $strSQL = "SELECT DISTINCT ID FROM vendite ORDER BY ID";
                            $risultato = mysqli_query($conn, $strSQL);
                            while ($riga = mysqli_fetch_array($risultato)) {
                                echo "<option value=\"" . $riga["ID"] . "\">" . $riga["ID"] . "</option> \n";
                            }
                            ?>
                        </select>
                    </p>
                    <p>
                        <label for="DataVendita">Data di vendita:&nbsp; </label>
                        <input type="date" name="DataVendita" id="DataVendita_Vendite" />
                    </p>
                    <p>
                        <label for="Prezzo Vendita">Prezzo di vendita:&nbsp; </label>
                        <input type="number" step="0.01" name="PrezzoVendita" id="PrezzoVendita_Vendite"></input>
                    </p>

                    <!-- SELEZIONO LA MATRICOLA DA INSERIRE (in ordine) -->
                    <p>
                        <label for="Matricola">Matricola agente di vendita:&nbsp; </label>
                        <select name="Matricola" id="Matricola_Vendite">
                            <option>---</option>
                            <?php
                            // Comando SQL. ( Ricorda: il .= è stato deprecato )
                            $strSQL = "SELECT DISTINCT Matricola FROM dipendenti ORDER BY Matricola;"; // Raccolgo la matricola del capo dalla tabella dipendenti
                            $risultato = mysqli_query($conn, $strSQL);
                            while ($riga = mysqli_fetch_array($risultato)) {
                                echo "<option value=\"" . $riga["Matricola"] . "\">" . $riga["Matricola"] . "</option> \n";
                            }
                            ?>
                        </select>
                    </p>

                    <!-- SELEZIONO ID DEL CAPO DA AGGIORNARE (in ordine) -->
                    <p>
                        <label for="IDCapo">Id capo:&nbsp;</label>
                        <select name="IdCapo" id="IDCapo_Vendite">
                            <option>---</option>
                            <?php
                            // Comando SQL. ( Ricorda: il .= è stato deprecato )
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

                    <input type="submit" name="AggiornaVendita" value="Aggiorna" />
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
    $ID_Vendite = null;
    $PrezzoVendita = null;
    $Matricola = null;
    $IdCapo = null;
    $DataVendita = null;
    if ((isset($_POST['AggiornaVendita'])) && (isset($_POST['Matricola'])) && (isset($_POST['IdCapo']))) // isset — Determine if a variable is declared and is different than null
    {

        // Controllo ID della vendita
        if (isset($_POST["AggiornaVendita"]) && isset($_POST["ID_Vendite"]) && !empty($_POST["ID_Vendite"]) && (strcmp($_POST["ID_Vendite"], $stringaControllo) != 0)) {
            $ID_Vendite = $_POST["ID_Vendite"];
        } else {
    ?>
            <p class="text-warning">Devi immettere l'ID della vendita da aggiornare</p>
        <?php
        }

        // Controllo prezzo di vendita
        if ((isset($_POST['AggiornaVendita'])) && (isset($_POST["PrezzoVendita"])) && (!empty($_POST["PrezzoVendita"]))) {
            $PrezzoVendita = $_POST["PrezzoVendita"];
        } else {
        ?>
            <p class="text-warning">Devi inserire il prezzo di vendita</p>
        <?php
        }


        // Controllo matricola
        if ((isset($_POST['AggiornaVendita'])) && (isset($_POST["Matricola"])) && (!empty($_POST["Matricola"])) && (strcmp($_POST["Matricola"], $stringaControllo) != 0)) {
            $Matricola = $_POST["Matricola"];
        } else {
        ?>
            <p class="text-warning">Devi inserire la matricola dell'agente di vendita</p>
            <!-- nella select matricola dell'agente che vende, potrei farmi una query in cui vado a prendermi solo i dipendenti la cui qualifica è 'venditore' -->
        <?php
        }


        // Controllo IdCapo
        if ((isset($_POST['AggiornaVendita'])) && (isset($_POST["IdCapo"])) && (!empty($_POST["IdCapo"])) && (strcmp($_POST["IdCapo"], $stringaControllo) != 0)) {
            $IdCapo = $_POST["IdCapo"];
        } else {
        ?>
            <p class="text-warning">Devi inserire l'ID del capo che si vuole vendere</p>
        <?php
        }

        // Controllo data di vendita
        if ((isset($_POST['AggiornaVendita'])) && (isset($_POST["DataVendita"])) && (!empty($_POST["DataVendita"]))) {
            $DataVendita = $_POST["DataVendita"];
        } else {
        ?>
            <p class="text-warning">Devi inserire la data di vendita</p>
            <?php
        }

        if (($ID_Vendite != null) && ($PrezzoVendita != null) && ($Matricola != null) && ($IdCapo != null) && ($DataVendita != null)) {   // Comando SQL  !! Per le stringhe devo usare gli apici !!
            // Ci metto solo i campi che mi interessano
            $strSQL = "UPDATE vendite  
                       SET  ID = '$ID_Vendite', DataVendita = '$DataVendita', PrezzoVendita = '$PrezzoVendita', Matricola = '$Matricola', IDCapo = '$IdCapo'
                       WHERE ID = '$ID_Vendite';";
            $risultato = mysqli_query($conn, $strSQL);
            // Controllo del corretto inserimento
            if ($risultato) {
            ?>
                <p class=text-success>Vendita aggiornata correttamente</p>
            <?php
            } else {
            ?>
                <p class=text-danger>Errore nell'aggiornamento della vendita</p>
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
        <p class="text-warning">Devi prima inserire almeno un dipendente ed un capo d'abbigliamento</p>
    <?php
    }
    ?>
    <!-- FINE QUERY DI INSERIMENTO -->














    <?php
    footer(); // Richiamo la funzione per il piè di pagina
    ?>
    <!-- Chiusura della connessione al DataBase -->
    <?php
    mysqli_close($conn); //Make sure to close out the database connection
    ?>



    <!-- Uso codice Javascript e JQuery nel documento corrente -->
    <script>
        $("h2").css("font-weight", "bold");
        $("h2").css("text-align", "center");
        $("p").css("text-align", "center");
        $("p.testoOmbreggiato").css("text-shadow", "2px 2px 5px white");
        // $("fieldset").css("align","center");

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














        /** ############################################## */
        /** ############################################## */
        /*   CHIAMATA AJAX PER SELEZIONE DELL'ID DEL CAPO  */
        /** ############################################## */
        /** ############################################## */
        $(document).ready(function() {
            $('#ID_Capi').change(function() {
                // Salvo il value dell'elemento con id '#ID_Capi'
                var id = $('#ID_Capi').val();
                // Se id è deverso da stringa vuota
                if (id != '') {
                    // Chiamata ajax
                    $.ajax({
                        // A cui passo alcuni parametri
                        url: "getCapo.php",
                        method: "POST",
                        data: {
                            id: id
                        },
                        dataType: "json",
                        // Nel caso di successo
                        success: function(data) {
                            console.log("Sono dentro a successo");
                            // Scrivo sugli elementi del DOM aventi quegli id
                            $('#Taglia_Capi').val(data.Taglia);
                            $('#Colore_Capi').val(data.Colore);
                            $('#CodPV_Capi').val(data.CodPV);
                            $('#CodModello_Capi').val(data.CodModello);
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    })
                } else {
                    alert("Per favore, seleziona un capo");
                    console.log("Sono dentro all'else");
                }
            });
















            /** ########################################################## */
            /** ########################################################## */
            /*   CHIAMATA AJAX PER SELEZIONE DEL CODICE DEL MODELLO  */
            /** ########################################################## */
            /** ############################################## ############*/

            $('#CodModello_Modelli').change(function() {

                var codmodello = $('#CodModello_Modelli').val();
                // Se id è deverso da stringa vuota
                if (codmodello != '') {
                    // Chiamata ajax
                    $.ajax({
                        // A cui passo alcuni parametri
                        url: "getModello.php",
                        method: "POST",
                        data: {
                            codmodello: codmodello
                        },
                        dataType: "json",
                        // Nel caso di successo
                        success: function(data) {
                            console.log("Sono dentro a successo");
                            // Scrivo sugli elementi del DOM aventi quegli id
                            $('#Nome_Modelli').val(data.Nome);
                            $('#Descrizione_Modelli').val(data.Descrizione);
                            $('#PrezzoListino_Modelli').val(data.PrezzoListino);
                            $('#Genere_Modelli').val(data.Genere);
                            $('#Collezione_Modelli').val(data.Collezione);
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    })
                } else {
                    alert("Per favore, seleziona un modello");
                    console.log("Sono dentro all'else");
                }
            });












            /** ########################################################## */
            /** ########################################################## */
            /*   CHIAMATA AJAX PER SELEZIONE DELLA MATRICOLA DEL DIPENDENTE */
            /** ########################################################## */
            /** ############################################## ############*/

            $('#Matricola_Dipendenti').change(function() {

                var matricola = $('#Matricola_Dipendenti').val();
                // Se id è deverso da stringa vuota
                if (matricola != '') {
                    // Chiamata ajax
                    $.ajax({
                        // A cui passo alcuni parametri
                        url: "getDipendente.php",
                        method: "POST",
                        data: {
                            matricola: matricola
                        },
                        dataType: "json",
                        // Nel caso di successo
                        success: function(data) {
                            console.log("Sono dentro a successo");
                            // Scrivo sugli elementi del DOM aventi quegli id
                            $('#Cognome_Dipendenti').val(data.Cognome);
                            $('#Nome_Dipendenti').val(data.Nome);
                            $('#CodiceFiscale_Dipendenti').val(data.CodiceFiscale);
                            $('#Qualifica_Dipendenti').val(data.Qualifica);
                            $('#CodPV_Dipendenti').val(data.PuntoVendita);
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    })
                } else {
                    alert("Per favore, seleziona un dipendente");
                    console.log("Sono dentro all'else");
                }
            });














            /** ########################################################## */
            /** ########################################################## */
            /*   CHIAMATA AJAX PER SELEZIONE DEL CODICE DEL PUNTO VENDITA  */
            /** ########################################################## */
            /** ############################################## ############*/

            $('#CodPV_PuntiVendita').change(function() {

                var puntovendita = $('#CodPV_PuntiVendita').val();
                // Se id è deverso da stringa vuota
                if (puntovendita != '') {
                    // Chiamata ajax
                    $.ajax({
                        // A cui passo alcuni parametri
                        url: "getPuntoVendita.php",
                        method: "POST",
                        data: {
                            puntovendita: puntovendita
                        },
                        dataType: "json",
                        // Nel caso di successo
                        success: function(data) {
                            console.log("Sono dentro a successo");
                            // Scrivo sugli elementi del DOM aventi quegli id
                            $('#Indirizzo_PuntiVendita').val(data.Indirizzo);
                            $('#Telefono_PuntiVendita').val(data.Telefono);
                            $('#Citta_PuntiVendita').val(data.Citta);
                            $('#DataInizio_PuntiVendita').val(data.DataInizio);
                            $('#Nazione_PuntiVendita').val(data.Nazione);
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    })
                } else {
                    alert("Per favore, seleziona un punto vendita");
                    console.log("Sono dentro all'else");
                }
            });























            /** ########################################################## */
            /** ########################################################## */
            /*   CHIAMATA AJAX PER SELEZIONE DELL'ID DELLA VENDITA  */
            /** ########################################################## */
            /** ############################################## ############*/

            $('#ID_Vendite').change(function() {

                var vendita = $('#ID_Vendite').val();
                // Se id è deverso da stringa vuota
                if (vendita != '') {
                    // Chiamata ajax
                    $.ajax({
                        // A cui passo alcuni parametri
                        url: "getVendita.php",
                        method: "POST",
                        data: {
                            vendita: vendita
                        },
                        dataType: "json",
                        // Nel caso di successo
                        success: function(data) {
                            console.log("Sono dentro a successo");
                            // Scrivo sugli elementi del DOM aventi quegli id
                            $('#DataVendita_Vendite').val(data.DataVendita);
                            $('#PrezzoVendita_Vendite').val(data.PrezzoVendita);
                            $('#Matricola_Vendite').val(data.Matricola_Vendita);
                            $('#IDCapo_Vendite').val(data.IDCapo_Vendita);
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    })
                } else {
                    alert("Per favore, seleziona una vendita");
                    console.log("Sono dentro all'else");
                }
            });
        });
    </script>


</body>

</html>
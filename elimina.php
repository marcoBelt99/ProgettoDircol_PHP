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
    <title>ELIMINAZIONE</title>

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
    <h2>Eliminazione di un capo</h2>
    <!-- Con questo form vado a prendere in input dall'utente: Taglia, Colore, PuntoVendita, Modello, per poi elaborare il tutto successivamente -->
    <div class="d-flex justify-content-center">
        <fieldset>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>#formEliminaCapi" id="formEliminaCapi" class="formOperazioniDML">
                <!-- $ _SERVER [ 'PHP_SELF'] è una variabile d'ambiente supportata da tutte le piattaforme che indica il nome del file su cui è attualmente in esecuzione lo script PHP rispetto alla root del Web server.
                                                                                                  In pratica si tratta del nome della pagina corrente; lo puoi utilizzare quando il codice che processa i dati del form si trova nella stessa pagina in cui si trova il form -->
                <div class="form-group">

                    <!-- SELEZIONO L'ID DEL CAPO DI INTERESSE per poi fare l'eliminazione -->
                    <p>
                        <label for="ID">ID del capo da eliminare:&nbsp;</label>
                        <select name="ID" id="ID_Capi" onchange="mostraTabellaCapo(this.value); hideDiv('divEliminaID_Capi',this); showDiv('divEliminaID_Capi',this)">
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


                    <p id="tabellaCapo"> </p>

                    <br>
                    <input type="submit" name="EliminaCapo" value="Elimina" id="elementoModello" />
                    <input type="reset" name="Annulla" value="Annulla" id="elementoModello" onclick="nascondiElemento('tabellaCapo')" />
                </div>
            </form>
        </fieldset>
    </div>
    <!-- FINE QUERY DI RACCOLTA DATI DA FORM -->

    <!-- QUERY DI ELIMINAZIONE -->
    <?php
    $ID = null;
    if (isset($_POST['EliminaCapo']) &&  isset($_POST["ID"]) && !empty($_POST["ID"]) && (strcmp($_POST["ID"], $stringaControllo) != 0)) // isset — Determine if a variable is declared and is different than null
    {
        $ID = $_POST["ID"];

        // Comando SQL  !! Per le stringhe devo usare gli apici !!
        if (($ID != null)) {
            $strSQL = "DELETE FROM capi WHERE  ID = '$ID'";
            $risultato = mysqli_query($conn, $strSQL);

            // Controllo del corretto inserimento
            if ($risultato) {
    ?>
                <div class="container divMessaggio">
                    <!-- "d-flex justify-content-center" -->
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Capo eliminato correttamente</strong>.
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
                        <strong>Errore nell'eliminazione del capo</strong>.
                    </div>
                </div>
                <!-- <p class=text-danger></p> -->
        <?php
                echo $conn->error;
            }
        } // fine if comando SQL

    } // chiusura if(isset) bottone principale
    else {
        ?>
        <div class="container divMessaggio" id="divEliminaID_Capi">
            <!-- "d-flex justify-content-center" -->
            <div class="alert alert-warning alert-dismissible">
                <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  -->
                <strong>Attenzione! </strong>Devi prima inserire l'ID del capo da eliminare.
            </div>
        </div>
        <!-- <p class="text-warning"></p> -->
    <?php
    } // chiusura else(isset)
    ?>
    <!-- FINE QUERY DI ELIMINAZIONE -->






    <br>
    <br>
    <br>







    <!-- ############################################################################################################################################### -->
    <!-- ############################################################################################################################################### -->
    <!-- ############################################################################################################################################### -->
    <!--  MODELLI -->
    <!-- QUERY DI RACCOLTA DATI DA FORM -->
    <h2>Eliminazione di un modello (di capo d'abbigliamento)</h2>
    <!-- Con questo form vado a prendere in input dall'utente: Nome, Descrizione, PrezzoListino, Genere, Collezione per poi elaborare il tutto successivamente -->
    <div class="d-flex justify-content-center">
        <fieldset>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>#formEliminaModelli" id="formEliminaModelli" class="formOperazioniDML">
                <!-- $ _SERVER [ 'PHP_SELF'] è una variabile d'ambiente supportata da tutte le piattaforme che indica il nome del file su cui è attualmente in esecuzione lo script PHP rispetto alla root del Web server.
                                                                                                  In pratica si tratta del nome della pagina corrente; lo puoi utilizzare quando il codice che processa i dati del form si trova nella stessa pagina in cui si trova il form -->
                <div class="form-group">

                    <!-- SELEZIONO IL CODICE DEL MODELLO DI INTERESSE -->
                    <p>
                        <label for="CodModello">Codice Modello da eliminare:&nbsp;</label>
                        <select name="CodModello" id="CodModello_Modelli" onchange="mostraTabellaModello(this.value); hideDiv('divEliminaModello_Modelli',this); showDiv('divEliminaModello_Modelli',this)">
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

                    <p id="tabellaModello"></p>

                    <br>
                    <input type="submit" name="EliminaModello" value="Elimina" />
                    <input type="reset" name="Annulla" value="Annulla" onclick="nascondiElemento('tabellaModello')" />
                </div>
            </form>
        </fieldset>
    </div>
    <!-- FINE QUERY DI RACCOLTA DATI DA FORM -->

    <!-- QUERY DI AGGIORNAMENTO -->
    <?php
    // Dichiaro le variabili che mi servono
    $CodModello = null;

    if (isset($_POST['EliminaModello']) && isset($_POST["CodModello"]) && !empty($_POST["CodModello"]) && (strcmp($_POST["CodModello"], $stringaControllo) != 0)) // isset — Determine if a variable is declared and is different than null
    {
        $CodModello = $_POST["CodModello"];

        // COMANDO SQL  !! Per le stringhe devo usare gli apici !!
        if ($CodModello != null) {
            $strSQL = "DELETE FROM modelli WHERE CodModello = '$CodModello'";
            $risultato = mysqli_query($conn, $strSQL);
            // Controllo del corretto inserimento
            if ($risultato) {
    ?>
                <div class="container divMessaggio">
                    <!-- "d-flex justify-content-center" -->
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Modello eliminato correttamente.</strong>
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
                        <strong>Errore nell'eliminazione del modello.</strong>
                    </div>
                </div>
                <!-- <p class="text-danger">Errore nell'eliminazione del modello</p> -->
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
                <strong>Attenzione! </strong>Devi prima inserire il codice del modello
            </div>
        </div>
        <!-- <p class="text-warning"> </p> -->
    <?php
    }
    ?>
    <!-- FINE QUERY DI ELIMINAZIONE -->










    <br>
    <br>
    <br>






    <!-- ############################################################################################################################################### -->
    <!-- ############################################################################################################################################### -->
    <!-- ############################################################################################################################################### -->
    <!--  PUNTI VENDITA  -->
    <!-- QUERY DI RACCOLTA DATI DA FORM -->
    <h2>Eliminazione di una filiale (Punto Vendita)</h2>
    <!-- Con questo form vado a prendere in input dall'utente: CodPV, Indirizzo, Telefono, Citta, DataInizio, Nazione per poi elaborare il tutto successivamente -->
    <div class="d-flex justify-content-center">
        <fieldset>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>#formEliminaPuntiVendita" id="formEliminaPuntiVendita" class="formOperazioniDML">
                <!-- $ _SERVER [ 'PHP_SELF'] è una variabile d'ambiente supportata da tutte le piattaforme che indica il nome del file su cui è attualmente in esecuzione lo script PHP rispetto alla root del Web server.
                                                                                                  In pratica si tratta del nome della pagina corrente; lo puoi utilizzare quando il codice che processa i dati del form si trova nella stessa pagina in cui si trova il form -->
                <div class="form-group">

                    <!-- SELEZIONO IL PUNTO VENDITA D'INTERESSE -->
                    <p>
                        <label for="CodPV">Punto vendita da eliminare:&nbsp; </label>
                        <select name="CodPV" id="CodPV_PuntiVendita" onchange="mostraTabellaPuntoVendita(this.value); hideDiv('divEliminaPuntoVendita_PuntiVendita',this); showDiv('divEliminaPuntoVendita_PuntiVendita',this)">
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


                    <p id="tabellaPuntoVendita"></p>

                    <br>
                    <input type="submit" name="EliminaPV" value="Elimina" />
                    <input type="reset" name="AnnullaPV" value="Annulla" onclick="nascondiElemento('tabellaPuntoVendita')" />
                </div>
            </form>


        </fieldset>
    </div>
    <!-- FINE QUERY DI RACCOLTA DATI DA FORM -->

    <!-- QUERY DI AGGIORNAMENTO -->
    <?php
    // Variabili che mi servono
    $CodPV = null;

    if (isset($_POST['AggiornaPV']) && (isset($_POST["CodPV"])) && (!empty($_POST["CodPV"])) && (strcmp($_POST["CodPV"], $stringaControllo) != 0)) // isset — Determine if a variable is declared and is different than null
    {
        $CodPV = $_POST["CodPV"];


        // COMANDO SQL 
        if ($CodPV != null) {
            // Ci metto solo i campi che mi interessano
            $strSQL = "DELETE FROM  puntivendita WHERE CodPV = '$CodPV' ";

            $risultato = mysqli_query($conn, $strSQL);
            // Controllo del corretto inserimento
            if ($risultato) {
    ?>
                <div class="container divMessaggio">
                    <!-- "d-flex justify-content-center" -->
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Punto vendita eliminato correttamente. </strong>
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
                        <strong>Errore nell'eliminazione del punto vendita </strong>
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
        <div class="container divMessaggio" id="divEliminaPuntoVendita_PuntiVendita">
            <!-- "d-flex justify-content-center" -->
            <div class="alert alert-warning alert-dismissible">
                <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  -->
                <strong>Attenzione! </strong> Devi immettere il codice del punto vendita.
            </div>
        </div>

        <!-- <p class="text-warning"></p> -->
    <?php
    }
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
    <h2>Eliminazione di un dipendente</h2>
    <!-- Con questo form vado a prendere in input dall'utente: Matricola, Cognome, Nome, CodiceFiscale, Qualifica, PuntoVendita dalla tabella dipendenti, per poi elaborare il tutto successivamente -->
    <div class="d-flex justify-content-center">
        <fieldset>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>#formEliminaDipendenti" id="formEliminaDipendenti" class="formOperazioniDML">
                <!-- $ _SERVER [ 'PHP_SELF'] è una variabile d'ambiente supportata da tutte le piattaforme che indica il nome del file su cui è attualmente in esecuzione lo script PHP rispetto alla root del Web server.
                                                                                                         In pratica si tratta del nome della pagina corrente; lo puoi utilizzare quando il codice che processa i dati del form si trova nella stessa pagina in cui si trova il form -->
                <div class="form-group">


                    <p>
                        <label for="Matricola">Scegli la matricola tra quelle esistenti:&nbsp; </label>
                        <!-- SELEZIONO LA MATRICOLA DEL DIPENDENTE DI INTERESSE (in ordine) -->
                        <select name="Matricola" id="Matricola_Dipendenti" onchange="mostraTabellaDipendente(this.value); hideDiv('divEliminaDipendente_Dipendenti',this); showDiv('divEliminaDipendente_Dipendenti',this)">
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

                <p id="tabellaDipendente"></p>



                <br>
                <input type="submit" name="EliminaDipendente" value="Elimina" />
                <input type="reset" name="Annulla" value="Annulla" onclick="nascondiElemento('tabellaDipendente')" />
    </div>
    </form>
    </fieldset>
    </div>
    <!-- FINE QUERY DI RACCOLTA DATI DA FORM -->

    <!-- QUERY DI ELIMINAZIONE -->
    <?php
    $Matricola = null;
    if (isset($_POST['EliminaDipendente']) && (isset($_POST['Matricola'])) && (strcmp($_POST["Matricola"], $stringaControllo) != 0)) // isset — Determine if a variable is declared and is different than null
    {
        $Matricola = $_POST["Matricola"];

        // Comando SQL
        if ($Matricola != null) {
            $strSQL = "DELETE FROM dipendenti WHERE Matricola = '$Matricola'";

            $risultato = mysqli_query($conn, $strSQL);

            // Controllo del corretto inserimento
            if ($risultato) {
    ?>
                <div class="container divMessaggio">
                    <!-- "d-flex justify-content-center" -->
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Dipendente eliminato correttamente. </strong>
                    </div>
                </div>
                <!-- <p class=text-success></p> -->
            <?php

            } else {
            ?>
                <div class="container divMessaggio">
                    <!-- "d-flex justify-content-center" -->
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Errore nell'eliminazione del dipendente.</strong>
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
        <div class="container divMessaggio" id="divEliminaDipendente_Dipendenti">
            <!-- "d-flex justify-content-center" -->
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Attenzione! </strong>Devi immettere la matricola
            </div>
        </div>
        <!-- <p class="text-warning"></p> -->
    <?php
    } //  chiusura else (isset)
    ?>
    <!-- FINE QUERY DI ELIMINAZIONE -->









    <br>
    <br>
    <br>









    <!-- ############################################################################################################################################### -->
    <!-- ############################################################################################################################################### -->
    <!-- ############################################################################################################################################### -->
    <!--  VENDITE  -->
    <!-- QUERY DI RACCOLTA DATI DA FORM -->
    <h2>Eliminazione di una vendita</h2>
    <!-- Con questo form vado a prendere in input dall'utente il codice del modello e la taglia, per poi elaborare il tutto successivamente -->
    <div class="d-flex justify-content-center">
        <fieldset>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>#formEliminaVendite" id="formEliminaVendite" class="formOperazioniDML">
                <!-- $ _SERVER [ 'PHP_SELF'] è una variabile d'ambiente supportata da tutte le piattaforme che indica il nome del file su cui è attualmente in esecuzione lo script PHP rispetto alla root del Web server.
                                                                                                         In pratica si tratta del nome della pagina corrente; lo puoi utilizzare quando il codice che processa i dati del form si trova nella stessa pagina in cui si trova il form -->
                <div class="form-group">

                    <!-- SELEZIONO L'ID DELLA VENDITA DA AGGIORNARE (in ordine) -->
                    <p>
                        <label for="ID">ID della vendita da eliminare: &nbsp;</label>
                        <select name="ID_Vendite" id="ID_Vendite" onchange="mostraTabellaVendita(this.value); hideDiv('divEliminaVendita_Vendite',this); showDiv('divEliminaVendita_Vendite',this)">
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

                    <p id="tabellaVendita"></p>

                    <br>
                    <input type="submit" name="EliminaVendita" value="Elimina" />
                    <input type="reset" name="Annulla" value="Annulla" onclick="nascondiElemento('tabellaVendita')" />
                </div>
            </form>
        </fieldset>
    </div>
    <!-- FINE QUERY DI RACCOLTA DATI DA FORM -->

    <!-- QUERY DI INSERIMENTO -->
    <?php


    // Variabili che mi servono

    $ID_Vendite = null;

    if ((isset($_POST['EliminaVendita'])) && isset($_POST["ID_Vendite"]) && !empty($_POST["ID_Vendite"]) && (strcmp($_POST["ID_Vendite"], $stringaControllo) != 0)) // isset — Determine if a variable is declared and is different than null
    {
        $ID_Vendite = $_POST["ID_Vendite"];


        // Comando SQL

        if ($ID_Vendite != null) {
            // Ci metto solo i campi che mi interessano
            $strSQL = "DELETE FROM vendite WHERE ID = '$ID_Vendite';";
            $risultato = mysqli_query($conn, $strSQL);
            // Controllo del corretto inserimento
            if ($risultato) {
    ?>
                <div class="container divMessaggio">
                    <!-- "d-flex justify-content-center" -->
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Vendita eliminata correttamente</strong>
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
                        <strong>Errore nell'eliminazione della vendita</strong>
                    </div>
                </div>
                <!-- <p class=text-danger></p> -->
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
        <div class="container divMessaggio" id="divEliminaVendita_Vendite">
            <!-- "d-flex justify-content-center" -->
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Attenzione! </strong>Devi immettere l'ID della vendita da eliminare
            </div>
        </div>
        <!-- <p class="text-warning"></p> -->
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
</body>

</html>


<!-- Uso codice Javascript e JQuery nel documento corrente -->
<script>
    $("h2").css("font-weight", "bold");
    $("h2").css("text-align", "center");
    $("p").css("text-align", "center");
    $("p.testoOmbreggiato").css("text-shadow", "2px 2px 5px white");
    // $("fieldset").css("align","center");



    // nascondiElemento: funzione che nasconde un elemento del DOM (in particolare i paragrafi di avvenuta (o non) conferma delle operazioni di DML nelle pagine: inserisci.php, aggiorna.php, elimina.php)
    //                  La richiamo quando sono uscito da un bottone (onmouseout). 
    //                  Durante l'evento click sul pulsante annulla, la tabella di risposta della chiamata Ajax viene "nascosta" 
    function nascondiElemento(elementoDaNascondere) {
        x = document.getElementById(elementoDaNascondere); // ottengo l'elemento di interesse
        if ((x != "---") && (x.style.display == 'none'))
            x.style.display = 'block';
        else {
            document.getElementById(elementoDaNascondere).innerHTML = "";
        } // ci faccio l'operazione che voglio
    }






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
    /*   FUNZIONE AJAX PER SELEZIONE DELL'ID DEL CAPO  */
    /** ############################################## */
    /** ############################################## */

    // Funzione per mostrare dinamicamente i dati del capo tramite AJAX
    function mostraTabellaCapo(str) {
        // Controllo se è selezionato qualcosa
        if (str == "" || str == "---") {
            document.getElementById("tabellaCapo").innerHTML = "";
            return;
        } else {
            // Se è selezionato qualcosa
            // str.style.display = 'block';
            // Creo un nuovo oggetto XMLHttpRequest
            var xmlhttp = new XMLHttpRequest();
            // Creo la funzione che il server deve eseguire quando la risposta del server è pronta
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("tabellaCapo").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "getTabellaCapo.php?q=" + str, true);
            // Invia la richiesta di un file al server
            xmlhttp.send();
        }
    }









    /** ############################################## */
    /** ############################################## */
    /*   FUNZIONE AJAX PER SELEZIONE DEL CODICE DEL MODELLO  */
    /** ############################################## */
    /** ############################################## */

    // Funzione per mostrare dinamicamente i dati del capo tramite AJAX
    function mostraTabellaModello(str) {
        // Controllo se è selezionato qualcosa
        if (str == "" || str == "---") {
            document.getElementById("tabellaModello").innerHTML = "";
            return;
        } else {
            // Creo un nuovo oggetto XMLHttpRequest
            var xmlhttp = new XMLHttpRequest();
            // Creo la funzione che il server deve eseguire quando la risposta del server è pronta
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("tabellaModello").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "getTabellaModello.php?q=" + str, true);
            // Invia la richiesta di un file al server
            xmlhttp.send();
        }
    }













    /** ############################################## */
    /** ############################################## */
    /*   FUNZIONE AJAX PER SELEZIONE DEL CODICE DEL PUNTO VENDITA  */
    /** ############################################## */
    /** ############################################## */

    // Funzione per mostrare dinamicamente i dati del capo tramite AJAX
    function mostraTabellaPuntoVendita(str) {
        // Controllo se è selezionato qualcosa
        if (str == "" || str == "---") {
            document.getElementById("tabellaPuntoVendita").innerHTML = "";
            return;
        } else {
            // Creo un nuovo oggetto XMLHttpRequest
            var xmlhttp = new XMLHttpRequest();
            // Creo la funzione che il server deve eseguire quando la risposta del server è pronta
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("tabellaPuntoVendita").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "getTabellaPuntoVendita.php?q=" + str, true);
            // Invia la richiesta di un file al server
            xmlhttp.send();
        }
    }











    /** ############################################## */
    /** ############################################## */
    /*   FUNZIONE AJAX PER SELEZIONE DELLA MATRICOLA DI UN DIPENDENTE     */
    /** ############################################## */
    /** ############################################## */

    // Funzione per mostrare dinamicamente i dati del capo tramite AJAX
    function mostraTabellaDipendente(str) {
        // Controllo se è selezionato qualcosa
        if (str == "" || str == "---") {
            document.getElementById("tabellaDipendente").innerHTML = "";
            return;
        } else {
            // Creo un nuovo oggetto XMLHttpRequest
            var xmlhttp = new XMLHttpRequest();
            // Creo la funzione che il server deve eseguire quando la risposta del server è pronta
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("tabellaDipendente").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "getTabellaDipendente.php?q=" + str, true);
            // Invia la richiesta di un file al server
            xmlhttp.send();
        }
    }









    /** ############################################## */
    /** ############################################## */
    /*   FUNZIONE AJAX PER SELEZIONE DELL'ID DELLA VENDITA  */
    /** ############################################## */
    /** ############################################## */

    // Funzione per mostrare dinamicamente i dati del capo tramite AJAX
    function mostraTabellaVendita(str) {
        // Controllo se è selezionato qualcosa
        if (str == "" || str == "---") {
            document.getElementById("tabellaVendita").innerHTML = "";
            return;
        } else {
            // Creo un nuovo oggetto XMLHttpRequest
            var xmlhttp = new XMLHttpRequest();
            // Creo la funzione che il server deve eseguire quando la risposta del server è pronta
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("tabellaVendita").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "getTabellaVendita.php?q=" + str, true);
            // Invia la richiesta di un file al server
            xmlhttp.send();
        }
    }
</script>
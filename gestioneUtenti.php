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
    <title>Gestione Utenti</title>
    <link rel="stylesheet" href="radio.css">
</head>

<body>
    <?php
    navbar();
    ?>

    <?php
    // Popolo la lista degli utenti: leggo da file e aggiungo in testa ad ogni refresh della pagina
    $listaUtenti =  caricaListaUtenti();
    // $listaUtenti->stampaLista();
    // print_r($listaUtenti);
    ?>


    <div class="row">

        <div class="col-md-6" class="paddingColonneGestioneUtenti">
            <div class="col-md-12">
                <form action="" class="formOperazioniDML formRadio">
                    <h4 style="text-align: left;">Scegli l'operazione da fare:</h2>
                        <p>
                            <label for="prova">Inserisci utente</label>
                            <input type="radio" name="prova" id="">
                        </p>
                        <p>
                            <label for="prova">Aggiorna utente</label>
                            <input type="radio" name="prova" id="">
                        </p>
                        <p>
                            <label for="prova">Elimina utente</label>
                            <input type="radio" name="prova" id="">
                        </p>
                </form>
                <!-- fine radio button -->



                <!-- FORM INSERIMENTO UTENTE -->
                <h2>Inserimento nuovo Utente</h2>
                <div class="d-flex  justify-content-center">
                    <fieldset>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>#formInserisciUtenti" name="formInserisciUtente" class="formOperazioniDML">
                            <div class="form-group">
                                <!-- class=" formOperazioniDML" -->
                                <p>
                                    <!-- Username -->
                                    <label for="UsernameUtente">Username dell'utente da inserire</label>
                                    <input type="text" name="UsernameUtente" id="UsernameUtente" onchange="hideDiv('divInserisciUsername_Utenti',this); showDiv('divInserisciUsername_Utenti',this)">
                                </p>

                                <p>
                                    <!-- Password -->
                                    <label for="PasswordUtente">Inserire la password dell'utente da inserire</label>
                                    <input type="password" name="PasswordUtente" id="PasswordUtente" onchange="hideDiv('divInserisciPassword_Utenti',this); showDiv('divInserisciPassword_Utenti',this)">
                                </p>

                                <p>
                                    <!-- Nome -->
                                    <label for="NomeUtente">Nome dell'utente da inserire</label>
                                    <input type="text" name="NomeUtente" id="NomeUtente" onchange="hideDiv('divInserisciNome_Utenti',this); showDiv('divInserisciNome_Utenti',this)">
                                </p>

                                <p>
                                    <!-- Cognome -->
                                    <label for="CognomeUtente">Cognome dell'utente da inserire</label>
                                    <input type="text" name="CognomeUtente" id="CognomeUtente" onchange="hideDiv('divInserisciCognome_Utenti',this); showDiv('divInserisciCognome_Utenti',this)">
                                </p>

                                <!-- Commento -->
                                <p>
                                    <label for="CommentoUtente" style="text-align: left;">Commento dell'utente da inserire</label>
                                </p>
                                <p>
                                    <textarea name="CommentoUtente" id="CommentoUtente" onchange="hideDiv('divInserisciCommento_Utenti',this); showDiv('divInserisciCommento_Utenti',this)"></textarea>
                                </p>

                                <p>
                                    <!-- Voto -->
                                    <label for="VotoUtente">Voto dell'utente da inserire</label>
                                    <input type="number" name="VotoUtente" id="VotoUtente" min="1" max="5" onchange="hideDiv('divInserisciVoto_Utenti',this); showDiv('divInserisciVoto_Utenti',this)">
                                </p>

                                <p>
                                    <!-- Inserisci -->
                                    <input type="submit" value="Inserisci" name="InserisciUtente">
                                    <!-- Annulla -->
                                    <input type="reset" value="Annulla" name="Annulla">
                                </p>
                            </div> <!-- fine div for-group -->
                        </form>
                    </fieldset>
                </div>


                <?php
                // Variabili che mi servono
                // Creo un nuovo oggetto U di tipo Utente e gli assegno come valori al suo costruttore quelli appena letti (campo dato del nodo da inserire)
                $U = new UtenteOrdinario('', '', '', '', '', 0);
                if (isset($_POST['InserisciUtente'])) {

                    // Controllo Username
                    if (isset($_POST['UsernameUtente']) && !empty($_POST['UsernameUtente']) && strcmp($_POST['UsernameUtente'], $stringaControllo) != 0) {
                        // Se non esiste alcun utente con questo username (se non lo trovo nell lista degli utenti)
                        if ($listaUtenti->ricercaUsername($_POST['UsernameUtente']) == false) {
                            $U->Username = $_POST['UsernameUtente']; // Allora gli passo il giusto Username
                        } else {
                ?>
                            <div class="container divMessaggio" id="divInserisciUsername_Utenti">
                                <!-- "d-flex justify-content-center" -->
                                <div class="alert alert-warning alert-dismissible">
                                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Bottone che serve per chiudere il warning -->
                                    <strong>Attenzione!</strong> Username gi&agrave; inserito!
                                </div>
                            </div>
                        <?php
                        }
                    }


                    // Controllo Password
                    if (isset($_POST['PasswordUtente']) && !empty($_POST['PasswordUtente'])) {
                        $U->Password = $_POST['PasswordUtente']; // Allora gli passo il giusto Username
                    } else {
                        ?>
                        <div class="container divMessaggio" id="divInserisciPassword_Utenti">
                            <!-- "d-flex justify-content-center" -->
                            <div class="alert alert-warning alert-dismissible">
                                <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Bottone che serve per chiudere il warning -->
                                <strong>Attenzione!</strong> Inserire una password valida
                            </div>
                        </div>
                    <?php
                    }


                    // Controllo Nome
                    if (isset($_POST['NomeUtente']) && !empty($_POST['NomeUtente'])) {
                        $U->Nome = $_POST['NomeUtente'];
                    } else {
                    ?>
                        <div class="container divMessaggio" id="divInserisciNome_Utenti">
                            <!-- "d-flex justify-content-center" -->
                            <div class="alert alert-warning alert-dismissible">
                                <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Bottone che serve per chiudere il warning -->
                                <strong>Attenzione!</strong> Devi inserire il nome dell'utente
                            </div>
                        </div>
                    <?php
                    }

                    // Controllo Cognome
                    if (isset($_POST['CognomeUtente']) && !empty($_POST['CognomeUtente'])) {
                        $U->Cognome = $_POST['CognomeUtente'];
                    } else {
                    ?>
                        <div class="container divMessaggio" id="divInserisciCognome_Utenti">
                            <!-- "d-flex justify-content-center" -->
                            <div class="alert alert-warning alert-dismissible">
                                <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Bottone che serve per chiudere il warning -->
                                <strong>Attenzione!</strong> Devi inserire il cognome dell'utente
                            </div>
                        </div>
                    <?php
                    }


                    // Controllo Commento
                    if (isset($_POST['CommentoUtente']) && !empty($_POST['CommentoUtente'])) {
                        $U->Commento = $_POST['CommentoUtente'];
                    } else {
                    ?>
                        <div class="container divMessaggio" id="divInserisciCommento_Utenti">
                            <!-- "d-flex justify-content-center" -->
                            <div class="alert alert-warning alert-dismissible">
                                <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Bottone che serve per chiudere il warning -->
                                <strong>Attenzione!</strong> Inserisci un feedback dell'utente
                            </div>
                        </div>
                    <?php
                    }


                    // Controllo Voto
                    if (isset($_POST['VotoUtente']) && !empty($_POST['VotoUtente'])) {
                        if ($_POST['VotoUtente'] >= 1 && $_POST['VotoUtente'] <= 5)
                            $U->Voto = $_POST['VotoUtente'];
                    } else {
                    ?>
                        <div class="container divMessaggio" id="divInserisciVoto_Utenti">
                            <!-- "d-flex justify-content-center" -->
                            <div class="alert alert-warning alert-dismissible">
                                <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Bottone che serve per chiudere il warning -->
                                <strong>Attenzione!</strong> Devi esprimere un voto da 1 a 5
                            </div>
                        </div>
                    <?php
                    }

                    // INSERIMENTO
                    if ($U != null && (strcmp($U->Username, '') != 0) && (strcmp($U->Password, '') != 0) && (strcmp($U->Nome, '') != 0)  && (strcmp($U->Cognome, '') != 0) && (strcmp($U->Commento, '') != 0) && ($U->Voto != 0)) { // Se l'oggetto $U non è null
                        echo "<br>". $U->Password . "<br>";
                        echo "<br>". $_POST["PasswordUtente"] . "<br>";
                        // Apro il file in aggiunta
                        $fp = fopen("feedback.txt", "a") or die("Non riesco ad aprire il file: feedback.txt!");
                        // Lo salvo nel file
                        fwrite($fp, "\n" . $U);
                        fclose($fp);
                        // Lo inserisco in testa alla lista!
                        $listaUtenti->insTesta($U);
                        // $listaUtenti->insOrdinato($U);

                    ?>
                        <div class="container divMessaggio">
                            <div class="alert alert-success alert-dismissible">
                                <!-- style="display:inline-block;" -->
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Nuovo Utente Inserito correttamente</strong>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="container divMessaggio">
                            <div class="alert alert-danger alert-dismissible">
                                <!-- style="display:inline-block;" -->
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Errore nell'inserimento dell'utente</strong>
                            </div>
                        </div>
                    <?php
                    }
                } // fine (isset) bottone invia
                else {
                    ?>
                    <div class="container divMessaggio">
                        <div class="alert alert-warning alert-dismissible">
                            <!-- style="display:inline-block;" -->
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Attenzione! </strong>Devi compilare tutti i campi.
                        </div>
                    </div>
                    <!-- <p class="text-warning">Devi prima inserire almeno un dipendente ed un capo d'abbigliamento</p> -->
                <?php
                } // fine else (isset)


                ?>

























                <!-- FORM AGGIORNAMENTO UTENTE -->
                <h2>Aggiornamento di un Utente</h2>
                <div class="d-flex justify-content-center">
                    <fieldset>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>#formAggiornaUtenti" name="formAggiornaUtente" class="formOperazioniDML">
                            <div class="form-group">
                                <p>
                                    <!-- Username -->
                                    <label for="UsernameUtente">Seleziona lo username dell'utente da aggiornare</label>&nbsp;
                                    <!-- <select type="text" name="UsernameUtente" id="UsernameUtente" onchange="hideDiv('divInserisciUsername_Utenti',this); showDiv('divInserisciUsername_Utenti',this)"> -->
                                    <select name="AggiornaUsername" id="AggiornaUsername" onchange="hideDiv('divAggiornaUsername_Utenti',this); showDiv('divAggiornaUsername_Utenti',this)">
                                        <option>---</option>
                                        <?php
                                        //$temp = new Nodo();
                                        $temp = $listaUtenti->head;
                                        while ($temp != null) {
                                            echo "<option value=\"" . $temp->dato->Username . "\">" . $temp->dato->Username . "</option> \n";
                                            $temp = $temp->next;
                                        }
                                        ?>
                                    </select>

                                </p>

                                <p>
                                    <!-- Password -->
                                    <label for="PasswordUtente">Password dell'utente da aggiornare</label>
                                    <input type="password" name="AggiornaPasswordUtente" id="AggiornaNomeUtente" onchange="hideDiv('divAggiornaPassword_Utenti',this); showDiv('divInserisciNome_Utenti',this)">
                                </p>


                                <p>
                                    <!-- Nome -->
                                    <label for="NomeUtente">Nome dell'utente da aggiornare</label>
                                    <input type="text" name="AggiornaNomeUtente" id="AggiornaNomeUtente" onchange="hideDiv('divAggiornaNome_Utenti',this); showDiv('divInserisciNome_Utenti',this)">
                                </p>

                                <p>
                                    <!-- Cognome -->
                                    <label for="CognomeUtente">Cognome dell'utente da aggiornare</label>
                                    <input type="text" name="AggiornaCognomeUtente" id="AggiornaCognomeUtente" onchange="hideDiv('divAggiornaCognome_Utenti',this); showDiv('divInserisciCognome_Utenti',this)">
                                </p>

                                <p>
                                    <!-- Commento -->
                                    <label for="CommentoUtente">Commento dell'utente da aggiornare</label>
                                </p>
                                <p>
                                    <textarea name="AggiornaCommentoUtente" id="AggiornaCommentoUtente" onchange="hideDiv('divAggiornaCommento_Utenti',this); showDiv('divInserisciCommento_Utenti',this)"></textarea>
                                </p>

                                <p>
                                    <!-- Voto -->
                                    <label for="VotoUtente">Voto dell'utente da aggiornare</label>
                                    <input type="number" name="AggiornaVotoUtente" id="AggiornaVotoUtente" min="1" max="5" onchange="hideDiv('divAggiornaVoto_Utenti',this); showDiv('divInserisciVoto_Utenti',this)">
                                </p>

                                <p>
                                    <!-- Aggiorna -->
                                    <input type="submit" value="Aggiorna" name="AggiornaUtente">
                                    &nbsp;&nbsp;
                                    <!-- Annulla -->
                                    <input type="reset" value="Annulla" name="Annulla">
                                </p>
                        </form>
                    </fieldset>
                </div>



                <?php
                // Sentinelle per verificare che gli input dell'utente siano non null non vuoti (e che rispettino alcune loro specifiche)
                $okUsername = false;
                $okPassword = false;
                $okNome = false;
                $okCognome = false;
                $okCommento = false;
                $okVoto = false;

                if (isset($_POST["AggiornaUtente"])) {

                    // Controllo Username
                    if (isset($_POST['AggiornaUsername']) && strcmp($_POST['AggiornaUsername'], $stringaControllo) != 0) {
                        $okUsername = true;
                    } else {
                ?>
                        <div class="container divMessaggio" id="divAggiornaUsername_Utenti">
                            <!-- "d-flex justify-content-center" -->
                            <div class="alert alert-warning alert-dismissible">
                                <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Bottone che serve per chiudere il warning -->
                                <strong>Attenzione!</strong> Devi selezionare lo username dell'utente da aggiornare.
                            </div>
                        </div>
                    <?php
                    }

                    // Controllo Password

                    if (isset($_POST['AggiornaPasswordUtente']) && !empty($_POST['AggiornaPasswordUtente'])) {
                        $okPassword = true;
                    } else {
                    ?>
                        <div class="container divMessaggio" id="divAggiornaNome_Utenti">
                            <!-- "d-flex justify-content-center" -->
                            <div class="alert alert-warning alert-dismissible">
                                <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Bottone che serve per chiudere il warning -->
                                <strong>Attenzione!</strong> Devi inserire la password dell'utente da aggiornare.
                            </div>
                        </div>
                    <?php
                    }





                    // Controllo Nome
                    if (isset($_POST['AggiornaNomeUtente']) && !empty($_POST['AggiornaNomeUtente'])) {
                        $okNome = true;
                    } else {
                    ?>
                        <div class="container divMessaggio" id="divAggiornaNome_Utenti">
                            <!-- "d-flex justify-content-center" -->
                            <div class="alert alert-warning alert-dismissible">
                                <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Bottone che serve per chiudere il warning -->
                                <strong>Attenzione!</strong> Devi inserire il nome dell'utente da aggiornare.
                            </div>
                        </div>
                    <?php
                    }

                    // Controllo Cognome
                    if (isset($_POST['AggiornaCognomeUtente']) && !empty($_POST['AggiornaCognomeUtente'])) {
                        $okCognome = true;
                    } else {
                    ?>
                        <div class="container divMessaggio" id="divAggiornaCognome_Utenti">
                            <!-- "d-flex justify-content-center" -->
                            <div class="alert alert-warning alert-dismissible">
                                <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Bottone che serve per chiudere il warning -->
                                <strong>Attenzione!</strong> Devi inserire il cognome dell'utente da aggiornare.
                            </div>
                        </div>
                    <?php
                    }


                    // Controllo Commento
                    if (isset($_POST['AggiornaCommentoUtente']) && !empty($_POST['AggiornaCommentoUtente'])) {
                        $okCommento = true;
                    } else {
                    ?>
                        <div class="container divMessaggio" id="divAggiornaCommento_Utenti">
                            <!-- "d-flex justify-content-center" -->
                            <div class="alert alert-warning alert-dismissible">
                                <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Bottone che serve per chiudere il warning -->
                                <strong>Attenzione!</strong> Aggiorna il feedback dell'utente selezionato.
                            </div>
                        </div>
                    <?php
                    }


                    // Controllo Voto
                    if (isset($_POST['AggiornaVotoUtente']) && !empty($_POST['AggiornaVotoUtente'])) {
                        if ($_POST['AggiornaVotoUtente'] >= 1 && $_POST['AggiornaVotoUtente'] <= 5) {
                            $okVoto = true;
                        }
                    } else {
                    ?>
                        <div class="container divMessaggio" id="divAggiornaVoto_Utenti">
                            <!-- "d-flex justify-content-center" -->
                            <div class="alert alert-warning alert-dismissible">
                                <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Bottone che serve per chiudere il warning -->
                                <strong>Attenzione!</strong> Devi esprimere un voto da 1 a 5
                            </div>
                        </div>
                    <?php
                    }


                    //AGGIORNAMENTO
                    if (($okUsername == true) && ($okPassword == true) && ($okNome == true) && ($okCognome == true) && ($okCommento == true) && ($okVoto == true)) {
                        $lineaDaAggiornare = $listaUtenti->aggiornaUtente($_POST["AggiornaUsername"], $_POST["AggiornaNomeUtente"], $_POST["AggiornaCognomeUtente"], $_POST["AggiornaCommentoUtente"], $_POST["AggiornaVotoUtente"]);
                        // $lineaDaAggiornare = $lineaDaAggiornare->dato->__toString();
                        $lettura = fopen('feedback.txt', 'r');
                        $scrittura = fopen('feedback.tmp', 'w');

                        $aggiornata = false;

                        while (!feof($lettura)) {
                            // Ottengo la linea 
                            $linea = fgets($lettura);
                            // Se nella linea, trovo una determinata parola
                            if (stristr($linea, $lineaDaAggiornare->dato->Username)) {
                                // Allora sostituiscila
                                $linea = $lineaDaAggiornare->dato->__toString() . "\n";
                                $aggiornata = true;
                            }
                            // In questa linea ci metto la nuova linea appena aggiornata
                            fputs($scrittura, $linea);
                        }
                        fclose($lettura);
                        fclose($scrittura);
                        // Se non ho trovato niente, allora non sostituisco (non sovrascrivo il file)
                        if ($aggiornata) {
                            rename('feedback.tmp', 'feedback.txt');
                        } else {
                            // Quindi, se non ho trovato niente, allora elimino il file in cui ho scritto
                            unlink('feedback.tmp');
                        }

                    ?>
                        <div class="container divMessaggio">
                            <div class="alert alert-success alert-dismissible">
                                <!-- style="display:inline-block;" -->
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Utente Aggiornato correttamente</strong>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="container divMessaggio">
                            <div class="alert alert-danger alert-dismissible">
                                <!-- style="display:inline-block;" -->
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Errore nell'aggiornamento dell'utente</strong>
                            </div>
                        </div>
                    <?php

                    }
                } // fine if (isset) 
                else {
                    ?>
                    <div class="container divMessaggio">
                        <div class="alert alert-warning alert-dismissible">
                            <!-- style="display:inline-block;" -->
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Attenzione! </strong>Devi compilare tutti i campi.
                        </div>
                    </div>
                    <!-- <p class="text-warning">Devi prima inserire almeno un dipendente ed un capo d'abbigliamento</p> -->
                <?php
                } // fine else (isset)

                ?>






























                <!-- FORM ELIMINAZIONE UTENTE -->
                <h2>Eliminazione di un Utente</h2>

                <div class="d-flex justify-content-center">
                    <fieldset>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>#formEliminaUtenti" name="formEliminaUtenti" class="formOperazioniDML">
                            <div class="form-group">
                                <p>
                                    <!-- Username -->
                                    <label for="UsernameUtente">Seleziona lo username dell'utente da eliminare</label>&nbsp;
                                    <!-- <select type="text" name="UsernameUtente" id="UsernameUtente" onchange="hideDiv('divInserisciUsername_Utenti',this); showDiv('divInserisciUsername_Utenti',this)"> -->
                                    <select name="EliminaUsername" id="EliminaUsername" onchange=" mostraTabellaUtente(this.value); hideDiv('divEliminaUsername_Utenti',this); showDiv('divEliminaUsername_Utenti',this)">
                                        <option>---</option>
                                        <?php
                                        //$temp = new Nodo();
                                        $temp = $listaUtenti->head;
                                        while ($temp != null) {
                                            echo "<option value=\"" . $temp->dato->Username . "\">" . $temp->dato->Username . "</option> \n";
                                            $temp = $temp->next;
                                        }
                                        ?>
                                    </select>
                                </p>


                                <p id="tabellaUtente"></p>


                                <p>
                                    <!-- Elimina -->
                                    <input type="submit" value="Elimina" name="EliminaUtente">&nbsp;&nbsp;
                                    <!-- Annulla -->
                                    <input type="reset" value="Annulla" name="Annulla" onclick="nascondiElemento('tabellaUtente')">

                                </p>
                        </form>
                    </fieldset>
                </div>

                <?php

                if (isset($_POST["EliminaUtente"])) {

                    // Controllo Username
                    if (isset($_POST['EliminaUsername']) && strcmp($_POST['EliminaUsername'], $stringaControllo) != 0) {
                        $okUsername = true;
                    } else {
                ?>
                        <div class="container divMessaggio" id="divEliminaUsername_Utenti">
                            <!-- "d-flex justify-content-center" -->
                            <div class="alert alert-warning alert-dismissible">
                                <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Bottone che serve per chiudere il warning -->
                                <strong>Attenzione!</strong> Devi selezionare lo username dell'utente da aggiornare.
                            </div>
                        </div>
                    <?php
                    }

                    // ELIMINAZIONE
                    if ($okUsername == true) {
                        $lineaDaEliminare =  $listaUtenti->ricercaUtente($_POST["EliminaUsername"]);
                        $listaUtenti->eliminaUtente($_POST["EliminaUsername"]);

                        $lettura = fopen('feedback.txt', 'r');
                        $scrittura = fopen('feedback.tmp', 'w');

                        $eliminata = false;
                        while (!feof($lettura)) {
                            // Ottengo la linea 
                            $linea = fgets($lettura);
                            // Se nella linea, trovo una determinata parola
                            if (stristr($linea, $lineaDaEliminare->dato->Username)) {
                                // Allora sostituiscila con la stringa vuota
                                $linea = "";
                                $eliminata = true;
                            }
                            // In questa linea ci metto la nuova linea appena aggiornata
                            fputs($scrittura, $linea);
                        }
                        fclose($lettura);
                        fclose($scrittura);
                        // Se non ho trovato niente, allora non sostituisco (non sovrascrivo il file)
                        if ($eliminata) {
                            rename('feedback.tmp', 'feedback.txt');
                        } else {
                            // Quindi, se non ho trovato niente, allora elimino il file in cui ho scritto
                            unlink('feedback.tmp');
                        }

                    ?>
                        <div class="container divMessaggio">
                            <div class="alert alert-success alert-dismissible">
                                <!-- style="display:inline-block;" -->
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Utente eliminato correttamente</strong>.
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="container divMessaggio">
                            <div class="alert alert-danger alert-dismissible">
                                <!-- style="display:inline-block;" -->
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Errore nell'eliminazione dell'utente</strong>
                            </div>
                        </div>
                    <?php
                    }
                } // fine if (isset)
                else {
                    ?>
                    <div class="container divMessaggio">
                        <div class="alert alert-warning alert-dismissible">
                            <!-- style="display:inline-block;" -->
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Attenzione! </strong>Devi compilare tutti i campi.
                        </div>
                    </div>
                    <!-- <p class="text-warning">Devi prima inserire almeno un dipendente ed un capo d'abbigliamento</p> -->
                <?php
                } // fine else (isset)
                ?>
            </div><!-- fine div col-md 12 -->
        </div> <!-- fine div col-md 6 -->


        <div class="col-md-6">
            <div class="col-md-12">
                <!-- VISUALIZZA LISTA UTENTI -->
                <h2 id="titolo1"> LISTA UTENTI </h2>

                <table id='tabellaUtenti' class="table table-center lista-responsive">
                    <thead id="thead1">
                        <tr>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>Commento</th>
                            <th>Voto</th>
                        </tr>
                    </thead>
                    <!-- Corpo della tabella -->
                    <tbody>
                        <?php
                        // Preservo la testa della lista, sempre!!
                        $temp = $listaUtenti->head;
                        while ($temp != null) { // Finchè la lista di utenti è diversa da NULL
                        ?>
                            <!-- Crea una nuova riga -->
                            <tr>
                                <!-- Singolo elemento della riga -->
                                <td>
                                    <?php
                                    echo $temp->dato->getUsername();
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $temp->dato->getPassword();
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $temp->dato->getNome();
                                    ?>
                                </td>
                                <td>

                                    <?php
                                    echo $temp->dato->getCognome();
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $temp->dato->getCommento();
                                    ?>
                                </td>
                                <td>
                                    <?php

                                    switch ($temp->dato->getVoto()) {
                                        case 1:
                                    ?>
                                            <svg viewBox="0 0 24 24" width="45%" height="45%">
                                                <path d="M12,2C6.47,2 2,6.47 2,12C2,17.53 6.47,22 12,22A10,10 0 0,0 22,12C22,6.47 17.5,2 12,2M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1

12,20M16.18,7.76L15.12,8.82L14.06,7.76L13,8.82L14.06,9.88L13,10.94L14.06,12L15.12,10.94L16.18,12L17.24,10.94L16.18,9.88L17.24,8.82L16.18,7.76M7.82,12L8.88,10.94L9.94,12L11,10.94L9.94,9.88L11,8.82L9.94,7.76L8.88,8.82L7.82,7.76L6.76,8.82L7.82,9.88L6.76,10.94L7.82,12M12,14C9.67,14 7.69,15.46 6.89,17.5H17.11C16.31,15.46 14.33,14 12,14Z" />
                                            </svg>
                                        <?php
                                            break;
                                        case 2:
                                        ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="45%" height="45%" viewBox="0 0 24 24">
                                                <path d="M20,12A8,8 0 0,0 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12M22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2A10,10 0 0,1 22,12M15.5,8C16.3,8 17,8.7 17,9.5C17,10.3 16.3,11 15.5,11C14.7,11 14,10.3 14,9.5C14,8.7 14.7,8 15.5,8M10,9.5C10,10.3 9.3,11 8.5,11C7.7,11 7,10.3 7,9.5C7,8.7 7.7,8 8.5,8C9.3,8 10,8.7 10,9.5M12,14C13.75,14 15.29,14.72 16.19,15.81L14.77,17.23C14.32,16.5 13.25,16 12,16C10.75,16 9.68,16.5 9.23,17.23L7.81,15.81C8.71,14.72 10.25,14 12,14Z" />
                                            </svg>
                                        <?php
                                            break;
                                        case 3:
                                        ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="45%" height="45%" viewBox="0 0 24 24">
                                                <path d="M8.5,11A1.5,1.5 0 0,1 7,9.5A1.5,1.5 0 0,1 8.5,8A1.5,1.5 0 0,1 10,9.5A1.5,1.5 0 0,1 8.5,11M15.5,11A1.5,1.5 0 0,1 14,9.5A1.5,1.5 0 0,1 15.5,8A1.5,1.5 0 0,1 17,9.5A1.5,1.5 0 0,1 15.5,11M12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22C6.47,22 2,17.5 2,12A10,10 0 0,1 12,2M9,14H15A1,1 0 0,1 16,15A1,1 0 0,1 15,16H9A1,1 0 0,1 8,15A1,1 0 0,1 9,14Z" />
                                            </svg>

                                        <?php
                                            break;
                                        case 4:
                                        ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="45%" height="45%" viewBox="0 0 24 24">
                                                <path d="M20,12A8,8 0 0,0 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12M22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2A10,10 0 0,1 22,12M10,9.5C10,10.3 9.3,11 8.5,11C7.7,11 7,10.3 7,9.5C7,8.7 7.7,8 8.5,8C9.3,8 10,8.7 10,9.5M17,9.5C17,10.3 16.3,11 15.5,11C14.7,11 14,10.3 14,9.5C14,8.7 14.7,8 15.5,8C16.3,8 17,8.7 17,9.5M12,17.23C10.25,17.23 8.71,16.5 7.81,15.42L9.23,14C9.68,14.72 10.75,15.23 12,15.23C13.25,15.23 14.32,14.72 14.77,14L16.19,15.42C15.29,16.5 13.75,17.23 12,17.23Z" />
                                            </svg>

                                        <?php
                                            break;
                                        case 5:
                                        ?>
                                            <svg viewBox="0 0 24 24" width="45%" height="45%">
                                                <path d="M12,17.5C14.33,17.5 16.3,16.04 17.11,14H6.89C7.69,16.04 9.67,17.5 12,17.5M8.5,11A1.5,1.5 0 0,0 10,9.5A1.5,1.5 0 0,0 8.5,8A1.5,1.5 0 0,0 7,9.5A1.5,1.5 0 0,0 8.5,11M15.5,11A1.5,1.5 0 0,0 17,9.5A1.5,1.5 0 0,0 15.5,8A1.5,1.5 0 0,0 14,9.5A1.5,1.5 0 0,0 15.5,11M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20M12,2C6.47,2 2,6.5 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                                            </svg>

                                    <?php
                                            break;

                                        default:
                                            # code...
                                            break;
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php
                            // Passa al prossimo elemento
                            $temp = $temp->next;
                        } // chiudo il while aperto prima
                        ?>

                    </tbody>
                </table>
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                        <div class="callout callout-info divCallout" id="calloutUtente">
                            <h4>Lista Utenti</h4>
                            Per rappresentare il feedback dei singoli utenti
                        </div>
                    </div>
                </div>
                <!-- FINE LISTA UTENTI -->

            </div> <!-- fine div col-md 12 -->
        </div> <!-- fine div col-md 6 -->
    </div>

    <?php
    // $listaUtenti->stampaLista();
    // print_r($listaUtenti);
    ?>





























































    <?php
    footer();
    ?>
</body>

</html>

<script>
    $(document).ready(function() {
        // Aggiungo a tutte le tabelle con id "#table-centerN" le classi contenute in addClass(...)
        $("#tabellaUtenti").addClass("table mx-auto w-auto stileTabelle");

        // Applico a tutti gli h2 lo stile grassetto
        $("h2").css("font-weight", "bold");
        $("h2").css("text-align", "center");
    });


    // Eventi con i callout:
    $(function() {
        // All'evento click sull'elemento di id #tabellaUtenti
        $("#tabellaUtenti").click(function() {
            // Mostra il callout con id #calloutUtente
            $("#calloutUtente").show();
            $("#calloutUtente").fadeIn(); // "slow"
        }).dblclick(function() {
            $("#calloutUtente").fadeOut("slow"); // "fast"
        });
    })



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








    /** ########################################################## */
    /** ########################################################## */
    /*   CHIAMATA AJAX PER SELEZIONE DELL'ID DELLA VENDITA  */
    /** ########################################################## */
    /** ############################################## ############*/

    $('#AggiornaUsername').change(function() {

        var utente = $('#AggiornaUsername').val();
        // Se id è deverso da stringa vuota
        if (utente != '') {
            // Chiamata ajax
            $.ajax({
                // A cui passo alcuni parametri
                url: "getUtente.php",
                method: "POST",
                data: {
                    utente: utente
                },
                dataType: "json",
                // Nel caso di successo
                success: function(data) {
                    console.log("Sono dentro a successo");
                    // Scrivo sugli elementi del DOM aventi quegli id
                    $('#AggiornaNomeUtente').val(data.Nome);
                    $('#AggiornaCognomeUtente').val(data.Cognome);
                    $('#AggiornaCommentoUtente').val(data.Commento);
                    $('#AggiornaVotoUtente').val(data.Voto);
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

















    /** ############################################## */
    /** ############################################## */
    /*   FUNZIONE AJAX PER SELEZIONE DELLO USERNAME DELL'UTENTE */
    /** ############################################## */
    /** ############################################## */

    // Funzione per mostrare dinamicamente i dati del capo tramite AJAX
    function mostraTabellaUtente(str) {
        // Controllo se è selezionato qualcosa
        if (str == "" || str == "---") {
            document.getElementById("tabellaUtente").innerHTML = "";
            return;
        } else {
            // Creo un nuovo oggetto XMLHttpRequest
            var xmlhttp = new XMLHttpRequest();
            // Creo la funzione che il server deve eseguire quando la risposta del server è pronta
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("tabellaUtente").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "getTabellaUtente.php?q=" + str, true);
            // Invia la richiesta di un file al server
            xmlhttp.send();
        }
    }
</script>
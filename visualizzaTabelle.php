<!-- In questa pagina sono riportate tutte le tabelle -->
<!-- Includo le istruzioni per la connessione scritte nel file: 'connessione.php' 
     Includo le istruzioni per le funzioni, da richiamare in ogni pagina
-->
<?php
include_once('connessione.php');
include_once('funzioni.php');
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <?php
    head();  // Richiamo la funzione head()
    ?>
    <title>Visualizzazione Tabelle del Database</title>

</head>

<body>
    <?php
    navbar(); // Richiamo la funzione navbar()
    ?>


    <!-- TABELLA CAPI -->
    <h2 id="titolo1"> CAPI </h2>
    <!-- Costruisco la tabella di visualizzazione della query -->
    <!-- Intestazione della tabella -->
    <table id='table-center1' class="table">
        <thead id="thead1">
            <tr>
                <th>ID Capo</th>
                <th>Taglia</th>
                <th>Colore</th>
                <th>PuntoVendita</th>
                <th>Modello</th>
            </tr>
        </thead>
        <!-- Corpo della tabella -->
        <tbody>
            <?php
            // Comando SQL
            $strSQL = "SELECT * FROM capi ORDER BY ID;"; // Semplice Query di visualizzazione
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

        </tbody>
    </table>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="callout callout-info divCallout" id="calloutCapo">
                <h4>Tabella Capi</h4>
                Per rappresentare i singoli capi di abbigliamento in vendita nei negozi;
            </div>
        </div>
    </div>
    <!-- FINE TABELLA CAPI -->

    <br>



    <!-- #########################################################################################################################################  -->



    <!-- TABELLA DIPENDENTI -->
    <h2 id="titolo2"> DIPENDENTI </h2>
    <table id='table-center2' class="table">
        <thead>
            <tr>
                <th>Matricola</th>
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
            $strSQL = "SELECT * FROM dipendenti ORDER BY Matricola;"; // Semplice Query di visualizzazione
            $risultato = mysqli_query($conn, $strSQL);
            while ($riga = mysqli_fetch_array($risultato)) {
            ?>
                <!-- Riga della tabella -->
                <tr>
                    <!-- Singolo elemento della riga -->
                    <td>
                        <?php
                        echo $riga['Matricola'];
                        ?>
                    </td>
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

        </tbody>
    </table>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="callout callout-info divCallout" id="calloutDipendente">
                <h4>Tabella Dipendente</h4>
                Per rappresentare il personale impiegato presso i vari punti vendita della società;
            </div>
        </div>
    </div>
    <!-- FINE TABELLA DIPENDENTI -->
    <br>



    <!-- #########################################################################################################################################  -->



    <!-- TABELLA MODELLI -->
    <h2 id="titolo3">MODELLI</h2>
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
            $strSQL = "SELECT * FROM modelli ORDER BY CodModello;"; // Semplice Query di visualizzazione
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
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="callout callout-info divCallout" id="calloutModello">
                <h4>Tabella Modello</h4>
                Per rappresentare i modelli di abbigliamento;
            </div>
        </div>
    </div>
    <!-- FINE TABELLA MODELLI -->
    <br>



    <!-- #########################################################################################################################################  -->



    <!-- TABELLA PUNTI VENDITA -->
    <h2 id="titolo4">PUNTI VENDITA </h2>
    <table id='table-center4' class="table">
        <thead>
            <tr>
                <th>Codice PV</th>
                <th>Indirizzo</th>
                <th>Telefono</th>
                <th>Città</th>
                <th>Data inizio</th>
                <th>Nazione</th>
            </tr>
        </thead>
        <!-- Corpo della tabella -->
        <tbody>
            <?php
            // Comando SQL
            $strSQL = "SELECT * FROM puntivendita ORDER BY CodPV;"; // Semplice Query di visualizzazione
            $risultato = mysqli_query($conn, $strSQL);
            while ($riga = mysqli_fetch_array($risultato)) {
            ?>
                <!-- Riga della tabella -->
                <tr>
                    <!-- Singolo elemento della riga -->
                    <td>
                        <?php
                        echo $riga['CodPV'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $riga['Indirizzo'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $riga['Telefono'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $riga['Citta'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $riga['DataInizio'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $riga['Nazione'];
                        ?>
                    </td>
                </tr>
                <!-- Alla fine di tutto, quando lavoro col PHP devo sempre mettere questo -->
            <?php
            } // chiudo il while aperto prima
            ?>
        </tbody>
    </table>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="callout callout-info divCallout" id="calloutPuntoVendita">
                <h4>Tabella PuntoVendita</h4>
                Per rappresentare i negozi della rete commerciale dell’azienda
            </div>
        </div>
    </div>
    <!-- FINE TABELLA PUNTI VENDITA -->


    <br>
    <!-- #########################################################################################################################################  -->



    <!-- TABELLA VENDITE -->
    <h2 id="titolo5">VENDITE </h2>
    <!-- Costruisco la tabella di visualizzazione della query -->
    <!-- Intestazione della tabella -->
    <table id='table-center5' class="table">
        <thead>
            <tr>
                <th>ID Vendita</th>
                <th>Data Vendita</th>
                <th>Prezzo Vendita</th>
                <th>Matricola</th>
                <th>Id Capo</th>
            </tr>
        </thead>
        <!-- Corpo della tabella -->
        <tbody>
            <?php
            // Comando SQL
            $strSQL = "SELECT * FROM vendite ORDER BY ID, DataVendita;"; // Semplice Query di visualizzazione
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
                        echo $riga['DataVendita'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $riga['PrezzoVendita'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $riga['Matricola'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $riga['IDCapo'];
                        ?>
                    </td>
                </tr>
                <!-- Alla fine di tutto, quando lavoro col PHP devo sempre mettere questo -->
            <?php
            } // chiudo il while aperto prima (QUANDO LAVORO CON LE TABELLE LO DEVO CHIUDERE SEMPRE PRIMA DEL TBODY)
            ?>
        </tbody>
    </table>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="callout callout-info divCallout" id="calloutVendita">
                <h4>Tabella Vendita</h4>
                Per rappresentare le operazioni di vendita dei singoli capi.
            </div>
        </div>
    </div>
    <!-- FINE TABELLA VENDITE -->

    <?php
    footer(); // Richiamo la funzione per il piè di pagina
    ?>

</body>

</html>


<!-- Javascript e JQuery nel documento corrente-->
<script>
    $(document).ready(function() {
        // Aggiungo a tutte le tabelle con id "#table-centerN" le classi contenute in addClass(...)
        $("#table-center1").addClass("table mx-auto w-auto stileTabelle");
        $("#table-center2").addClass("table mx-auto w-auto stileTabelle");
        $("#table-center3").addClass("table mx-auto w-auto stileTabelle");
        $("#table-center4").addClass("table mx-auto w-auto stileTabelle");
        $("#table-center5").addClass("table mx-auto w-auto stileTabelle");

        // Applico a tutti gli h2 lo stile grassetto
        $("h2").css("font-weight", "bold");
        $("h2").css("text-align", "center");

        // Mostro/Nascondo (toggle) contenuto della tabella 1
        $("#titolo1").click(function() {
            $("#table-center1").toggle();
        });


        // Mostro/Nascondo (toggle) contenuto della tabella 2
        $("#titolo2").click(function() {
            $("#table-center2").toggle();
        });


        // Mostro/Nascondo (toggle) contenuto della tabella 3
        $("#titolo3").click(function() {
            $("#table-center3").toggle();
        });


        // Mostro/Nascondo (toggle) contenuto della tabella 4
        $("#titolo4").click(function() {
            $("#table-center4").toggle();
        });


        // Mostro/Nascondo (toggle) contenuto della tabella 5
        $("#titolo5").click(function() {
            $("#table-center5").toggle();
        });

        // Voglio che tutti i callout siano nascosti
        $(".callout").hide();
        // $(".callout-info").hide();
    }); // fine document.ready


    // Eventi con i callout:
    $(function() {
        // All'evento click sull'elemento di id #table-center1
        $("#table-center1").click(function() {
            // Mostra il callout con id #calloutCapo
            $("#calloutCapo").show();
            $("#calloutCapo").fadeIn(); // "slow"
        }).dblclick(function() {
            $("#calloutCapo").fadeOut("slow"); // "fast"
        });


        // All'evento click sull'elemento di id #table-center2
        $("#table-center2").click(function() {
            // Mostra il callout con id #calloutCapo
            $("#calloutDipendente").show();
            $("#calloutDipendente").fadeIn(); // "slow"
        }).dblclick(function() {
            $("#calloutDipendente").fadeOut("slow"); // "fast"
        });


        // All'evento click sull'elemento di id #table-center3
        $("#table-center3").click(function() {
            // Mostra il callout con id #calloutCapo
            $("#calloutModello").show();
            $("#calloutModello").fadeIn(); // "slow"
        }).dblclick(function() {
            $("#calloutModello").fadeOut("slow"); // "fast"
        });



        // All'evento click sull'elemento di id #table-center4
        $("#table-center4").click(function() {
            // Mostra il callout con id #calloutCapo
            $("#calloutPuntoVendita").show();
            $("#calloutPuntoVendita").fadeIn(); // "slow"
        }).dblclick(function() {
            $("#calloutPuntoVendita").fadeOut("slow"); // "fast"
        });



        // All'evento click sull'elemento di id #table-center5
        $("#table-center5").click(function() {
            // Mostra il callout con id #calloutCapo
            $("#calloutVendita").show();
            $("#calloutVendita").fadeIn(); // "slow"
        }).dblclick(function() {
            $("#calloutVendita").fadeOut("slow"); // "fast"
        });
    }); // fine function esterna
</script>


<!-- RICORDA: 
*) Per centrare un div in bootstrap devo usare:
        <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="...">
                <p> testo </p>
            </div>
        </div>
    </div>

*) Per ... 
-->
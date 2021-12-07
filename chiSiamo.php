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
    <title>Chi siamo</title>
</head>

<body>
    <header>
        <nav>
            <?php
            navbar(); // Richiamo la funzione navbar
            ?>
        </nav>
    </header>
    <!-- PAGINA DI INFORMAZIONI SU CHI SIAMO -->
    <div class="container">
        <div class="callout callout-info divCallout" style="text-justify: auto;">

            <img src="/immagini/man.png" alt="">&nbsp;<h1>Chi siamo</h1>
            <p class="lead">
                Il mercato dell' abbigliamento ha conosciuto negli ultimi anni profonde modificazioni su scala globale a causa dei nuovi comportamenti dei consumatori.
                <br>
                L'azienda "Dircol" &egrave; una societ&agrave; multinazionale di produzione e commercializzazione di prodotti di abbigliamento.
                <br>
                Essa ha intuito l'opportunit&agrave; di indagare i nuovi "modelli individuali" di comportamento dei consumatori e ha adeguato le proprie strategie manageriali,
                utilizzando metodologie di raccolta dati che consentano un rapido feedback tra l'analisi delle vendite e le strategie di produzione.
                <br>
                Ci&ograve; le ha consentito di offrire sul mercato modelli di abbigliamento di tendenza, con un processo di progettazione, produzione e distribuzione di poche settimane (time to market breve), e a prezzi accessibili al grande pubblico.
                <br>
                L'offerta di modelli &egrave; differenziata in base all'analisi dei comportamenti dei consumatori e pertanto, per identificarne rapidamente le tendenze, Dircol traccia ogni singolo capo disponibile nei suoi punti vendita.
                <br>
                La struttura produttiva dell'azienda Dircol &egrave; basata su stabilimenti dislocati in diverse nazioni europee, che si approvvigionano da vari fornitori.
                <br>
                La sua rete commerciale &egrave; composta di punti vendita che presentano caratteristiche e offerte differenziate, distribuiti prevalentemente nelle citt&agrave; di medie e grandi dimensioni.
                <br>
                Il personale di vendita pu&ograve; essere impiegato presso i vari punti vendita della societ&agrave;, in periodi diversi.
                <br>
                L'azienda attua strategie di fidelizzazione e di raccolta delle opinioni dei clienti anche tramite Web.
            </p>
        </div>
    </div>


    <!-- FINE INFORMAZIONI DI CHI SIAMO -->
    <!-- <div style="margin-bottom: 20px; margin-left: 2%; padding-bottom: 20px;"> -->
    <div class="container" style="margin-bottom: 2%; padding-bottom: 2%;">
        <div class="callout callout-info divCallout" style="text-justify: auto; ">
            <h1>Aree del sistema informativo dell'azienda Dircol</h1>

            <p>
                L’azienda è organizzata in funzioni aziendali, secondo una struttura gerarchica nella quale le funzioni
                dipendono dalla Direzione generale:
            </p>
            <ul style="font-size: 20px;">
                <li>Logistica</li>
                <li>R&D (Research and Development, Ricerca e Sviluppo) e Produzione</li>
                <li>Amministrazione, Finanza e Controllo</li>
                <li>HR (Human resources, Risorse umane)</li>
                <li>Marketing e Vendite</li>
            </ul>
            <p>
                Nello specifico, l’azienda Dircol ha una struttura produttiva basata su stabilimenti dislocati in diverse nazioni
                europee, che si approvvigionano da vari fornitori .
                Essa opera attraverso una rete commerciale composta di punti vendita dislocati nelle città di medie e grandi
                dimensioni.
                Un particolare aspetto che attiene al marketing riguarda l’analisi delle vendite per individuare i comportamenti
                e le tendenze dei consumatori e ricavarne dati utili per determinare le strategie di produzione.
                Il sistema informatico dell’azienda si basa su soluzioni informatiche che rispondano in modo funzionale alle
                esigenze del management aziendale. Esse sono basate sui sistemi aperti, in grado di integrare tecnologie
                diverse, rendendo compatibili sistemi nuovi e sistemi meno recenti.
                Le applicazioni hanno come requisiti fondamentali:
            </p>
            <ul style="font-size: 20px;">
                <li>l’interoperabilità, cioè la possibilità di comunicare con altre applicazioni sia locali che remote;</li>
                <li>la portabilità, cioè la possibilità di poter operare su piattaforme hardware diverse;</li>
                <li>l’integrazione tra i processi dell’impresa.</li>
            </ul>
            <p>
                Tutti i programmi utilizzati in azienda sono messi in relazione tra loro condividendo i dati comuni e i protocolli
                standard.
            </p>
        </div>
    </div>


    <!-- Chiusura della connessione al DataBase -->
    <?php
    mysqli_close($conn); //Make sure to close out the database connection
    ?>


    <footer>
        <?php
        footer(); // Richiamo la funzione per il piè di pagina
        ?>
    </footer>

</body>

</html>
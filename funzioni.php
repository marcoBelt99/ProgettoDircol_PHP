<?php
include_once('listeCollegate.php');
function head()
{ ?>
  <!-- Questo file conterrà alcune funzioni da richiamare in tutte le pagine -->
  <!-- Contiene inoltre alcune variabili globaili utili da usare nelle diverse pagine, ricordandosi sempre di includere questa pagina nelle altre -->
  <!-- FUNZIONE HEAD -->
  <header>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Includo i CDN di bootstrap 4 per il CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Includo i miei fogli di stile CSS personali -->
    <link rel="stylesheet" href="stili.css" type="text/css">

    <!-- Includo JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->

    <!-- Script che evidenzia i link nella navbar in base alla pagina in cui mi trovo in questo momento -->
    <script>
      $(function() {
        $('a').each(function() {
          if ($(this).prop('href') == window.location.href) {
            $(this).addClass('active');
            $(this).addClass('hover');
            $(this).parents('li').addClass('active');
            $(this).parents('li').addClass('hover');
          }
        });
      });
    </script>

    <!-- Includo le icone di Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">

    <!-- Includo i Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300&display=swap" rel="stylesheet">
  </header>
<?php
} // chiusura funzione head
// <!-- FINE FUNZIONE HEAD -->
?>




<?php
// <!-- FUNZIONE NAVBAR (e logo) -->
function navbar()
{ ?>
  <!-- NAVBAR e LOGO (da fare in una function che poi richiamo in ogni pagina) -->
  <navbar>
    <!-- <nav class="navbar navbar-dark navbar-expand-md fixed-top" style="background-color: #7952b3;"> -->

    <nav class="navbar navbar-expand-md navbar-expand-xl navbar-dark static-top stileNavbar">
      <!--  navbar-expand-sm navbar-expand-md navbar-expand-lg navbar-expand-xl shift py-4-->
      <div class="navbar-brand">
        <img src="immagini\D.png" alt="logo" class="logo" width="40" height="40">
        <!-- <canvas id="canvasLogo"></canvas> -->
      </div>
      <!-- Bottone Hamburger menù -->
      <button class="navbar-toggler p-0 border-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"> </span>
      </button>

      <div class="collapse navbar-collapse " id="navbarSupportedContent">
        <!-- Lista di link della navbar -->
        <ul class="navbar-nav mr-auto">

          <!-- Home -->
          <li class="nav-item">
            <!-- posso aggiungere active per lasciarlo active-->
            <a class="nav-link text-nowrap" href="index.php">
              <i class="bi bi-house-fill"></i> Home<span class="sr-only">(current)</span>
            </a>
          </li>

          <!-- Chi siamo -->
          <li class="nav-item">
            <a class="nav-link text-nowrap" href="chiSiamo.php">
              <i class="bi bi-people-fill"></i> Chi siamo <span class="sr-only">(current)</span>
            </a>
          </li>

          <!-- Contatti -->
          <li class="nav-item">
            <a class="nav-link text-nowrap" href="contatti.php">
              <i class="bi bi-telephone-fill"></i> Contatti <span class="sr-only">(current)</span>
            </a>
          </li>

          <!-- Gestione Modelli -->
          <li class="nav-item">
            <a class="nav-link text-nowrap" href="gestioneModelli.php" target="_blank">
              <i class="bi bi-bag-fill"></i> Acquista Modelli
            </a>
          </li>

          <!-- Visualizza tabelle -->
          <li class="nav-item">
            <a class="nav-link text-nowrap" href="visualizzaTabelle.php" target="_blank">
              <i class="bi bi-file-spreadsheet-fill"></i> Visualizza tabelle
            </a>
          </li>

          <!-- Dropdown menù: Operazioni Di Data Manipulation Language -->
          <li class="nav-item dropdown drop">
            <a class="nav-link dropdown-toggle text-nowrap" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="bi bi-list-task"></i> Operazioni DML
            </a>
            <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
              <!-- Inserisci -->
              <a class="dropdown-item" href="inserisci.php">
                <i class="bi bi-plus-circle-fill"></i> Inserisci
              </a>
              <!-- Aggiorna -->
              <a class="dropdown-item" href="aggiorna.php">
                <i class="bi bi-pencil-square"></i> Aggiorna
              </a>
              <div class="dropdown-divider"></div> <!-- Divisore tra le voci del dropdown menu -->
              <!-- Elimina -->
              <a class="dropdown-item link-danger linkElimina" href="elimina.php">
                <i class="bi bi-x-circle-fill"></i> Elimina
              </a>
            </div>
          </li>
          <!-- Fine dropdown menù-->

          <!-- Interrogazioni -->
          <li class="nav-item">
            <a class="nav-link text-nowrap" href="interrogazioni.php">
              <i class="bi bi-clipboard-data"></i> Interrogazioni
            </a>
          </li>

          <!-- Link disabilitato -->
          <!-- <li class="nav-item">
                <a class="nav-link disabled " href="#" tabindex="-1" aria-disabled="true">Disabled</a>
              </li> -->
        </ul>
        <!-- Gestione Utenti -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link text-nowrap" href="gestioneUtenti.php">
              <i class="bi bi-person-square"></i> Gestione Utenti <span class="sr-only">(current)</span>
            </a>
          </li>
        </ul>

        <!-- Fine lista di link della navbar -->

        <!-- Form della navbar -->
        <!-- <div class="navbar-right">
            <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Cerca" aria-label="Search">
              <button class="btn btn-outline-warning" type="submit">Cerca</button>
            </form>
          </div> -->


        <!-- Fine form della navbar -->

      </div>

    </nav>
  </navbar>


  <!-- FINE NAVBAR -->
  <!-- RICHIAMO (oltre al CSS) ANCHE I CDN DI JAVASCRIPT: Questi sono utili ad esempio per il dropdown menù: senza di questi non mi farebbe scendere il menù a tendina del dropdown menù -->
  <!--                                                    Inoltre è risolto anche il problema dell'hamburger menù (che senza javascript di Bootstrap rimaneva bloccato quando provavo a cliccarci) -->



  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <!-- Always remember to call the above files first before calling the bootstrap.min.js file -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

  <section>
  <?php
} // Fine funzione navbar 
//  <!-- FINE FUNZIONE NAVBAR, inizio section -->
  ?>




  <?php
  //  <!-- FUNZIONE FOOTER, fine section -->
  function
  footer()
  {
  ?>
  </section>
  <!-- Footer -->
  <footer class="dark stileFooter ">
    <a href="https://www.dircol/facebook.com"><i class="bi bi-facebook"></i></a>
    &nbsp; &nbsp;
    <a href="https://www.dircol/twitter.com"> <i class="bi bi-twitter"></i> </a>
    &nbsp; &nbsp;
    <a href="https://www.instagram.com/dircolSPA"><i class="bi bi-instagram"></i></a>
    &nbsp; &nbsp;
    <a href="mailto:info@dircol.it"><i class="bi bi-mail"></i></a>
    &nbsp; &nbsp;
    Copyright &copy; Dircol S.P.A. <?php echo date("Y"); ?>
  </footer>
  <!-- Fine Footer -->

<?php
  } // Fine funzione footer
  // <!-- FINE FUNZIONE FOOTHER -->
?>
























<?php
// Mi salvo l'insieme delle taglie in un array di stringhe
$taglie = array("M", "L", "S", "XL", "XS", "XXS", "XXL");
sort($taglie); // Riordino l'array
$stringaControllo = "---"; // Stringa che serve per i controlli sull'input nei vari form nelle select

// Creo una nuova lista di utenti


// $listaUtenti = new Lista(); 
function caricaListaUtenti()
{
  $listaUtenti = new Lista();
  // DICHIARAZIONE LISTA, LETTURA LINEE DA FILE 'feedback.txt' IN CUI OGNI LINEA E' COMPOSTA DA PAROLE DIVISE DA UN CARATTERE DI '\t'
  // Popolo il file
  $linee = file('feedback.txt'); // Provo a leggere dal file feedback.txt linea per linea e a stamparla a video; Ottengo un array di linee, in cui ogni elemento è una linea del file
  foreach ($linee as $i => $linea) {
    // Stampa la linea $linea (che parte da 0);  La variabile $linea diventa la stringa i-esima
    // echo "Linea numero $i: $linea" . "<br>";
    $token = strtok($linea, "\t");  // Provo a splittare la linea in parole divise da un tab '\t'
    while ($token != false) {
      // Stampo l'intera riga // echo "$token<br>";
      $Ut = new Utente('', '', '', '', 0);  // Creo un nuovo oggetto di tipo Utente che sarà il campo dato del nodo
      $Ut->Username = $token;
      // Prendi il prossimo pezzetto della linea
      $token = strtok("\t");
      $Ut->Nome = $token;
      // Prendi il prossimo pezzetto della linea
      $token = strtok("\t");
      $Ut->Cognome = $token;
      // Prendi il prossimo pezzetto della linea
      $token = strtok("\t");
      $Ut->Commento = $token;
      // Prendi il prossimo pezzetto della linea
      $token = strtok("\t");
      $Ut->Voto = (int)$token;
      // Prendi il prossimo pezzetto della linea
      $token = strtok("\t");
      // Inserisco l'oggetto in testa alla lista
      $listaUtenti->insTesta($Ut);
    } // fine while analisi della linea
  } // fine foreach
  return $listaUtenti;
}
?>
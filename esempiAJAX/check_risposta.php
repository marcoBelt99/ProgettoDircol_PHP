<?php
  $dato = $_GET["dati_inviati"]; //r32  alla domanda 2 ha risposto 3 (terza risposta)

  //cerchiamo nel db il numero della risposta corretta a questa domanda
  $codice_domanda = $dato[2];         //r32 -> 2
  $num_risposta_data = $dato[1];      //r32 -> 3

  if ( ($conn = @mysqli_connect("localhost", "root", "", "quiz")) )
  {
    
    $comandoSQL = "select num_risposta_corretta from domande where codice_domanda=$codice_domanda";
    $risultato = mysqli_query($conn, $comandoSQL);

    if ( mysqli_num_rows($risultato)===1 )
    {
      extract( mysqli_fetch_assoc($risultato) ); //esplode l`array nei componenti 

      if ($num_risposta_data === $num_risposta_corretta)
      {
        echo "corretta";
      }
      else
      {
        echo "sbagliata";
      }      
    }
    else
    {
      echo "Domanda non trovata sul server ...";
      die;
    }
  }
  else
  {
    echo "Errore di connessione al server...";
    die;
  }
?>
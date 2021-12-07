<?php
include_once('utente.php');
include_once('listeCollegate.php');



// Creo una lista vuota
$L = new Lista();

// Aggiungo il primo nodo
$n1 = new Nodo();
$n1->dato = 5;
$n1->next = null; // faccio puntare a null
// Linko la head della lista al primo nodo
$L->head = $n1;
$L->dimensione++;


// Aggiungo il secondo nodo
$n2 = new Nodo();
$n2->dato = -2;
$n2->next = null;
// Linko il primo nodo col secondo
$n1->next = $n2;
$L->dimensione++;


// Aggiungo un terzo nodo
$n3 = new Nodo();
$n3->dato = 333;
$n3->next = null;
// Linko il secondo nodo col terzo
$n2->next = $n3;
$L->dimensione++;

$L->stampaLista();






// Creo alcuni oggetti di classe Utente con il costruttore
$sara = new Utente('Sara', 'Morin', 'Servizio eccezionale', 4);
$mattia = new Utente('Mattia', 'Forza', 'Un buon servizio di compravendita di Vestiti', 3);
$salvatore = new Utente('Salvatore', 'Aranzulla', 'Pienamente contento di aver acquistato da voi', 5);
$martina = new Utente('Martina', 'Vendemmiati', 'Qualità nella norma, nulla di così particolare in fondo ', 3);
$marco = new Utente('', '', '', '');
$diletta = new Utente('', '', '', '');
$mario = new Utente('', '', '', '');


// In tutto ho 7 oggetti di tipo Utente()

// Popolo alcuni degli oggetti con i metodi setter
$marco->setNome('Marco');
$marco->setCognome('Beltrame');
$marco->setCommento('Veramente un bel servizio! Merita il massimo delle stelle');
$marco->setVoto(5);


$diletta->setNome('Diletta');
$diletta->setCognome('Biondi');
$diletta->setCommento('Molto entusiasta, prezzi onesti');
$diletta->setVoto(4);

$mario->setNome('Mario');
$mario->setCognome('Rossi');
$mario->setCommento('Poco soddisfatto');
$mario->setVoto(2);

// Uso il metodo getter
echo "Nome:\t\tCognome:\t\tFeedback:\t\tVoto<br>";
echo $marco->getNome() . "\t\t" . $marco->getCognome() . "\t\t" .  $marco->getCommento() . "\t\t" . $marco->getVoto();
// echo "Utente:<br>" . "Nome: " . $marco->getNome() . "\t" . "Cognome: " . $marco->getCognome() . "\t" . "Feedback: " . $marco->getCommento();

// Media voti
$sommaVoti =  $sara->getVoto()  + $mattia->getVoto() + $salvatore->getVoto() + $martina->getVoto() + $marco->getVoto() + $diletta->getVoto() + $mario->getVoto();
$media = $sommaVoti / 7;
echo "<br>";
echo "La media dei voti degli utenti &egrave: " . $media;

// $Utenti[] = new Utente();
$fp = null;
?>

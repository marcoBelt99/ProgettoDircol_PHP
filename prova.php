<?php
include_once('connessione.php');
include_once('funzioni.php');

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

echo "<br><br>";
class A
{
    public $foo = 1;
}

$a = new A; // creo l'oggetto a di classe A
$b = $a;     // $a and $b are copies of the same identifier
// ($a) = ($b) = <id>
$b->foo = 2;
echo $a->foo . "\n";


$c = new A;
$d = &$c;    // $c and $d are references
// ($c,$d) = <id>

$d->foo = 2;
echo $c->foo . "\n";


$e = new A;

function foo($obj)
{
    // ($obj) = ($e) = <id>
    $obj->foo = 2;
}

foo($e);
echo $e->foo . "\n";


function incrementa($var)
{
    $var++;
}
$a = 10;
echo "<br> Prima dell'incremento a vale: $a<br>";
incrementa($a);
echo "<br> Dopo l'incremento a vale: $a<br>";

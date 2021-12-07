<?php
// Includo i file con le definizioni della classe Utente e delle classi Nodo e Lista
include_once('utente.php');
include_once('listeCollegate.php');

// LETTURA SINGOLA RIGA DAL FILE: numeri.txt
echo "LETTURA SINGOLA RIGA DAL FILE: numeri.txt";
echo "<br>";
$fp = fopen('numeri.txt', 'r') or die("Non sono riuscito ad aprire il file: numeri.txt");
while ($line = fgets($fp)) { /*  Con la fgets leggo riga per riga */
    // <... Do your work with the line ...>
    // Stampo la singola riga
    echo ($line);
}
fclose($fp);

echo "<br>";
echo "<br>";
echo "<br>";

// LETTURA E STAMPA DI TUTTO IL FILE (!!non in maniera formattata!!)
echo "LETTURA E STAMPA DI TUTTO IL FILE (!!non in maniera formattata!!)";
echo "<br>";
$fp = fopen("dizionario.txt", "r") or die("Non sono riuscito ad aprire il file: dizionario.txt");
echo fread($fp, filesize("dizionario.txt"));
fclose($fp);

echo "<br>";
echo "<br>";
echo "<br>";

// LETTURA E STAMPA DI TUTTO IL FILE (!!in maniera formattata!!)
echo "LETTURA E STAMPA DI TUTTO IL FILE (!!in maniera formattata!!)";
echo "<br>";
$fp = fopen("dizionario.txt", "r") or die("Non sono riuscito ad aprire il file: dizionario.txt");

while (!feof($fp)) {
    /** The feof() function checks if the "end-of-file" (EOF) has been reached. 
     * The feof() function is useful for looping through data of unknown length. */
    // Output one line until end-of-file
    echo fgets($fp) . "<br>";
}
fclose($fp);


/* ********************************************************************************************************** */
/* ********************************************************************************************************** */
/* ********************************************************************************************************** */
/* ********************************************************************************************************** */
/* ********************************************************************************************************** */
/* ********************************************************************************************************** */
/* ********************************************************************************************************** */
/* ********************************************************************************************************** */
/* ********************************************************************************************************** */
/* ********************************************************************************************************** */
/* ********************************************************************************************************** */

// Provo a leggere dal file feedback.txt linea per linea e a stamparla a video
// $linee = file('feedback.txt'); // Ottengo un array di linee, in cui ogni elemento è una linea del file

// Creo una nuova lista 
/*
$Utenti = new Lista();

echo "<h1>Inserimento</h1><br>";

foreach ($linee as $i => $linea) {
    // Stampa la linea $linea (che parte da 0)
    // La variabile $linea diventa la stringa i-esima
    // echo "Linea numero $i: $linea" . "<br>";
    // Provo a splittare la linea in parole divise da un tab '\t'
    $token = strtok($linea, "\t");
    while ($token != false) {
        // Stampo l'intera riga
        // echo "$token<br>";
        // Creo un nuovo oggetto di tipo Utente
        $U = new Utente('', '', '', '', 0); // campo dato del nodo
        $U->Username = $token;
        $token = strtok("\t");
        $U->Nome = $token;
        // Prendi il prossimo pezzetto della linea
        $token = strtok("\t");
        $U->Cognome = $token;
        // Prendi il prossimo pezzetto della linea
        $token = strtok("\t");
        $U->Commento = $token;
        // Prendi il prossimo pezzetto della linea
        $token = strtok("\t");
        $U->Voto = (int)$token;
        // Prendi il prossimo pezzetto della linea
        $token = strtok("\t");
        // Inserisco l'oggetto in testa alla lista
        $Utenti->insTesta($U);
    }
    // echo "<br>";
}

echo "La lista degli Utenti e':<br>";
$Utenti->stampaLista();

echo "<h1>Ricerca</h1><br>";
$username = "giu99";
echo "Ricerco l'utente di username: $username<br>";
if ($Utenti->ricercaUsername($username) == true) {
    echo "Trovato<br>";
} else {
    echo "Non Trovato<br>";
}

echo "<h1>Cancellazione</h1><br>";


$username = "SALVOAR";
echo "Elimino l'utente di username: $username<br>";
if ($Utenti->eliminaUtente($username)) {
    echo "Eliminato<br>";
} else {
    echo "Non Eliminato<br>";
}

$Utenti->stampaLista();
*/
?>

<script>
    $("h1").css("color: red");
</script>
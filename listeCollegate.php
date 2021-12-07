<?php
// Importo la pagina in cui è definita la classe Utente
include_once('utente.php');
// Provo a definire un nuovo oggetto di tipo nodo
// Poi definisco un oggetto di tipo lista
// Poi definisco un oggetto di tipo Utente (che sarà il campo dato di ogni nodo della lista)
// Poi creo una lista di utenti
// Poi leggerò o da un file .txt o da un file .json alcuni dati e li salverò

/*###############################  DEFINIZIONE TIPI ########################## */
// Nodo
class Nodo
{
    // Properties
    public $dato; // chiave del nodo
    public $next; // puntatore al nodo successivo


    // Metodi
    public function getDato()
    {
        return $this->dato;
    }

    // Faccio overloading della toString
    public function __toString()
    {
        return $this->dato->__toString();
    }
}

// Lista
class Lista
{
    // PROPRIETA'
    public $dimensione; // dimensione della lista. (numero di nodi della lista)
    public $head; // puntatore al nodo successivo

    // COSTRUTTORE: per creare una lista vuota
    public function __construct()
    {
        $this->dimensione = 0;
        $this->head = null;
    }

    // METODI: ricorda--> se sto lavorando con i metodi dentro la classe, devo richiamare gli attributi con: $this->attributo

    // Funzione di inserimento di un nodo in testa alla lista (Lista L, Dato da inserire nel campo dato del nuovo Nodo)
    public function insTesta($nuovoDato)
    {
        // Alloco un nuovo nodo
        $aux = new Nodo();
        // Gli inserisco il dato
        $aux->dato = $nuovoDato;
        // Faccio puntare questo nodo alla testa della lista
        $aux->next = $this->head;
        // Assegno questo  nuovo nodo alla testa della lista
        $this->head = $aux;
        // Incremento la dimensione della lista
        $this->dimensione++;
    }


    // Funzione Booleana di ricerca di un nodo avente una certa proprietà: un certo username
    public function ricercaUsername($username)
    {
        // Mi salvo la posizione di partenza della testa
        // $corrente = new Nodo();
        $corrente = $this->head;
        while ($corrente != null) {
            // Se ho trovato lo username che sto cercando
            if (strcmp($corrente->dato->Username, $username) == 0)
                // Trovato, Ritorna true
                return true;
            // Altrimenti passa al prossimo
            $corrente = $corrente->next;
        }
        // Se arrivo qui, non ho trovato un bel niente
        return false;
    }

    // Funzione di ricerca che ritorna il nodo desiderato
    public function ricercaUtente($username)
    {
        // Mi salvo la posizione di partenza della testa
        // $corrente = new Nodo();
        $corrente = $this->head;
        while ($corrente != null) {
            // Se ho trovato lo username che sto cercando
            if (strcmp($corrente->dato->Username, $username) == 0)
                // Trovato, Ritorna il nodo
                return $corrente;
            // Altrimenti passa al prossimo
            $corrente = $corrente->next;
        }
        // Se arrivo qui, non ho trovato un bel niente
        return null;
    }


    /*
    // Passo per riferimento il nodo da eliminare
    public function elimTesta(&$l)
    {
        $aux = new Nodo();
        $aux = $l;
        $l = $l->next;
        $aux = null;
        $this->dimensione--;
    }
*/

    // Funzione di ricerca utente da Eliminare e di eliminazione dello stesso dalla lista

    public function eliminaUtente($username)
    {
        // Ricerco l'utente desiderato e mi salvo il nodo in L

        $L =  $this->ricercaUtente($username);
        // CASO PRIMO NODO DELLA LISTA
        if ($L == $this->head) { // Se il nodo è pari alla teseta (si trova in testa alla lista)
            $this->head = $this->head->next; // Salta il nodo L
            unset($L);
            $this->dimensione--;
            return 1;
        }

        // CASO ULTIMO NODO DELLA LISTA
        if ($L->next == NULL) { // Creo un nuovo nodo q
            $q = new Nodo();
            $q = $this->head; // Mi salvo l'indirizzo della testa
            while ($q->next != $L) {
                $q = $q->next;
            }
            $q->next = $L->next; // Salta il nodo L
            unset($L);
            $this->dimensione--;
            return 1;
        }


        // CASO DI UN NODO QUALSIASI
        $q = new Nodo(); // Creo un nuovo nodo q
        $q = $this->head; // Gli assegno il valore della testa della lista
        while ($q->next != $L)  // Scorro la lista, cercando il nodo immediatamente precedente a L
            $q = $q->next;
        $q->next = $L->next; // Salta il nodo L
        unset($L);
        $this->dimensione--;
        return 1;
    }



    // Funzione di aggiornamento di un Utente della lista
    public function aggiornaUtente($username, $nuovoNome, $nuovoCognome, $nuovoCommento, $nuovoVoto)
    {
        $l = $this->ricercaUtente($username);

        // Se non è null, ho trovato l'utente desiderato
        if ($l != null) {
            // Allora aggiorna i campi
            // $l->Username = $username;
            $l->dato->Nome = $nuovoNome;
            $l->dato->Cognome = $nuovoCognome;
            $l->dato->Commento = $nuovoCommento;
            $l->dato->Voto = $nuovoVoto;
            return $l;
        } else
            return 0;
    }



    // Una lista è vuota se vale NULL
    public function vuota()
    {
        return $this->head == NULL;
    }

    // Mentre non può mai essere piena
    public function piena()
    {
        return 0;
    }

    // 

    // Stampa i nodi della lista
    public function stampaLista()
    {
        // Nuovo nodo ausiliario
        $aux = new Nodo();
        // il nuovo nodo ausiliario parte dalla head
        $aux = $this->head;
        if ($aux != null) {
            echo "<br>";
            $i = 1;
            while ($aux != null) {
                // Stampa il nodo corrente: Nota--> devo chiamare la toString per stampare l'intero oggetto
                echo  "<h3>$i] " . $aux->__toString() . "</h3>";
                // Passa al prossimo nodo della lista
                $aux = $aux->next;
                $i++;
            }
            // Vado a capo
            echo "<br>";
        } else {
            echo "La lista è vuota, infatti contiene: " . $this->dimensione . " elementi.<br>";
        }
        echo "La lista contiene: " . $this->dimensione . " elementi.";
    } // fine funzione stampa



    public function ricercaOrdinata($Dato)
    {
        // Mi salvo la posizione di partenza della testa
        // $corrente = new Nodo();
        $corrente = $this->head;
        while ($corrente != null) {
            // Se ho trovato lo username in ordine
            if (strcmp($corrente->dato->Username, $username) > 0)
                break;
            // Altrimenti passa al prossimo
            $corrente = $corrente->next;
        }
        return $corrente;
    }

    public function insOrdinato($Dato)
    {
        $this->head = $this->ricercaOrdinata($Dato);
        $this->insTesta($Dato);
    }
} // fine classe Lista


/*############################### MAIN ########################## */

/*

// Provo con dei semplici esempi con numeri interi



// Aggiungo il primo nodo

// Creo un oggetto campo dato del nuovo nodo
$u1 = new Utente('', '', '', '', 0);
$u1->setUsername("marcus");
$u1->setNome("Marco");
$u1->setCognome("Beltrame");
$u1->setCommento("Bella cosa questa qui che sto recensendo");
$u1->setVoto(4);
$u2 = new Utente('dylet', 'Diletta', 'Biondi', 'Abbastanza bello tutto ciò, poteva essere peggio', 3);
$u3 = new Utente('sernela', 'Serenella', 'Marchesini', 'Tutto molto carino', 5);
$u4 = new Utente('francy', 'Frigato', 'Francesco', 'Si dai, puo andare', 3);


// Creo una lista vuota
$L = new Lista();
$n1 = new Nodo();
$n2 = new Nodo();
$n3 = new Nodo();
$n4 = new Nodo();

$n1->dato = $u1;
$n1->next = null;
$n2->dato = $u2;
$n2->next = null;
$n3->dato = $u3;
$n3->next = null;
$n4->dato = $u4;
$n4->next = null;


$L->insTesta($n1);
$L->insTesta($n2);
$L->insTesta($n3);
$L->insTesta($n4);

echo "<br>Lista dopo inserimenti<br>";
$L->stampaLista();

$L->aggiornaUtente("dylet", "Dile", "Biondissima", "commentino hahaha", 5);

echo "<br>Lista dopo aggiornamento<br>";
$L->stampaLista();

echo "<br>" . $n1->dato->__toString();
*/
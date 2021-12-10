<?php

// Implementazione Feedback Utenti:
// Questo file contiene la dichiarazione e la definizione della classe Utente
class Utente
{
    // Properties
    public $Username;
    public $Password;
    public $Nome;
    public $Cognome;
    public $Commento;
    public $Voto; // intero da 1 a 5

    // Costruttore
    function __construct($Username, $Password, $Nome, $Cognome, $Commento, $Voto)
    {
        $this->Username = $Username;
        $this->Password = $Password;
        $this->Nome = $Nome;
        $this->Cognome = $Cognome;
        $this->Commento = $Commento;
        $this->Voto = $Voto;
    }

    // Methods
    function setUsername($Username)
    {
        $this->Username = $Username;
    }
    function getUsername()
    {
        return $this->Username;
    }

    function setPassword($Password)
    {
        $this->Password = $Password;
    }
    function getPassword()
    {
        return $this->Password;
    }
    function setNome($Nome)
    {
        $this->Nome = $Nome;
    }
    function getNome()
    {
        return $this->Nome;
    }

    function setCognome($Cognome)
    {
        $this->Cognome = $Cognome;
    }
    function getCognome()
    {
        return $this->Cognome;
    }

    function setCommento($Commento)
    {
        $this->Commento = $Commento;
    }
    function getCommento()
    {
        return $this->Commento;
    }

    function setVoto($Voto)
    {
        $this->Voto = $Voto;
    }
    function getVoto()
    {
        return $this->Voto;
    }

    public function __toString()
    {
        return $this->Username . "\t" . $this->Nome . "\t" . $this->Cognome . "\t" . $this->Commento . "\t" . $this->Voto;
    }
} // fine classe


/** Classe per rappresentare l'amministratore dell'applicazione */
class Admin extends Utente
{
    // private $Username = "admin";
    // private $Password = "password";

    function __construct()
    {
        $this->Username = "admin";
        $this->Password = "password";
    }
}

/** Classe per rappresentare l'utente normale dell'applicazione */
class UtenteOrdinario extends Utente
{

}

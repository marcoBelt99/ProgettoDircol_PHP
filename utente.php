<?php

// Implementazione Feedback Utenti:
// Questo file contiene la dichiarazione e la definizione della classe Utente
class Utente
{
    // Properties
    public $Username;
    public $Nome;
    public $Cognome;
    public $Commento;
    public $Voto; // intero da 1 a 5

    // Costruttore
    function __construct($Username, $Nome, $Cognome, $Commento, $Voto)
    {
        $this->Username = $Username;
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

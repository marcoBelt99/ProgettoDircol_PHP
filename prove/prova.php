<?php
phpinfo();
    $codice = $_POST["codice"];
    if ($codice > 10) {
        echo "maggiore di 10";
    }
    else if($codice == 10) {
        echo "uguale a 10";
    }
    else {
        echo "minore di 10";
    }

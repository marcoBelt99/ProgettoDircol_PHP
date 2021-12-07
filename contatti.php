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
    <title>HomePage</title>
</head>

<body>
    <header>
        <nav>
            <?php
            navbar(); // Richiamo la funzione navbar
            ?>
        </nav>
    </header>
    <!-- PAGINA DI PRESENTAZIONE -->
   
        <h1>
            Contatti
        </h1>
        <p>
            Ahi quanto a dir qual era è cosa dura,
            esta selva selvaggia e aspra e forte
            che nel pensier rinova la paura!

        </p>
        <p>
            Ed una lupa, che di tutte brame
            sembiava carca ne la sua magrezza
            e molte genti fé già viver grame...
        </p>

        <p>
            "A te convien tenere altro viaggio,"
            rispuose, poi che lagrimar mi vide,
            "se vuoi campar d'esto loco selvaggio..."
        </p>
        <p>
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim iste eaque fuga nobis odio, quo minima, suscipit tempora tempore ea ab distinctio delectus animi doloribus inventore aut modi maiores. Libero.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores iure totam omnis ut ab! Doloremque iure assumenda repellat molestias nisi a. Possimus excepturi eligendi nemo ad dignissimos voluptatum ipsam deserunt.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quisquam necessitatibus dolor natus tempore vero culpa quod, expedita quas ut facere inventore reiciendis hic quaerat quasi sit reprehenderit ipsa numquam?
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit cumque a deserunt excepturi nesciunt quos accusantium. Consequatur esse, libero debitis quae, molestias architecto excepturi laborum consectetur officiis harum fugit quam.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur sapiente iusto corrupti repudiandae itaque! Et, earum commodi sint, praesentium aspernatur quo nihil magnam magni sequi placeat distinctio sit amet ipsam.
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Beatae odit ab, nihil nesciunt deleniti iure fugiat ipsam consequuntur nemo magnam numquam neque id ullam ut doloremque et harum unde placeat!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus iusto dolorem amet sequi totam, dolor velit consequatur ab consequuntur nemo voluptatum quibusdam aliquid voluptas aut assumenda, voluptatem molestias nisi aliquam?
        </p>

        <p>
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim iste eaque fuga nobis odio, quo minima, suscipit tempora tempore ea ab distinctio delectus animi doloribus inventore aut modi maiores. Libero.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores iure totam omnis ut ab! Doloremque iure assumenda repellat molestias nisi a. Possimus excepturi eligendi nemo ad dignissimos voluptatum ipsam deserunt.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quisquam necessitatibus dolor natus tempore vero culpa quod, expedita quas ut facere inventore reiciendis hic quaerat quasi sit reprehenderit ipsa numquam?
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit cumque a deserunt excepturi nesciunt quos accusantium. Consequatur esse, libero debitis quae, molestias architecto excepturi laborum consectetur officiis harum fugit quam.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur sapiente iusto corrupti repudiandae itaque! Et, earum commodi sint, praesentium aspernatur quo nihil magnam magni sequi placeat distinctio sit amet ipsam.
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Beatae odit ab, nihil nesciunt deleniti iure fugiat ipsam consequuntur nemo magnam numquam neque id ullam ut doloremque et harum unde placeat!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus iusto dolorem amet sequi totam, dolor velit consequatur ab consequuntur nemo voluptatum quibusdam aliquid voluptas aut assumenda, voluptatem molestias nisi aliquam?
        </p>
    
    <!-- FINE PRESENTAZIONE -->

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
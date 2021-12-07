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
    <!-- Includo gli stili per il testo customizzato -->
    <link rel="stylesheet" href="testo.css" type="text/css">
    <!-- Includo il javascript per il testo customizzato -->
    <script src="testo.js"></script>
    <!-- Includo Char.js -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>
    <script type="text/javascript" src="logo.js"></script>
</head>

<body>

    <nav>
        <?php
        navbar(); // Richiamo la funzione navbar
        ?>
    </nav>

    <!-- PAGINA DI PRESENTAZIONE -->

    <!-- CAROUSEL -->

    <div id="slider_vestiti" class="carousel slide carouselStile" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#slider_vestiti" data-slide-to="0" class="active"></li>
            <li data-target="#slider_vestiti" data-slide-to="1"></li>
            <li data-target="#slider_vestiti" data-slide-to="2"></li>
            <li data-target="#slider_vestiti" data-slide-to="3"></li>
            <li data-target="#slider_vestiti" data-slide-to="4"></li>
        </ol>
        <div class="carousel-inner">
            <!-- Immagine 1 -->
            <div class="carousel-item active">
                <img class="d-block img-fluid" src="immagini/vestiti.webp " alt="Slide1" width="100%">

                <div class="carousel-caption d-none d-md d-md-block">
                    <h3>Caption per la slide 1</h3>
                    <p>Descrizione slide 1</p>
                </div>
            </div>
            <!-- Immagine 2 -->
            <div class="carousel-item">
                <img class="d-block img-fluid" src="immagini/hm.jpg" alt="Slide1" width="100%">

                <div class="carousel-caption d-none d-md d-md-block">
                    <h3>Caption per la slide 2</h3>
                    <p>Descrizione slide 2</p>
                </div>
            </div>
            <!-- Immagine 3 -->
            <div class="carousel-item ">
                <img class="d-block w-100" src="immagini/armadio1.jpg" alt="Second slide">
                <div class="carousel-caption d-none d-md d-md-block">
                    <h3>Caption per la slide 3</h3>
                    <p>Descrizione slide 3</p>
                </div>
            </div>
            <!-- Immagine 4 -->
            <div class="carousel-item ">
                <img class="d-block w-100" src="immagini/armadio2.jpg" alt="Third slide">
                <div class="carousel-caption d-none d-md d-md-block">
                    <h3>Caption per la slide 4</h3>
                    <p>Descrizione slide 4</p>
                </div>
            </div>
            <!-- Immagine 5 -->
            <div class="carousel-item">
                <img class="d-block w-100" src="immagini/wardrobe.jpg " alt="Slide5" width="100%">

                <div class="carousel-caption d-none d-md d-md-block">
                    <h3>Caption per la slide 5</h3>
                    <p>Descrizione slide 5</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#slider_vestiti" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#slider_vestiti" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div style="margin-bottom: 2px;"></div>
    <!-- FINE CAROUSEL -->


    <!-- JUMBOTRON -->
    <div class="jumbotron jumbotron-fluid text-white">
        <div class="container">
            <!-- <h1 class="display-1">Dircol s.p.a.</h1> -->
            <div class="testoAnimato">
                <h1 class="display-1" data-text="Dircol">Dircol</h1>
            </div>

            <p class="lead">Cambia il tuo modo di vestirti! Rivitalizza il tuo guardaroba!</p>
            <footer class="blockquote-footer text-white">
                <cite title="Source Title">Marco Beltrame</cite>
            </footer>
            <button class="btn btn-outline-warning">Scopri di più</button>
        </div>
    </div>

    <!-- FINE JUMBOTRON -->
    <!-- Implementazione sistema di feedback -->
    <section>
        <h2>Alcune statistiche dei nostri utenti</h2>
        <!-- <canvas id="myChart" width="5" height="5"></canvas>
        <script>
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script> -->

        <script>
            $(document).ready(function() {

                $("#submit_data").click(function() {
                    
                });
            });
        </script>

    </section>


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
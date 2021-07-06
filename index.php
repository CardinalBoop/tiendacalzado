<!DOCTYPE html>
<html lang="es">
<head>
    <title>Inicio</title>

    <!-- Se incluye los css para el diseño de la pagina -->
    <?php include './inc/link.php'; ?>
</head>






<!-- El navbar, funciona mediante php include -->
<body id="container-page-index" >
    <?php include './inc/navbar.php'; ?>
    
    <section id="slider-store" class="carousel slide" data-ride="carousel" style="padding: 0;">

        <!--  -->
        <ol class="carousel-indicators">
            <li data-target="#slider-store" data-slide-to="0" class="active"></li>
            <li data-target="#slider-store" data-slide-to="1"></li>
            <li data-target="#slider-store" data-slide-to="2"></li>
        </ol>

        <!-- Sliders del index -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="./assets/img/slider1.jpg" alt="slider1">
                <div class="carousel-caption">
                    
                </div>
            </div>
            <div class="item">
                <img src="./assets/img/slider2.jpg" alt="slider2">
                <div class="carousel-caption">
                   
                </div>
            </div>
            <div class="item">
                <img src="./assets/img/slider3.jpg" alt="slider3">
                <div class="carousel-caption">
                </div>
            </div>
        </div>

        <!-- Controles del index -->
        <a class="left carousel-control" href="#slider-store" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#slider-store" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </section>
     <!-- Se incluye la lista de productos y footer de la pagina por php include -->
    <?php include './inc/listprod.php'; ?>


    <?php include './inc/footer.php'; ?>
</body>

</html>
<?php
include './library/configServer.php';
include './library/consulSQL.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Productos</title>
    <?php include './inc/link.php'; ?>
</head>

<body id="container-page-product">
<?php include './inc/navbar.php'; ?>
<section id="infoproduct">
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>DETALLE DE PRODUCTO <small class="tittles-pages-logo">CALZADOS CORTESI</small></h1>
            </div>


            <?php

            $CodigoProducto = consultasSQL::clean_string($_GET['CodigoProd']);
            $sizc = consultasSQL::clean_string($_GET['Numero']);
            $productoinfo = ejecutarSQL::consultar("SELECT producto.CodigoProd,producto.NombreProd,producto.CodigoCat,categoria.Nombre,stock.Cantidad,talla.CodigoTalla,talla.Numero,producto.Precio,producto.Descuento,producto.Imagen
                    FROM producto
                    INNER JOIN stock
                    INNER JOIN categoria ON producto.CodigoCat=categoria.CodigoCat AND stock.CodigoProd=producto.CodigoProd
                    INNER JOIN talla ON stock.CodigoTalla=talla.CodigoTalla WHERE talla.Numero='$sizc' AND producto.CodigoProd='$CodigoProducto'");

            while ($fila = mysqli_fetch_array($productoinfo, MYSQLI_ASSOC)) {
                echo '
                            <div class="col-xs-12 col-sm-6">
                                <h3 class="text-center">Información de producto</h3>
                                <br><br>
                        <h4><strong>Nombre: </strong>' . $fila['NombreProd'] . '</h4><br>
                        <h4><strong>Talla: </strong>' . $fila['Numero'] . '</h4><br>        
                                <h4><strong>Precio: </strong>$' . number_format(($fila['Precio'] - ($fila['Precio'] * ($fila['Descuento'] / 100))), 0, '.', '') . '</h4><br>
                                <h4><strong>Categoria: </strong>' . $fila['Nombre'] . '</h4><br>
                                <h4><strong>Stock: </strong>' . $fila['Cantidad'] . '</h4>';?>
                        
                                <!-- talla -->
                                <div class="form-group">
                                <label>Seleccion de talla</label>
                                <form action="process/CargarTalla.php" method="POST" enctype="multipart/form-data">               
                                 <select id="talla" class="form-control" name="talla">
                                 <?php
                                 $tallac = ejecutarSQL::consultar("SELECT * FROM stock INNER JOIN producto ON producto.CodigoProd=stock.CodigoProd INNER JOIN talla ON stock.CodigoTalla=talla.CodigoTalla WHERE stock.CodigoProd='$CodigoProducto' order by talla.Numero asc");
                                 echo '<option value="0">Seleccionado: '. $fila['Numero'] .'</option>';
                                 while ($sizc = mysqli_fetch_array($tallac, MYSQLI_ASSOC)) {
                                     echo '<option value="' . $sizc['Numero'] . '">' . $sizc['Numero'] . '</option>';
                                }
                                ?>
                            </select>
                            <input value="<?php echo $CodigoProducto; ?>" id="codigoprod" hidden>
                             </form>
                            </div>
                                <?php

                if ($fila['Cantidad'] >= 1) {
                    if ($_SESSION['nombreAdmin'] != "" || $_SESSION['nombreUser'] != "") {
                        echo '<form action="process/carrito.php" method="POST" class="FormCatElec" data-form="">
                                            <input type="hidden" value="' . $fila['CodigoProd'] . '" name="codigo">
                                            
                                       
                                            <label class="text-center"><small>Agrega la cantidad de productos que añadiras al carrito de compras (Maximo ' . $fila['Cantidad'] . ' productos)</small></label>
                                            <div class="form-group">
                                                <input type="number" class="form-control" value="1" min="1" max="' . $fila['Cantidad'] . '" name="cantidad">
                                                <input type="hidden" value="' . $fila['Numero'] . '" name="numero">
                                            </div>
                                            <button class="btn btn-lg btn-raised btn-success btn-block"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp; Añadir al carrito</button>
                                        </form>
                                        <div class="ResForm"></div>';
                    } else {
                        echo '<p class="text-center"><small>Para agregar productos al carrito de compras debes iniciar sesion</small></p><br>';
                        echo '<button class="btn btn-lg btn-raised btn-info btn-block" data-toggle="modal" data-target=".modal-login"><i class="fa fa-user"></i>&nbsp;&nbsp; Iniciar sesion</button>';
                    }
                } else {
                    echo '<p class="text-center text-danger lead">No hay existencias de este producto</p><br>';
                }
                if ($fila['Imagen'] != "" && is_file("./assets/img-products/" . $fila['Imagen'])) {
                    $imagenFile = "./assets/img-products/" . $fila['Imagen'];
                } else {
                    $imagenFile = "./assets/img-products/default.png";
                }
                echo '<br>
                                <a href="product.php" class="btn btn-lg btn-primary btn-raised btn-block"><i class="fa fa-mail-reply"></i>&nbsp;&nbsp;Regresar a la tienda</a>
                            </div>


                            <div class="col-xs-12 col-sm-6">
                                <br><br><br>
                                <img class="img-responsive" src="' . $imagenFile . '">
                            </div>';
            }

            ?>


        </div>


    </div>

</section>


<?php include './inc/footer.php'; ?>

</body>

</html>
<section id="new-prod-index">    
         <div class="container">
            <div class="page-header">
                <h1>Últimos <small>productos agregados</small></h1>
            </div>
            <div class="row">
            <!-- Se incluye la funcion de la conexion a la BD y las consultas, se hace la consulta llamando a la lista de productos donde el Estado es Activo, ordenado por id de mayor a menor -->
              	<?php
                  include 'library/configServer.php';
                  include 'library/consulSQL.php';
                //$consulta= ejecutarSQL::consultar("SELECT * FROM producto, talla WHERE Estado='Activo' GROUP BY id ORDER BY id DESC LIMIT 7");
                  //$consulta= ejecutarSQL::consultar("SELECT * FROM producto WHERE Estado='Activo' ORDER BY id DESC LIMIT 7"); 

                $consulta = ejecutarSQL::consultar("SELECT DISTINCT * FROM producto p INNER JOIN stock s ON s.CodigoProd=p.CodigoProd INNER JOIN talla t ON t.CodigoTalla=s.CodigoTalla WHERE p.Estado='Activo' AND p.CodigoProd GROUP BY id order by id DESC LIMIT 9");
                  //$talla= ejecutarSQL::consultar("SELECT * FROM talla INNER JOIN stock ON talla.CodigoTalla=stock.CodigoTalla");
                  $totalproductos = mysqli_num_rows($consulta);
                  //$dsa = $talla->fetch_array();
                  if($totalproductos>0){
                    while($fila=mysqli_fetch_array($consulta, MYSQLI_ASSOC)){
                ?>
                <div class="col-xs-12 col-sm-6 col-md-4">
                     <div class="thumbnail">
                       <img class="img-product" src="assets/img-products/<?php if($fila['Imagen']!="" && is_file("./assets/img-products/".$fila['Imagen'])){ echo $fila['Imagen']; }else{ echo "default.png"; } ?>">
                       <div class="caption">
                       		<h3><?php echo $fila['Marca']; ?></h3>
                            <p><?php echo $fila['NombreProd']; ?></p>
                            <?php if($fila['Descuento']>0): ?>
                             <p>
                             <?php
                             $pref=number_format($fila['Precio']-($fila['Precio']*($fila['Descuento']/100)), 0, '.', '');
                             echo $fila['Descuento']."% descuento: $".$pref; 
                             ?>
                             </p>
                             <?php else: ?>
                              <p>$<?php echo $fila['Precio']; ?></p>
                             <?php endif; ?>
                        <p class="text-center">
                            <a href="infoProd.php?CodigoProd=<?php echo $fila['CodigoProd']; ?>&Numero=<?php echo $fila['Numero'] ?>" class="btn btn-primary btn-sm btn-raised btn-block"><i class="fa fa-plus"></i>&nbsp; Detalles</a>
                        </p>
                       </div>
                     </div>
                </div>     
                <?php
                     }   
                  }else{
                      echo '<h2>No hay productos registrados en la tienda</h2>';
                  }  
              	?>  
            </div>
         </div>
    </section>
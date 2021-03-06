<p class="lead">
	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum voluptates, corporis nisi dolores cumque obcaecati perferendis, quisquam, ipsa commodi labore molestias dolor itaque nam cupiditate totam, ea dicta? Sit, asperiores?
</p>
<ul class="breadcrumb" style="margin-bottom: 5px;">
    <li>
        <a href="configAdmin.php?view=stock">
            <i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp; Nuevo inventario
        </a>
    </li>
    <li>
        <a href="configAdmin.php?view=stocklist"><i class="fa fa-list-ol" aria-hidden="true"></i> &nbsp; Inventario de la tienda</a>
    </li>
</ul>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
            <br><br>
            <div class="panel panel-info">
              <div class="panel-heading text-center"><h4>Inventario de la tienda</h4></div>
                <div class="table-responsive">
                  <table class="table table-striped table-hover">
                      <thead class="">
                          <tr>
                          	  <th class="text-center">#</th>
                              <th class="text-center">Código</th>
                              <th class="text-center">Producto</th>
                              <th class="text-center">Talla</th>
                              <th class="text-center">Cantidad</th>
                              <th class="text-center">Actualizar</th>
                              <th class="text-center">Eliminar</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php
                        	$mysqli = mysqli_connect(SERVER, USER, PASS, BD);
							mysqli_set_charset($mysqli, "utf8");

							$pagina = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;
							$regpagina = 30;
							$inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

							$stock=mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS * FROM stock LIMIT $inicio, $regpagina");

							$totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
							$totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);

							$numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

							$cr=$inicio+1;
                            while($st=mysqli_fetch_array($stock, MYSQLI_ASSOC)){
                        ?>
                        <tr>
                        	<td class="text-center"><?php echo $cr; ?></td>
                        	<td class="text-center"><?php echo $st['CodigoStock']; ?></td>
                        	<td class="text-center">
                        		<?php 
                        			$prod=ejecutarSQL::consultar("SELECT NombreProd FROM producto WHERE CodigoProd='".$st['CodigoProd']."'");
                        			$datc=mysqli_fetch_array($prod, MYSQLI_ASSOC);
                        			echo $datc['NombreProd'];
                        		?>
                        	</td>
                            <td class="text-center">
                        		<?php 
                        			$siz=ejecutarSQL::consultar("SELECT Numero FROM talla WHERE CodigoTalla='".$st['CodigoTalla']."'");
                        			$datc2=mysqli_fetch_array($siz, MYSQLI_ASSOC);
                        			echo $datc2['Numero'];
                        		?>
                        	</td>
                        	<td class="text-center"><?php echo $st['Cantidad']; ?></td>
                        	<td class="text-center">
                        		<a href="configAdmin.php?view=stockinfo&code=<?php echo $st['CodigoStock']; ?>" class="btn btn-raised btn-xs btn-success">Actualizar</a>
                        	</td>
                        	<td class="text-center">
                        		<form action="process/delstock.php" method="POST" class="FormCatElec" data-form="delete">
                        			<input type="hidden" name="stock-code" value="<?php echo $st['CodigoStock']; ?>">
                        			<button type="submit" class="btn btn-raised btn-xs btn-danger">Eliminar</button>	
                        		</form>
                        	</td>
                        </tr>
                        <?php 
                        	$cr++;
                        	}
                        ?>
                      </tbody>
                  </table>
                </div>
                <?php if($numeropaginas>=1): ?>
              	<div class="text-center">
                  <ul class="pagination">
                    <?php if($pagina == 1): ?>
                        <li class="disabled">
                            <a>
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="configAdmin.php?view=stocklist&pag=<?php echo $pagina-1; ?>">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>


                    <?php
                        for($i=1; $i <= $numeropaginas; $i++ ){
                            if($pagina == $i){
                                echo '<li class="active"><a href="configAdmin.php?view=stocklist&pag='.$i.'">'.$i.'</a></li>';
                            }else{
                                echo '<li><a href="configAdmin.php?view=stocklist&pag='.$i.'">'.$i.'</a></li>';
                            }
                        }
                    ?>
                    

                    <?php if($pagina == $numeropaginas): ?>
                        <li class="disabled">
                            <a>
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="configAdmin.php?view=stocklist&pag=<?php echo $pagina+1; ?>">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                  </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>
	</div>
</div>
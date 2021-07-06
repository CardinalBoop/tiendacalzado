<p class="lead">
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, culpa quasi tempore assumenda, perferendis sunt. Quo consequatur saepe commodi maxime, sit atque veniam blanditiis molestias obcaecati rerum, consectetur odit accusamus.
</p>
<ul class="breadcrumb" style="margin-bottom: 5px;">
    <li>
        <a href="configAdmin.php?view=stock">
            <i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp; Nuevo Inventario
        </a>
    </li>
    <li>
        <a href="configAdmin.php?view=stocklist"><i class="fa fa-list-ol" aria-hidden="true"></i> &nbsp; Inventario</a>
    </li>
</ul>
<div class="container">
	<div class="row">
        <div class="col-xs-12">
            <div class="container-form-admin">
                <h3 class="text-info text-center">Actualizar datos de tallas</h3>
                <?php
                	$code=$_GET['code'];
                	$stock=ejecutarSQL::consultar("SELECT * FROM stock WHERE CodigoStock='$code'");
                	$st=mysqli_fetch_array($stock, MYSQLI_ASSOC);
                ?>
                <form action="./process/updateStock.php" method="POST" class="FormCatElec" data-form="update">
                	<input type="hidden" name="code-old-stock" value="<?php echo $st['CodigoStock']; ?>">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Código</label>
                                    <input class="form-control" type="text" value="<?php echo $st['CodigoStock']; ?>" name="stock-code" maxlength="9" readonly>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Cantidad</label>
                                    <input class="form-control" value="<?php echo $st['Cantidad']; ?>" type="text" name="stock-cant" maxlength="30" required="">
                                </div>  
                            </div>
                        </div>
                    </div>
                    <p class="text-center"><button type="submit" class="btn btn-primary btn-raised">Actualizar talla</button></p>
                </form>
            </div>
        </div>
    </div>
</div>
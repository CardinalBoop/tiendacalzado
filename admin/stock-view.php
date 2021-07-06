<p class="lead">
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, culpa quasi tempore assumenda, perferendis sunt. Quo consequatur saepe commodi maxime, sit atque veniam blanditiis molestias obcaecati rerum, consectetur odit accusamus.
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
            <div class="container-form-admin">
                <h3 class="text-primary text-center">Agregar una cantidad y talla al producto</h3>
                <form action="./process/regstock.php" method="POST" enctype="multipart/form-data" class="FormCatElec" data-form="save">
                    <div class="container-fluid">
                        <div class="row">


                              <div class="col-xs-12">
                                <legend>Informacion del producto</legend>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-4">
                              <div class="form-group">
                                <label>Producto</label>
                                <select class="form-control" name="stock-producto">
                                    <?php
                                        $productoc= ejecutarSQL::consultar("SELECT * FROM producto");
                                        while($prodc=mysqli_fetch_array($productoc, MYSQLI_ASSOC)){
                                            echo '<option value="'.$prodc['CodigoProd'].'">'.$prodc['NombreProd'].'</option>';
                                        }
                                    ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                              <div class="form-group">
                                <label>Talla</label>
                                <select class="form-control" name="stock-talla">
                                    <?php
                                        $tallac=  ejecutarSQL::consultar("SELECT * FROM talla");
                                        while($tallc=mysqli_fetch_array($tallac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$tallc['CodigoTalla'].'">'.$tallc['Numero'].'</option>';
                                        }
                                    ?>
                                </select>
                              </div>
                            </div>

                            <div class="col-xs-12">
                                <legend>Stock</legend>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-4">
                              <div class="form-group label-floating">
                                <label class="control-label">Código de stock</label>
                                <input type="text" class="form-control" required maxlength="30" name="stock-codigo">
                              </div>
                          
                              <div class="form-group label-floating">
                                <label class="control-label">Unidades disponibles</label>
                                <input type="text" class="form-control" required maxlength="20" pattern="[0-9]{1,20}" name="stock-cant">
                              </div>
                           
    
                        </div>
                    </div>
                <input type="hidden"  name="admin-name" value="<?php echo $_SESSION['nombreAdmin'] ?>">
                <p class="text-center"><button type="submit" class="btn btn-primary btn-raised">Agregar a la tienda</button></p>
                </form>
            </div>
        </div>     
    </div>
</div>
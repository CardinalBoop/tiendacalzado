<?php
    session_start();
    include '../library/configServer.php';
    include '../library/consulSQL.php';

    $codeStock=consultasSQL::clean_string($_POST['stock-codigo']);
    $prodStock=consultasSQL::clean_string($_POST['stock-producto']);
    $tallaStock=consultasSQL::clean_string($_POST['stock-talla']);
    $cantStock=consultasSQL::clean_string($_POST['stock-cant']);

    if($codeStock!="" && $prodStock!="" && $tallaStock!="" && $cantStock!=""){
        $verificar =  ejecutarSQL::consultar("SELECT * FROM stock WHERE CodigoProd='$prodStock' AND CodigoTalla='$tallaStock'");
        $verificaltotal = mysqli_num_rows($verificar);
        $verificarcod = ejecutarSQL::consultar("SELECT * FROM stock WHERE CodigoStock='$codeStock'");
        $verificartotalcod = mysqli_num_rows($verificarcod);
        if($verificaltotal<=0){
            if($verificartotalcod<=0){

                        if(consultasSQL::InsertSQL("stock", "CodigoStock, CodigoProd, CodigoTalla, Cantidad", "'$codeStock','$prodStock','$tallaStock', '$cantStock'")){
                            echo '<script>
                                swal({
                                  title: "Stock registrado",
                                  text: "El stock se añadió a la tienda con éxito",
                                  type: "success",
                                  showCancelButton: true,
                                  confirmButtonClass: "btn-danger",
                                  confirmButtonText: "Aceptar",
                                  cancelButtonText: "Cancelar",
                                  closeOnConfirm: false,
                                  closeOnCancel: false
                                  },
                                  function(isConfirm) {
                                  if (isConfirm) {
                                    location.reload();
                                  } else {
                                    location.reload();
                                  }
                                });
                            </script>';
                        }else{
                            echo '<script>swal("ERROR", "Ocurrió un error inesperado, por favor intente nuevamente.", "error");</script>';
                        }  
                    }else{
                        echo '<script>swal("ERROR", "El codigo de inventario ya se encuentra registrado, ingrese otro.", "error");</script>';
                    }  
                
                          
        }else{
            echo '<script>swal("ERROR", "El producto y la talla no pueden ser repetidas, por favor seleccione otro producto u otra talla", "error");</script>';
        }
        
    }else {
        echo '<script>swal("ERROR", "Los campos no deben de estar vacíos, por favor verifique e intente nuevamente", "error");</script>';
    }
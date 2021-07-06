<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';

$codeSiz=consultasSQL::clean_string($_POST['siz-code']);
$numSiz=consultasSQL::clean_string($_POST['siz-number']);

$verificar=ejecutarSQL::consultar("SELECT * FROM talla WHERE CodigoTalla='".$codeSiz."'");
if(mysqli_num_rows($verificar)<=0){
    if(consultasSQL::InsertSQL("talla", "CodigoTalla, Numero", "'$codeSiz','$numSiz'")){
        echo '<script>
            swal({
              title: "Talla registrada",
              text: "La talla se registró con éxito en el sistema",
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
       echo '<script>swal("ERROR", "Ocurrió un error inesperado, por favor intente nuevamente", "error");</script>'; 
    }
}else{
    echo '<script>swal("ERROR", "El código que ha ingresado ya se encuentra registrado en el sistema, por favor verifique e intente nuevamente", "error");</script>';
}
mysqli_free_result($verificar);
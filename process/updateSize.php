<?php
include '../library/configServer.php';
include '../library/consulSQL.php';

$codeOldSizUp=consultasSQL::clean_string($_POST['siz-code-old']);
$numSizUp=consultasSQL::clean_string($_POST['siz-number']);
if(consultasSQL::UpdateSQL("talla", "Numero='$numSizUp'", "CodigoTalla='$codeOldSizUp'")){
    echo '<script>
        swal({
          title: "Talla actualizada",
          text: "Los datos de la talla se actualizaron con éxito",
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


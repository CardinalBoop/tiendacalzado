<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';
$codeOldStockUp=consultasSQL::clean_string($_POST['code-old-stock']);
$cantStockUp=consultasSQL::clean_string($_POST['stock-cant']);

if(consultasSQL::UpdateSQL("stock", "Cantidad='$cantStockUp'", "CodigoStock='$codeOldStockUp'")){
   echo '<script>
    swal({
      title: "Stock actualizado",
      text: "El stock se actualizo con éxito",
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
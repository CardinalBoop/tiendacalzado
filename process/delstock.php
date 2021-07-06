<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';

$stockcode=consultasSQL::clean_string($_POST['stock-code']);
if(consultasSQL::DeleteSQL('stock', "CodigoStock='".$stockcode."'")){
    echo '<script>
	    swal({
	      title: "Stock eliminado",
	      text: "Stock eliminado con éxito",
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


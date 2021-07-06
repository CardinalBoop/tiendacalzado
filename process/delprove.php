<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';

$rutProve=consultasSQL::clean_string($_POST['rut-prove']);
$cons=ejecutarSQL::consultar("SELECT * FROM producto WHERE RUTProveedor='$rutProve'");
if(mysqli_num_rows($cons)<=0){
    if(consultasSQL::DeleteSQL('proveedor', "RUTProveedor='".$rutProve."'")){
        echo '<script>
		    swal({
		      title: "Proveedor eliminado",
		      text: "Los datos del proveedor se eliminaron exitosamente",
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
    echo '<script>swal("ERROR", "Lo sentimos no podemos eliminar el proveedor ya que existen productos asociados a este proveedor", "error");</script>';
}
mysqli_free_result($cons);
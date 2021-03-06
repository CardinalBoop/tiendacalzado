<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';

$codeSiz=consultasSQL::clean_string($_POST['siz-code']);
$cons=ejecutarSQL::consultar("SELECT * FROM stock WHERE CodigoTalla='$codeSiz'");
if(mysqli_num_rows($cons)<=0){
    if(consultasSQL::DeleteSQL('talla', "CodigoTalla='".$codeSiz."'")){
        echo '<script>
		    swal({
		      title: "Talla eliminada",
		      text: "La talla se eliminó con éxito",
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
    echo '<script>swal("ERROR", "Lo sentimos no podemos eliminar la talla ya que existen inventarios asociados a dicha talla", "error");</script>';
}
mysqli_free_result($cons);
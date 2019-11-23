<?php
include '../../../config/conexionBD.php';
$id_estado=$_POST['cbx_estado'];
echo 'codigo nombre';
echo "$id_estado";
$codireu=isset($_POST["codireu"]) ? trim($_POST["codireu"]): null;
echo "$codireu";
$sql="INSERT INTO invitados VALUES(0,$id_estado,$codireu)";
echo "$sql";
$result = $conn->query($sql);
if($result){
    echo "Registro guardado";
}else{
    echo "Registro no guardado";
}
?>
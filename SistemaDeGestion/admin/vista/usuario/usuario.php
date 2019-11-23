<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">
 <title>Gestión de usuario</title>
 
 <link type="text/css" rel="stylesheet" href="../../../css/estiloresu.css "/> 
</head>
<body>
<header>
    <ul>
    
    <li><a href="../../../config/cerrar_sesion.php">Cerrar sesion</a></li>

    </ul>
</header>
 <table style="width:100%">
 <tr>
 <th>Cedula</th>
 <th>Nombres</th>
 <th>Apellidos</th>
 <th>Dirección</th>
 <th>Telefono</th>
 <th>Correo</th>
 <th>Fecha Nacimiento</th>
 </tr>
 <?php
 session_start();
 if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){
 header("Location: /SistemaDeGestion/public/vista/login.html");
 }
?>
 <?php
  $codigo = $_GET["codigo"];  
 include '../../../config/conexionBD.php'; 
   
 $sql = "SELECT * FROM usuario WHERE usu_codigo='$codigo' ";
 $result = $conn->query($sql);
 if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()) {
 echo "<tr>";
 echo " <td>" . $row["usu_cedula"] . "</td>";
 echo " <td>" . $row['usu_nombre'] ."</td>";
 echo " <td>" . $row['usu_apellido'] . "</td>";
 echo " <td>" . $row['usu_direccion'] . "</td>";
 echo " <td>" . $row['usu_telefono'] . "</td>";
 echo " <td>" . $row['usu_correo'] . "</td>";
 echo " <td>" . $row['usu_fecha_nacimiento'] . "</td>";
 echo "   <td> <a href='eliminar.php?codigo=" . $row['usu_codigo'] . "'>Eliminar</a> </td>";  
 echo "   <td> <a href='modificar.php?codigo=" . $row['usu_codigo'] . "'>Modificar</a> </td>";   
 echo "   <td> <a href='cambiar_contrasena.php?codigo=" . $row['usu_codigo'] . 
 "'>Cambiar contraseña</a> </td>";   
 echo "   <td> <a href='crear_reunion.php?codigo=" . $row['usu_correo'] . "'>Crear reunion</a> </td>";  
 echo "   <td> <a href='../../../public/vista/buscar.html'>Buscar Reuniones</a> </td>";  

  echo "</tr>";
 }
 } else {
 echo "<tr>";
 echo " <td colspan='7'> No existen usuarios registradas en el sistema </td>";
 echo "</tr>";
 }
 $conn->close();
 ?>
 </table>

 <table>
 <table style="width:100%">
 <tr>
 <th>Fecha</th>
 <th>Hora</th>
 <th>Lugar</th>
 <th>Latitud</th>
 <th>Longitud</th>
 <th>Motivo</th>
 <th>Observaciones</th>
 </tr>
 <?php
 include '../../../config/conexionBD.php';
 $sql = "SELECT * FROM reuniones ";
 $result = $conn->query($sql);

 if ($result->num_rows > 0) {

 while($row = $result->fetch_assoc()) {
 echo "<tr>";
 echo " <td>" . $row['reu_fecha'] ."</td>";
 echo " <td>" . $row['reu_hora'] . "</td>";
 echo " <td>" . $row['reu_lugar'] . "</td>";
 echo " <td>" . $row['reu_latitud'] . "</td>";
 echo " <td>" . $row['reu_longitud'] . "</td>";
 echo " <td>" . $row['reu_motivo'] . "</td>"; 
 echo " <td>" . $row['reu_observaciones'] . "</td>";      
 echo "   <td> <a href='invitar.php?codigoreu=" . $row['reu_id'] . "'>Invitar</a> </td>"; 
 echo "</tr>";
 }
 } else {
 echo "<tr>";
 echo " <td colspan='8'> No existen usuarios registradas en el sistema </td>";
 echo "</tr>";
 }
 $conn->close();
 ?>
</table>

<table>
<table style="width:100%">
<tr>
<th>Nombre</th>
<th>Fecha</th>
<th>Hora</th>
<th>Lugar</th>
<th>Latitud</th>
<th>Longitud</th>
<th>Motivo</th>
<th>Observaciones</th>
</tr>
<?php
 $codigo = $_GET["codigo"];  
include '../../../config/conexionBD.php';
/*SELECT usuario.usu_nombre AS nombre,reuniones.reu_fecha, reuniones.reu_lugar , 
reuniones.reu_hora,reuniones.reu_latitud,reuniones.reu_longitud,reuniones.reu_remitente,
reuniones.reu_motivo,reuniones.reu_observaciones as reuni  FROM invitados,usuario,reuniones 
WHERE usuario.usu_codigo
 = invitados.invitado and reuniones.reu_id=invitados.reunion; */
$sql = "SELECT usu_nombre from invitados,usuario where invitados.invitado=$codigo";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()) {
echo "<tr>";
echo " <td>" . $row['id_invitado'] ."</td>";
echo " <td>" . $row['invitado'] . "</td>";
echo " <td>" . $row['reunion'] . "</td>";
echo "</tr>";
}
} else {
echo "<tr>";
echo " <td colspan='8'> No existen usuarios registradas en el sistema </td>";
echo "</tr>";
}
$conn->close();
?>
</table>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">
 <title>Gestión de usuarios</title>
</head>
<body>

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
 include '../../../config/conexionBD.php';
 $sql = "SELECT * FROM usuario WHERE rol='usuario'";
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
 echo "   <td> <a href='eliminar.php?codigo=" . $row['reu_id'] . "'>Eliminar</a> </td>";  
 echo "   <td> <a href='modificar.php?codigo=" . $row['reu_id'] . "'>Modificar</a> </td>";   
 echo "   <td> <a href='cambiar_contrasena.php?codigo=" . $row['reu_id'] . 
 "'>Cambiar contraseña</a> </td>"; 
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

 </table>
</body>
</html>

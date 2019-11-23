<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">  
    <title>Buscar</title>
</head>
<body>
<?php
 //incluir conexión a la base de datos
 include "../../config/conexionBD.php";
 $motivo = $_GET['motivo'];

 $sql = "SELECT * FROM reuniones WHERE  reu_motivo='$motivo'";
//cambiar la consulta para puede buscar por ocurrencias de letras
 $result = $conn->query($sql);
 echo " <table style='width:100%'>
 <tr>
 <th>Fecha</th>
 <th>Hora</th>
 <th>Lugar</th>
 <th>Latitud</th>
 <th>Longitud</th>
 <th>Remitente</th>
 <th>Motivo</th>
 <th>Observaciones</th>
 <th></th>
 <th></th>
 <th></th>
 </tr>";
 if ($result->num_rows > 0) {
 while($row = $result->fetch_assoc()) {
 echo "<tr>";
 echo " <td>" . $row['reu_fecha'] . "</td>";
 echo " <td>" . $row['reu_hora'] ."</td>";
 echo " <td>" . $row['reu_lugar'] . "</td>";
 echo " <td>" . $row['reu_latitud'] . "</td>";
 echo " <td>" . $row['reu_longitud'] . "</td>";
 echo " <td>" . $row['reu_remitente'] . "</td>";
 echo " <td>" . $row['reu_motivo'] . "</td>"; 
 echo " <td>" . $row['reu_observaciones'] . "</td>";
 echo "</tr>";
 }
 } else {
 echo "<tr>";
 echo " <td colspan='7'> No existen usuarios registradas en el sistema </td>";
 echo "</tr>";
 }
 echo "</table>";
 $conn->close();

?>
    
</body>
</html>

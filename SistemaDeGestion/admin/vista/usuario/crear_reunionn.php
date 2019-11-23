<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Crear Nuevo Usuario</title>
<style type="text/css" rel="stylesheet">
.error{
color: red;
}
</style>
</head>
<body>
<?php
 session_start();
 if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){
 header("Location: /SistemaDeGestion/public/vista/login.html");
 }
?>

<?php
//incluir conexión a la base de datos
      include '../../../config/conexionBD.php';
      $fecha = isset($_POST["fecha"]) ? trim($_POST["fecha"]) : null;
      $hora = isset($_POST["hora"]) ? mb_strtoupper(trim($_POST["hora"]), 'UTF-8') : null;
      $lugar = isset($_POST["lugar"]) ? mb_strtoupper(trim($_POST["lugar"]), 'UTF-8') : null;
      $latitud = isset($_POST["latitud"]) ? mb_strtoupper(trim($_POST["latitud"]), 'UTF-8') : null;
      $longitud = isset($_POST["longitud"]) ? trim($_POST["longitud"]): null;
      $remitente=isset($_POST["remitente"]) ? trim($_POST["remitente"]): null;
      $motivo = isset($_POST["motivo"]) ? trim($_POST["motivo"]): null;
      $observa = isset($_POST["obser"]) ? trim($_POST["obser"]): null;
      $sql = "INSERT INTO reuniones VALUES (0, '$fecha', '$hora', '$lugar', '$latitud', '$longitud',
      '$remitente', '$motivo', '$observa')";
      if ($conn->query($sql) === TRUE) {
      echo "<p>Se ha creado los de reunion correctamente!!!</p>";
      } else {
      if($conn->errno == 1062){
      echo "<p class='error'>La reunion ya esta registrada </p>";
      }else{echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
      }
      }
      //cerrar la base de datos
      $conn->close();
      echo "<a href='../../../publica/vista/login.html'>Regresar</a>";
      ?>
</body>
</html>
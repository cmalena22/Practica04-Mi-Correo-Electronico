# Practica04-Mi-Correo-Electronico
<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">
 <title>Iniciar sesión</title>
 <link type="text/css" rel="stylesheet" href="../../css/estilos.css "/>
</head>

<body>
    <head>
        <ul>
            <li><em><a href="formulario.html">Registrarse</a></em></li>
        </ul>
    </head>
 <form id="formulario02" method="POST" action="../controladores/login.php">
 <label for="correo">Correo electrónico </label>
 <input type="text" id="correo" name="correo" value="" placeholder="Ingrese el correo ..."/>
 <br>
 <label for="nombres">Constraseña (*)</label>
 <input type="password" id="contrasena" name="contrasena" value="" placeholder="Ingrese su
contraseña ..."/>
 <br>
 <input type="submit" id="login" name="login" value="Iniciar Sesión" />

 </form>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href=" ../../css/estilos.css "/>
    
</head>
<body>

    <form id="formulario01" method="POST" action="../controladores/crear_usuario.php" >
          
        <label for="cedula">Cedula (*)</label>
        <input type="text" maxlength="10" id="cedula" name="cedula" value="" placeholder="Ingrese el número de cedula ..." />
        <span id="mensajeCedula" class="error"></span>        
        <br>

        <label for="nombres">Nombres (*)</label>
        <input type="text" id="nombre" name="nombre" value="" placeholder="Ingrese sus dos nombres ..."
       />
        <br>

        <label for="apellidos">Apelidos (*)</label>
        <input type="text" id="apellidos" name="apellidos" value="" placeholder="Ingrese sus dos apellidos ..." 
       />
        <br>

        <label for="direccion">Dirección (*)</label>
        <input type="text" id="direccion" name="direccion" value="" placeholder="Ingrese su dirección ..." 
       />
        <br>

        <label for="telefono">Teléfono (*)</label>
        <input type="text" maxlength="10" id="telefono" name="telefono" value=""  placeholder="Ingrese su número telefónico ..." 
        />
        <br>                

        <label for="fecha">Fecha Nacimiento (*)</label>
        <input type="text" id="fechaNacimiento" name="fechaNacimiento" value="" placeholder="dd/mm/yyyy"
       />

        <spam id="f" style="display: none;">ERROR</spam>
        <br>	

        <label for="correo">Correo electrónico (*)</label>
        <input type="email" id="correo" name="correo"  placeholder="Ingrese su correo electrónico ..."
       />
        <br>

        <label for="correo">Contraseña (*)</label>
        <input type="password" id="contrasena" name="contrasena" value="" placeholder="Ingrese su contraseña ..." />
        <br>

        <input type="submit" id="crear" name="crear" value="Aceptar" />
        <input type="reset" id="cancelar" name="cancelar" value="Cancelar" />
    </form> 
 

</body>
</html>

<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">
 <link type="text/css" rel="stylesheet" href="../../css/estiloresu.css "/>
 <title>Buscar</title>
</head>

<body>
    
    <form onsubmit="return buscarPorCedula()" action="../controladores/buscar.php">
        <input type="text" id="motivo" name="motivo" value="">
        <input type="button" id="buscar" name="buscar" value="Buscar" onclick="buscarPorCedula()">
       </form>
       <div id="informacion"><b>Datos de la persona</b></div>
<script>

function buscarPorCedula() {
 var motivo = document.getElementById("motivo").value;
 if (motivo == "") {
 document.getElementById("informacion").innerHTML = "";
 } else {
 if (window.XMLHttpRequest) {
 // code for IE7+, Firefox, Chrome, Opera, Safari
 xmlhttp = new XMLHttpRequest();
 } else {
 // code for IE6, IE5
 xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
 }
 xmlhttp.onreadystatechange = function() {
 if (this.readyState == 4 && this.status == 200) {
 document.getElementById("informacion").innerHTML = this.responseText;
 
 }
 };
 xmlhttp.open("GET","../controladores/buscar.php?motivo="+motivo,true);
 xmlhttp.send();
 }
 return false;
}
</script>
</body>
</html>

<?php     session_start();     
if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){                 
    header("Location: /SistemaDeGestion/public/vista/login.html");             
    } 
?>
<?php     session_start(); 
 
    include '../../config/conexionBD.php'; 
 
    $usuario = isset($_POST["correo"]) ? trim($_POST["correo"]) : null;     
    $contrasena = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : null;  
    $sql = "SELECT * FROM usuario WHERE usu_correo = '$usuario' and usu_password = '$contrasena'"; 
 
    $result = $conn->query($sql);            
    if ($result->num_rows > 0) {  
        $_SESSION['isLogged'] = TRUE;  
        while($row = $result->fetch_assoc()) {
          if($row["rol"]=="administrador"){
            header("Location: ../../admin/vista/usuario/index.php");        

            }else {
            header("Location: ../../admin/vista/usuario/usuario.php?codigo=".$row['usu_codigo']);  
            echo"dhfjgdf";
        }
        }
 } else {             
        header("Location: ../vista/login.html");     
    }              
    $conn->close(); 
 
?> 


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
 //incluir conexión a la base de datos
 include '../../config/conexionBD.php';
 $cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : null;
 $nombre = isset($_POST["nombre"]) ? mb_strtoupper(trim($_POST["nombre"]), 'UTF-8') : null;
 $apellido = isset($_POST["apellidos"]) ? mb_strtoupper(trim($_POST["apellidos"]), 'UTF-8') : null;
 $direccion = isset($_POST["direccion"]) ? mb_strtoupper(trim($_POST["direccion"]), 'UTF-8') : null;
 $telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]): null;
 $correo = isset($_POST["correo"]) ? trim($_POST["correo"]): null;
 $contrasena = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : null;
 $fechaNacimiento = isset($_POST["fechaNacimiento"]) ? trim($_POST["fechaNacimiento"]): null; 
 
 $sql = "INSERT INTO usuario VALUES (0, '$cedula', '$nombre', '$apellido', '$direccion', '$telefono',
'$correo', '$contrasena', '$fechaNacimiento','usuario')";
 if ($conn->query($sql) === TRUE) {
 echo "<p>Se ha creado los datos personales correctamemte!!!</p>";
 } else {
 if($conn->errno == 1062){
 echo "<p class='error'>La persona con la cedula $cedula ya esta registrada en el sistema </p>";
 }else{
 echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
 }
 }
 //cerrar la base de datos
 $conn->close();
 echo "<a href='../../public/vista/login.html '>Regresar</a>";
 ?>
</body>
</html>

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

html{
    margin:0 auto ;
    width: 40%;
    max-width: 3050px;
    min-width:1150px;
}

body {
	margin: 0 auto;
	width: 100%;
	max-width: 2000px;
}
html {  
    background-color: rgb(222, 224, 228);
   }  
  body { 
    background-color: #EEF5DB; 
       }
    
    table {
        /* Para asegurarse que todos los labels tienen el mismo tamaño y están alineados correctamente */
        display: inline-block;
        width: 500px;
        text-align: right;
        margin-left: .5em;
        padding-left: 10px;
        border:1px solid black;        
        border-collapse: separate;
        border-spacing: 30px 20px;
    }
    
     a{
      font-family: 'Courier New', Courier, monospace;
      color: black;
      }
      form {   
        /* Para ver el borde del formulario */
        padding: 1em;
       
        border-radius: 2em;
    }

html{
    margin:0 auto ;
    width: 40%;
    max-width: 1000px;
    min-width:500px;
}

body {
	margin: 0 auto;
	width: 100%;
	max-width: 1120px;
}
html {  
    background-color: rgb(222, 224, 228);
   }  
  body { 
    background-color: #EEF5DB; 
       }
       form {   
        /* Para ver el borde del formulario */
        padding: 1em;
        border: 2px solid #333745;
        border-radius: 2em;
    }
    label {
        /* Para asegurarse que todos los labels tienen el mismo tamaño y están alineados correctamente */
        display: inline-block;
        width: 150px;
        text-align: right;
        margin-left: .5em;
        padding-left: 90px;
    }
     a{
      font-family: 'Courier New', Courier, monospace;
      color: black;
      }

<?php
$db_servername="localhost";
$db_username="root";
$db_password="";
$db_name="practica";

$conn= new mysqli($db_servername,$db_username,$db_password,$db_name);
$conn->set_charset("utf8");

#probar conexion
if ($conn->connect_error) {
    die("Connection Failed:".$conn->connect_error);
}else {
    echo "<p>Conexion Exitosa :) </p>";
}

?>

<?php
 session_start();
 $_SESSION['isLogged'] = FALSE;
 session_destroy();
 header("Location: ../public/vista/login.html");
?>

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

<!DOCTYPE html> 
<html> 
    <head>     
        <meta charset="UTF-8">     
        <title>Modificar datos de persona</title>     
        
 <link type="text/css" rel="stylesheet" href="../../../css/estilos.css "/> 
    </head> 
 
<body>   
<?php     session_start();     
if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){                 
    header("Location: /SistemaDeGestion/public/vista/login.html");             
    } 
?>
    <?php         
    $codigo = $_GET["codigo"];         
    $sql = "SELECT * FROM usuario where usu_codigo=$codigo"; 
 
        include '../../../config/conexionBD.php';          
        $result = $conn->query($sql);                  
        if ($result->num_rows > 0) {                          
            while($row = $result->fetch_assoc()) {             
        ?> 
 
                <form id="formulario01" method="POST" action="../../controladores/usuario/modificar.php"> 
                <input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo ?>" /> 
 
                    <label for="cedula">Cedula (*)</label>                     
                    <input type="text" id="cedula" name="cedula" value="<?php echo $row["usu_cedula"]; ?>" required placeholder="Ingrese la cedula ..."/>                     
                    <br> 
 
                    <label for="nombres">Nombres (*)</label>                     
                    <input type="text" id="nombre" name="nombre" value="<?php echo $row["usu_nombre"]; ?>" required placeholder="Ingrese los dos nombres ..."/>                     
                    <br> 
 
                    <label for="apellidos">Apelidos (*)</label>                     
                    <input type="text" id="apellido" name="apellido" value="<?php echo $row["usu_apellido"]; ?>" required placeholder="Ingrese los dos apellidos ..."/>                     
                    <br> 
 
                    <label for="direccion">Dirección (*)</label>                     
                    <input type="text" id="direccion" name="direccion" value="<?php echo $row["usu_direccion"]; ?>" required placeholder="Ingrese la dirección ..."/>                     
                    <br> 
 
                    <label for="telefono">Teléfono (*)</label>                     
                    <input type="text" id="telefono" name="telefono" value="<?php echo $row["usu_telefono"]; ?>" required placeholder="Ingrese el teléfono ..."/>                     
                    <br>                 
 
                    <label for="fecha">Fecha Nacimiento (*)</label>                     
                    <input type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $row["usu_fecha_nacimiento"]; ?>" required placeholder="Ingrese la fecha de nacimiento ..."/>                     
                    <br> 
 
                    <label for="correo">Correo electrónico (*)</label>                     
                    <input type="email" id="correo" name="correo" value="<?php echo $row["usu_correo"]; ?>" required placeholder="Ingrese el correo electrónico ..."/>                     
                    <br>                                         
                     <input type="submit" id="modificar" name="modificar" value="Modificar" />                     
                     <input type="reset" id="cancelar" name="cancelar" value="Cancelar" /> 
                </form>                     
 
             <?php             
            }         
            } else {                         
                echo "<p>Ha ocurrido un error inesperado !</p>";             
                echo "<p>" . mysqli_error($conn) . "</p>";         
                }         
                $conn->close();              
                ?>                       
 
</body> 
</html> 

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Gestión de usuarios</title>
<a href="../../../config/cerrar_sesion.php">Cerrar sesion</a>
<script src="js/"></script> 
</head>

<body>
    <?php
    include '../../../config/conexionBD.php';
    $codi=$_GET['codigoreu'];
    $sql = "SELECT usu_codigo,usu_nombre FROM usuario WHERE rol='usuario'";
    $result = $conn->query($sql);
    ?>
 <form id="combo" name="combo" action="guardarasistete.php" method="POST">
     <div> Selecciona un usuario:<select id="cbx_estado" name="cbx_estado">
        <option id ="codigo" value="0">Seleccionar usuario</option>
        <?php while($row =$result->fetch_assoc()) { ?>
         <option value="<?php echo $row['usu_codigo']; ?>"><?php echo $row['usu_nombre']; ?>
        
         
        <?php 
    } 
    ?>
        <input type="hidden" id="codireu" name="codireu" value="<?php echo $codi ?>" />
        <input type="submit" id="enviar" value="Guardar" />
        </select>
        </div>
        </body>
</html>

<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">
 <title>Gestión de usuarios</title>
 
 <link type="text/css" rel="stylesheet" href=" ../../../css/estiloresu.css "/>
 
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
 <?php     session_start();     
if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){                 
    header("Location: /SistemaDeGestion/public/vista/login.html");             
    } 
?>
 <?php
 include '../../../config/conexionBD.php';
 $sql = "SELECT * FROM usuario WHERE rol='usuario'";
 $result = $conn->query($sql);

 if ($result->num_rows > 0) {

 while($row = $result->fetch_assoc()) {//for each 01 & para concatenar y pasar paremetros en el url
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
 $sql = "SELECT * FROM reuniones ORDER BY reu_fecha DESC ";
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
 echo "   <td> <a href='eliminarr.php?codigo=" . $row['reu_id'] . "'>Eliminar</a> </td>";  
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

<!DOCTYPE html> 
<html> 
    <head>     
        <meta charset="UTF-8">     
        <title>Eliminar datos de persona</title>     
        
 <link type="text/css" rel="stylesheet" href="../../../css/estilos.css "/> 
    </head> 
 
<body>     
<?php     session_start();     
if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){                 
    header("Location: /SistemaDeGestion/public/vista/login.html");             
    } 
?>
    <?php              
    $codigo = $_GET["codigo"];         
    $sql = "SELECT * FROM reuniones where reu_id=$codigo";                  
    include '../../../config/conexionBD.php';          
    $result = $conn->query($sql);                  
    if ($result->num_rows > 0) {                          
        while($row = $result->fetch_assoc()) {             
    ?> 
 
                <form id="formulario01" method="POST" action="../../controladores/usuario/eliminarr.php">                     
                <input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo ?>" /> 
 
                    <label for="fecha">fecha (*)</label>                     
                    <input type="text" id="cedula" name="cedula" value="<?php echo $row["reu_fecha"]; ?>" disabled/>                     <br> 
 
                    <label for="hora">Hora (*)</label>                     
                    <input type="text" id="hora" name="hora" value="<?php echo $row["reu_hora"]; ?>" disabled/>                     <br> 
 
                    <label for="lugar">Lugar (*)</label> 
                    <input type="text" id="lugar" name="lugar" value="<?php echo $row["reu_lugar"]; ?>" disabled/>                     <br> 
 
                    <label for="latitud">Latitud (*)</label>                     
                    <input type="text" id="latitud" name="latitud" value="<?php echo $row["reu_latitud"]; ?>" disabled/>                     <br> 
 
                    <label for="longitud">Longitud (*)</label>                     
                    <input type="text" id="longitud" name="longitud" value="<?php echo $row["reu_longitud"]; ?>" disabled/>                     <br>                 
 
                    <label for="motivo">Motivo (*)</label>                     
                    <input type="text" id="motivo" name="motivo" value="<?php echo $row["reu_motivo"]; ?>" disabled/>                     <br> 
 
                    <label for="observaciones">Observaciones (*)</label>                     
                    <input type="text" id="observaciones" name="observaciones" value="<?php echo $row["reu_observaciones"]; ?>" disabled/>                     <br>                                          
                    <input type="submit" id="eliminar" name="eliminar" value="Eliminar" />                     
                    <input type="reset" id="cancelar" name="cancelar" value="Cancelar" />                 
                </form>                     
 
             <?php            
             }         
             } else {                         
                 echo "<p>Ha ocurrido un error inesperado !</p>";             
                 echo "<p>" . mysqli_error($conn) . "</p>";         
                 }         
                 $conn->close();              
                 ?>                       
 
</body> 
</html> 
       

<!DOCTYPE html> 
<html> 
    <head>     
        <meta charset="UTF-8">     
        <title>Eliminar datos de persona</title>    
        
 <link type="text/css" rel="stylesheet" href="../../../css/estilos.css "/> 
        
    </head> 
 
<body>     
<?php     session_start();     
if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){                 
    header("Location: /SistemaDeGestion/public/vista/login.html");             
    } 
?>
    <?php              
    $codigo = $_GET["codigo"];         
    $sql = "SELECT * FROM usuario where usu_codigo=$codigo";                  
    include '../../../config/conexionBD.php';          
    $result = $conn->query($sql);                  
    if ($result->num_rows > 0) {                          
        while($row = $result->fetch_assoc()) {             
    ?> 
 
                <form id="formulario01" method="POST" action="../../controladores/usuario/eliminar.php">                     <input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo ?>" /> 
 
                    <label for="cedula">Cedula (*)</label>                     
                    <input type="text" id="cedula" name="cedula" value="<?php echo $row["usu_cedula"]; ?>" disabled/>                     <br> 
 
                    <label for="nombres">Nombres (*)</label>                     
                    <input type="text" id="nombre" name="nombre" value="<?php echo $row["usu_nombre"]; ?>" disabled/>                     <br> 
 
                    <label for="apellidos">Apelidos (*)</label> 
                    <input type="text" id="apellido" name="apellido" value="<?php echo $row["usu_apellido"]; ?>" disabled/>                     <br> 
 
                    <label for="direccion">Dirección (*)</label>                     
                    <input type="text" id="direccion" name="direccion" value="<?php echo $row["usu_direccion"]; ?>" disabled/>                     <br> 
 
                    <label for="telefono">Teléfono (*)</label>                     
                    <input type="text" id="telefono" name="telefono" value="<?php echo $row["usu_telefono"]; ?>" disabled/>                     <br>                 
 
                    <label for="fecha">Fecha Nacimiento (*)</label>                     
                    <input type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $row["usu_fecha_nacimiento"]; ?>" disabled/>                     <br> 
 
                    <label for="correo">Correo electrónico (*)</label>                     
                    <input type="email" id="correo" name="correo" value="<?php echo $row["usu_correo"]; ?>" disabled/>                     <br>                                          
                    <input type="submit" id="eliminar" name="eliminar" value="Eliminar" />                     
                    <input type="reset" id="cancelar" name="cancelar" value="Cancelar" />                 
                </form>                     
 
             <?php            
             }         
             } else {                         
                 echo "<p>Ha ocurrido un error inesperado !</p>";             
                 echo "<p>" . mysqli_error($conn) . "</p>";         
                 }         
                 $conn->close();              
                 ?>                       
 
</body> 
</html> 

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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href ="archivo.css" rel="stylesheet"/>
   
    <style type="text/css">
      .error {
          color: red;
          font-size: 8px;
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
$codigo=$_GET['codigo'];
?>
    <article class="about_tss">
        <h1>Formulario</h1>
          <form action="crear_reunionn.php" method="post" onsubmit="return validarCampos()">
            <label for="fecha">Fecha:</label>
            <input type="text" id="fecha" name="fecha" onkeyup="return validarLetras(this);this.value=dosPalabras(this.value)"/>
            <br>
                   <label for="hora">Hora:</label>
                  <input type="text" id="hora" name="hora" onkeyup="return validarLetras(this);this.value=dosPalabras(this.value)"/>
                  <br>

                  <label for="lugar">Lugar:</label>
                  <input type="text" id="lugar" name="lugar" onkeyup="return validarLetras(this);this.value=dosPalabras(this.value)"/>
                  
                  <br>

                  <label for="latitud">Latitud:</label>
                  <input type="text" id="latitud" name="latitud"  onkeyup="return ValidarFecha();this.value=validarLetras(this.value)"/>
                 
                <br>

                <label for="longitud">Longitud:</label>
                <input type="text" id="longitud" name="longitud" />
                <br>

                <input type="hidden" id="remitente" name="remitente" value="<?php echo $codigo ?>" />

                <br>
                  <label for="motivo">Motivo:</label>
                  <input type="text" id="motivo"name="motivo" maxlength="10" onkeyup="this.value=ValidarNumeros(this.value)" />
                  <br>

                  <label for="observacion">Observacion:</label>
                  <input type="text" id="obser" name="obser" onkeyup="return valdarCorreo();this.value=validarAlfa(this.value)"/>
             
                  <br>
                  <input type="submit" id="crear" value="Aceptar" name="crear"/>
                  <br>
                  <input type="reset" id="cancelar" name="cancelar" name="cancelar" value="Cancelar" />
                 
          </form>
        </article>


</body>
</html>

<!DOCTYPE html> 
<html> 
<head> 
    <meta charset="UTF-8">     
    <title>Modificar datos de persona</title>    
    
 <link type="text/css" rel="stylesheet" href="../../../css/estilos.css "/>  
    </head> 
 
<body>   
<?php     session_start();     
if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){                 
    header("Location: /SistemaDeGestion/public/vista/login.html");             
    } 
?>  
<?php         
$codigo = $_GET["codigo"];             
?> 
 
    <form id="formulario01" method="POST" action="../../controladores/usuario/cambiar_contrasena.php">                  
    <input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo ?>" /> 
 
        <label for="cedula">Contraseña Actual (*)</label>         
        <input type="password" id="contrasena1" name="contrasena1" value="" required placeholder="Ingrese su contraseña actual ..."/>         
        <br> 
 
        <label for="cedula">Contraseña Nueva (*)</label>         
        <input type="password" id="contrasena2" name="contrasena2" value="" required placeholder="Ingrese su contraseña nueva ..."/>         
        <br>                  
        <input type="submit" id="modificar" name="modificar" value="Modificar" />         
        <input type="reset" id="cancelar" name="cancelar" value="Cancelar" />     
        </form>                                 
 
</body> 
</html> 

<!DOCTYPE html> 
<html> 
    <head>     
        <meta charset="UTF-8">     
        <title>Modificar datos de persona </title> 
    </head> 
    <body> 
        <?php     session_start();     
        if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){                 
        header("Location: /SistemaDeGestion/public/vista/login.html");             
        } 
        ?>  
<?php         
        //incluir conexión a la base de datos     
        include '../../../config/conexionBD.php';  
 
    $codigo = $_POST["codigo"];     
    $cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : null;     
    $nombres = isset($_POST["nombre"]) ? mb_strtoupper(trim($_POST["nombre"]), 'UTF-8') : null;     
    $apellidos = isset($_POST["apellido"]) ? mb_strtoupper(trim($_POST["apellido"]), 'UTF-8') : null;     
    $direccion = isset($_POST["direccion"]) ? mb_strtoupper(trim($_POST["direccion"]), 'UTF-8') : null;     
    $telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]): null;         
    $correo = isset($_POST["correo"]) ? trim($_POST["correo"]): null;     
    $fechaNacimiento = isset($_POST["fechaNacimiento"]) ? trim($_POST["fechaNacimiento"]): null;  
 
    
    $sql = "UPDATE usuario " .
    "SET usu_cedula = '$cedula', " .
    "usu_nombre = '$nombres', " .            
    "usu_apellido = '$apellidos', " .                       
    "usu_direccion = '$direccion', " .             
    "usu_telefono = '$telefono', " .            
    "usu_correo = '$correo', " .            
    "usu_fecha_nacimiento = '$fechaNacimiento' " .         
    "WHERE usu_codigo = $codigo"; 
 
    if ($conn->query($sql) === TRUE) {         
        echo "Se ha actualizado los datos personales correctamemte!!!<br>";          
    } else {                 
        echo "Error: " . $sql . "<br>" . mysqli_error($conn) . "<br>";             
    }     
    echo "<a href='../../vista/usuario/usuario.php'>Regresar</a>"; 
 
    $conn->close();      
    ?> 
    </body> 
    </html> 

<!DOCTYPE html> 
<html> 
    <head>     
        <meta charset="UTF-8">     
        <title>Eliminar reuniones </title> 
        </head> 
        <body> 
        <?php     
        session_start();     
             if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){                 
                header("Location: /SistemaDeGestion/public/vista/login.html");             
                } 
?>
            <?php     //incluir conexión a la base de datos     
            include '../../../config/conexionBD.php';  
 
    $codigo = $_POST["codigo"];              //Si voy a eliminar físicamente el registro de la tabla     //$sql = "DELETE FROM usuario WHERE codigo = '$codigo'"; 
 
    date_default_timezone_set("America/Guayaquil");     
    $fecha = date('Y-m-d H:i:s', time());    
    $sql = "DELETE FROM reuniones WHERE reu_id = '$codigo'";  
 
    if ($conn->query($sql) === TRUE) {                 
        echo "<p>Se ha eliminado los datos correctamemte!!!</p>";          
    } else {                 
        echo "<p>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>";             
    }     echo "<a href='../../vista/usuario/index.php'>Regresar</a>"; 
 
    $conn->close();     
     ?> 
</body> 
</html> 

<!DOCTYPE html> 
<html> 
    <head>     
        <meta charset="UTF-8">     
        <title>Eliminar datos de persona </title> 
        </head> 
        <body> 
        <?php     session_start();     
    if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){                 
    header("Location: /SistemaDeGestion/public/vista/login.html");             
    } 
?>
            <?php     //incluir conexión a la base de datos     
            include '../../../config/conexionBD.php';  
 
    $codigo = $_POST["codigo"];              
    
    date_default_timezone_set("America/Guayaquil");     
    $fecha = date('Y-m-d H:i:s', time());    
    $sql = "DELETE FROM usuario WHERE usu_codigo = '$codigo'";  
 
    if ($conn->query($sql) === TRUE) {                 
        echo "<p>Se ha eliminado los datos correctamemte!!!</p>";          
    } else {                 
        echo "<p>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>";             
    }     echo "<a href='../../vista/usuario/index.php'>Regresar</a>"; 
 
    $conn->close();     
     ?> 
</body> 
</html> 
 
<!DOCTYPE html> 
<html> 
<head>     
<meta charset="UTF-8">     
<title>Modificar datos de persona </title> 
</head> 
<body> 
<?php     session_start();     
if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){                 
    header("Location: /SistemaDeGestion/public/vista/login.html");             
    } 
?>
<?php         //incluir conexión a la base de datos     
include '../../../config/conexionBD.php';  
 
    $codigo = $_POST["codigo"];     
    $contrasena1 = isset($_POST["contrasena1"]) ? trim($_POST["contrasena1"]) : null;     
    $contrasena2 = isset($_POST["contrasena2"]) ? trim($_POST["contrasena2"]) : null; 
 
    $sqlContrasena1 = "SELECT * FROM usuario where usu_codigo=$codigo and usu_password='$contrasena1'";             
    $result1 = $conn->query($sqlContrasena1);              
    if ($result1->num_rows > 0) {                    
 
        date_default_timezone_set("America/Guayaquil");         
        $fecha = date('Y-m-d H:i:s', time()); 
 
        $sqlContrasena2 = "UPDATE usuario " .             
        "SET usu_password = '$contrasena2' " .             
        "WHERE usu_codigo = $codigo"; 
 
        if ($conn->query($sqlContrasena2) === TRUE) {             
            echo "Se ha actualizado la contraseña correctamemte!!!<br>";              
        } else {                     
            echo "<p>Error: " . mysqli_error($conn) . "</p>";                 
        }                     
     }else{        
          echo "<p>La contraseña actual no coincide con nuestros registros!!! </p>";                 
        }     
        echo "<a href='../../vista/usuario/index.php'>Regresar</a>";     
        $conn->close();      
?> </body> </html> 
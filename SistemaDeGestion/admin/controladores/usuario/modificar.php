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
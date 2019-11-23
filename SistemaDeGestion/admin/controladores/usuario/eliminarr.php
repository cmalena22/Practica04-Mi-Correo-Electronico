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
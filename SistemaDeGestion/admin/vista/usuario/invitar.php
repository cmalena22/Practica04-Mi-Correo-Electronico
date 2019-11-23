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

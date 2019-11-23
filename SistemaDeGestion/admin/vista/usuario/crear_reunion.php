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
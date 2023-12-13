<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario GestionXML Mueble</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
    
    <?php
        include_once(__DIR__ . '/Hermandad.php');
        include_once(__DIR__ . '/Patrimonio.php');
        include_once(__DIR__ . '/Mueble.php');
        include_once(__DIR__ . '/Inmueble.php');
        include_once(__DIR__ . '/GestionXML.php');
        if(!isset($_SESSION)) {
            session_start();
        }
    ?> 


    <div id="formularios">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="formMenu">
            <h1>Gestionar Patrimonio Material - <?php echo $_SESSION['hermandad']->getNombre(); ?> </h1>
            <input type="button" value="Añadir Material" onclick="location.href='FormularioAñadirPatrimonioMaterial.php'" id="añadir">
            <input type="button" value="Mostar Material" onclick="location.href='FormularioMostrarPatrimonioMaterial.php'" id="mostrar">
            <input type="button" value="Borrar Material" onclick="location.href='FormularioBorrarPatrimonioMaterial.php'" id="borrar">
            <input type="button" value="Modificar Material" onclick="location.href='FormularioModificarPatrimonioMaterial.php'" id="modificar">
            <input type="button" value="Gestionar en XML" onclick="location.href='FormularioGestionarXMLPatrimonioMaterial.php'" id="GXML">
            <input type="button" value="Volver" onclick="location.href='FormularioPatrimonio.php'">
        </form>
    </div>

 


    <div id="formularios">
        <?php
            if(isset($_POST['guardarXML'])){
                GestionXML::escribirXMLPatrimonio();
                
            }
        ?>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="formEscribirXML">
            <input type="submit" value="Guardar XML" name="guardarXML">
        </form>

    </div>

    <div id="formularios">
        <?php
            if(isset($_POST['leerXML'])){

                GestionXML::leerXMLPatrimonio();
                
            }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="formLeerXML" >
            <input type="submit" value="Leer XML" name="leerXML">
        </form>
    </div>




</body>
</html>
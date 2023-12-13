<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Inmueble</title>
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
                <h1>Gestionar Patrimonio Inmaterial - <?php echo $_SESSION['hermandad']->getNombre(); ?> </h1>
                <input type="button" value="Añadir Inmaterial" onclick="location.href='FormularioAñadirInmaterial.php'" id="añadir">
                <input type="button" value="Mostar Inmaterial" onclick="location.href='FormularioMostrarInmaterial.php'" id="mostrar">
                <input type="button" value="Borrar Inmaterial" onclick="location.href='FormularioBorrarInmaterial.php'"  id="borrar">
                <input type="button" value="Modificar Inmaterial" onclick="location.href='FormularioModificarInmaterial.php'" id="modificar">
                <input type="button" value="Gestionar XML" onclick="location.href='FormularioGestionarXMLInmaterial.php'" id="GXML">
                <input type="button" value="Volver" onclick="location.href='FormularioPatrimonio.php'">
            </form>
    </div>

 

    <div id="formularios">
        <?php
            if(isset($_POST['guardarXML'])){
                GestionXML::escribirXMLPatrimonio();
                echo "<h2>XML guardado correctamente</h2>";
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
                echo "<h2>XML leido correctamente</h2>";
            }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="formLeerXML" >
            <input type="submit" value="Leer XML" name="leerXML">
        </form>
    </div>



</body>
</html>
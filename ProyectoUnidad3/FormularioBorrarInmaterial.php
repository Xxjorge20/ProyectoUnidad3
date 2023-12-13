<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar Patrimonio Inmaterial</title>
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
        if(isset($_POST['confirmarBorrado'])){
            if($_SESSION['hermandad']->deletePatrimonio($_SESSION['hermandad']->obtenerPatrimonioInmueble($_POST['idPatrimonio']))){
                echo "Patrimonio Inmaterial borrado correctamente";   
            }
            else{
                echo "No se ha podido borrar el Patrimonio Inmaterial";
            }
        }
        
        if(isset($_POST['borrarPatrimonioInmaterial'])){ ?>
            <h2>Confirmar borrado de patrimonio</h2>
            <p>¿Estás seguro de que deseas borrar el patrimonio con ID <?php echo $_POST['idPatrimonio']; ?>?</p>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <input type="hidden" name="idPatrimonio" value="<?php echo $_POST['idPatrimonio']; ?>">
                
                <input type="submit" value="Confirmar borrado" name="confirmarBorrado">
            </form>
        <?php } ?>

  
        <h1>Borrar Patrimonio Inmaterial</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <label for="ID del Patrimonio Inmueble a Borrar"></label>
            <input type="text" name="idPatrimonio" id="idPatrimonio" placeholder="ID del Patrimonio Inmueble a Borrar" required>
            <input type="submit" value="Borrar Patrimonio Material" name="borrarPatrimonioInmaterial">
        </form>
    </div>


</body>
</html>
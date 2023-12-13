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
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <h1>Mostrar Patrimonios Inmateriales <?php echo $_SESSION['hermandad']->getNombre(); ?> </h1>
            <input type="submit" value="Mostrar Patrimonios" name="mostrarPatrimonio">
        </form>
        <!-- Aquí se mostrarán los patrimonios -->
        <?php
            if(isset($_POST['mostrarPatrimonio'])){
                $patrimoniosEntontrados = array();
                $patrimoniosEntontrados = $_SESSION['hermandad']->mostrarPatrimonio();
        

                    echo "<h1>Patrimonios encontrados de tipo Inmueble en la Hermandad</h1>";
                
                    foreach ($patrimoniosEntontrados as $patrimonio) {
                        if($patrimonio instanceof Inmueble) {
                            echo "ID del patrimonio: ".$patrimonio->getIdPatrimonio() . "<br>";
                            echo "Nombre del patrimonio: ".$patrimonio->getNombre() . "<br>";
                            echo "Tipo de patrimonio: ".get_class($patrimonio) . "<br>";
                        }
                    }
            
     
            }
        ?>
    </div>



</body>
</html>
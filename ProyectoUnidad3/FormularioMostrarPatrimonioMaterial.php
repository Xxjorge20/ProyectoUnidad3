<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Patrimonio Material</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <?php
        include_once(__DIR__ . '/Hermandad.php');
        include_once(__DIR__ . '/Patrimonio.php');
        include_once(__DIR__ . '/Mueble.php');
        include_once(__DIR__ . '/Inmueble.php');
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
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <h1>Mostrar Patrimonios materiales de la <?php echo $_SESSION['hermandad']->getNombre(); ?></h1>
            <input type="submit" value="Mostrar Patrimonios" name="mostrarPatrimonio">
        </form>
        <!-- Aquí se mostrarán los patrimonios -->
        <?php
            if(isset($_POST['mostrarPatrimonio'])){
                $patrimoniosEntontrados = array();
                $patrimoniosEntontrados = $_SESSION['hermandad']->mostrarPatrimonio();
        
                echo "<h1>Patrimonios encontrados de tipo Material en la Hermandad</h1>";
                
                foreach ($patrimoniosEntontrados as $patrimonio) {
                    if(get_class($patrimonio) == Mueble::class) {
                        echo "ID del patrimonio: ".$patrimonio->getIdPatrimonio() . "<br>";
                        echo "Nombre del patrimonio: ".$patrimonio->getNombre() . "<br>";
                        echo "Tipo de patrimonio: ".get_class($patrimonio) . "<br>";
                    }
                }
                $_SESSION['patrimoniosEncontrados'] = $patrimoniosEntontrados;
            }
        ?>
    </div>



</body>
</html>
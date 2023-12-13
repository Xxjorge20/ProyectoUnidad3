<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Patrimonio Inmaterial</title>
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

                try {
                    if(isset($_POST['patrimonioInmaterialModificar'])){
                        $tipoInmueble = TipoInmueble::IGLESIA;
                        switch ($_POST['tipoInmueble']) {
                            case 'Iglesia':
                                $tipoInmueble = TipoInmueble::IGLESIA;
                                break;
                            case 'Capilla':
                                $tipoInmueble = TipoInmueble::CAPILLA;
                                break;
                            case 'Museo':
                                $tipoInmueble = TipoInmueble::MUSEO;
                                break;
                            case 'Casa':
                                $tipoInmueble = TipoInmueble::CASA;
                                break;
                            case 'Casa Hermandad':
                                $tipoInmueble = TipoInmueble::CASA_HERMANDAD;
                                break;
                            case 'Otro':
                                $tipoInmueble = TipoInmueble::OTRO;
                                break;
                        }
    
    
    
    
                        $patrimonioModificado = new Inmueble(
                            $_SESSION['patrimonioAModificar']->getIdPatrimonio(),
                            $_POST['nombre'],
                            $_POST['descripcion'],
                            new DateTime($_POST['fechaAdquisicion']),
                            $_SESSION['patrimonioAModificar']->getFotos(),
                            $_POST['ubicacion'],
                            $tipoInmueble,
                            $_POST['valoracion'],
                            $_POST['estadoConservacion'],
                            $_POST['uso']
                        );
    
                        if($_SESSION['hermandad']->addPatrimonio($patrimonioModificado,true)) {
                            echo "Inmueble modificado correctamente";
            
                        }
                        else {
                            echo "No se ha podido modificar el inmueble";
                        }
    
                    }
                } catch (\Throwable $th) {
                    echo "No se ha podido modificar el inmueble" . $th->getMessage();
                }
            ?>
            <?php
                if (isset($_POST['idPatrimonio']) && isset($_POST['modificarInmueble'])) {
                    $_SESSION['patrimonioAModificar'] = $_SESSION['hermandad']->obtenerPatrimonioInmueble($_POST['idPatrimonio']);
                    $_SESSION['idPatrimonio'] = $_POST['idPatrimonio'];

                    
            ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="modificarMuebleForm">
                    <h1>Modificar Patrimonio Inmaterial</h1>
                    <h2><?php echo $_SESSION['patrimonioAModificar']->getIdPatrimonio(); ?></h2>
                    <input type="text" name="nombre" id="nombre" required
                        value="<?php echo $_SESSION['patrimonioAModificar']->getNombre(); ?>">
                    <br>
                    <br>
                    <label for="descripcion">Descripción:</label>
                    <input type="text" name="descripcion" id="descripcion" required
                        value="<?php echo $_SESSION['patrimonioAModificar']->getDescripcion(); ?>">
                    <br>
                    <br>
                    <label for="fechaAdquisicion">Fecha de adquisición:</label>
                    <input type="date" name="fechaAdquisicion" id="fechaAdquisicion" required
                        value="<?php echo $_SESSION['patrimonioAModificar']->getFechaAdquisicion()->format('Y-m-d'); ?>">
                    <br>
                    <br>
                    <label for="ubicacion">Ubicación:</label>
                    <input type="text" name="ubicacion" id="ubicacion" required
                        value="<?php echo $_SESSION['patrimonioAModificar']->getUbicacion(); ?>">
                    <br>
                    <br>
                    <label for="tipoInmueble">Tipo de inmueble:</label>
                    <select name="tipoInmueble" id="tipoInmueble">
                        <option value="iglesia" <?php echo ($_SESSION['patrimonioAModificar']->getTipoInmueble() === 'iglesia') ? 'selected' : ''; ?>>Iglesia</option>
                        <option value="capilla" <?php echo ($_SESSION['patrimonioAModificar']->getTipoInmueble() === 'capilla') ? 'selected' : ''; ?>>Capilla</option>
                        <option value="sede" <?php echo ($_SESSION['patrimonioAModificar']->getTipoInmueble() === 'sede') ? 'selected' : ''; ?>>Sede</option>
                        <option value="casa" <?php echo ($_SESSION['patrimonioAModificar']->getTipoInmueble() === 'casa') ? 'selected' : ''; ?>>Casa</option>
                        <option value="otro" <?php echo ($_SESSION['patrimonioAModificar']->getTipoInmueble() === 'otro') ? 'selected' : ''; ?>>Otro</option>
                    </select>
                    <br>
                    <br>
                    <label for="valoracion">Valor Cultural:</label>
                    <input type="text" name="valoracion" id="valorCultural" required
                        value="<?php echo $_SESSION['patrimonioAModificar']->getValorCultural(); ?>">
                    <br>
                    <br>
                    <label for="Reconociomientos">Reconocimientos:</label>
                    <input type="text" name="estadoConservacion" id="reconocimientos" required
                        value="<?php echo $_SESSION['patrimonioAModificar']->getReconocimientos(); ?>">
                    <br>
                    <br>
                    <label for="uso">Uso:</label>
                    <input type="text" name="uso" id="uso" required
                        value="<?php echo $_SESSION['patrimonioAModificar']->getUso(); ?>">
                    <br>
                    <br>
                    <input type="submit" value="Modificar Inmueble" name="patrimonioInmaterialModificar">
                    <?php 
                        }
                        else{
                    ?>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <h1>Modificar Inmueble</h1>
                                <label for="ID del Inmueble a Modificar"></label>
                                <input type="text" name="idPatrimonio" id="idPatrimonio" placeholder="ID del Inmueble a Modificar">
                                <input type="submit" value="Modificar Inmueble" name="modificarInmueble">
                            </form>
                    <?php
                        }
                    ?>
    </div>


    




</body>
</html>
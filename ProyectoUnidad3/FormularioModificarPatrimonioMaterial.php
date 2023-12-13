<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Patrimonio Material</title>
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
            <?php
                try {
                    if(isset($_POST['patrimonioInmuebleModificado'])){
                        $tipoMaterial = null;
                        switch ($_POST['tipoMueble']) {
                            case 'Escultura':
                                $tipoMaterial = TipoMueble::escultura;
                                break;
                            case 'Pintura':
                                $tipoMaterial = TipoMueble::pintura;
                                break;
                            case 'Orfebrería':
                                $tipoMaterial = TipoMueble::orfebreria;
                                break;
                            case 'Mobiliario':
                                $tipoMaterial = TipoMueble::mobiliario;
                                break;
                            case 'Otro':
                                $tipoMaterial = TipoMueble::OTRO;
                                break;
                        }
    
    
    
    
                        $patrimonioModificado = new Mueble(
                            $_SESSION['patrimonioAModificar']->getIdPatrimonio(),
                            $_POST['nombre'],
                            $_POST['descripcion'],
                            new DateTime($_POST['fechaAdquisicion']),
                            $_SESSION['patrimonioAModificar']->getFotos(),
                            $_POST['ubicacion'],
                            $tipoMaterial,
                            $_POST['estado'],
                            $_POST['valor'],
                            $_POST['historia'],
                            $_POST['autor']
                        );
    
                        if($_SESSION['hermandad']->addPatrimonio($patrimonioModificado,true)) {
                            echo "Patrimonio Material modificado correctamente";
            
                        }
                        else {
                            echo "No se ha podido modificar el Patrimonio Material";
                        }
    
                    }
                } catch (\Throwable $th) {
                    echo "No se ha podido modificar el Patrimonio Material" . $th->getMessage();
                }
            ?>
            <?php
                if (isset($_POST['idPatrimonio']) && isset($_POST['modificarPatrimonioMaterial'])) {
                    $_SESSION['patrimonioAModificar'] = $_SESSION['hermandad']->obtenerPatrimonio($_POST['idPatrimonio']);
                    $_SESSION['idPatrimonio'] = $_POST['idPatrimonio'];

                    
            ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="modificarInmuebleForm">
                    <h1>Modificar Patrimonio Material</h1>
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
                    <label for="tipoMueble">Tipo de Patrimonio Material:</label>
                    <select name="tipoMueble" id="tipoMueble">
                        <option value="iglesia" <?php echo ($_SESSION['patrimonioAModificar']->getTipoMueble() === 'escultura') ? 'selected' : ''; ?>>Escultura</option>
                        <option value="capilla" <?php echo ($_SESSION['patrimonioAModificar']->getTipoMueble() === 'pintura') ? 'selected' : ''; ?>>Pintura</option>
                        <option value="sede" <?php echo ($_SESSION['patrimonioAModificar']->getTipoMueble() === 'orfebreria') ? 'selected' : ''; ?>>Orfebreria</option>
                        <option value="casa" <?php echo ($_SESSION['patrimonioAModificar']->getTipoMueble() === 'Mobiliario') ? 'selected' : ''; ?>>Mobiliario</option>
                        <option value="otro" <?php echo ($_SESSION['patrimonioAModificar']->getTipoMueble() === 'otro') ? 'selected' : ''; ?>>Otro</option>
                    </select>
                    <br>
                    <br>
                    <label for="valor">Valor:</label>
                    <input type="text" name="valor" id="valor" required
                        value="<?php echo $_SESSION['patrimonioAModificar']->getValor(); ?>">
                    <br>
                    <br>
                    <label for="Reconociomientos">Historia:</label>
                    <input type="text" name="historia" id="historia" required
                        value="<?php echo $_SESSION['patrimonioAModificar']->getHistoria(); ?>">
                    <br>
                    <br>
                    <label for="uso">Autor:</label>
                    <input type="text" name="autor" id="autor" required
                        value="<?php echo $_SESSION['patrimonioAModificar']->getAutor(); ?>">
                    <br>
                    <br>
                    <input type="submit" value="Modificar Inmueble" name="patrimonioInmuebleModificado">
                    <?php 
                        }
                        else{
                    ?>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <h1>Modificar Inmueble</h1>
                                <label for="ID del Patrimonio Material a Modificar"></label>
                                <input type="text" name="idPatrimonio" id="idPatrimonio" placeholder="ID del Patrimonio Material a Modificar">
                                <input type="submit" value="Modificar Inmueble" name="modificarPatrimonioMaterial">
                            </form>
                    <?php
                        }
                    ?>
    </div>


</body>
</html>
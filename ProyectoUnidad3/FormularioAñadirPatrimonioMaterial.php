<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Patrimonio Material</title>
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
                if(isset($_POST['patrimonioMaterial'])){
                    try {
                        
                    $tipoMaterial = null;
                    switch ($_POST['tipoMueble']) {
                        case 'Escultura':
                            $tipoMaterial = TipoMueble::escultura;
                            break;
                        case 'Pintura':
                            $tipoMaterial = TipoMueble::pintura;
                            break;
                        case 'Orfebreria':
                            $tipoMaterial = TipoMueble::orfebreria;
                            break;
                        case 'Mobiliario':
                            $tipoMaterial = TipoMueble::mobiliario;
                            break;
                        case 'Otro':
                            $tipoMaterial = TipoMueble::OTRO;
                            break;

                    }


                    $fechaAdquisicionMueble = new DateTime($_POST['fechaAdquisicion']);
                    $fotos = array('foto3.jpg', 'foto4.jpg');

                    
                    $mueble = new Mueble(
                        null,
                        $_POST['nombre'],
                        $_POST['descripcion'],
                        $fechaAdquisicionMueble,
                        $fotos,
                        $_POST['ubicacion'],
                        $tipoMaterial,
                        $_POST['estado'],
                        $_POST['valor'],
                        $_POST['historia'],
                        $_POST['autor']
                    );


                    if($_SESSION['hermandad']->addPatrimonio($mueble,false)) {
                        echo "Mueble añadido correctamente";
                        $_POST = array();
                    }
                    else {
                        echo "No se ha podido añadir el Mueble";
                    }
                    } catch (\Throwable $th) {
                        echo "Error al añadir el Mueble" . $th->getMessage();
                    }
                }
            ?>        
        <h1>Formulario para añadir Patrimonio Material</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>">
            <br><br>

            <label for="descripcion">Descripción:</label>
            <input type="text" name="descripcion" id="descripcion" required value="<?php echo isset($_POST['descripcion']) ? htmlspecialchars($_POST['descripcion']) : ''; ?>">
            <br><br>

            <label for="fechaAdquisicion">Fecha de adquisición:</label>
            <input type="date" name="fechaAdquisicion" id="fechaAdquisicion" required value="<?php echo isset($_POST['fechaAdquisicion']) ? htmlspecialchars($_POST['fechaAdquisicion']) : ''; ?>">
            <br><br>

            <label for="ubicacion">Ubicación:</label>
            <input type="text" name="ubicacion" id="ubicacion" required value="<?php echo isset($_POST['ubicacion']) ? htmlspecialchars($_POST['ubicacion']) : ''; ?>">
            <br><br>
            <label for="tipoMueble">Tipo de Patrimonio Material:</label>
            <select name="tipoMueble" id="tipoMueble">
                <option value="Escultura">Escultura</option>
                <option value="Pintura">Pintura</option>
                <option value="Orfebreria">Orfebreria</option>
                <option value="Mobiliario">Mobiliario</option>
                <option value="Otro">Otro</option>
            </select>
            <br>
            <br>
            <label for="estado">Estado:</label>
            <input type="text" name="estado" id="estado" required value="<?php echo isset($_POST['estado']) ? htmlspecialchars($_POST['estado']) : ''; ?>">
            <br><br>

            <label for="valor">Valor:</label>
            <input type="text" name="valor" id="valor" required value="<?php echo isset($_POST['valor']) ? htmlspecialchars($_POST['valor']) : ''; ?>">
            <br><br>

            <label for="historia">Historia:</label>
            <input type="text" name="historia" id="historia" required value="<?php echo isset($_POST['historia']) ? htmlspecialchars($_POST['historia']) : ''; ?>">
            <br><br>

            <label for="autor">Autor:</label>
            <input type="text" name="autor" id="autor" required value="<?php echo isset($_POST['autor']) ? htmlspecialchars($_POST['autor']) : ''; ?>">
            <br><br>
            <input type="submit" value="Añadir Patrimonio Material" name="patrimonioMaterial">
        </form>
    </div>


</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Inmaterial</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        include_once(__DIR__ . '/Hermandad.php');
        include_once(__DIR__ . '/Patrimonio.php');
        include_once(__DIR__ . '/Mueble.php');
        include_once(__DIR__ . '/Inmueble.php');
        include_once(__DIR__ . '/GestionXML.php');
        include_once(__DIR__ . '/validacionDatos.php');
        if(!isset($_SESSION)) {
            session_start();
        }

        error_reporting(E_ALL);
        ini_set('display_errors', '1');
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
                if(isset($_POST['inmuebleAñadido'])){

                    try {

                        $tipoInmueble = null;
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
    
    
                        $fechaAdquisicionInmueble = new DateTime($_POST['fechaAdquisicion']);
                        $fotos = array('foto3.jpg', 'foto4.jpg');
    
                        
                        $inmueble = new Inmueble(
                            null,
                            $_POST['nombre'],
                            $_POST['descripcion'],
                            $fechaAdquisicionInmueble,
                            $fotos,
                            $_POST['ubicacion'],
                            $tipoInmueble,
                            $_POST['valoracion'],
                            $_POST['estadoConservacion'],
                            $_POST['uso']
                        );
    
    
                        if($_SESSION['hermandad']->addPatrimonio($inmueble,false)) {
                            echo "Patrimonio Inmaterial añadido correctamente";
                            $_POST = array();
                        }
                        else {
                            echo "No se ha podido añadir el Patrimonio Inmaterial";
                        }
                    } catch (Exception  $th) {
                        echo $th->getMessage();
                    }
                }
            ?>        
        <h1>Formulario para añadir Patrimonio Inmueble</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo isset($_POST['inmuebleAñadido']) ? $_POST['nombre'] : ''; ?>" required>
            <br>
            <br>

            <label for="descripcion">Descripción:</label>
            <input type="text" name="descripcion" id="descripcion" value="<?php echo isset($_POST['inmuebleAñadido']) ? $_POST['descripcion'] : ''; ?>" required>
            <br>
            <br>

            <label for="fechaAdquisicion">Fecha de adquisición:</label>
            <input type="date" name="fechaAdquisicion" id="fechaAdquisicion" value="<?php echo isset($_POST['inmuebleAñadido']) ? $_POST['fechaAdquisicion'] : ''; ?>" required>
            <br>
            <br>

            <label for="ubicacion">Ubicación:</label>
            <input type="text" name="ubicacion" id="ubicacion" value="<?php echo isset($_POST['inmuebleAñadido']) ? $_POST['ubicacion'] : ''; ?>" required>
            <br>
            <br>
            <label for="tipoInmueble">Tipo de inmueble:</label>
            <select name="tipoInmueble" id="tipoInmueble">
                <option value="Casa">Casa</option>
                <option value="Casa Hermandad">Casa Hermandad</option>
                <option value="Museo">Museo</option>
                <option value="Iglesia">Iglesia</option>
                <option value="Capilla">Capilla</option>
                <option value="Otro">Otro</option>
            </select>
            <br>
            <br>
            <label for="valoracion">Valor Cultural:</label>
            <input type="text" name="valoracion" id="valorCultural" value="<?php echo isset($_POST['inmuebleAñadido']) ? $_POST['valoracion'] : ''; ?>" required>
            <br>
            <br>

            <label for="estadoConservacion">Reconocimientos:</label>
            <input type="text" name="estadoConservacion" id="reconocimientos" value="<?php echo isset($_POST['inmuebleAñadido']) ? $_POST['estadoConservacion'] : ''; ?>" required>
            <br>
            <br>

            <label for="uso">Uso:</label>
            <input type="text" name="uso" id="uso" value="<?php echo isset($_POST['inmuebleAñadido']) ? $_POST['uso'] : ''; ?>" required>
            <br>
            <br>
            <input type="submit" value="Añadir Inmueble" name="inmuebleAñadido">
        </form>
    </div>

</body>
</html>
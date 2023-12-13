<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Mostrar Hermanos</title>
</head>
<body>
    <?php
        include_once 'Hermandad.php';
        include_once 'Hermanos.php';
        session_start();
    ?>
    <div id="formularios">
        <h2>Gestionar Hermano - <?php echo $_SESSION['hermandad']->getNombre(); ?></h2>
        <div class="button-container">
            <form action="FormularioAñadirHermanos.php">
                <button type="submit" name="formAñadir">Añadir Hermano</button>
            </form>

            <form action="FormularioMostrarHermanos.php">
                <button type="submit" name="formMostrar">Mostrar Hermano</button>
            </form>

            <form action="FormularioEliminarHermanos.php">
                <button type="submit" name="formEliminar">Eliminar Hermano</button>
            </form>

            <form action="FormularioModificarHermanos.php">
                <button type="submit" name="formModificar">Modificar Hermano</button>
            </form>
            <form action="FormularioXML.php">
                <button type="submit" name="formModificar">Gestionar XML</button>
            </form>
            <form action="FormularioHermandad.php" name="formulario" method="post">
                <button type="submit" name="bVolver">Volver al menu principal</button>
            </form>
        </div>
    </div>

    <div id="formularios">
        <!-- Formulario de Mostrar Hermanos -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="formMostrar" method="post" id="formMostrar">
            <h3>Mostrar Hermano</h3>
            <label for="dniMostrar">Introduzca el DNI del hermano:</label>
            <input type="text" id="dniMostrar" name="dniMostrar">
            <br>
            <br>

            <label for="nombreMostrar">Introduzca el nombre del hermano:</label>
            <input type="text" id="nombreMostrar" name="nombreMostrar">
            <br>
            <br>

            <label for="apellidosMostrar">Introduzca los apellidos del hermano:</label>
            <input type="text" id="apellidosMostrar" name="apellidosMostrar">
            <br>
            <br>

            <button type="submit" name="bMostrar">Mostrar</button>

            <?php
                // Verificar si se ha enviado el formulario
                if (isset($_POST['bMostrar'])) {
                    // Obtener los valores del formulario
                    $dniMostrar = $_POST['dniMostrar'];
                    $nombreMostrar = $_POST['nombreMostrar'];
                    $apellidosMostrar = $_POST['apellidosMostrar'];

                    $hermanoObtenido = null;

                    // Verificar qué criterios de búsqueda se han proporcionado
                    if (!empty($dniMostrar)) {
                        // Buscar por DNI
                        $hermanoObtenido = $_SESSION['hermandad']->obtenerHermano($dniMostrar);

                        echo $hermanoObtenido;
                        $_SESSION['hermanoObtenido'] = $hermanoObtenido;

                    } elseif (!empty($nombreMostrar) && !empty($apellidosMostrar)) {
                        // Buscar por nombre y apellidos
                        $hermanoObtenido = $_SESSION['hermandad']->obtenerHermano(null, $nombreMostrar, $apellidosMostrar);

                        echo $hermanoObtenido;
                        $_SESSION['hermanoObtenido'] = $hermanoObtenido;
                    }

                    if (empty($dniMostrar) && empty($nombreMostrar) && empty($apellidosMostrar)) {
                        $hermanoObtenido = $_SESSION['hermandad']->mostrarHermanos();
                        
                        foreach ($hermanoObtenido as $hermano) {
                            echo $hermano;
                            echo "<br>";
                        }
                    }

                    if (empty($hermanoObtenido)) {
                        echo "No hay hermanos registrados.";
                    }
                }
            ?>
        </form>
    </div>
</body>
</html>
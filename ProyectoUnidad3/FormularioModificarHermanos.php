<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Modificar Hermano</title>
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
        <!-- Formulario de Modificar Hermanos -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="formModificar" method="post" id="formModificar">
            <h3>Modificar Hermano</h3>

            <label for="dniModificar">Introduzca el DNI del hermano:</label>
            <input type="text" id="dniModificar" name="dniModificar">

            <button type="submit" name="bCargar">Cargar Hermano</button>

            <?php 
                if (isset($_POST['bCargar'])) {
                    $_SESSION['dniModificar'] = $_POST['dniModificar'];
                    if ($_SESSION['dniModificar'] != null) {
                        $_SESSION['hermanoModificar'] = $_SESSION['hermandad']->obtenerHermano($_SESSION['dniModificar']);
                    
            ?>

            <br>
            <br>
            <label for="nombreModificar">Introduzca el nombre del hermano:</label>
            <input type="text" id="nombreModificar" name="nombreModificar" value="<?php echo $_SESSION['hermanoModificar']->getNombre(); ?>" required>
            <br>
            <br>

            <label for="apellidosModificar">Introduzca los apellidos del hermano:</label>
            <input type="text" id="apellidosModificar" name="apellidosModificar" value="<?php echo $_SESSION['hermanoModificar']->getApellidos(); ?>" required>
            <br>
            <br>

            <label for="edadModificar">Introduzca la edad del hermano:</label>
            <input type="number" id="edadModificar" name="edadModificar" value="<?php echo $_SESSION['hermanoModificar']->getEdad(); ?>" required>
            <br>
            <br>

            <label for="dadoAltaModificar">Introduzca la fecha de alta del hermano:</label>
            <input type="date" id="dadoAltaModificar" name="dadoAltaModificar" value="<?php echo $_SESSION['hermanoModificar']->getDadoAlta()->format('Y-m-d'); ?>" required>
            <br>
            <br>

            <label for="domicilioModificar">Introduzca el domicilio del hermano:</label>
            <input type="text" id="domicilioModificar" name="domicilioModificar" value="<?php echo $_SESSION['hermanoModificar']->getDomicilio(); ?>" required>
            <br>
            <br>

            <label for="correoModificar">Introduzca el correo del hermano:</label>
            <input type="text" id="correoModificar" name="correoModificar" value="<?php echo $_SESSION['hermanoModificar']->getCorreo(); ?>" required>
            <br>
            <br>

            <label for="telefonoModificar">Introduzca el telefono del hermano:</label>
            <input type="text" id="telefonoModificar" name="telefonoModificar" value="<?php echo $_SESSION['hermanoModificar']->getTelefono(); ?>" required>
            <br>
            <br>

            <button type="submit" name="bModificar">Modificar</button>
            <br>
            <br>

            <?php
                    }
                }

                if (isset($_POST['bModificar'])) {
                    try {
                        $nombreModificar = $_POST['nombreModificar'];
                        $apellidosModificar = $_POST['apellidosModificar'];
                        $edadModificar = $_POST['edadModificar'];
                        $dadoAltaModificar = new DateTime($_POST['dadoAltaModificar']);
                        $domicilioModificar = $_POST['domicilioModificar'];
                        $correoModificar = $_POST['correoModificar'];
                        $telefonoModificar = $_POST['telefonoModificar'];

                        $hermano = new Hermanos($_SESSION['dniModificar'], $nombreModificar, $apellidosModificar, $edadModificar, $dadoAltaModificar, $domicilioModificar, $correoModificar, $telefonoModificar);

                        $_SESSION['hermandad']->addHermano($hermano, true);

                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                }
            ?>
        </form>
    </div>
</body>
</html>
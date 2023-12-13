<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Añadir Hermano</title>
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
        <?php
            if (isset($_POST['bAñadir'])) {
                try {
                    $dni = $_POST['dni'];
                    $nombre = $_POST['nombre'];
                    $apellidos = $_POST['apellidos'];
                    $edad = $_POST['edad']; 
                    $dadoAlta = new DateTime($_POST['dadoAlta']); 
                    $domicilio = $_POST['domicilio'];
                    $correo = $_POST['correo'];
                    $telefono = $_POST['telefono'];

                    $hermano = new Hermanos($dni, $nombre, $apellidos, $edad, $dadoAlta, $domicilio, $correo, $telefono);
            
                    if ($_SESSION['hermandad']->addHermano($hermano, false)){
                        echo "Hermano añadido correctamente";

                        $_POST = array(); // Vaciar el post
                    }
 
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
        ?>
        <!-- Formulario de Añadir Hermanos -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="formAñadir" method="post" id="formAñadir">
            <h3>Añadir Nuevo Hermano</h3>
            <label for="dni">Introduzca el DNI del hermano:</label>
            <input type="text" id="dni" name="dni" value="<?php echo isset($_POST['bAñadir']) ? $_POST['dni'] : ''; ?>" required >
            <br>
            <br>

            <label for="nombre">Introduzca el nombre del hermano:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo isset($_POST['bAñadir']) ? $_POST['nombre'] : ''; ?>" required>
            <br>
            <br>

            <label for="apellidos">Introduzca los apellidos del hermano:</label>
            <input type="text" id="apellidos" name="apellidos" value="<?php echo isset($_POST['bAñadir']) ? $_POST['apellidos'] : ''; ?>" required>
            <br>
            <br>

            <label for="edad">Introduzca la edad del hermano:</label>
            <input type="number" id="edad" name="edad" value="<?php echo isset($_POST['bAñadir']) ? $_POST['edad'] : ''; ?>" required>
            <br>
            <br>

            <label for="dadoAlta">Introduzca la fecha de alta del hermano:</label>
            <input type="date" id="dadoAlta" name="dadoAlta" value="<?php echo isset($_POST['bAñadir']) ? $_POST['dadoAlta'] : ''; ?>" required>
            <br>
            <br>

            <label for="domicilio">Introduzca el domicilio del hermano:</label>
            <input type="text" id="domicilio" name="domicilio" value="<?php echo isset($_POST['bAñadir']) ? $_POST['domicilio'] : ''; ?>" required>
            <br>
            <br>

            <label for="correo">Introduzca el correo del hermano:</label>
            <input type="text" id="correo" name="correo" value="<?php echo isset($_POST['bAñadir']) ? $_POST['correo'] : ''; ?>" required>
            <br>
            <br>

            <label for="telefono">Introduzca el telefono del hermano:</label>
            <input type="number" id="telefono" name="telefono" value="<?php echo isset($_POST['bAñadir']) ? $_POST['telefono'] : ''; ?>" required>
            <br>
            <br>

            <button type="submit" name="bAñadir">Añadir</button>
        </form>
    </div>
</body>
</html>
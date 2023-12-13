<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Eliminar Hermano</title>
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
        <!-- Formulario de Eliminar Hermanos -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="formEliminar" method="post" id="formEliminar">
            <h3>Eliminar Hermano</h3>

            <label for="dniEliminar">Introduzca el DNI del hermano:</label>
            <input type="text" id="dniEliminar" name="dniEliminar" >

            <button type="submit" name="bEliminar">Eliminar</button>

            <?php 
                if (isset($_POST['bEliminar'])) {
                    $_SESSION['dniDelete'] = $_POST['dniEliminar'];
                    if ($_SESSION['dniDelete'] != null) {
                        $_SESSION['hermanoEliminar'] = $_SESSION['hermandad']->obtenerHermano($_SESSION['dniDelete']); 
                    ?>
                        <h2>Confirmar borrado de hermano</h2>
                        <p>¿Estás seguro de que deseas borrar al hermano con DNI <?php echo $_SESSION['dniDelete']; ?>?</p>
                        <button type="submit" name="confirmarBorrado">Confirmar borrado</button>
                    <?php
                    }
                }   

                if (isset($_POST['confirmarBorrado'])) {
                    $_SESSION['hermandad']->deleteHermano($_SESSION['hermanoEliminar']);
                    echo "Hermano eliminado correctamente";
                }
            ?>
        </form>
    </div>
</body>
</html>

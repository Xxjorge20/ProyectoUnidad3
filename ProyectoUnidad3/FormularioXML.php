<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Gestion XML</title>
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
        <h2>Gestionar XML</h2>
        <hr>
        <form action="Escribir.php" name="formularioHermandad3" method="post">
            <h3>Guardar XML</h3>
            <button type="submit" name="bXML">Guardar XML</button>
        </form>
        <br>
        <form action="Leer.php" name="formularioHermandad3" method="post">
            <h3>Leer XML</h3>
            <button type="submit" name="bXML">Leer XML</button>
        </form>
    </div>
</body>
</html>
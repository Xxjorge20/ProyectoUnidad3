<?php
    include_once 'Hermandad.php';
    include_once 'Hermanos.php';
    session_start();

    $hermandad = $_SESSION['hermandad'];

    $arrayHermanos = [];

    $arrayHermanos = $_SESSION['hermandad']->mostrarHermanos();

    // Crear un objeto de la clase DOMDocument 
    $dom = new DOMDocument('1.0', 'UTF-8');

    // Indicamos que el documento XML resultante es formateado automaticamente
    $dom->formatOutput = true;

    // Crear elemento raiz del documento
    $raiz = $dom->createElement('hermandades');
    $dom->appendChild($raiz);


    // Creamos un elemento en el archivo XML con la hermandad
    $hermElem = $dom->createElement('hermandad');
    $raiz->appendChild($hermElem);

    $hermElem->appendChild($dom->createElement('id', $hermandad->getId()));
    $hermElem->appendChild($dom->createElement('nombre', $hermandad->getNombre()));
    $hermElem->appendChild($dom->createElement('fechaFundacion', $hermandad->getFechaFundacion()->format('Y-m-d')));
    $hermElem->appendChild($dom->createElement('ubicacionSede', $hermandad->getUbicacionSede()));
    $hermElem->appendChild($dom->createElement('numeroCuenta', $hermandad->getNumeroCuenta()));

    // Crear elemento raiz del documento
    $hermanos = $dom->createElement('hermanos');
    $raiz->appendChild($hermanos);

    // Recorremos el array de hermanos y creamos un elemento en el archivo XML con cada hermano
    foreach($arrayHermanos as $h) { 
        $hermElem = $dom->createElement('hermano');
        $hermanos->appendChild($hermElem);

        $hermElem->appendChild($dom->createElement('dni', $h->getDni()));
        $hermElem->appendChild($dom->createElement('nombre', $h->getNombre()));
        $hermElem->appendChild($dom->createElement('apellidos', $h->getApellidos()));
        $hermElem->appendChild($dom->createElement('edad', $h->getEdad()));
        $hermElem->appendChild($dom->createElement('dadoAlta', $h->getDadoAlta()->format('Y-m-d')));
        $hermElem->appendChild($dom->createElement('domicilio', $h->getDomicilio()));
        $hermElem->appendChild($dom->createElement('correo', $h->getCorreo()));
        $hermElem->appendChild($dom->createElement('telefono', $h->getTelefono()));
        $hermElem->appendChild($dom->createElement('codigo', $h->getCodigo()));
        $hermElem->appendChild($dom->createElement('cuota', $h->getCuota()));
    }

    $dom->save("hermandad.xml");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Escribir Datos</title>
</head>
<body>
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
            <form action="FormularioXML.php" name="formulario" method="post">
                <button type="submit" name="bVolver">Volver</button>
            </form>
        </div>
    </div>
    <h2>XML Guardado correctamente.</h2>
</body>
</html>
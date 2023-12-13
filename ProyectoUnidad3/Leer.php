<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Mostrar Datos</title>
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
            <form action="FormularioXML.php" name="formulario" method="post">
                <button type="submit" name="bVolver">Volver</button>
            </form>
        </div>
    </div>

    <div id="formularios">
        <?php
            $hermandadArray = [];
            $hermanosArray = [];

            // Creamos el objeto DOMDocument y cargamos el archivo XML
            $dom = new DOMDocument('1.0', 'UTF-8');
            $dom->load("hermandad.xml");

            // Obtenemos una lista de los elementos con etiqueta 'hermandad' y 'hermano'
            $hermandadElement = $dom->getElementsByTagName('hermandad')->item(0);
            $hermanosElements = $dom->getElementsByTagName('hermano');

            
            $id = $hermandadElement->getElementsByTagName('id')->item(0)->nodeValue;
            $nombre = $hermandadElement->getElementsByTagName('nombre')->item(0)->nodeValue;
            $fechaFundacion = date_create($hermandadElement->getElementsByTagName('fechaFundacion')->item(0)->nodeValue);
            $UbicacionSede = $hermandadElement->getElementsByTagName('ubicacionSede')->item(0)->nodeValue;
            $NumeroCuenta = $hermandadElement->getElementsByTagName('numeroCuenta')->item(0)->nodeValue;

            $hermandad = new Hermandad($nombre, $fechaFundacion, $UbicacionSede, $NumeroCuenta);
            $hermandadArray[] = $hermandad;

            
            foreach ($hermanosElements as $hermElem) {
                $dni = $hermElem->getElementsByTagName('dni')->item(0)->nodeValue;
                $nombre = $hermElem->getElementsByTagName('nombre')->item(0)->nodeValue;
                $apellidos = $hermElem->getElementsByTagName('apellidos')->item(0)->nodeValue;
                $edad = $hermElem->getElementsByTagName('edad')->item(0)->nodeValue;
                $dadoAlta = date_create($hermElem->getElementsByTagName('dadoAlta')->item(0)->nodeValue);
                $domicilio = $hermElem->getElementsByTagName('domicilio')->item(0)->nodeValue;
                $correo = $hermElem->getElementsByTagName('correo')->item(0)->nodeValue;
                $telefono = $hermElem->getElementsByTagName('telefono')->item(0)->nodeValue;
                $codigo = $hermElem->getElementsByTagName('codigo')->item(0)->nodeValue;
                $cuota = $hermElem->getElementsByTagName('cuota')->item(0)->nodeValue;

                $hermanos = new Hermanos($dni, $nombre, $apellidos, $edad, $dadoAlta, $domicilio, $correo, $telefono, $codigo, $cuota);
                $hermanosArray[] = $hermanos;
            }

            foreach ($hermandadArray as $herman) {
                echo "<br><h3>Hermandad</h3>";
                echo "id: ". $herman->getId(). "<br>";
                echo "Nombre: ". $herman->getNombre(). "<br>";
                echo "FechaFundacion: ". $herman->getFechaFundacion()->format('Y-m-d'). "<br>";
                echo "UbicacionSede: ". $herman->getUbicacionSede(). "<br>";
                echo "NumeroCuenta: ". $herman->getNumeroCuenta(). "<br>";
            }

            foreach ($hermanosArray as $herm) {
                echo "<br><h3>Hermanos</h3>";
                echo "DNI: ". $herm->getDni(). "<br>";
                echo "Nombre: ". $herm->getNombre(). "<br>";
                echo "Apellidos: ". $herm->getApellidos(). "<br>";
                echo "Edad: ". $herm->getEdad(). "<br>";
                echo "DadoAlta: ". $herm->getDadoAlta()->format('Y-m-d'). "<br>";
                echo "Domicilio: ". $herm->getDomicilio(). "<br>";
                echo "Correo: ". $herm->getCorreo(). "<br>";
                echo "Telefono: ". $herm->getTelefono(). "<br>";
                echo "Codigo: ". $herm->getCodigo(). "<br>";
                echo "Cuota: ". $herm->getCuota(). "<br>";
            }
        ?>
    </div>
</body>
</html>


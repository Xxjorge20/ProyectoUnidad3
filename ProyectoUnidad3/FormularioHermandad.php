<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Hermandad del Gran Poder de Sevilla</title>
</head>
<body>
    <?php
        include_once 'Hermandad.php';
        session_start();
        $hermandad = new Hermandad("Hermandad del Gran Poder de Sevilla", new DateTime('1620-10-12'), "P/San Lorenzo", "IBN123456789445555443455");
        $_SESSION['hermandad'] = $hermandad;
    ?>
    <div id="formularios">
        <h1 id="nombreHermandad"><?php echo $_SESSION['hermandad']->getNombre(); ?> </h1>
        <form action="FormularioAñadirHermanos.php" name="formularioHermandad1" method="post">
            <h3>Gestionar Hermanos</h3>
            <button type="submit" name="bHermano">Hermanos</button>
            <br>
            <br>
        </form>
        <form action="FormularioPatrimonio.php" name="formularioHermandad2" method="post">
            <h3>Gestionar Patrimonio</h3>
            <button type="submit" name="bPatrimonio">Patrimonio</button>
        </form>
    </div>

    <div id="gif" class="tenor-gif-embed" data-postid="11548993" data-share-method="host" data-aspect-ratio="1.77778" data-width="80%">
        <a href="https://tenor.com/view/velas-virgen-procesion-semana-santa-fe-gif-11548993">Virgen En Procesión GIF</a>from 
        <a href="https://tenor.com/search/velas-gifs">Velas GIFs</a></div> <script type="text/javascript" async src="https://tenor.com/embed.js">
        </script>
    </div>
</body>
</html>
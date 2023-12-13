<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Patrimonio</title>
</head>
<body>

    <?php
        include_once(__DIR__ . '/Hermandad.php');
        include_once(__DIR__ . '/Patrimonio.php');
        include_once(__DIR__ . '/Mueble.php');
        include_once(__DIR__ . '/Inmueble.php');
        session_start();
    ?>

    <div id="formularios">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="formMenu">
            <h1>Gestionar Patrimonio - <?php echo $_SESSION['hermandad']->getNombre(); ?> </h1>
            <input type="button" value="Gestionar Patrimonio Inmaterial" onclick="location.href='FormularioAñadirInmaterial.php'">
            <input type="button" value="Gestionar Patrimonio Material" onclick="location.href='FormularioAñadirPatrimonioMaterial.php'">
            <input type="button" value="Volver al menu principal" onclick="location.href='FormularioHermandad.php'">
        </form>
    </div>
    
    <div class="tenor-gif-embed" data-postid="11548993" data-share-method="host" data-aspect-ratio="1.77778" data-width="100%" id="gif">
        <a href="https://tenor.com/view/velas-virgen-procesion-semana-santa-fe-gif-11548993">Virgen En Procesión GIF</a>from 
        <a href="https://tenor.com/search/velas-gifs">Velas GIFs</a></div> <script type="text/javascript" async src="https://tenor.com/embed.js">
        </script>
    </div>
</body>
</html>
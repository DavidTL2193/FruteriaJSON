<?php
    //Recuperar datos del archivo JSON
    $archivo = file_get_contents('fruteria.json');
    $datos = json_decode($archivo);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Frutería</title>
        <link rel="stylesheet" type="text/css" href="Css/css.css">
    </head>
    <body>
        <div class="contenedor">
            <div class="titulo"><h1>Frutería</h1></div>
            <div id="añadir"><a href="añadir.php">Añadir nuevo producto</a></div>
            <div class="catalogo">
                <?php
                    $indice = 0;
                    //Si hay datos:
                    if(!empty($datos)){
                        //Recorre el array y muestra los datos
                        foreach($datos->fruteria as $fila){
                ?>
                            <div class="producto">
                                <p><?php echo $fila->nombre;?></p>
                                <p><?php echo $fila->tipo;?></p>
                                <p><?php echo $fila->color;?></p>
                                <p><?php echo $fila->precio;?>€</p>
                                <img src="Fotos/<?php echo $fila->imagen;?>" width="200" height="200"/>
                                <p id="p_enlaces">
                                    <a href="modificar.php?modificar_id=<?php echo $indice; ?>">Modificar</a>
                                    <a href="eliminar.php?eliminar_id=<?php echo $indice; ?>">Eliminar</a>
                                </p>
                            </div>
                <?php
                            $indice++;
                        }
                    }else{
                        echo "El archivo JSON esta vacio";
                    }
                ?>
            </div>
        </div>
    </body>
</html>

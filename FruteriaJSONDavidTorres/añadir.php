<?php
    if(isset($_POST['nombre'])){
        $archivo = file_get_contents('fruteria.json');
        $datos = json_decode($archivo, true);
        $nombre = $_POST['nombre'];
        $tipo = $_POST['tipo'];
        $precio = $_POST['precio'];
        $color = $_POST['color'];
        $imagen = $_FILES['imagen']['name'];
        
        $array_datos = array(
            'nombre' => $nombre,
            'tipo' => $tipo,
            'precio' => $precio,
            'color' => $color,
            'imagen' => $imagen
        );
        $datos['fruteria'] = array_values($datos['fruteria']);
        array_push($datos['fruteria'], $array_datos);
        file_put_contents('fruteria.json', json_encode($datos, JSON_PRETTY_PRINT));
        
        //Subir imagen al servidor
        if(isset($_FILES['imagen']['name']) && !empty($_FILES['imagen']['name'])){
            if($_FILES['imagen']['type']=='image/jpg' || $_FILES['imagen']['type']=='image/jpeg' ||
                $_FILES['imagen']['type']=='image/png' || $_FILES['imagen']['type']=='image/gif'){
                if($_FILES['imagen']['size'] < 40000){
                    $ruta_provisional = $_FILES['imagen']['tmp_name'];
                    $carpeta = 'Fotos/';
                    $ruta_servidor = $carpeta.$imagen;
                    move_uploaded_file($ruta_provisional, $ruta_servidor);
                }else{
                    echo 'Tamaño de imagen demasiado grande';
                }
            }else{
                echo 'Formato de imagen no permitido o el archivo no es una imagen';
            }
        }else{
            echo 'El archivo no existe';
        }
        header("Location: index.php");
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Añadir</title>
        <link rel="stylesheet" type="text/css" href="Css/css.css">
        <script type="text/javascript" src="Jquery/JQuery_3_4_1.js"></script>
        <script>
            $(document).ready(function(){
                $("#btnAñadir").click(function(){
                    $("#tderror").html("");
                    if( $("#nom").val() == ""){
                        $("#tderror").html("Campo nombre obligatorio");
                        $("#nom").focus();
                        return;
                    }
                    if( $("#tip").val() == ""){
                        $("#tderror").html("Campo tipo obligatorio");
                        $("#tip").focus();
                        return;
                    }
                    var precio=$("#pre").val();
                    if ( precio == "" || isNaN(precio) ){
                        $("#tderror").html("Campo precio obligatorio");
                        $("#pre").focus();
                        return;
                    }
                    if( $("#col").val() == ""){
                        $("#tderror").html("Campo color obligatorio");
                        $("#col").focus();
                        return;
                    }
                    $('form').submit();
                });
            });
        </script>
    </head>
    <body>
        <div class="contenedor">
            <div class="titulo"><h1>Frutería</h1></div>
            <div class="formulario"><h1 id="h_añadir">Añadir Producto</h1></div>
            <div class="catalogo">
                <form method='post' action='añadir.php' enctype="multipart/form-data">
                    <table align="center">
                        <tr>
                            <td><label>Nombre: </label></td><td><input type='text' name='nombre' id='nom' size="45"/></td>
                        </tr>
                        <tr>
                            <td><label>Tipo: </label></td><td><input type='text' name='tipo' id='tip' size="45"/></td>
                        </tr>
                        <tr>
                            <td><label>Precio: </label></td><td><input type='number' name='precio' id='pre'/></td>
                        </tr>
                        <tr>
                            <td><label>Color: </label></td><td><input type='text' name='color' id='col' size="45"/></td>
                        </tr>
                        <tr>
                            <td><label>Imagen: </label></td><td><input type="file" name="imagen" id='img'/></td>
                        </tr>
                        <tr>
                            <td colspan="2" id="tderror" class="error"></td>
                        </tr>
                        <tr>
                            <td><input type="button" value="Añadir" id="btnAñadir" class="btn"></td>
                            <td><input type='button' value="Cancelar" onclick='document.location="index.php"' class="btn"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>

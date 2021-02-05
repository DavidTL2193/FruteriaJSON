<?php
    if(isset($_GET['eliminar_id'])){
        $eliminar_id = $_GET['eliminar_id'];
        $archivo = file_get_contents('fruteria.json');
        $datos = json_decode($archivo, true);
        
        unset($datos['fruteria'][$eliminar_id]);
        
        $datos['fruteria'] = array_values($datos['fruteria']);
        file_put_contents('fruteria.json', json_encode($datos, JSON_PRETTY_PRINT));
        header('Location: index.php');
    }else{
        header('Location: index.php');
    }
    
?>


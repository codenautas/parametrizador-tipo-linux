<?php
function parametrizar_tipo_linux($arg){
    if(!is_array($arg)){
            throw new Exception ("parametrizador_tipo_linux: espera un arreglo");
    }
    $grupos_previo = array_filter($arg,function($datos) use($arg) {
        return array_keys($arg,substr($datos,0,2)=='--');
    });
    $grupos=array();
    foreach($grupos_previo as $clave=>$valor){
        $grupos[]=substr($valor,2);
    }
    if($grupos==array()){
        $respuesta=$arg;
    }else{
        $posiciones_grupos=array_keys($grupos_previo);
        $primeros_args=array_slice($arg,0,$posiciones_grupos[0]);
        $resto_args=ordenarPorGrupo($arg,$grupos,$posiciones_grupos);
        $respuesta=array_merge($primeros_args,$resto_args);
    }
    return $respuesta;
}
function ordenarPorGrupo($arg,$grupos,$posiciones_grupos){
    foreach($posiciones_grupos as $id_posicion=>$def_posicion){
        $inicio=$def_posicion+1;
        $fin=next($posiciones_grupos);
        if($fin!=false){
           $long_grupo=$fin-$inicio;
           $respuesta[$grupos[$id_posicion]]=array_slice($arg,$inicio,$long_grupo);
        }else{
            if(count($arg)==$def_posicion){
                $respuesta[$grupos[$id_posicion]]=array();
            }else{
                $respuesta[$grupos[$id_posicion]]=array_slice($arg,$inicio);
            }
        }
    }
    return $respuesta;
}


?>
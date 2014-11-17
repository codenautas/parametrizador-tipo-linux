<?php
require_once "parametrizador_tipo_linux.php";

class ParametrizarTipoLinuxTest extends PHPUnit_Framework_TestCase{
    public function testPosicional(){
        $datos=array("uno","dos","tres");
        $obtenido=parametrizar_tipo_linux($datos);
        $esperado=array('uno','dos','tres');
        $this->assertEquals($esperado,$obtenido);
    }
    public function testMezcladoUltimoGrupoVacio(){
        $datos=array("uno","dos","tres","--griegas","alfa","beta","--otra","otra2","--nada");
        $obtenido=parametrizar_tipo_linux($datos);
        $esperado=array('uno','dos','tres','griegas'=>array('alfa','beta'),'otra'=>array('otra2'),'nada'=>array());
        $this->assertEquals($esperado,$obtenido);
    }
    public function testMezcladoUltimoGrupoNormal(){
        $datos=array("uno","dos","tres","--griegas","alfa","beta","--otra","otra2","--ultimos","99","100");
        $obtenido=parametrizar_tipo_linux($datos);
        $esperado=array('uno','dos','tres','griegas'=>array('alfa','beta'),'otra'=>array('otra2'),'ultimos'=>array("99","100"));
        $this->assertEquals($esperado,$obtenido);
    }
    public function testMezcladoSinGrupoAnonimo(){
        $datos=array("--griegas","alfa","beta","--otra","otra2","--ultimos","99","100");
        $obtenido=parametrizar_tipo_linux($datos);
        $esperado=array('griegas'=>array('alfa','beta'),'otra'=>array('otra2'),'ultimos'=>array("99","100"));
        $this->assertEquals($esperado,$obtenido);
    }
    public function testMezcladoGrupoFinalVacio(){
        $datos=array("--griegas","alfa","beta","--otra","otra2","--anteultimos","99","100","--ultimo");
        $obtenido=parametrizar_tipo_linux($datos);
        $esperado=array('griegas'=>array('alfa','beta'),'otra'=>array('otra2'),'anteultimos'=>array("99","100"),'ultimo'=>array());
        $this->assertEquals($esperado,$obtenido);
    }
    public function testUnGrupoVacio(){
        $datos=array("--griegas");
        $obtenido=parametrizar_tipo_linux($datos);
        $esperado=array('griegas'=>array());
        $this->assertEquals($esperado,$obtenido);
    }
    public function testUnSoloElemento(){
        $datos=array("griegas");
        $obtenido=parametrizar_tipo_linux($datos);
        $esperado=array('griegas');
        $this->assertEquals($esperado,$obtenido);
    }
    public function testDosGruposVacios(){
        $datos=array("--griegas","--otra");
        $obtenido=parametrizar_tipo_linux($datos);
        $esperado=array('griegas'=>array(),'otra'=>array());
        $this->assertEquals($esperado,$obtenido);
    }
    public function testUnElementoYUnGrupo(){
        $datos=array("uno","--griega","alfa");
        $obtenido=parametrizar_tipo_linux($datos);
        $esperado=array('uno','griega'=>array('alfa'));
        $this->assertEquals($esperado,$obtenido);
    }    
}
?>
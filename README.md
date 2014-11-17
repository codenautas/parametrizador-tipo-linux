parametrizador-tipo-linux
=========================

just for process --like parameters

parametrizar_tipo_linux($arg)
-----------------------------

Recibe un string con la l�nea de par�metros tal cual es recibida en $argv

Devuelve un array con los par�metros. 

Entiende que un par�metro --algo empieza un grupo (o lista).

### Ejemplos

  echo parametrizar_tipo_linux("uno dos tres");
  array("uno", "dos", "tres");
    
  echo parametrizar_tipo_linux("uno dos -griegas alfa beta --otras no hay");
  array(
    "uno", 
    "dos", 
    "griegas"=>array(
        "alfa",
        "beta"
    ),
    "otras"=>array(
        "no",
        "hay"
    )
  );

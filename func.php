<?php
    $lista = [1,2,3,4,5];
    function llamar($a,$b) {
        if ($b > count($a)) {
            echo "<p>El array tiene " . count($a) . " posiciones</p>";
        } else {
            echo $a[$b];
        }
    }

    llamar($lista,2);

    function sumar($a) {
        $resultado = 0;
        for ($x = 0; $x <= count($a) - 1; $x++ ) {
            $resultado = $resultado + $a[$x];
        }
        echo "<p>La suma del array es: $resultado</p>";
    }
    function restar($a) {
        $resultado = 0;
        for ($x = 0; $x <= count($a) - 1; $x++ ) {
            $resultado = $resultado - $a[$x];
        }
        echo "<p>La resta del array es: $resultado</p>";
    }
    function multiplicar($a) {        $resultado = 1;
        for ($x = 0; $x <= count($a) - 1; $x++ ) {
            $resultado = $resultado * $a[$x];
        }
        echo "<p>La multiplicación del array es: $resultado</p>";
    }
    function dividir($a) {        $resultado = 1;
        for ($x = 0; $x <= count($a) - 1; $x++ ) {
            $resultado = $resultado / $a[$x];
        }
        echo "<p>La división del array es: $resultado</p>";
    }
    sumar($lista);
    restar($lista);
    multiplicar($lista);
    dividir($lista);

    function iva($precio,$tipo) {
        switch ($tipo) {
            case "S":
               $res = 0.04 * $precio + $precio;
               echo "<p>El IVA super reducido de $precio es $res</p>";
               break;
            case "R":
                $res = 0.10 * $precio + $precio;
                echo "<p>El IVA reducido de $precio es $res</p>";
                break;
            case "G": 
                $res = 0.21 * $precio + $precio;;
                echo "<p>El IVA general de $precio es $res</p>";
                break;
            default: 
                echo "<p>La opción seleccionada no existe...</p>";
                break
            ;
        }
    }
    iva(50,"S");
    iva(50,"R");
    iva(50,"G");
    iva(50,"d");

?>
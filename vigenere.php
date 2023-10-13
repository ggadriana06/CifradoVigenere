<?php
header("Content-Type: application/json");

$mensaje = isset($_GET['mensaje']) ? strtoupper($_GET['mensaje']) : "";
$clave = isset($_GET['clave']) ? strtoupper($_GET['clave']) : "";

function cifrarVigenere($mensaje, $clave)
{
    $mensaje = strtoupper($mensaje);
    $clave = strtoupper($clave);
    $mensajeCifrado = "";

    $mensajeLen = strlen($mensaje);
    $claveLen = strlen($clave);

    for ($i = 0; $i < $mensajeLen; $i++) {
        $mensajeChar = $mensaje[$i];
        if (ctype_upper($mensajeChar)) {
            $mensajeAscii = ord($mensajeChar) - 65;
            $claveChar = $clave[$i % $claveLen];
            $claveAscii = ord($claveChar) - 65; 
        
            $nuevoAscii = ($mensajeAscii + $claveAscii) % 26 + 65;
            $mensajeCifrado .= chr($nuevoAscii);
        } else {
            $mensajeCifrado .= $mensajeChar;
        }
    }

    return $mensajeCifrado;
}

function descifrarVigenere($mensaje, $clave)
{
    $mensaje = strtoupper($mensaje);
    $clave = strtoupper($clave);
    $mensajeDescifrado = "";

    $mensajeLen = strlen($mensaje);
    $claveLen = strlen($clave);

    for ($i = 0; $i < $mensajeLen; $i++) {
        $mensajeChar = $mensaje[$i];
        if (ctype_upper($mensajeChar)) {
            $mensajeAscii = ord($mensajeChar) - 65;
            $claveChar = $clave[$i % $claveLen];
            $claveAscii = ord($claveChar) - 65;
            $nuevoAscii = ($mensajeAscii - $claveAscii + 26) % 26 + 65;
            $mensajeDescifrado .= chr($nuevoAscii);
        } else {
            $mensajeDescifrado .= $mensajeChar;
        }
    }

    return $mensajeDescifrado;
}

$accion = isset($_GET['accion']) ? $_GET['accion'] : "";

if ($accion === "cifrar") {
    $mensajeCifrado = cifrarVigenere($mensaje, $clave);
    respuesta(200, "Texto cifrado exitosamente", $mensajeCifrado);
} elseif ($accion === "descifrar") {
    $mensajeDescifrado = descifrarVigenere($mensaje, $clave);
    respuesta(200, "Texto descifrado exitosamente", $mensajeDescifrado);
} else {
    respuesta(400, "Acción no válida", null);
}

function respuesta($status, $mensaje, $datos)
{
    header("HTTP/1.1 $status $mensaje");
    $response['status'] = $status;
    $response['mensaje'] = $mensaje;
    $response['datos'] = $datos;

    $json_response = json_encode($response);
    echo $json_response;
}
?>

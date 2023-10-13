<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cifrado Vigenère</title>
</head>
<body>
    <h1>CIFRADO VIGENÈRE</h1>
    
    <h2>Cifrado</h2>
    <form action="" method="GET">
        <input type="text" name="mensaje" placeholder="Ingrese el mensaje" required><br><br>
        <input type="text" name="clave" placeholder="Ingrese la clave" required><br><br>
        <input type="submit" name="accion" value="cifrar">
    </form>

    <h2>Descifrado</h2>
    <form action="" method="GET">
        <input type="text" name="mensaje" placeholder="Ingrese el mensaje cifrado" required><br><br>
        <input type="text" name="clave" placeholder="Ingrese la clave" required><br><br>
        <input type="submit" name="accion" value="descifrar">
    </form>

    <?php
    if (isset($_GET['accion'])) {
        $accion = $_GET['accion'];
        $mensaje = isset($_GET['mensaje']) ? strtoupper($_GET['mensaje']) : "";
        $clave = isset($_GET['clave']) ? strtoupper($_GET['clave']) : "";

        $url = "http://localhost/CifradoVigenere/vigenere.php?accion=$accion&mensaje=$mensaje&clave=$clave";
        $data = json_decode(file_get_contents($url), true);

        echo '<div class="result">';
        echo "<strong>Resultado:</strong><br>";
        echo "Texto " . ($accion === 'cifrar' ? 'cifrado' : 'descifrado') . ": " . $data['datos'] . "<br>";
        echo '</div>';
    }
    ?>
</body>
</html>

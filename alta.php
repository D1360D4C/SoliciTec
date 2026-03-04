<?php

// Lista de palabras prohibidas
$palabrasProhibidas = [
    'gay', 'mierda', 'puta', 'puto', 'pelotudo', 'boludo',
    'hijo de puta', 'hija de puta', 'cabron', 'cabrona',
    'pendejo', 'pendeja', 'idiota', 'imbecil', 'estupido', 'estupida'
];

// Función que verifica si un texto contiene palabras prohibidas
function contienePalabraProhibida($texto, $lista) {
    $texto = strtolower($texto);

    foreach ($lista as $palabra) {
        if (strpos($texto, $palabra) !== false) {
            return true;
        }
    }
    return false;
}

// ============================
// REGISTRO (Crear cuenta)
// ============================

if (isset($_POST['agre'])) {

    $nombre   = trim($_POST['nom1']);
    $apellido = trim($_POST['ape1']);
    $email    = trim($_POST['ema']);
    $password = $_POST['pass1'];

    // Validamos solo nombre, apellido y email
    if (
        contienePalabraProhibida($nombre, $palabrasProhibidas) ||
        contienePalabraProhibida($apellido, $palabrasProhibidas) ||
        contienePalabraProhibida($email, $palabrasProhibidas)
    ) {
        echo "<script>
alert('Algún campo contiene una palabra prohibida');
window.history.back();
</script>";
exit();
    }

    // Si pasa validación
    echo "<h2>Bienvenido " . htmlspecialchars($nombre) . "</h2>";
    exit();
}

// ============================
// LOGIN
// ============================

if (isset($_POST['sesion'])) {

    $email = trim($_POST['ema']);
    $password = $_POST['pass'];

    echo "<h2>Inicio de sesión exitoso</h2>";
    exit();
}

?>
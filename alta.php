<?php
session_start();
include_once 'cone.php';



$palabrasProhibidas = [
    'gay', 'mierda', 'puta', 'puto', 'pelotudo', 'boludo',
    'hijo de puta', 'hija de puta', 'cabron', 'cabrona',
    'pendejo', 'pendeja', 'idiota', 'imbecil', 'estupido', 'estupida'
];



function contienePalabraProhibida($texto, $lista) {
    $texto = strtolower($texto);

    foreach ($lista as $palabra) {
        if (strpos($texto, $palabra) !== false) {
            return true;
        }
    }
    return false;
}



if (isset($_POST['agre'])) {

    $nombre   = $_POST['nom1'];
    $apellido = $_POST['ape1'];
    $email    = $_POST['ema'];
    $contra   = $_POST['pass1'];

    
    if (
        contienePalabraProhibida($nombre, $palabrasProhibidas) ||
        contienePalabraProhibida($apellido, $palabrasProhibidas) ||
        contienePalabraProhibida($email, $palabrasProhibidas) ||
        contienePalabraProhibida($contra, $palabrasProhibidas)
    ) {
        echo "<script>
                alert('El formulario contiene palabras no permitidas');
                window.location='index.html';
              </script>";
        exit();
    }

    
    $encrip = password_hash($contra, PASSWORD_DEFAULT);

   
    $stmt = $conexdb->prepare("INSERT INTO usuarios (nick, apellido, email, contra) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $apellido, $email, $encrip);
    $stmt->execute();

    echo "<script>
            alert('Usuario registrado correctamente');
            window.location='index.html';
          </script>";
    exit();
}


if (isset($_POST['sesion'])) {

    $email = $_POST['ema'];
    $pass  = $_POST['pass'];

    $stmt = $conexdb->prepare("SELECT nick, contra FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado && $resultado->num_rows > 0) {

        $registro = $resultado->fetch_assoc();

        if (password_verify($pass, $registro['contra'])) {

            $_SESSION['nick'] = $registro['nick'];
            header("Location: inicio.php");
            exit();
        }
    }

    echo "<script>
            alert('Usuario o contraseña incorrectos');
            window.location='index.html';
          </script>";
    exit();
}
?>
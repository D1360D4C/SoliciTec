<?php
session_start();
include_once 'cone.php';



$palabrasProhibidas = [
    'gay', 'mierda', 'puta', 'puto', 'pelotudo', 'boludo',
    'hijo de puta', 'hija de puta', 'cabron', 'cabrona',
    'pendejo', 'pendeja', 'idiota', 'imbecil', 'estupido', 'estupida'
];


selec($conexdb);

function selec($conexdb){

    if(isset($_POST['agre'])){
        agregar($conexdb);
    }

    if(isset($_POST['sesion'])){
        sesion($conexdb);
    }
}



function contienePalabraProhibida($texto, $lista) {

    $texto = strtolower($texto);

    foreach ($lista as $palabra) {
        if (strpos($texto, $palabra) !== false) {
            return true;
        }
    }

    return false;
}


function agregar($cdb){

    global $palabrasProhibidas;

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

    // 🔹 Encriptar contraseña
    $encrip = password_hash($contra, PASSWORD_DEFAULT);

    
    $stmt = $cdb->prepare("INSERT INTO usuarios(nick, apellido, email, contra) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $apellido, $email, $encrip);
    $stmt->execute();

    mysqli_close($cdb);

    echo "<script>
            alert('Usuario registrado correctamente');
            window.location='index.html';
          </script>";
    exit();
}



function sesion($cdb){

    $email = $_POST['ema'];
    $pass  = $_POST['pass'];

    $consulta = "SELECT nick, contra FROM usuarios WHERE email = ?";

    $stmt = $cdb->prepare($consulta);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if($resultado && $resultado->num_rows > 0) {

        $registro = $resultado->fetch_assoc();
        $contrase = $registro['contra'];
        $nombre   = $registro['nick'];

        if(password_verify($pass, $contrase)){

            $_SESSION['nick'] = $nombre;

            header("Location: inicio.php");
            exit();
        }
    }

    mysqli_close($cdb);

    echo "<script>
            alert('Usuario o contraseña incorrectos');
            window.location='index.html';
          </script>";
    exit();
}
?>
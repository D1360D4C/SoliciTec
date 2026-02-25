<?php
session_start();
include_once 'cone.php';

selec($conexdb);

function selec($conexdb){
    if(isset($_POST['agre'])){
        agregar($conexdb);
    }

    if(isset($_POST['sesion'])){
        sesion($conexdb);
    }

    
}

function agregar($cdb){
    $nombre = $_POST['nom1'];
    $apellido = $_POST['ape1'];
    $email = $_POST['ema'];
    $contra = $_POST['pass1'];
    $encrip = password_hash($contra,PASSWORD_DEFAULT);

    $consulta = "INSERT INTO usuarios(nick, apellido,email,contra) VALUES ('$nombre', '$apellido', '$email','$encrip')";

    mysqli_query($cdb,$consulta);
    mysqli_close($cdb);
    echo "<p>Hola, $nombre. ¡Bienvenido!</p>";
}

function sesion($cdb){
    $email = $_POST['ema'];
    $pass = $_POST['pass'];

    $consulta = "SELECT nick, contra FROM usuarios WHERE email= ? ";

    $stmt = $cdb-> prepare($consulta);
    $stmt ->bind_param("s",$email);
    $stmt ->execute();
    $resultado = $stmt->get_result();

    if($resultado && $resultado->num_rows > 0) {
        $registro = $resultado->fetch_assoc();
        $contrase = $registro['contra'];
        $nombre = $registro['nick'];
        
        if(password_verify($pass,$contrase)){
            $_SESSION['nick'] = $nombre;
            header("location: inicio.php");
            exit();
        }
       
    }
    mysqli_close($cdb);

        echo '
            <script>
            alert("Usuario no encontrado, introduzca datos verificados");
            window.location = "index.html";
            </script>';
            exit();
    }



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

    $nombre = $_POST['nom1'];
    $apellido = $_POST['ape1'];
    $email = $_POST['ema'];
    $pass = $_POST['pass1'];

    
    if (
        contienePalabraProhibida($nombre, $palabrasProhibidas) ||
        contienePalabraProhibida($apellido, $palabrasProhibidas) ||
        contienePalabraProhibida($email, $palabrasProhibidas) ||
        contienePalabraProhibida($pass, $palabrasProhibidas)
    ) {
        echo "Error: El formulario contiene palabras no permitidas.";
        exit();
    }

    
    echo "Usuario registrado correctamente.";
}

?>   


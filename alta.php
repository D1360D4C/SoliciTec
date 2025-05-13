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

    $consulta = "INSERT INTO usuarios(nick, apellido,email,contra) VALUES ('$nombre', '$apellido', '$email','$contra')";

    mysqli_query($cdb,$consulta);
    mysqli_close($cdb);
    echo "<p>Hola, $nombre. ¡Bienvenido!</p>";
}

function sesion($cdb){
    $email = $_POST['ema'];
    $pass = $_POST['pass'];
    $nombreU = "SELECT nick FROM usuarios WHERE email='$email' AND contra= '$pass'";

    $consulta= mysqli_query($cdb, $nombreU);

    $coname= $cdb->query($nombreU);

    $name = $coname ? $coname->fetch_assoc()['nick'] : null;

    if(mysqli_num_rows($consulta) > 0) {
        $_SESSION['nick'] = $name;
        header ("location: inicio.php");
        exit();
    }else{
        echo '
            <script>
            alert("Usuario no encontrado, introduzca datos verificados");
            window.location = "index.html";
            </script>';
            exit();
    }


}
?>
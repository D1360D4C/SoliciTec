<?php

include_once 'cone.php';

selec($conexdb);

function selec($conexdb){
    if(isset($_POST['agre'])){
        agregar($conexdb);
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


?>
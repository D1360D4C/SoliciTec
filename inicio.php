<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
session_start();

if(isset($_POST['cerrar'])){
    cerrar();
}
function cerrar(){
    session_destroy();
    header("location:index.html");
}

?>
<h1>Hola! Bienvenido <?php echo $_SESSION['nick']; ?></h1>
<form action="" method="post">
    <button type="submit" name="cerrar">Cerrar sesion</button>

</form>



</body>
</html>
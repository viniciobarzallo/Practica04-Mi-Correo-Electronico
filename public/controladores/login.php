<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    include '../../config/conexionBD.php';
    $usuario = isset($_POST["correo"]) ? mb_strtoupper(trim($_POST["correo"])) : null;
    $contrasena = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : null;

    $pass = MD5($contrasena);
    $sql = "SELECT * FROM usuario WHERE usu_correo = '$usuario' and usu_password = '$pass' and usu_eliminado='N'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION['cod'] = "$row[usu_codigo]";
            $_SESSION['nom'] = "$row[usu_nombres]";
            $_SESSION['ape'] = "$row[usu_apellidos]";
            $_SESSION['el'] = "$row[usu_eliminado]";
            $_SESSION['cor'] = "$usuario";
            $_SESSION['rol'] = "$row[usu_rol]";
        }
        $_SESSION['isLogged'] = TRUE;
        if ($_SESSION['rol'] == "admin") {
            header("Location: ../../admin/vista/admin/index.php");
        } else {
            header("Location: ../../admin/vista/user/index.php");
        }
    } else {
        header("Location: ../vista/login.html");
    }
    $conn->close();
    ?>
</body>

</html>
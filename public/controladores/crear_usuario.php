<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Crear Nueva Cuenta</title>
        <style type="text/css" rel="stylesheet">
            .error {
                color: red;
            }
        </style>
    </head>

    <body>
        <?php
        //incluir conexión a la base de datos
        include '../../config/conexionBD.php';
        $cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : null;
        $nombres = isset($_POST["nombres"]) ? mb_strtoupper(trim($_POST["nombres"]), 'UTF-8') : null;
        $apellidos = isset($_POST["apellidos"]) ? mb_strtoupper(trim($_POST["apellidos"]), 'UTF-8') : null;
        $direccion = isset($_POST["direccion"]) ? mb_strtoupper(trim($_POST["direccion"]), 'UTF-8') : null;
        $telefono = isset($_POST["telefono"])  ? trim($_POST["telefono"]) : null;
        $correo =  isset($_POST["correo"]) ?  mb_strtoupper(trim($_POST["correo"])) : null;
        $fechaNacimiento = isset($_POST["fechaNacimiento"]) ? trim($_POST["fechaNacimiento"]) : null;
        $fecha = date('Y-m-d', strtotime(str_replace('/', '-', $fechaNacimiento)));
        $contrasena = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : null;
        $pass = MD5($contrasena);

        if (!isset($_FILES["image"]["tmp_name"])) {
            $foto = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
        } else {
            $foto = addslashes(file_get_contents('../vista/images/usu.PNG'));
        }


        $sql = "INSERT INTO usuario VALUES(0, '$cedula', '$nombres', '$apellidos', '$direccion', '$telefono', '$correo', '$pass', '$fecha', 'N', null,null,'user','$foto');";
        if ($conn->query($sql) === TRUE) {
            echo "<p>Se ha creado los datos personales correctamemte !!!</p>";
        } else {
            if ($conn->errno == 1062) {
                echo "<p class='error'> La persona con la cedula $cedula ya está registrada en el sistema </p>";
            } else {
                echo "<p class='error'>Error : " . mysqli_error($conn) . "</ p>";
            }
        }
        //cerrar la base de datos
        $conn->close();
        echo "<a href='../vista/crear_usuario.html'>Regresar</a>";
        ?>
    </body>

</html>
<?php
session_start();
$codigoui = $_SESSION['cod'];
$usurol = $_SESSION['rol'];
if (!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE) {
    header("Location: /SistemaDeGestion/public/vista/login.html");
}
if ($usurol == 'user') {
    ?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Sistema de Gestion de Usuarios</title>
        <link href="../../public/vista/css/style.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <header class="cab">
            <h1>Comprobación de Borrado</h1>
        </header>
        <?php
        include '../../../config/conexionBD.php';
        #Eliminado Completo
        #$sql = "DELETE FROM usuario WHERE usu_codigo=$codigo;";
        date_default_timezone_set('America/Guayaquil');
        $codigo = $_GET["codigo"];
        $fecha = date('Y-m-d H:i:s', time());

        #Eliminado Lógico
        if ($codigoui == $codigo) {
            $sql = "UPDATE usuario SET usu_eliminado='S', usu_fecha_modificacion='$fecha' WHERE usu_codigo=$codigo;";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Se han borrado los datos personales correctamemte !!!</p>";
            } else {
                if ($conn->errno == 1062) {
                    echo "<p class='error'> La persona con la cedula $cedula no se encuentra registrada en el sistema </p>";
                } else {
                    echo "<p class='error'>Error : " . mysqli_error($conn) . "</ p>";
                }
            }
        } else {
            echo "<p> No cuenta con los permisos para ejecutar está orden </p>";
        }
        //cerrar la base de datos
        $conn->close();
        echo "<a href='../../../config/cerrarSesion.php'> Regresar </a>";
        ?>
    </body>

    </html>
<?php
} else {
    header("Location: ../../../config/acceso.html");
}
?>
<?php
session_start();
$codigoui = $_SESSION['cod'];
$usurol = $_SESSION['rol'];
$correoui = $_SESSION['cor'];
if (!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE) {
    header("Location: /SistemaDeGestion/public/vista/login.html");
}
if ($usurol == 'user') {
    ?>
    <!DOCTYPE html>
    <html>

    <head>

        <meta charset="UTF-8">
        <title>Nuevo Mensaje</title>
        <style type="text/css" rel="stylesheet">
            .error {
                color: red;
            }
        </style>
    </head>

    <body>
        <?php
        date_default_timezone_set('America/Guayaquil');
        //incluir conexión a la base de datos
        include '../../../config/conexionBD.php';

        $cor_usu_destinatario = isset($_POST["destinatario"]) ? mb_strtoupper(trim($_POST["destinatario"]), 'UTF-8') : null;

        $codigodes = 0;
        $bus = "SELECT * FROM usuario WHERE usu_correo='$cor_usu_destinatario';";
        $resultb = $conn->query($bus);
        if ($resultb->num_rows > 0) {
            while ($row = $resultb->fetch_assoc()) {
                $codigodes = $row["usu_codigo"];
                $rol = $row["usu_rol"];
            }
        }
        $asunto = isset($_POST["asunto"])  ? trim($_POST["asunto"]) : null;
        $mensaje =  isset($_POST["mensaje"]) ?  mb_strtoupper(trim($_POST["mensaje"])) : null;
        if ($rol == 'admin') {
            echo "<h2> No se puede enviar correos a usuarios administradores </h2>";
        } else {
            $sql = "INSERT INTO correos VALUES(0,NULL,$codigoui,$codigodes, '$asunto', '$mensaje','N',NULL);";
            if ($conn->query($sql) === TRUE) {
                echo "<p>Se ha enviado el correo correctamemte !!!</p>";
            } else {
                echo "<p class='error'>Error : " . mysqli_error($conn) . "</ p>";
            }
        }
        //cerrar la base de datos
        $conn->close();
        echo "<a href='../../vista/user/index.php'> Regresar </a>";
        ?>
    </body>

    </html>
<?php
} else {
    header("Location: ../../../config/acceso.html");
}
?>
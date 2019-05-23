<?php
session_start();
$codigoui = $_SESSION['cod'];
$nombresui = explode(" ", $_SESSION['nom']);
$apellidosui =  explode(" ", $_SESSION['ape']);
$correoui = $_SESSION['cor'];
$usurol = $_SESSION['rol'];
if (!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE) {
    header("Location: /SistemaDeGestion/public/vista/login.html");
}
if ($usurol == 'admin') {
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <title>Sistema de Gestion de Usuarios</title>
        <link href="../../../public/vista/css/style.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <header class="cabis">
            <h2>
                Lectura Mensaje
            </h2>
        </header>
        <?php
        include '../../../config/conexionBD.php';
        $sql = "SELECT * FROM correos WHERE cor_eliminado='N' AND cor_codigo=$_GET[codigo];";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $codigo = $row["cor_codigo"];
                $asunto = $row["cor_asunto"];
                $mensaje = $row["cor_mensaje"];
                $correorem = "";
                $bus = "SELECT * FROM usuario WHERE usu_codigo='$row[cor_usu_remitente]';";
                $resultb = $conn->query($bus);
                if ($resultb->num_rows > 0) {
                    while ($row = $resultb->fetch_assoc()) {
                        $correorem = $row["usu_correo"];
                    }
                }
            }
        }
        $conn->close();
        ?>
        <form id="formulario01" method="POST" action="../../controladores/admin/eliminarmen.php">
            <input type="hidden" id="codigo" name="codigo" value=" <?php echo $codigo ?>" />
            <label for="destinatario">Correo Remitente
                (*)</label>
            <input type="text" id="remitente" name="remitente" value="<?php echo $correorem ?>" placeholder="Ingrese el correo del destinatario
                        ..." disabled />
            <br>
            <label for="asunto"> Asunto (*)</label>
            <input type="text" id="asunto" name="asunto" value="<?php echo $asunto ?>" placeholder="Ingrese el asunto
                            ..." disabled />
            <br>
            <label for="mensaje">Mensaje (*)</label>
            <textarea id="mensaje" name="mensaje" placeholder="Ingrese el mensaje..." disabled><?php echo $mensaje ?></textarea>
            <br>
            <input type="submit" id="eliminar" name="eliminar " value="Eliminar" />
            <input type="reset" id="cancelar " name="cancelar" value="Cancelar" />
            <a href="../../vista/admin/index.php"> Regresar </a>
        </form>
    </body>

    </html>
<?php
} else {
    header("Location: ../../../config/acceso.html");
}
?>
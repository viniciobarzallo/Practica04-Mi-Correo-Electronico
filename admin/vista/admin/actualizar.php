<?php
session_start();
$usurol = $_SESSION['rol'];
if (!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE) {
    header("Location: /SistemaDeGestion/public/vista/login.html");
}
if ($usurol == 'admin') {
    ?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Sistema de Gestion de Usuarios</title>
        <link href="../../../public/vista/css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="../../../public/controladores/js/funciones.js"> </script>
        <script type="text/javascript" src="../../../public/controladores/js/validaciones.js"> </script>
    </head>

    <body>
        <?php
        include '../../../config/conexionBD.php';
        $sqlu = "SELECT * FROM usuario WHERE usu_codigo=$_GET[codigo];";
        $resultu = $conn->query($sqlu);
        if ($resultu->num_rows > 0) {
            while ($row = $resultu->fetch_assoc()) {
                $codigo = $row["usu_codigo"];
                $cedula = $row["usu_cedula"];
                $nombres = $row["usu_nombres"];
                $apellidos = $row["usu_apellidos"];
                $direccion = $row["usu_direccion"];
                $telefono = $row["usu_telefono"];
                $correo = $row["usu_correo"];
                $fecha = $row["usu_fecha_nacimiento"];
                $contrasena = $row["usu_password"];
                $foto = $row["usu_foto"];
            }
        }
        ?>
        <header class="cab">
            <h1>Actualizar Datos Usuario</h1>
        </header>
        <form id="formulario01" method="POST" enctype="multipart/form-data" action="../../controladores/admin/actualizar.php" onsubmit="return validarCamposObligatorios($usurol)">
            <div class="parte1">
                <input type="hidden" id="codigo" name="codigo" value=" <?php echo $codigo; ?>" />
                <label for="cedula">Cedula (*)</label>
                <input type="text" id="cedula" name="cedula" value="<?php echo $cedula; ?>" />
                <br>
                <label for="nombres">Nombres (*)</label>
                <input type="text" id="nombres" name="nombres" value="<?php echo $nombres; ?>" onkeyup="valLetras(this)" />
                <br>
                <label for="apellidos">Apelidos (*)</label>
                <input type="text" id="apellidos" name="apellidos" value="<?php echo $apellidos; ?>" onkeyup="valLetras(this)" />
                <br>
                <label for="direccion">Dirección (*)</label>
                <input type="text" id="direccion" name="direccion" value="<?php echo $direccion; ?>" />
                <br>
                <label for="telefono">Teléfono (*)</label>
                <input type="text" id="telefono" name="telefono" value="<?php echo $telefono; ?>" onkeyup="valNumeros(this)" />
                <br>
                <label for="fecha">Fecha Nacimiento (*)</label>
                <input type="text" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $fecha; ?>" />
                <br>
                <label for="correo">Correo electrónico (*)</label>
                <input type="text" id="correo" name="correo" value="<?php echo $correo; ?>" />
                <br>
                <input type="submit" id="eliminar" name="eliminar " value="Actualizar" />
                <input type="reset" id="cancelar " name="cancelar" value="Cancelar" />
                <a href="listado.php"> Regresar </a>
            </div>
            <div class="parte2">
                <label for="imagen">Foto</label>
                <input id="uploadImage1" type="file" name="image" onchange="previewImage(1)" accept="image/*" />
                <img id="uploadPreview1" name="upload" src="data:image/*;base64,<?php echo base64_encode($foto); ?>" alt="titulo foto" />
            </div>

        </form>

    </body>

    </html>
<?php
} else {
    header("Location: ../../../config/acceso.html");
}
$conn->close();
?>
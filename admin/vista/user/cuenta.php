<?php
session_start();
$codigoui = $_SESSION['cod'];
$nombresui = explode(" ", $_SESSION['nom']);
$apellidosui =  explode(" ", $_SESSION['ape']);
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
        <link href="../../../public/vista/css/style.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <?php
        include '../../../config/conexionBD.php';
        $sqlu = "SELECT * FROM usuario WHERE usu_codigo='$codigoui';";
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
            <h2>Datos Usuario</h2>
            <nav class="navi">
                <ul id="menu">
                    <li><a href="#"> <img id="imagen" src="data:image/jpg;base64,<?php echo base64_encode($foto); ?>" alt="titulo foto" /> <?php echo $nombresui[0] . ' ' . $apellidosui[0] ?></a>
                        <ul>
                            <li><a href="actualizar.php"> Modificar Datos</a></li>
                            <li><a href="../../controladores/user/eliminar.php?codigo=<?php echo $codigo; ?>"> Eliminar Usuario</a></li>
                            <li><a href="cambiarContrasena.php?codigo=<?php echo $codigo; ?>"> Cambiar Contraseña</a></li>
                            <li><a href="../../../config/cerrarSesion.php"> Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <nav class="naveg">
                <ul>
                    <li> <a href="index.php">Inicio </a> </li>
                    <li> <a href="mensajenu.php">Nuevo Mensaje</a> </li>
                    <li> <a href="mensajesen.php">Mensajes Enviados</a> </li>
                    <li> <a href="cuenta.php">Mi Cuenta</a> </li>
                </ul>
            </nav>
        </header>
        <form id="formulario01">
            <div class="parte1">
                <input type="hidden" id="codigo" name="codigo" value=" <?php echo $codigo ?>" />
                <label for="cedula">Cedula (*)</label>
                <input type="text" id="cedula" name="cedula" value="<?php echo $cedula; ?>" disabled />
                <br>
                <label for="nombres">Nombres (*)</label>
                <input type="text" id="nombres" name="nombres" value="<?php echo $nombres; ?>" disabled />
                <br>
                <label for="apellidos">Apelidos (*)</label>
                <input type="text" id="apellidos" name="apellidos" value="<?php echo $apellidos; ?>" disabled />
                <br>
                <label for="direccion">Dirección (*)</label>
                <input type="text" id="direccion" name="direccion" value="<?php echo $direccion; ?>" disabled />
                <br>
                <label for="telefono">Teléfono (*)</label>
                <input type="text" id="telefono" name="telefono" value="<?php echo $telefono; ?>" disabled />
                <br>
                <label for="fecha">Fecha Nacimiento (*)</label>
                <input type="text" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $fecha; ?>" disabled />
                <br>
                <label for="correo">Correo electrónico (*)</label>
                <input type="text" id="correo" name="correo" value="<?php echo $correo; ?>" disabled />
            </div>
            <div class="parte2">
                <label for="foto">Foto (*)</label>
                <img id="foto" src="data:image/*;base64,<?php echo base64_encode($foto); ?>" alt="titulo foto" />
                <br>
            </div>
        </form>
        <?php
        $conn->close();
        ?>
    </body>

    </html>
<?php
} else {
    header("Location: ../../../config/acceso.html");
}
?>
<?php
session_start();
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
        <header class="cab">
            <h1>Borrar Usuario</h1>
        </header>
        <form id="formulario01" method="POST" action="../../controladores/user/eliminar.php">
            <div class="parte1">
                <input type="hidden" id="codigo" name="codigo" value=" <?php echo $_GET["codigo"]; ?>" />
                <label for="cedula">Cedula (*)</label>
                <input type="text" id="cedula" name="cedula" value="<?php echo $_GET["cedula"]; ?>" disabled />
                <br>
                <label for="nombres">Nombres (*)</label>
                <input type="text" id="nombres" name="nombres" value="<?php echo $_GET["nombres"]; ?>" disabled />
                <br>
                <label for="apellidos">Apelidos (*)</label>
                <input type="text" id="apellidos" name="apellidos" value="<?php echo $_GET["apellidos"]; ?>" disabled />
                <br>
                <label for="direccion">Dirección (*)</label>
                <input type="text" id="direccion" name="direccion" value="<?php echo $_GET["direccion"]; ?>" disabled />
                <br>
                <label for="telefono">Teléfono (*)</label>
                <input type="text" id="telefono" name="telefono" value="<?php echo $_GET["telefono"]; ?>" disabled />
                <br>
                <label for="fecha">Fecha Nacimiento (*)</label>
                <input type="text" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $_GET["fecha"]; ?>" disabled />
                <br>
                <label for="correo">Correo electrónico (*)</label>
                <input type="text" id="correo" name="correo" value="<?php echo $_GET["correo"]; ?>" disabled />
                <br>
                <input type="submit" id="eliminar" name="eliminar " value="Eliminar" />
                <input type="reset" id="cancelar " name="cancelar" value="Cancelar" />
            </div>
            <a href="index.php"> Regresar </a>
        </form>
    </body>

    </html>
<?php
} else {
    header("Location: ../../../config/acceso.html");
}
?>
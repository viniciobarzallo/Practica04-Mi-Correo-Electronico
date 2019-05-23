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
    </head>

    <body>
        <header class="cab">
            <h1>Cambiar Contraseña Usuario</h1>
        </header>
        <form id="formulario01" method="POST" action="../../controladores/admin/cambiarContrasena.php">
            <div class="parte1">
                <input type="hidden" id="codigo" name="codigo" value=" <?php echo $_GET["codigo"]; ?>" />
                <label for="contrasenaActual">Contraseña Actual (*)</label>
                <input type="password" id="contrasenaActual" name="contrasenaActual" value="" />
                <br>
                <label for="contrasenaNueva">Contraseña Nueva (*)</label>
                <input type="password" id="contrasenaNueva" name="contrasenaNueva" value="" />
                <br>
                <br>
                <input type="submit" id="cambiarContrasena" name="cambiarContrasena" value="Cambiar Contraseña" />
                <input type="reset" id="cancelar " name="cancelar" value="Cancelar" />
                <a href="listado.php"> Regresar </a>
            </div>
        </form>
    </body>

    </html>
<?php
} else {
    header("Location: ../../../config/acceso.html");
}
?>
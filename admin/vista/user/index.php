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
if ($usurol == 'user') {
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <title>Gestión de usuarios</title>
        <link href="../../../public/vista/css/stables.css" rel="stylesheet" type="text/css" />
        <link href="../../../public/vista/css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="../../controladores/user/js/metodos.js"> </script>
    </head>

    <body>
        <?php
        include '../../../config/conexionBD.php';
        $sqlu = "SELECT * FROM usuario WHERE usu_codigo='$codigoui';";
        $resultu = $conn->query($sqlu);
        $row = $resultu->fetch_assoc();
        $foto = $row["usu_foto"];
        ?>
        <header class="cabis">
            <h2>
                Listado de Correos del Usuario
            </h2>
            <nav class="navi">
                <ul id="menu">
                    <li><a href="#"> <img id="imagen" src="data:image/*;base64,<?php echo base64_encode($foto); ?>"> <?php echo $nombresui[0] . ' ' . $apellidosui[0] ?></a>
                        <ul>
                            <li><a href="../../../config/cerrarSesion.php"> Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <nav class='naveg'>
                <ul>
                    <li> <a href='index.php'>Inicio </a> </li>
                    <li> <a href='mensajenu.php'>Nuevo Mensaje</a> </li>
                    <li> <a href='mensajesen.php'>Mensajes Enviados</a> </li>
                    <li> <a href='cuenta.php'>Mi Cuenta</a> </li>
                </ul>
            </nav>
            <h4>Mensajes Recibidos</h4>
        </header>
        <table id="tbl">
            <input autofocus type="text" id="correo" name="correo" value="" placeholder="Ingrese cédula para buscar" required onkeyup="buscarPorCorreo()" />
            <img id="imagen2" src="../../../public/vista/images/lupa.png">
            <tr>
                <th>Fecha</th>
                <th>Remitente</th>
                <th>Asunto</th>
                <th>Leer</th>
            </tr>
            <?php
            $url = $_SERVER['REQUEST_URI'];
            $sql = "SELECT * FROM correos WHERE cor_eliminado='N' AND cor_usu_destinatario=$codigoui ORDER BY cor_fecha_hora DESC;";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $codigo = $row["cor_codigo"];
                    $fecha = $row["cor_fecha_hora"];
                    $asunto = $row["cor_asunto"];
                    $correodes = "";
                    $bus = "SELECT usu_correo FROM usuario WHERE usu_codigo='$row[cor_usu_remitente]';";
                    $resultb = $conn->query($bus);
                    if ($resultb->num_rows > 0) {
                        while ($row = $resultb->fetch_assoc()) {
                            $correodes = $row["usu_correo"];
                        }
                    }
                    echo "<tr>";
                    echo "   <td>" . $fecha . "</td>";
                    echo "   <td>" . $correodes . "</td>";
                    echo "   <td>" . $asunto . "</td>";
                    echo "   <td> <a href='../../controladores/user/lecturamen.php?codigo=$codigo&url=$url'> Ir </a> </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr>";
                echo "   <td colspan='7'> No existen correos registrados al usuario </td>";
                echo "</tr>";
            }
            $conn->close();
            ?>
        </table>
        <footer>
            <h5> Copyright </h5>
            <h5> Jordan Murillo </h5>
            <h5> 2019 </h5>
        </footer>
    </body>

    </html>
<?php
} else {
    header("Location: ../../../config/acceso.html");
}
?>
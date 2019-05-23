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
    </head>

    <body>
        <table id="tbl">
            <?php
            $correo = $_GET['correo'];
            $url = $_GET['url'];
            include '../../../config/conexionBD.php';
            $val = false;
            $val1 = false;
            $array = [];
            $bus = "SELECT * FROM usuario WHERE usu_correo LIKE '$correo%';";
            $resultb = $conn->query($bus);
            if ($resultb->num_rows > 0) {
                while ($row = $resultb->fetch_assoc()) {
                    $array[] = $row["usu_codigo"];
                }
            }
            if (count($array) != 0) {
                if ($url == "/SistemaDeGestion/admin/vista/user/mensajesen.php") {
                    echo "<tr>";
                    echo "<th>Fecha</th>";
                    echo "<th>Destinatario</th>";
                    echo " <th>Asunto</th>";
                    echo "<th>Leer</th>";
                    echo "</tr>";
                    foreach ($array as $i => $value) {
                        $sql = "SELECT * FROM correos WHERE cor_eliminado='N' AND cor_usu_destinatario=$array[$i] AND cor_usu_remitente=$codigoui ORDER BY cor_fecha_hora DESC;";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $codigo = $row["cor_codigo"];
                                $fecha = $row["cor_fecha_hora"];
                                $asunto = $row["cor_asunto"];
                                $correodes = "";
                                $bus = "SELECT * FROM usuario WHERE usu_codigo='$row[cor_usu_destinatario]';";
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
                                echo "   <td> <a href=' eliminar . php ? codigo = $codigo '> Ir </a> </td>";
                                echo "</tr>";
                            }
                        } else {
                            $val1 = true;
                        }
                    }
                    if ($val1 == true) {
                        echo "<tr>";
                        echo "   <td colspan='4'> No existen correos enviados de usuarios que su correo empieze con $correo </td>";
                        echo "</tr>";
                    }
                } else if ($url == "/SistemaDeGestion/admin/vista/user/index.php") {
                    echo "<tr>";
                    echo "<th>Fecha</th>";
                    echo "<th>Remitente</th>";
                    echo " <th>Asunto</th>";
                    echo "<th>Leer</th>";
                    echo "</tr>";
                    foreach ($array as $i => $value) {
                        $sql = "SELECT * FROM correos WHERE cor_eliminado='N' AND cor_usu_remitente=$array[$i] AND cor_usu_destinatario=$codigoui ORDER BY cor_fecha_hora DESC;";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $codigo = $row["cor_codigo"];
                                $fecha = $row["cor_fecha_hora"];
                                $asunto = $row["cor_asunto"];
                                $correodes = "";
                                $bus = "SELECT * FROM usuario WHERE usu_codigo='$row[cor_usu_remitente]';";
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
                                echo "   <td> <a href=' eliminar . php ? codigo = $codigo '> Ir </a> </td>";
                                echo "</tr>";
                            }
                        } else {
                            $val = true;
                        }
                    }
                    if ($val == true) {
                        echo "<tr>";
                        echo "   <td colspan='4'>  No existen correos enviados de usuarios que su correo empieze con $correo </td>";
                        echo "</tr>";
                    }
                }
            } else {
                if ($url == "/SistemaDeGestion/admin/vista/user/mensajesen.php") {
                    echo "<tr>";
                    echo "<th>Fecha</th>";
                    echo "<th>Destinatario</th>";
                    echo " <th>Asunto</th>";
                    echo "<th>Leer</th>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "   <td colspan='4'>  No existen correos enviados de usuarios que su correo empieze con $correo </td>";
                    echo "</tr>";
                } else if ($url == "/SistemaDeGestion/admin/vista/user/index.php") {
                    echo "<tr>";
                    echo "<th>Fecha</th>";
                    echo "<th>Remitente</th>";
                    echo " <th>Asunto</th>";
                    echo "<th>Leer</th>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "   <td colspan='4'>  No existen correos enviados de usuarios que su correo empieze con $correo </td>";
                    echo "</tr>";
                }
            }
            $conn->close();
            ?>
        </table>
    </body>

    </html>
<?php
} else {
    header("Location: ../../../config/acceso.html");
}
?>
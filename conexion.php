
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validacion del dato</title>
    <title>Formulario</title>
    <link rel="icon" type="image/x-icon" href="./imagenes/logosas.png">
    <style>
         a {
            border: none;
            outline: none;
            background-color: royalblue;
            padding: 10px;
            color: #fff;
            font-size: 16px;
            transition: 0.3s ease;
            cursor: pointer;
            width: 48%;
            text-decoration: none;
            font-family: sans-serif;
            text-align: center;
            margin-top: 10px;
        }

    </style>
</head>
<body>
    <br>
    <center>
<a href="http://192.168.2.242:8080/Empleados/index.php" class="button">Regresar</a>
</center>
<br>
<br>
<br>
</body>
</html>

<?php
// Configuración de la conexión
$serverName = "HERCULES"; // Nombre del servidor
$connectionOptions = array(
    "Database" => "RBOSKY3",
    "Uid" => "sa",
    "PWD" => "Sky2022*!",
    "CharacterSet" => "UTF-8" // Asegura que la conexión use UTF-8
);

// Establecer la conexión
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Verificar si los datos fueron enviados
if(isset($_POST['Nombre']) && isset($_POST['empID']) && isset($_POST['Apellido']) && isset($_POST['Code']) && isset($_POST['Cargo']) && isset($_POST['departamento']) && isset($_POST['fecha_inicio']) && isset($_POST['sexo']) && isset($_POST['Cedula']) && isset($_POST['activo']) && isset($_POST['Area']) && isset($_POST['operario_codigo'])) {
    $nombre = $_POST['Nombre'];
    $empID = $_POST['empID'];
    $apellido = $_POST['Apellido'];
    $code = $_POST['Code'];
    $Cargo = $_POST['Cargo'];
    $departamento = $_POST['departamento'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $sexo = $_POST['sexo'];
    $Cedula = $_POST['Cedula'];
    $Estado = $_POST['activo'];
    $Area = $_POST['Area'];
    $operario_codigo = $_POST['operario_codigo'];

    // Preparar la consulta
    $sql = "INSERT INTO OHEM (firstName, empID, lastName, Code,govID,dept,startDate,sex,passportNo,U_Comentarios,U_HBT_Contrasena,U_GSP_Target) VALUES (?, ?, ?, ?,?,?,?,?,?,?,?,?)";
    $params = array($nombre, $empID, $apellido, $code,$Cargo,$departamento,$fecha_inicio,$sexo,$Cedula,$Estado,$Area,$operario_codigo);

    // Ejecutar la consulta
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "Registro exitoso";
    }
} else {
    echo "Error: No se recibieron los datos del formulario.";
}

// Cerrar la conexión
sqlsrv_close($conn);
?>

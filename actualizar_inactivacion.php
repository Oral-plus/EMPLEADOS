<?php
// Verificar si se recibieron datos en formato JSON
$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    $serverName = "HERCULES"; // Nombre del servidor
    $connectionOptions = array(
        "Database" => "RBOSKY3",
        "Uid" => "sa",
        "PWD" => "Sky2022*!"
    );

    $conn = sqlsrv_connect($serverName, $connectionOptions);

    if ($conn === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    foreach ($data as $row) {
        $empID = $row['empID'];
        $Active = $row['Active'];

        // Depurar valores recibidos
        error_log("empID: $empID, Active: $Active");

        // Utilizar WRITETEXT para actualizar campos ntext
        $sql = "UPDATE OHEM SET Active = ? WHERE empID = ?";
        $params = array($Active, $empID);
        
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt === false) {
            echo "Error al actualizar datos: " . print_r(sqlsrv_errors(), true);
        }
    }

    sqlsrv_close($conn);
} else {
    echo "Error: No se recibieron datos en formato JSON";
}
?>
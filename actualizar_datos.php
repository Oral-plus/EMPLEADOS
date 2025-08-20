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
        $U_OcrCode2 = $row['U_OcrCode2'];
        $U_Comentarios = $row['U_Comentarios'];
        $U_OcrCode5 = $row['U_OcrCode5'];
      
        error_log("empID: $empID, U_OcrCode2: $U_OcrCode2, U_Comentarios: $U_Comentarios, U_OcrCode5: $U_OcrCode5");

        // Actualizar la base de datos
        $sql = "UPDATE OHEM SET U_OcrCode2 = ?, U_Comentarios = ?, U_OcrCode5 = ? WHERE empID = ?";
        $params = array($U_OcrCode2, $U_Comentarios, $U_OcrCode5, $empID);
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

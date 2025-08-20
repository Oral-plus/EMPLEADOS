<?php
// Conexión a la base de datos
$serverName = "HERCULES";
$connectionInfo = array("Database" => "RBOSKY3", "UID" => "sa", "PWD" => "Sky2022*!");
$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Obtener el departamento seleccionado de la solicitud AJAX
$deptSeleccionado = isset($_POST['dept']) ? $_POST['dept'] : '';

if (!empty($deptSeleccionado)) {
    // Consulta para obtener los nombres asociados con el departamento seleccionado
    $sql = "SELECT DISTINCT firstName FROM OHEM WHERE dept = ?";
    $params = array($deptSeleccionado);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Construir opciones del selector de nombres basadas en los resultados de la consulta
    $options = '';
    echo '<option value="">Selecciona el nombre</option>';
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $options .= '<option value="' . htmlspecialchars($row['firstName']) . '">' . htmlspecialchars($row['firstName']) . '</option>';
    }
    
    echo $options;
} else {
    // Si no se proporciona un departamento seleccionado, devolver una opción vacía
    echo '<option value="">Selecciona el nombre</option>';
}

// Liberar recursos
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>

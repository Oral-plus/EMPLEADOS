<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>inactivar empleados</title>
  <link rel="icon" type="image/x-icon" href="./imagenes/logosas.png">
  <style>
    /* Estilos para la tabla */
    .table-container {
      margin-top: 20px;
      overflow-x: auto;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      border: 1px solid #ddd;
    }

    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }

    tr:hover {
      background-color: #f2f2f2;
    }

    .boton {
      background-color: #7d2181;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    .boton:hover {
      background-color: #7d2181;
    }

    .titulo {
      display: block;
      margin-bottom: 10px;
      font-size: 18px;
      color: #333;
    }

    .form-container {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 10px;
      justify-content: center; /* Centra los divs horizontalmente */
    }

    .form-container div {
      display: flex;
      align-items: center; /* Centra verticalmente los elementos */
    }

    .form-container label {
      padding-right: 10px;
      width: 120px; /* Ancho fijo para los labels */
      text-align: right; /* Alinea los labels a la derecha */
    }

    .form-container input {
      width: 50%; /* Ocupa el 50% del ancho del contenedor */
      padding: 8px;
      border: 1px solid #ddd;
      border-radius: 4px;
      box-sizing: border-box;
    }

    .form-container select {
      width: 50%; /* Ocupa el 50% del ancho del contenedor */
      padding: 8px;
      border: 1px solid #ddd;
      border-radius: 4px;
      box-sizing: border-box;
    }

    .boton-div {
      display: flex;
      justify-content: center; /* Alinea el contenido al final */
      align-items: center; /* Centra verticalmente el botón */
    }

    .logo-container {
      text-align: center;
      margin-bottom: 20px;
    }

    .logo-container img {
      max-width: 100%;
      height: auto;
    }

    .contenedor2 {
      float:right;
      margin-top:30px;
    }

    .table-container {
      overflow-x: auto;
      max-width: 100%; /* Establece el ancho máximo */
      margin-top: 20px;
    }

    .container {
      display: flex;
      flex-direction: column;
      align-items: center; /* Centra horizontalmente los elementos */
      margin-top:30px;
    }

    .scrollable-table {
      max-height: 500px; /* Altura máxima */
      overflow-y: auto; /* Agrega una barra de desplazamiento vertical si es necesario */
      margin-top: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    table {
      border-collapse: collapse;
      width: 100%;
      border: 1px solid #ddd;
    }

    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }

    input[type="checkbox"]{
      text-align: center;
    }

    .center-checkbox {
        text-align: center;
    }
    .center-checkbox input {
        margin: auto;
    }
  </style>
</head>
<body>
<div class="logo-container">
    <img src="./imagenes/logosas.png" alt="logo">
</div>

<script>
function actualizarTodo() {
    var filas = document.getElementById("tablaDatos").rows;
    var datosActualizados = [];

    // Recorrer todas las filas
    for (var i = 1; i < filas.length; i++) { // Empezar desde 1 para omitir la fila de encabezados
        var fila = filas[i];
        var checkbox = fila.cells[7].querySelector('input');

        if (checkbox.checked !== checkbox.defaultChecked) { // Solo agregar si el estado del checkbox ha cambiado
            var empID = fila.cells[0].innerText; // Obtener el ID de la fila
            var Active = checkbox.checked ? 'Y' : 'N'; // Obtener el estado del checkbox Active
            console.log("empID:", empID, "Active:", Active); // Depurar valores
            datosActualizados.push({ empID: empID, Active: Active });
        }
    }

    if (datosActualizados.length > 0) {
        // Crear un objeto XMLHttpRequest
        var xhttp = new XMLHttpRequest();

        // Definir la función de retorno de llamada cuando se complete la solicitud
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4) {
                // La solicitud se completó
                if (this.status == 200) {
                    // La solicitud se completó correctamente
                    document.getElementById("mensaje").innerHTML = ""; // Limpiar el mensaje de error si hubo alguno anteriormente
                    alert("Datos actualizados correctamente"); // Puedes mostrar un mensaje de éxito si lo deseas
                } else {
                    // Hubo un error al completar la solicitud
                    document.getElementById("mensaje").innerHTML = "Error al actualizar datos: " + this.responseText; // Mostrar el mensaje de error en un elemento HTML
                }
            }
        };

        // Configurar la solicitud AJAX
        xhttp.open("POST", "actualizar_inactivacion.php", true);
        xhttp.setRequestHeader("Content-type", "application/json");

        // Enviar los datos actualizados al servidor
        xhttp.send(JSON.stringify(datosActualizados));
    } else {
        alert("No hay cambios para actualizar");
    }
}
</script>

<form method="post">
    <div class="boton-div">
        <input class="boton" type="submit" name="submit" value="Buscar Información">
    </div>
</form>

<div class="container">
    <button class="boton" onclick="actualizarTodo()">Actualizar Todo</button>
</div>

<div class="table-container">
    <div class="scrollable-table">
        <table id="tablaDatos" border="1">
            <tr>
                <th>Id</th>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cargo</th>
                <th>Departamento</th>
                <th>F.vinculacion</th>
                <th>Active</th>
            </tr>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

                $sqlMostrar = "SELECT T0.empID, T0.passportNo, T0.firstName, T0.lastName, T0.govID, T1.Name, T0.startDate, T0.Active FROM OHEM T0 LEFT JOIN OUDP T1 ON T0.[dept] = T1.[Code] WHERE 1=1 AND T0.passportNo IS NOT NULL AND T0.U_OcrCode5 = 'inactivo' AND T0.Active = 'Y'";
                $params = array();

                $resultMostrar = sqlsrv_query($conn, $sqlMostrar, $params);

                if ($resultMostrar === false) {
                    die("Error en la consulta: " . print_r(sqlsrv_errors(), true));
                }

                $i = 1; // Índice para las filas de la tabla
                while ($row = sqlsrv_fetch_array($resultMostrar, SQLSRV_FETCH_ASSOC)) {
                    $checkedActive = $row['Active'] == 'Y' ? 'checked' : '';
                    echo "<tr>";
                    echo "<td contenteditable='true'>" . $row['empID'] . "</td>";
                    echo "<td contenteditable='true'>" . $row['passportNo'] . "</td>";
                    echo "<td contenteditable='true'>" . $row['firstName'] . "</td>";
                    echo "<td contenteditable='true'>" . $row['lastName'] . "</td>";
                    echo "<td contenteditable='true'>" . $row['govID'] . "</td>";
                    echo "<td contenteditable='true'>" . utf8_encode($row['Name']) . "</td>";
                    echo "<td contenteditable='true'>" . ($row['startDate'] ? $row['startDate']->format('Y-m-d') : '') . "</td>";
                    echo "<td class='center-checkbox' contenteditable='true'><input type='checkbox' $checkedActive></td>";
                    echo "</tr>";
                    $i++; // Incrementar el índice después de cada fila
                }

                sqlsrv_free_stmt($resultMostrar);
                sqlsrv_close($conn);
            } else {
                echo "<tr><td colspan='8'>No se proporcionaron criterios de búsqueda.</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<div id="mensaje" style="color: red;"></div> <!-- Elemento para mostrar mensajes de error -->

</body>
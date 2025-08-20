<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario</title>
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
      background-color: #4caf50;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    .boton:hover {
      background-color: #45a049;
    }

    /* Resto de estilos */
    form {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
      justify-content: flex-end; /* Alinea el contenido al final */
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
        var empID = fila.cells[0].innerText; // Obtener el ID de la fila
        var U_OcrCode2 = fila.cells[1].querySelector('input').checked ? 'sus' : ''; // Obtener el estado del checkbox
        var U_Comentarios = fila.cells[fila.cells.length - 2].querySelector('input').checked ? 'activo' : ''; // Obtener el estado del checkbox Activo
        var U_OcrCode5 = fila.cells[fila.cells.length - 1].querySelector('input').checked ? 'inactivo' : ''; // Obtener el estado del checkbox Inactivo
        console.log("empID:", empID, "U_OcrCode2:", U_OcrCode2,"U_Comentarios:", U_Comentarios, "U_OcrCode5:", U_OcrCode5); // Depurar valores
        datosActualizados.push({ empID: empID, U_OcrCode2: U_OcrCode2, U_Comentarios: U_Comentarios, U_OcrCode5: U_OcrCode5 });
    }

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
    xhttp.open("POST", "actualizar_datos.php", true);
    xhttp.setRequestHeader("Content-type", "application/json");

    // Enviar los datos actualizados al servidor
    xhttp.send(JSON.stringify(datosActualizados));
}

function toggleCheckbox(row, checkboxType) {
    var fila = document.getElementById("tablaDatos").rows[row];
    var activoCheckbox = fila.cells[fila.cells.length - 2].querySelector('input');
    var inactivoCheckbox = fila.cells[fila.cells.length - 1].querySelector('input');
    var U_OcrCode2Checkbox = fila.cells[1].querySelector('input');

    if (checkboxType === 'activo' && activoCheckbox.checked) {
        inactivoCheckbox.checked = false;
        U_OcrCode2Checkbox.checked = false;
    } else if (checkboxType === 'inactivo' && inactivoCheckbox.checked) {
        activoCheckbox.checked = false;
        U_OcrCode2Checkbox.checked = false;
    } else if (checkboxType === 'U_OcrCode2' && U_OcrCode2Checkbox.checked) {
      activoCheckbox.checked = false;
      inactivoCheckbox.checked = false;
    }
}


</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            // Al cambiar la opción seleccionada en el selector de departamento
            $('select[name="Code"]').change(function(){
                var deptSeleccionado = $(this).val(); // Obtener el valor del departamento seleccionado

                // Realizar una solicitud AJAX para obtener los nombres asociados con el departamento seleccionado
                $.ajax({
                    url: 'obtener_nombres.php', // Ruta a tu script PHP que obtiene los nombres
                    method: 'POST',
                    data: {dept: deptSeleccionado}, // Enviar el departamento seleccionado al script PHP
                    success: function(response){
                        $('select[name="firstName"]').html(response); // Actualizar el selector de nombres con la respuesta del servidor
                    }
                });
            });
        });
    </script>
</head>
<body>
<form method="post">
<div class="form-container">
     
<?php
        // Conexión a la base de datos
        $serverName = "HERCULES";
        $connectionInfo = array("Database" => "RBOSKY3", "UID" => "sa", "PWD" => "Sky2022*!");
        $conn = sqlsrv_connect($serverName, $connectionInfo);

        if ($conn === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        // Obtener los nombres
        $sql = "SELECT DISTINCT firstName FROM OHEM";
        $stmt = sqlsrv_query($conn, $sql);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        ?>

        <div>
            <label class="titulo">Nombre:</label>
            <select name="firstName">
                <option value="">Selecciona el nombre</option>
                <?php
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    echo '<option value="' . htmlspecialchars($row['firstName']) . '">' . htmlspecialchars($row['firstName']) . '</option>';
                }
                sqlsrv_free_stmt($stmt);
                ?>
            </select>
        </div>
        <?php
// Obtener los departamentos
$sql = "SELECT DISTINCT Code, Name FROM OUDP WHERE NOT Code = '-2' AND NOT Code = '7' AND NOT Code = '5' AND NOT Code = '2'";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>

<div>
    <label class="titulo">Departamento:</label>
    <select name="Code">
        <option value="">Selecciona el departamento</option>
        <?php
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            echo '<option value="' . htmlspecialchars($row['Code']) . '">' . htmlspecialchars($row['Code'] . ' - ' . $row['Name']) . '</option>';
        }
        sqlsrv_free_stmt($stmt);
        ?>
    </select>
        </div>
    </div>
</div>
  <div class="boton-div">
    <input class="boton" type="submit" name="submit" value="Buscar Información">
  </div>
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
                <th>Suspencion</th>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cargo</th>
                <th>Departamento</th>
                <th>F.vinculacion</th>
                <th>Activo</th>
                <th>Inactivo</th>
            </tr>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $firstName = !empty($_POST['firstName']) ? $_POST['firstName'] : null;
                $dept = !empty($_POST['Code']) ? $_POST['Code'] : null;

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

                $sqlMostrar = "SELECT T0.empID,T0.U_OcrCode2, T0.passportNo, T0.firstName, T0.lastName, T0.govID, T1.Name, T0.startDate, T0.U_Comentarios, T0.U_OcrCode5 FROM OHEM T0 INNER JOIN OUDP T1 ON T0.[dept] = T1.[Code] 
                WHERE 1=1 AND T0.passportNo IS NOT NULL AND T0.Active = 'Y' AND T0.empID <> 645 AND T0.empID <> 646 AND T0.empID <> 647";
                $params = array();

                if ($firstName) {
                    $sqlMostrar .= " AND firstName = ?";
                    $params[] = $firstName;
                }

                if ($dept) {
                    $sqlMostrar .= " AND Dept = ?";
                    $params[] = $dept;
                }

                $resultMostrar = sqlsrv_query($conn, $sqlMostrar, $params);

                if ($resultMostrar === false) {
                    die("Error en la consulta: " . print_r(sqlsrv_errors(), true));
                }

                $i = 1; // Índice para las filas de la tabla
                while ($row = sqlsrv_fetch_array($resultMostrar, SQLSRV_FETCH_ASSOC)) {
                    $checkedU_OcrCode2 = ($row['U_OcrCode2'] == 'sus') ? 'checked' : ''; // Ajusta la condición según tus datos
                    $checkedActivo = $row['U_Comentarios'] == 'activo' ? 'checked' : '';
                    $checkedInactivo = $row['U_OcrCode5'] == 'inactivo' ? 'checked' : '';
                    
                    echo "<tr>";
                    echo "<td contenteditable='true'>" . $row['empID'] . "</td>";
                    echo "<td class='center-checkbox' contenteditable='true'><input type='checkbox' $checkedU_OcrCode2 onclick='toggleCheckbox($i, \"U_OcrCode2\")'></td>";
                    echo "<td contenteditable='true'>" . $row['passportNo'] . "</td>";
                    echo "<td contenteditable='true'>" . $row['firstName'] . "</td>";
                    echo "<td contenteditable='true'>" . $row['lastName'] . "</td>";
                    echo "<td contenteditable='true'>" . $row['govID'] . "</td>";
                    echo "<td contenteditable='true'>" . utf8_encode($row['Name']) . "</td>";
                    echo "<td contenteditable='true'>" . ($row['startDate'] ? $row['startDate']->format('Y-m-d') : '') . "</td>";
                    echo "<td class='center-checkbox' contenteditable='true'><input type='checkbox' $checkedActivo onclick='toggleCheckbox($i, \"activo\")'></td>";
                    echo "<td class='center-checkbox' contenteditable='true'><input type='checkbox' $checkedInactivo onclick='toggleCheckbox($i, \"inactivo\")'></td>";
                    echo "</tr>";
                    $i++; // Incrementar el índice después de cada fila
                }
          
                
                sqlsrv_free_stmt($resultMostrar);
                sqlsrv_close($conn);
            } else {
                echo "<tr><td colspan='10'>No se proporcionaron criterios de búsqueda.</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<div id="mensaje" style="color: red;"></div> <!-- Elemento para mostrar mensajes de error -->

</body>
</html>
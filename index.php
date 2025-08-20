<?php
// Configuración de la conexión
$serverName = "HERCULES"; // Nombre del servidor
$connectionOptions = array(
    "Database" => "RBOSKY3",
    "Uid" => "sa",
    "PWD" => "Sky2022*!"
);

// Establecer la conexión
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Obtener el siguiente empID
$sql = "SELECT MAX(empID) AS maxEmpID FROM OHEM";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$maxEmpID = $row['maxEmpID'];
$nextEmpID = $maxEmpID + 1;

// Cerrar la conexión
sqlsrv_close($conn);

// Incluir el formulario HTML y pasar $nextEmpID
?>


<?php
// Configuración de la conexión
$serverName = "HERCULES"; // Nombre del servidor
$connectionOptions = array(
    "Database" => "RBOSKY3",
    "Uid" => "sa",
    "PWD" => "Sky2022*!"
);

// Establecer la conexión
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Obtener el siguiente empID
$sql = "SELECT MAX(CONVERT(INT, T0.[U_GSP_Target])) AS maxoperario FROM OHEM T0";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$maxoperario = $row['maxoperario'];
$nextoperarioID = $maxoperario + 1;

// Cerrar la conexión
sqlsrv_close($conn);

// Incluir el formulario HTML y pasar $nextEmpID
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        .form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 100%;
            width: 100%;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            align-items: center;
            padding: 20px;
        }

        .title {
            font-size: 28px;
            color: royalblue;
            font-weight: 600;
            letter-spacing: -1px;
            position: relative;
            display: flex;
            align-items: center;
            padding-left: 30px;
        }

        .title::before, .title::after {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            border-radius: 50%;
            left: 0;
            background-color: royalblue;
        }

        .title::before {
            width: 18px;
            height: 18px;
        }

        .title::after {
            width: 18px;
            height: 18px;
            animation: pulse 1s linear infinite;
        }

        .message, .signin {
            color: rgba(88, 87, 87, 0.822);
            font-size: 14px;
        }

        .signin {
            text-align: center;
        }

        .signin a {
            color: royalblue;
        }

        .signin a:hover {
            text-decoration: underline royalblue;
        }

        .flex {
            display: flex;
            width: 100%;
            gap: 6px;
        }

        .form label {
            position: relative;
            width: 100%;
        }

        .form label .input,
        .form label .input3,
        .form label select {
            width: 50%;
            padding: 15px;
            outline: 0;
            border: 1px solid rgba(105, 105, 105, 0.397);
            border-radius: 10px;
            box-sizing: border-box;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .form label .input::placeholder,
        .form label .input3::placeholder {
            font-size: 1.2em;
            color: #555;
        }

        .form label .input:focus + span,
        .form label .input:valid + span,
        .form label .input3:focus + span,
        .form label .input3:valid + span {
            top: 0;
            font-size: 0.7em;
            font-weight: 600;
        }

        .form label .input + span,
        .form label .input3 + span {
            position: absolute;
            left: 10px;
            top: 15px;
            color: grey;
            font-size: 0.9em;
            cursor: text;
            transition: 0.3s ease;
        }

        .form label .input:placeholder-shown + span,
        .form label .input3:placeholder-shown + span {
            top: 15px;
            font-size: 0.9em;
        }

        .submit {
            border: none;
            outline: none;
            background-color: royalblue;
            padding: 10px;
    
            color: #fff;
            font-size: 16px;
            transition: 0.3s ease;
            cursor: pointer;
            width: 50%;
        }

        a {
            border: none;
            outline: none;
            background-color: #4caf50;
            padding: 10px;
  
            color: #fff;
            font-size: 16px;
            transition: 0.3s ease;
            cursor: pointer;
            width: 48%;
            text-decoration: none;
            font-family: sans-serif;
            text-align: center;
        }

        
        .aa {
            border: none;
            outline: none;
            background-color: #7d2181;
            padding: 10px;
  
            color: #fff;
            font-size: 16px;
            transition: 0.3s ease;
            cursor: pointer;
            width: 48%;
            text-decoration: none;
            font-family: sans-serif;
            text-align: center;
        }

        .submit:hover {
            background-color: rgb(56, 90, 194);
        }

        @keyframes pulse {
            from {
                transform: scale(0.9);
                opacity: 1;
            }
            to {
                transform: scale(1.8);
                opacity: 0;
            }
        }

        @media only screen and (max-width: 600px) {
            .flex {
                flex-direction: column;
            }

            .title {
                font-size: 24px;
                padding-left: 20px;
            }

            .form {
                padding: 20px;
            }

            .form label .input,
            .form label .input3,
            .form label select {
                width: 100%;
                padding: 15px;
                outline: 0;
                border: 1px solid rgba(105, 105, 105, 0.397);
                border-radius: 10px;
                box-sizing: border-box;
                font-size: 14px;
            }
        }

        img {
            width: 150px;
        }
    </style>
      <title>Ingreso de empleados</title>

      <link rel="icon" type="image/x-icon" href="./imagenes/logosas.png">
</head>
<body>
    <div class="form">
        <div class="title">Ingreso de empleados</div>
        <br>
        <img src="./imagenes/logosas.png" alt="logo">
        <center>
        <form method="post" action="conexion.php">
            <input type="hidden" name="Code" value="<?php echo $nextEmpID; ?>" readonly>
            <label for="empID">
                <input type="text" id="empID" class="input" name="empID" value="<?php echo $nextEmpID; ?>" readonly>
            </label>
          <!-- Campo oculto para el código de operario -->
            <label for="Codigo de operario">
                <input type="hidden" id="operario_codigo" class="input" name="operario_codigo" value="" readonly>
            </label>
            <label for="Nombre">
                <input type="text" id="Nombre" class="input" name="Nombre" Placeholder="Nombres" required>
            </label>
            <label for="Apellidos">
                <input type="text" id="Apellido" class="input" name="Apellido" Placeholder="Apellidos" required>
            </label>
            <label for="Cargo">
                <input type="text" id="Cargo" class="input" name="Cargo"  Placeholder="Cargo" required>
            </label>
            <label for="departamento">
        <select id="departamento" name="departamento" class="input" required>
            <option value="">Selecciona el departamento</option>
            <?php
            // Conexión a la base de datos
            $serverName = "HERCULES";
            $connectionInfo = array("Database" => "RBOSKY3", "UID" => "sa", "PWD" => "Sky2022*!");
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            if ($conn === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            // Obtener los departamentos
            $sql = "SELECT DISTINCT Code, Name FROM OUDP WHERE NOT Code = '-2' AND NOT Code = '7' AND NOT Code = '5' AND NOT Code = '2'";
            $stmt = sqlsrv_query($conn, $sql);

            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                echo '<option value="' . htmlspecialchars($row['Code']) . '">' . htmlspecialchars($row['Code'] . ' - ' . $row['Name']) . '</option>';
            }

            sqlsrv_free_stmt($stmt);
            ?>
        </select>
    </label>
            <label for="fecha_inicio">
                <input type="date" id="fecha_inicio" class="input" name="fecha_inicio" required>
            </label>
            <label for="sexo">
                <select name="sexo" class="input" required>
                    <option value="">Seleccione el sexo</option>
                    <option value="F">F</option>
                    <option value="M">M</option>
                </select>
            </label>
            <label for="Cedula">
                <input type="number" id="Cedula" class="input" name="Cedula"  Placeholder="Cedula"  required>
            </label>
            <input type="hidden" value="activo" name="activo">
            <br>
            </label>
            <label for="Area operario">
                <select name="Area" class="input">
                    <option value="">Selecciona el area del operario</option>
                    <option value="ENSAMBLE">ENSAMBLE</option>
                    <option value="ENVASADO">ENVASADO</option>
                    <option value="CEPILLOS">CEPILLOS</option>
                    <option value="SELLADO">SELLADO </option>
                    <option value="ACONDICIONAMIENTO">ACONDICIONAMIENTO</option>
                    <option value="DEVANADO">DEVANADO</option>
                    <option value="SELLADO">SELLADO</option>
                    <option value="PATINADOR">PATINADOR</option>
                    <option value="INYECCION">INYECCION</option>
                    <option value="PREPARACION">PREPARACION</option>
                    <option value="LOTEO">LOTEO</option>
                    <option value="MARCACION DE CEPILLOS">MARCACION DE CEPILLOS</option>
                    <option value="EMPAQUE">EMPAQUE</option>
                </select>
            </label>
            <button type="submit" class="submit">Registrar</button>
        </form>
        <script>
    document.getElementById('departamento').addEventListener('change', function() {
        var departamento = this.value;
        var operarioCodigo = document.getElementById('operario_codigo');

        // Verificar si el departamento seleccionado es 1
        if (departamento === '1') {
            operarioCodigo.value = "<?php echo $nextoperarioID; ?>"; // Asignar el valor de $nextoperarioID si el departamento es 1
        } else {
            operarioCodigo.value = ''; // Dejar el campo vacío si no es 1
        }
    });
</script>
        </center>
        <a href="http://192.168.2.242:8080/Empleados/Empleadossky.php" class="button">Listado de empleados</a>
        <a class="aa" href="http://192.168.2.242:8080/Empleados/Inactivar_empleados.php" class="button">Inactivar empleados</a>
    </div>
</body>
</html>

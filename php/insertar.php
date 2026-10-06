<html>
    <head>
        <meta charset="UTF-8">
        <title>
            Insertar Usuario
        </title>
        <link rel="icon" type="image/png" sizes="32x32" href="../imagenes/favicon.jpeg">
        <link rel="stylesheet" type="text/css" href="../estilos/estilos.css">
    </head>
<body>
    <?php
    $conexion = mysqli_connect("127.0.0.1", "php", "", "CAE", 3307) or die("Problemas con la conexion");
             mysqli_set_charset($conexion, "utf8mb4");
        
            $nombre= $_REQUEST['nombre'];
            $apellido= $_REQUEST['apellidos'];
            $dni= $_REQUEST['dni'];
            $fechaNacimiento= $_REQUEST['fechaNacimiento'];
            $telefono= $_REQUEST['telefono'];
            $email= $_REQUEST['email'];
    
            $tipo = "Soldadura";
                if ($_REQUEST['tipo'] == 'informatica'){
                    $tipo = 'Informática';
                } elseif ($_REQUEST['tipo'] == 'socio'){
                    $tipo = "Asistencia Sociosanitaria";
                }
                
    

            //1 si eligió parcial, 0 si completa
            $jornada = $_REQUEST['jornada'];
            if ($jornada == "parcial") {
                $jornadaParcial = 1;
            } else {
                $jornadaParcial = 0;
            }
 
            $idiomas = "";
            if (isset($_REQUEST['check1']) && isset($_REQUEST['check2'])) {
                $idiomas = "euskera,ingles";
            } elseif (isset($_REQUEST['check1'])) {
                $idiomas = "euskera";
            } elseif (isset($_REQUEST['check2'])) {
                $idiomas = "ingles";
            }


            $peticionInsertar = "INSERT INTO SOLICITUD (nombre, apellidos, dni, f_nac, tlf, email, profesion, jornadaParcial, idiomas)
                                VALUES ('$nombre', '$apellido', '$dni', '$fechaNacimiento', '$telefono', '$email', '$tipo', $jornadaParcial, '$idiomas')";
            $registros = mysqli_query($conexion, $peticionInsertar);
    
            if ($registros) {
                echo "Usuario registrado";
            } else {
            echo "Error al guardar los datos: " . mysqli_error($conexion);
            }
        ?>
        <button onclick="location.href='../html/index.html'">Volver al formulario</button>
</body>
</html>
<html>
    <head>
        <meta charset="UTF-8">

        <title>Examen de Desarrollo web en entorno servidor</title>
        <link rel="icon" type="image/png" sizes="32x32" href="../imagenes/favicon.jpeg">
        <link rel="stylesheet" type="text/css" href="../estilos/estilos.css">

    </head>
    <body>
        <h1>Centro de Ayuda al Empleo</h1>
        <h2>
            <?php
                $tipo = "Soldadura";
                    if ($_REQUEST['tipo'] == 'informatica'){
                        $tipo = 'Informática';
                    } elseif ($_REQUEST['tipo'] == 'socio'){
                        $tipo = "Asistencia Sociosanitaria";
                    }
                    echo "Solicitudes de $tipo";
            ?>
        </h2>

        
        <?php 
        $conexion = mysqli_connect("127.0.0.1", "php", "", "CAE", 3307) or die("Problemas con la conexion");
        mysqli_set_charset($conexion, "utf8mb4");
        


        $consulta = "SELECT nombre, apellidos, dni, f_nac, tlf, email, jornadaParcial, idiomas
                     FROM SOLICITUD WHERE profesion = '$tipo' ORDER BY apellidos, nombre";
        $resultado = mysqli_query($conexion, $consulta);
 
        if (mysqli_num_rows($resultado) > 0) {
            echo "<table>";
            echo "<tr><th>Nombre</th><th>Apellidos</th><th>DNI</th><th>Fecha de nacimiento</th>
                      <th>Teléfono</th><th>Email</th><th>Jornada</th><th>Idiomas</th></tr>";
 
            while ($fila = mysqli_fetch_assoc($resultado)) {
                // Traducimos lo guardado en la base de datos a texto legible
                if ($fila['jornadaParcial'] == 1) {
                    $jornada = "Parcial";
                } else {
                    $jornada = "Completa";
                }
 
                if ($fila['idiomas'] == "") {
                    $idiomasTexto = "Ninguno";
                } else {
                    $idiomasTexto = str_replace(['euskera', 'ingles', ','],
                                                ['Euskera', 'Inglés', ', '], $fila['idiomas']);
                }
 
                echo "<tr>";
                echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['apellidos']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['dni']) . "</td>";
                echo "<td>" . date('d/m/Y', strtotime($fila['f_nac'])) . "</td>";
                echo "<td>" . htmlspecialchars($fila['tlf']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['email']) . "</td>";
                echo "<td>$jornada</td>";
                echo "<td>$idiomasTexto</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Todavía no hay solicitudes de este tipo.</p>";
        }
 
        mysqli_close($conexion);
        ?>

        <button onclick="location.href='../html/index.html'">Volver al formulario</button>
    </body>
</html>




<!DOCTYPE html>
<html>

<head>
    <title>Provicias y sus cuidades OFC</title>
    <!-- Agrega los enlaces a los archivos de Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilos.css">

</head>

<body>


    <?php
    include 'class.php';





    // function mostrarDatosProvincia($paisData, $nombreProvincia)
// {
//     echo '<h1>Provincia: ' . $nombreProvincia . '</h1>';
    
    //     if (isset($paisData['provincias'][$nombreProvincia])) {
//         $provinciaData = $paisData['provincias'][$nombreProvincia];
    
    //         echo "- Nombre de la Provincia: {$provinciaData['nombre']}<br>";
//         echo "- Número de Ciudades: {$provinciaData['numCiudades']}<br>";
//         echo "  Ciudades:<br>";
//         foreach ($provinciaData['ciudades'] as $ciudadData) {
//             echo "  - Nombre: {$ciudadData['nombre']}<br>";
//             echo "  - Codigo Postal: {$ciudadData['CodigoPostal']}<br>";
    
    //         }
//     } else {
//         echo "Provincia no encontrada en este país.";
//     }
//     echo "<br>";
// }
    
    function mostrarDatosProvincia($paisData, $nombreProvincia)
    {
        echo '<div class="container mt-4">';
        echo '<h1 class="mb-4">Provincia: ' . $nombreProvincia . '</h1>';

        if (isset($paisData['provincias'][$nombreProvincia])) {
            $provinciaData = $paisData['provincias'][$nombreProvincia];

            echo '<div class="card mb-4 content-right">'; // Agrega la clase 'content-left'
            echo '<div class="card-header">';
            echo "<h4 class='card-title d-inline'>$nombreProvincia</h4>";
            echo "<span class='badge bg-secondary ms-2'>{$provinciaData['numCiudades']} Ciudades</span>";
            echo '</div>';
            echo '<div class="card-body">';
            foreach ($provinciaData['ciudades'] as $ciudadData) {
                echo '<div class="card mb-2 content-right">'; // Agrega la clase 'content-right'
                echo '<div class="card-body">';
                echo "<h5 class='card-title'>$ciudadData[nombre]</h5>";
                echo "<p class='card-text'>Código Postal: $ciudadData[CodigoPostal]</p>";
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
            echo '</div>';
        } else {
            echo '<div class="alert alert-warning" role="alert">';
            echo 'Provincia no encontrada en este país.';
            echo '</div>';
        }

        echo '</div>';
    }



    // Verificar si se recibió un país y una provincia en la solicitud POST
    if (isset($_POST['pais']) && isset($_POST['provincia'])) {
        $paisSeleccionado = $_POST['pais'];
        $provinciaSeleccionada = $_POST['provincia'];

        // Mostrar los datos de la provincia del país seleccionado
        if (isset($paisesData[$paisSeleccionado])) {
            $paisData = $paisesData[$paisSeleccionado];
            mostrarDatosProvincia($paisData, $provinciaSeleccionada);
        } else {
            echo "Provincia no encontrada.";
        }
    }

    ?>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">


</script>
<!-- Incluye el enlace a la biblioteca ScrollReveal -->
<script  > 
window.sr = ScrollReveal();
            sr.reveal('.navbar', {
                duration: 2000,
                origin: 'bottom'
            });
            sr.reveal('.content-left', {
                duration: 2000,
                origin: 'left',
                distance: '300px'
            });
            sr.reveal('.content-right', {
                duration: 2000,
                origin: 'right',
                distance: '300px'
            });
            sr.reveal('.header-btn', {
                duration: 2000,
                origin: 'bottom',
                delay: 100
            });
            sr.reveal('.content-btn', {
                duration: 2000,
                origin: 'bottom',
                distance: '300px',
                viewfactor: 0.2
            });
</script>



</html>
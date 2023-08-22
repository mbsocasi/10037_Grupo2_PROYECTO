<!DOCTYPE html>
<html>

<head>
    <title>Paises OFC</title>
    <!-- Agrega los enlaces a los archivos de Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <?php
    // terminado falta pulir...
    include 'class.php';

    // Mostrar los datos de los países, provincias y ciudades en pantalla
    
    function mostrarDatosPais($paisData)
    {
        echo '<div class="container mt-4">';

        echo '<div class="card mb-4">';
        echo '<div class="card-header">';
        echo "<center><h1 class='card-title'>$paisData[nombre]</h1></center>";
        echo '</div>';
        echo '</div>';

        // División para la imagen de la bandera
        echo '<div class="row">';
        echo '<div class="col-md-12 bandera-col">';
        echo '<div class="rounded mb-4">';
        echo "<img src='{$paisData['bandera']}' class='img-fluid rounded bandera' alt='Bandera'>";
        echo '</div>';
        echo '</div>';
        echo '</div>';

        // División para la moneda del país

        echo '<div class="container mt-4">';
    echo '<div class="card mb-4">';
    echo '<div class="card-header">';
    echo '<h2 class="mb-4">Moneda</h2>';
    echo "<p>{$paisData['moneda']}</p>";

// División para la imagen de la moneda del país
echo '<div class="row">';
echo '<div class="col-md-12 moneda-col">';
echo "<img src='{$paisData['imagen_moneda']}' class='img-fluid rounded moneda' alt='Moneda'>";
echo '</div>';
echo '</div>';

echo '</div>';
echo '</div>';
echo '</div>';



        // División para el plato del país
        echo '<div class="row">';
        echo '<div class="col-md-12">';
        echo '<h2 class="mb-4">Platos Típicos</h2>';
        echo '</div>';
        foreach ($paisData['plato_tipico'] as $index => $plato) {
        echo '<div class="col-md-4">';
        echo '<div class="card mb-3">';
        echo '<div class="card-body">';
        echo "<h5 class='card-title text-center' data-bs-toggle='modal' data-bs-target='#platoModal$index'>$plato</h5>";
        echo '</div>';
        echo '</div>';
        echo '</div>';

        // Modal para la imagen del plato
        echo "<div class='modal fade' id='platoModal$index' tabindex='-1' aria-labelledby='platoModalLabel$index' aria-hidden='true'>";
        echo '<div class="modal-dialog">';
        echo '<div class="modal-content">';
        echo '<div class="modal-header">';
        echo "<h5 class='modal-title' id='platoModalLabel$index'>$plato</h5>";
        echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '</div>';
        echo '<div class="modal-body text-center">';
        echo "<img src='{$paisData['imagenes_platos'][$index]}' class='img-fluid rounded' alt='$plato'>";
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        }
        echo '</div>';
        
        // Tabla para los nombres de las provincias
        echo '<div class="row">';
        echo '<div class="col-md-12">';
        echo '<table class="table table-bordered   table-striped">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">Provincias</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($paisData['provincias'] as $nombreProvincia => $provinciaData) {
            echo '<tr>';
            echo "<td>$nombreProvincia</td>";
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
        echo '</div>';

        echo '</div>'; // Cierre del container
    }


    // Verificar si se recibió un país en la solicitud POST
    if (isset($_POST['pais'])) {
        $paisSeleccionado = $_POST['pais'];

        // Mostrar los datos del país seleccionado
        if (isset($paisesData[$paisSeleccionado])) {
            $paisData = $paisesData[$paisSeleccionado];
            mostrarDatosPais($paisData);
        } else {
            echo "País no encontrado.";
        }
    }

    ?>
    <div class="container mt-4">

        <div class="col-md-12 mb-4 ">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Detalle de las provincias del pais</h2>
                    <form name="paisForm" method="POST" action="provincia.php">
                        <?php
                        if (isset($paisSeleccionado)) {
                            echo "<input type='hidden' name='pais' value='$paisSeleccionado'>";
                        } ?>
                        <label class="form-label" for="">Conoce mas..</label>
                        <select class="form-select" name="provincia">
                            <option selected disabled>Selecciona una provincia</option>
                            <?php


                            if (isset($_POST['pais']) && isset($paisesData[$_POST['pais']])) {
                                $provinciasPais = $paisesData[$_POST['pais']]['provincias'];
                                foreach ($provinciasPais as $nombreProvincia => $provinciaData) {
                                    echo "<option value='$nombreProvincia'>$nombreProvincia</option>";
                                }
                            }
                            ?>
                        </select>
                        <input class="btn btn-primary mt-4" type="submit" name="enviar"
                            value="Mostrar detalles Provincia">
                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Agrega el enlace al archivo de Bootstrap JS al final del cuerpo del documento -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
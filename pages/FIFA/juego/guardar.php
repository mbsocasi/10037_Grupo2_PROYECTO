<?php
// Leemos el contenido del archivo resultados.json
$resultados = json_decode(file_get_contents('resultados.json'), true);

// Obtenemos los datos del resultado desde la solicitud POST
$resultado = [
    'usuario' => $_POST['usuario'],
    'opcionesSeleccionadas' => $_POST['opcionesSeleccionadas'],
    'respuestasCorrectas' => $_POST['respuestasCorrectas']
];

// Agregamos el resultado al arreglo de resultados
$resultados[] = $resultado;

// Guardamos el arreglo de resultados en el archivo resultados.json
file_put_contents('resultados.json', json_encode($resultados));

?>
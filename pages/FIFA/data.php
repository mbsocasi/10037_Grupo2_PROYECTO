<?php 
 
// Cargar datos desde el archivo JSON
$jsonData = file_get_contents('paises.json');
$paisesData = json_decode($jsonData, true);

// Crear instancias de las clases Pais, Provincia y Ciudad a partir de los datos
$paises = [];
foreach ($paisesData as $nombrePais => $paisData) {
    $provincias = [];
    foreach ($paisData['provincias'] as $nombreProvincia => $provinciaData) {
        $ciudades = [];
        foreach ($provinciaData['ciudades'] as $ciudadData) {
            $ciudad = new Ciudad($ciudadData['nombre'], $ciudadData['CodigoPostal']);
            $ciudades[] = $ciudad;
        }
        $provincia = new Provincia($nombreProvincia, $ciudades, $provinciaData['numCiudades']);
        $provincias[] = $provincia;
    }
    $pais = new Pais(
        $nombrePais,
        $paisData['plato_tipico'],
        $paisData['moneda'],
        $paisData['bandera'],
        $provincias
    );
    $paises[] = $pais;
}
?>
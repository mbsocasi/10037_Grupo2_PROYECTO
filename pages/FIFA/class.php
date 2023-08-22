<?php
include 'data.php';
class Ciudad
{
    private $nombre;
    private $CodigoPostal;

    public function __construct($nombre, $CodigoPostal)
    {
        $this->nombre = $nombre;
        $this->CodigoPostal = $CodigoPostal;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getCodigoPostal()
    {
        return $this->CodigoPostal;
    }
}

class Provincia
{
    private $nombre;
    private $ciudades;
    private $numCiudades;

    public function __construct($nombre, $ciudades, $numCiudades)
    {
        $this->nombre = $nombre;
        $this->ciudades = $ciudades;
        $this->numCiudades = $numCiudades;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getCiudades()
    {
        return $this->ciudades;
    }

    public function getNumCiudades()
    {
        return $this->numCiudades;
    }
}

class Pais
{
    private $nombre;
    private $plato_tipico;
    private $moneda;
    private $bandera;
    private $provincias;

    public function __construct($nombre, $plato_tipico, $moneda, $bandera, $provincias)
    {
        $this->nombre = $nombre;
        $this->plato_tipico = $plato_tipico;
        $this->moneda = $moneda;
        $this->bandera = $bandera;
        $this->provincias = $provincias;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getPlatoTipico()
    {
        return $this->plato_tipico;
    }

    public function getMoneda()
    {
        return $this->moneda;
    }

    public function getBandera()
    {
        return $this->bandera;
    }

    public function getProvincias()
    {
        return $this->provincias;
    }
    
}


?>
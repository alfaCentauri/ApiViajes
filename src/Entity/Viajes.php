<?php
/**
 * Created by PhpStorm.
 * User: Ing. Ricardo Presilla
 * Date: 3/6/2019
 * Time: 7:04 PM
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Clase de viajes.
 * @author Ing. Ricardo Presilla
 * @version 1.0.
 * @ORM\Table(name="viajes" )
 * @ORM\Entity(repositoryClass="App\Repository\ViajesRepository")
 */
class Viajes{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var integer
     *
     * @ORM\Column(name="numeroPlazas", type="integer" )
     */
    private $numeroPlazas;
    /**
     * @var string
     *
     * @ORM\Column(name="destino", type="string", length=255, nullable=false)
     */
    private $destino;
    /**
     * @var string
     *
     * @ORM\Column(name="origen", type="string", length=255, nullable=false)
     */
    private $origen;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;
    /**
     * @var float
     *
     * @ORM\Column(name="precio", type="float" )
     */
    private $precio;
    
    function __construct() {
        $this->id = 0;
        $this->numeroPlazas = 0;
        $this->destino = "";
        $this->origen = "";
        $this->fecha = new \DateTime();
        $this->precio = 0;
    }

    function getId() {
        return $this->id;
    }

    function getNumeroPlazas() {
        return $this->numeroPlazas;
    }

    function getDestino() {
        return $this->destino;
    }

    function getOrigen() {
        return $this->origen;
    }

    function getFecha(): \DateTime {
        return $this->fecha;
    }

    function setId($id) {
        $this->id = $id;
    }
    /**Asigna el numero de plazas disponibles para el viaje.
     * @param $numeroPlazas Tipo entero.
     */
    function setNumeroPlazas($numeroPlazas) {
        $this->numeroPlazas = $numeroPlazas;
    }

    function setDestino($destino) {
        $this->destino = $destino;
    }

    function setOrigen($origen) {
        $this->origen = $origen;
    }

    function setFecha(\DateTime $fecha) {
        $this->fecha = $fecha;
    }
    function getPrecio() {
        return $this->precio;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

}
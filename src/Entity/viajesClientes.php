<?php
/**
 * Created by PhpStorm.
 * User: Ing. Ricardo Presilla
 * Date: 3/6/2019
 * Time: 7:06 PM
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Clase de viajesClientes.
 * @author Ing. Ricardo Presilla
 * @version 1.0.
 * @ORM\Table(name="viajesClientes" )
 * @ORM\Entity(repositoryClass="App\Repository\ViajesClienteRepository")
 */
class viajesClientes{
    /**
     * @var integer
     *
     * @ORM\Column(name="idViajes", type="integer")
     */
    private $idViajes;
    /**
     * @var integer
     *
     * @ORM\Column(name="idClientes", type="integer")
     */
    private $idClientes;
    /***/
    function getIdViajes() {
        return $this->idViajes;
    }

    function getIdClientes() {
        return $this->idClientes;
    }

    function setIdViajes($idViajes) {
        $this->idViajes = $idViajes;
    }

    function setIdClientes($idClientes) {
        $this->idClientes = $idClientes;
    }

}
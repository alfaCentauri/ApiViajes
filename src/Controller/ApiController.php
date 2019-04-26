<?php
/**
 * Created by PhpStorm.
 * User: Ricardo Presilla
 * Date: 3/6/2019
 * Time: 5:08 PM
 */

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints\Date;
use App\Entity\Clientes;
use App\Entity\Viajes;
/**
 * Controlador de la api.
 * @Route("/api")
**/
class ApiController extends Controller{
    /**
     * Mostrar los datos de los clientes
     * @Route("/listadoClientes", methods={"GET"})
     */
    public function listaClientesAction(){
        $repositorio = $this->getDoctrine()->getRepository('App:Clientes');
        $clientes = $repositorio->findAll();
        $lista = array();
        foreach ($clientes as $cliente){
            $nodo = array();
            $nodo['cedula']=$cliente->getCedula();
            $nodo['nombre']=$cliente->getNombre();
            $nodo['direccion']=$cliente->getDireccion();
            $nodo['telefono']=$cliente->getTelefono();
            $lista[]=$nodo;
        }
        if (sizeof($lista)>0){
            $statusCode = 200; // 200 encontrado
        }
        else {
            $statusCode = 404; // 404 no encontrado
        }
        // Se genera la respuesta
        $response = new JsonResponse($lista);
//        $response = new Response ();
//        $response->setContent(json_encode($lista));//Responde con el id del registro
//        $response->headers->set('Content-Type', 'application/json');
//        $response->setStatusCode($statusCode);
        return $response;
//        $response = new Response('<html><body>Listado de clientes: <br></body></html>');
//        return $response;
    }
    /**
     * Agregar los datos de un cliente. Recibe una solicitud con un json, valida 
     * su estructura y guarda los datos en la base de datos.
     * @Route("/agregarCliente", methods={"POST"})
     */
    public function agregarClienteAction(Request $request){
        $statusCode = 400; 
        $nodo = array();
        $content = $request->getContent();
        $data = json_decode($content, true);      
        if(isset($data)){
            $cliente = new Clientes();
            if($data["cedula"]!="" && $data["nombre"]!="" && 
                $data["direccion"]!="" && $data["telefono"]!=""){
                $cliente = $this->getDoctrine()->getRepository('App:Clientes')->find($data["cedula"]);
                if($cliente==null){
                    $cliente->setCedula($data["cedula"]);
                    $cliente->setNombre($data["nombre"]);
                    $cliente->setDireccion($data["direccion"]);
                    $cliente->setTelefono($data["telefono"]);
                    $entidad = $this->getDoctrine()->getManager();
                    $entidad->persist($cliente);
                    $entidad->flush();
                    $statusCode = 201; 
                    $nodo['id']=$cliente->getCedula();
                }
                else {
                    $statusCode = 409;
                    $nodo['error']="El cliente existe";
                }
            }
            else{
                $statusCode = 400; 
                $nodo['error']="Error de solicitud.";
            }
        }
        else{
            $statusCode = 400; 
            $nodo['error']="Error no se recibieron datos.";
        }
        // Se genera la respuesta
        $response = new Response ();
        $response->setContent(json_encode($nodo));
        $response->headers->set('Content-Type', 'application/json');
        $response->setStatusCode($statusCode);
        return $response;
    }
    /**
     * Edita al registro de un cliente indicado por su id (cedula)
     * @Route("/cliente/{id}", methods={"PUT"}, requirements={"id"="\d+"})
     */
    public function editarClienteAction(Request $request, $id)
    {
        $content = $request->getContent();
        $data = json_decode($content, true);
        if ($this->validacion($data) && $id>0){
            $statusCode = 201; // 201 Created
        }
        else{
            $statusCode = 400; // 400 Bad Request
        }
        // Se genera la respuesta
        $response = new Response ();
        $response->setContent(json_encode(["Mensaje"=>"Prueba de envio de datos"]));//Responde con el id del registro
        $response->headers->set('Content-Type', 'application/json');
        $response->setStatusCode($statusCode);
        return $response;
    }
    /**
     * Enviando un Json de los datos de los viajes registrados en el sistema.
     * @Route("/listaViajes" , name="apiListadoViajes")
     */
    public function listadoViajessAction(){
        $repositorio = $this->getDoctrine()->getRepository('App:Viajes');
        $viajes = $repositorio->findAll();
        $arregloViajes = array();
        foreach ($viajes as $viaje){
            $arregloViaje = array();
            $arregloViaje['id']=$viaje->getId();            
            $arregloViaje['cantidadPlazas']=$viaje->getNumeroPlazas();
            $arregloViaje['destino']=$viaje->getDestino();
            $arregloViaje['origen']=$viaje->getOrigen();
            $arregloViaje['precio']=$viaje->getPrecio();
            $arregloViaje['fecha']=$viaje->getFecha();
            $arregloViajes[]=$arregloViaje;
        }
        $response = new JsonResponse($arregloViajes);
        return $response;
    }
    /**
     * Agregar un viaje al sistema. 
     * @Route("/agregarViaje", methods={"POST"})
     */
    public function agregarViajeAction(Request $request){
        $statusCode = 406;
        $content = $request->getContent();
        $data = json_decode($content, true); 
        if(isset($data)){
            var_dump($data);//Visualizar datos
            if($data['cantidadPlazas']!="" && $data["origen"]!=""
                && $data["destino"]!="" && $data["precio"]!="" 
                && $data["fecha"]!="" ){
                $viaje = $this->getDoctrine()->getRepository('App:Viajes')
                        ->findOneByOrigenDestino($data["origen"], $data["destino"], $data["fecha"]);
                if($viaje==null){
                    $viaje = new Viajes();
                    $viaje->setNumeroPlazas($data['cantidadPlazas']);                    
                    $viaje->setOrigen($data["origen"]);
                    $viaje->setDestino($data["destino"]);
                    $viaje->setPrecio($data["precio"]);
                    $viaje->setFecha(new \DateTime());// $data["fecha"]
                    $entidad = $this->getDoctrine()->getManager();
                    $entidad->persist($viaje);
                    $entidad->flush(); 
                    $statusCode = 201; 
                    $nodo['mensaje']="Viaje creado";
                }
                else {
                    $statusCode = 409;
                    $nodo['error']="El viaje existe";
                }
            }
            else{
                $statusCode = 400; 
                $nodo['error']="Error de solicitud.";
            }
        }
        else{
            $statusCode = 400; 
            $nodo['error']="Error no se recibieron datos.";
        }
        // Se genera la respuesta
        $response = new Response ();
        $response->setContent(json_encode($nodo));
        $response->headers->set('Content-Type', 'application/json');
        $response->setStatusCode($statusCode);
        return $response;
    }
    /***/
    private function validacionCliente($json){
        if($json!=NULL && $json["cedula"]!="" && $json["nombre"]!="" && 
                $json["direccion"]!="" && $json["telefono"]!=""){   
            return true;
        }
        else{
            return false;
        }
    }
}
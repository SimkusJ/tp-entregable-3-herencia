<?php

require_once "Pasajero.php";
require_once "PasajeroVIP.php";
require_once "PasajeroEspecial.php";


class Viaje
{


    private $coleccionPasajeros;
    private $cantidadMaxima;
    private $pasajero;
    private $responsable;
    private $destino;
    private $codigoViaje;
    private $montoActual;

    public function __construct($codigoViaje, $destino, $responsable, $cantidadMaxima, $pasajero)
    {
        $this->coleccionPasajeros = [];
        $this->cantidadMaxima = $cantidadMaxima;
        $this->pasajero = $pasajero;

        $this->responsable = $responsable;
        $this->destino = $destino;
        $this->codigoViaje = $codigoViaje;
        $this->montoActual=0;
    }



    //Coleccion pasajeros
    public function setColeccionPasajeros($coleccion)
    {
        $this->coleccionPasajeros = $coleccion;
    }
    public function getColeccionPasajeros()
    {
        return $this->coleccionPasajeros;
    }

    //Cantidad maxima de pasajeros
    public function setCantidadMaxima($cantidad)
    {
        $this->cantidadMaxima = $cantidad;
    }
    public function getCantidadMaxima()
    {
        return $this->cantidadMaxima;
    }

    // seteo Pasajero
    public function setPasajero($pasajero)
    {
        $this->pasajero = $pasajero;
    }
    public function getPasajero()
    {
        return $this->pasajero;
    }

    //Responsable 
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;
    }
    public function getResponsable()
    {
        return $this->responsable;
    }

    // ----Destino---- //
    public function setDestino($valor)
    {
        $this->destino = $valor;
    }
    public function getDestino()
    {
        return $this->destino;
    }

    // ---- coodigoViaje ---- //
    public function setCodigoViaje($valor)
    {
        $this->codigoViaje = $valor;
    }
    public function getCodigoViaje()
    {
        return $this->codigoViaje;
    }

    // ---- Monto del viaje ---- //
    public function setMontoActual($monto){
        $this->montoActual=$monto;
    }
    public function getMontoActual(){
        return $this->montoActual;
    }


    public function __toString()
    {


        //seccion del responsable

        $responsable = $this->getResponsable();

        $mensaje = "========== SECCION DEL RESPONSABLE ========== \n";
        $mensaje .= "Nombre: " . $responsable->getNombre() . "\n";
        $mensaje .= "Apellido: " . $responsable->getApellido() . "\n";
        $mensaje .= "Numero de empleado: " . $responsable->getNumEmpleado() . "\n";
        $mensaje .= "Numero de licencia: " . $responsable->getNumLicencia() . "\n";
        $mensaje .= "============================================= \n";

        //Datos de viaje

        $mensaje .= "========== DATOS DEL VIAJE ========== \n";
        $mensaje .= "Destino del viaje: " . $this->getDestino() . "\n";
        $mensaje .= "Codigo del viaje: " . $this->getCodigoViaje() . "\n";
        $mensaje .= "Numero maximo de pasajeros: " . $this->getmaxPasajeros() . "\n";
        $mensaje .= "Cantidad actual de pasajeros: " . count($this->coleccionPasajeros) . "\n";
        $mensaje .= "Monto actual: " . $this->getMontoActual(). "$ \n";
        $mensaje .= "============================================= \n";



        //seccion de los pasajeros

        $mensaje .= "========== SECCION DE PASAJEROS ========== \n";

        if (count($this->coleccionPasajeros) > 0) {

            $pasajeros = $this->getColeccionPasajeros();

            for ($i = 0; $i < count($this->coleccionPasajeros); $i++) {


                $mensaje .= "========== Ubicacion en la lista: " . $i . "========== \n";
                $mensaje .= $pasajeros[$i] . "\n";
            }
        } else {

            $mensaje .= "============================================= \n";
            $mensaje .= "No se cargo informacion sobre los pasajeros. \n";
            $mensaje .= "============================================= \n";
        }

        return $mensaje;
    }


    //Funciones 

     // ------------ funcion para agregar un pasajero a la coleccion ------------//

    public function añadirPasajero($pasajero)
    {
        $coleccion = $this->getColeccionPasajeros();

        array_push($coleccion, $pasajero);

        $this->setColeccionPasajeros($coleccion);
    }

     // ------------ funcion para comprobar si hay pasajes disponibles ------------//

    public function hayPasajesDisponible()
    {
        if (count($this->getColeccionPasajeros()) < $this->getCantidadMaxima()) {
            $respuesta = true;
        } else {
            $respuesta = false;
        }
        return $respuesta;
    }

    // ------------ funcion para eliminar un pasajero ------------//

    public function eliminarPasajero($posicion)
    {
        $coleccion = $this->getColeccionPasajeros();

        unset($coleccion[$posicion]);

        $this->setColeccionPasajeros($coleccion);
    }

    // ------------ funcion para ordenar el arreglo de pasajeros ------------//

    public function ordenarArreglo()
    {

        $coleccion = $this->getColeccionPasajeros();

        $coleccion = array_values($coleccion);

        $this->setColeccionPasajeros($coleccion);
    }

    // ------------ funcion para buscar pasajero ------------//

    public function buscarPasajero($ticket)
    {

        $corte = false;
        $posicion = 0;
        $index = null;

        if (count($this->getColeccionPasajeros()) > 0) {

            $collecion = $this->getColeccionPasajeros();

            while (!$corte && ($posicion < count($this->coleccionPasajeros))) {

                $pasajero = $collecion[$posicion];

                if ($pasajero->getTicket() == $ticket) {
                    $corte = true;
                    $index = $posicion;
                }
                $posicion++;
            }
        }

        return $index;

    }

    // ------------ funcion para vender pasaje ------------//

    public function venderPasaje($pasajero)
    {
        $costo=null;

        if ($this->hayPasajesDisponible()) {

            $this->añadirPasajero($pasajero);
            
            //Se divide el porcentaje en 100 para hacer los calculos 

            $costo=700;
            $incremento=700*($pasajero->darPorcentajeIncremento/100) ;
            $costo=700+$incremento;

            //Se añade el valor del pasaje al monto actual del viaje
            $montoActual=$this->getMontoActual();
            $montoActual=$montoActual+$costo;
            $this->setMontoActual($montoActual);

        }

        return $costo;
    }
}

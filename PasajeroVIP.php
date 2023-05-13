<?php

require_once "Pasajero.php";
require_once "PasajerosEspeciales.php";

class PasajeroVIP extends Pasajero
{



    private $viajeroRecurente;
    private $cantidadMillas;

    public function __construct($nombre, $numeroAsiento, $ticket, $viajeroRecurente, $cantidadMillas)
    {

        parent::__construct($nombre, $numeroAsiento, $ticket);

        $this->viajeroRecurente = $viajeroRecurente;
        $this->cantidadMillas = $cantidadMillas;
    }


    public function setViajeroRecurente($valor)
    {
        $this->viajeroRecurente = $valor;
    }
    public function getViajeroRecurente()
    {
        return $this->viajeroRecurente;
    }

    public function setCantidadMillas($valor)
    {
        $this->cantidadMillas = $valor;
    }
    public function getCantidadMillas()
    {
        return $this->cantidadMillas;
    }

    public function darPorcentajeIncremento()
    {
        
        $porcentaje=parent::darPorcentajeIncremento();

        if ( $this->getCantidadMillas() > 300 ){

            $porcentaje=30;

        }else{
            
            $porcentaje=35;
        }

        return $porcentaje;
    }



    public function __toString()
    {

        $mensaje = parent:: __toString();


        $mensaje.= "================ VIP ================ \n";
        $mensaje.= "Viajero recurrente: " .$this->getViajeroRecurente(). "\n";
        $mensaje.= "Cantidad de millas: " .$this->getCantidadMillas(). "\n";
        $mensaje.= "======================================= \n";

        return $mensaje;
     }
}

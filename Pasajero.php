<?php


class Pasajero
{



    private $nombre;
    private $numeroAsiento;
    private $ticket;


    public function __construct($nombre, $numeroAsiento, $ticket)
    {

        $this->nombre = $nombre;
        $this->numeroAsiento = $numeroAsiento;
        $this->ticket = $ticket;
    }


    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNumeroAsiento($numero)
    {
        $this->numeroAsiento = $numero;
    }
    public function getNumeroAsiento()
    {
        return $this->numeroAsiento;
    }

    public function setTicket($valor)
    {
        $this->ticket = $valor;
    }
    public function getTicket()
    {
        return $this->ticket;
    }


    public function darPorcentajeIncremento(){

        $porcentaje=10;
        
        return $porcentaje;

    }



    public function __toString()
    {
        $mensaje= "========== Informacion basica ==========\n";
        $mensaje.= "Nombre: " .$this->getNombre(). "\n";
        $mensaje.= "Numero de asiento: " .$this->getNumeroAsiento(). "\n";
        $mensaje.= "Numero Ticket: " .$this->getTicket(). "\n";
        $mensaje.= "======================================= \n";

        return $mensaje;
    }





}

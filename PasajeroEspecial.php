<?php



require_once "Pasajero.php";
require_once "PasajeroVIP.php";



class PasajeroEspecial extends Pasajero
{



    private $sillaDeRuedas;
    private $comidaEspecial;
    private $asistencia;





    public function __construct($nombre, $numeroAsiento, $ticket, $sillaDeRuedas, $comidaEspecial, $asistencia)
    {

        parent::__construct($nombre, $numeroAsiento, $ticket);

        $this->sillaDeRuedas=$sillaDeRuedas;
        $this->comidaEspecial=$comidaEspecial;
        $this->asistencia=$asistencia;
    }





    public function setSillaDeRuedas($valor){
        $this->sillaDeRuedas=$valor;
    }
    public function getSillaDeRuedas(){
        return $this->sillaDeRuedas;
    }

    public function setComidaEspecial($valor){
        $this->comidaEspecial=$valor;
    }
    public function getComidaEspecial(){
        return $this->comidaEspecial;
    }

    public function setAsistencia($valor){
        $this->asistencia=$valor;
    }
    public function getAsistencia(){
        return $this->asistencia;
    }

    public function darPorcentajeIncremento(){

        $porcentaje=0;

        if($this->getSillaDeRuedas() and $this->getComidaEspecial() and $this->getAsistencia()){

            $porcentaje=30;

        }else{
            
        if ($this->getSillaDeRuedas()){

            $porcentaje=15;

        }elseif($this->getComidaEspecial()){

            $porcentaje=15;

        }elseif($this->getAsistencia()){

            $porcentaje=15;
        }

        }

        return $porcentaje;

    }



    public function __toString()
    {

        $mensaje = parent:: __toString();

        $mensaje.= "============== ESPECIAL ============== \n";
        
        $mensaje.= "Silla de ruedas: ". ($this->getSillaDeRuedas()? "Si":"No"). "\n"; 

        $mensaje.= "Comida especial: " ($this->getComidaEspecial()?"Si":"No"). "\n";

        $mensaje.= "Asistencia:".   ($this->getAsistencia()?"Si":"No"). "\n" ;
       
        $mensaje.= "====================================== \n";

        return $mensaje;
    }
}

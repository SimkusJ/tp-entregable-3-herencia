<?php


class ResponsableV {


    // seccion de atributos o instancias 
    private $numEmpleado;
    private $numLicencia;
    private $nombre;
    private $apellido;



    // seccion del constructor 
    public function __construct($numEmpleado, $numLicencia, $nombre, $apellido)
    {
        $this->numEmpleado=$numEmpleado;
        $this->numLicencia=$numLicencia;
        $this->nombre=$nombre;
        $this->apellido=$apellido;
        
    } 

    //seccion de los metodos o comportamientos 

    //Numero de empleado
    public function setNumEmpleado ($numero){
        $this->numEmpleado=$numero;
    }
    public function getNumEmpleado (){
        return $this->numEmpleado;
    }

    //Numero de licencia
    public function setNumLicencia ($num){
        $this->numLicencia=$num;
    }
    public function getNumLicencia () {
        return $this->numLicencia;
    }

    //Nombre del empleado
    public function setNombre ($nombre){
        $this->nombre=$nombre;
    }
    public function getNombre () {
        return $this->nombre;
    }

    //Apellido del empleado
    public function setApellido ($apellido){
        $this->apellido=$apellido;
    }
    public function getApellido () {
        return $this->apellido;
    }

    // toostring
    public function __toString()
    {
        $mensaje= "========== Responsable del viaje ========== \n";
        $mensaje.="---------- Datos ---------- \n";
        $mensaje.="Nombre: " .$this->getNombre(). "\n";
        $mensaje.="Apellido: " .$this->getApellido(). "\n";
        $mensaje.="Numero de empleado: " .$this->getNumEmpleado(). "\n";
        $mensaje.="Numero de licencia: " .$this->getNumLicencia(). "\n";
        $mensaje.="--------------------------- \n";
        $mensaje.="=========================================== \n";

        return $mensaje;

    
    }

}
<?php

require "Viaje.php";
require "ResponsableV.php";
require "Pasajero.php";
require "PasajeroEspecial.php";
require "PasajeroVIP.php";




//Aqui voy a provar el codigo de las clases :3



function cargarDatosViaje($viaje)
{


    echo "Ingrese su destino \n";
    $destinoV = trim(fgets(STDIN));

    echo "Ingrese la cantidad maxima de personas para este viaje \n";
    $cantidadMaxima = trim(fgets(STDIN));
    while (!ctype_alnum($cantidadMaxima) or $cantidadMaxima >= 50) {
        echo "Valor ingresado no valido! vuelva a intentarlo! \n";
        $cantidadMaxima = trim(fgets(STDIN));
    }

    echo "Ingrese el codigo del viaje \n";
    $codigoDeViaje = trim(fgets(STDIN));

    $viaje->setmaxPasajeros($cantidadMaxima);
    $viaje->setCodigoViaje($codigoDeViaje);
    $viaje->setDestino($destinoV);
}



function AñadirResponsable($viaje)
{

    $responsable = $viaje->getResponsable();
    echo "==== Ingrese los datos de la persona responsable ==== \n
    ==== Ingrese Nombre ==== \n";
    $responsable->setNombre(trim(fgets(STDIN)));
    echo "==== Ingrese apellido ==== \n";
    $responsable->setApellido(trim(fgets(STDIN)));
    echo "==== Ingrese numero de empleado ==== \n";
    $responsable->setNumEmpleado(trim(fgets(STDIN)));
    echo "==== Ingrese el numero de licencia ==== \n";
    $responsable->setNumLicencia(trim(fgets(STDIN)));

    echo "== Se añadieron o remplazaron los datos del responsable == \n";
}

function datosBasicos()
{

    echo "==== Ingrese el nombre ==== \n";
    $nombre = trim(fgets(STDIN));
    echo "==== Ingrese el numero de asiento ==== \n";
    $numeroAsiento = trim(fgets(STDIN));

    $ticket = getrandmax();
    $pasajero = new Pasajero($nombre, $numeroAsiento, $ticket);

    return $pasajero;
}

function añadirPasajero($viaje)
{

    if ($viaje->hayPasajesDisponible()) {

        $pasajero = datosBasicos();

        $comprobacion = $viaje->buscarPasajero($pasajero->getNombre());

        if ($comprobacion === null) {

            $costo = $viaje->venderPasaje($pasajero);
        } else {
            echo "==== Los datos ingresados coinciden con un pasajero existente ==== \n";
        }
    } else {

        echo "==== No quedan mas asientos para el viaje ==== \n";
    }

    if ($costo === null) {
        echo "No se pudo vender el pasaje \n";
    } else {
        echo "Se realizo la venta con exito! \n";
        echo "Costo del pasaje: " . $costo;
    }
}


function añadirPasajeroEspecial($viaje)
{

    if ($viaje->hayPasajesDisponible()) {




        $datosBasicos = datosBasicos();

        echo "==== Requiere una silla de ruedas? ==== \n";
        $respuesta = trim(fgets(STDIN));

        if ($respuesta == "si" or "SI" or "Si" or "sI") {
            $sillaDeRuedas = true;
        } else {
            $sillaDeRuedas = false;
        }

        echo "==== Requiere comida especial? ==== \n";
        $respuesta = trim(fgets(STDIN));

        if ($respuesta == "si" or "SI" or "Si" or "sI") {
            $comidaEspecial = true;
        } else {
            $comidaEspecial = false;
        }

        echo "==== Requiere Asistencia? ==== \n";
        $respuesta = trim(fgets(STDIN));

        if ($respuesta == "si" or "SI" or "Si" or "sI") {
            $asistencia = true;
        } else {
            $asistencia = false;
        }

        $pasajero = new PasajeroEspecial($datosBasicos->getNombre(), $datosBasicos->getNumeroAsiento(), $datosBasicos->getTicket(), $sillaDeRuedas, $comidaEspecial, $asistencia);

        $comprobacion = $viaje->buscarPasajero($pasajero->getNombre());

        if ($comprobacion === null) {

            $costo = $viaje->venderPasaje($pasajero);
        } else {
            echo "==== Los datos ingresados coinciden con un pasajero existente ==== \n";
        }
    } else {

        echo "==== No quedan mas asientos para el viaje ==== \n";
    }


    if ($costo === null) {
        echo "No se pudo vender el pasaje \n";
    } else {
        echo "Se realizo la venta con exito! \n";
        echo "Costo del pasaje: " . $costo;
    }
}



function añadirPasajeroVIP($viaje)
{

    if ($viaje->hayPasajesDisponible()) {



        $datosBasicos = datosBasicos();

        echo "==== Es un viajero recurrente? ==== \n";
        $respuesta = trim(fgets(STDIN));

        if ($respuesta == "si" or "SI" or "Si" or "sI") {
            $viajeroRecurente = true;
        } else {
            $viajeroRecurente = false;
        }

        echo " ==== Ingrese la cantidad de millas ====  \n";
        $cantidadMillas = trim(fgets(STDIN));


        $pasajero = new PasajeroVIP($datosBasicos->getNombre(), $datosBasicos->getNumeroAsiento(), $datosBasicos->getTicket(), $viajeroRecurente, $cantidadMillas);

        $comprobacion = $viaje->buscarPasajero($pasajero->getNombre());

        if ($comprobacion === null) {

            $costo = $viaje->venderPasaje($pasajero);
        } else {
            echo "==== Los datos ingresados coinciden con un pasajero existente ==== \n";
        }
    } else {

        echo "==== No quedan mas asientos para el viaje ==== \n";
    }


    if ($costo === null) {
        echo "No se pudo vender el pasaje \n";
    } else {
        echo "Se realizo la venta con exito! \n";
        echo "Costo del pasaje: " . $costo;
    }
}


function quitarPasajero($viaje)
{

    echo "Ingrese el ticket del pasajero \n";
    $ticket = trim(fgets(STDIN));

    $posicion = $viaje->buscarPasajero($ticket);

    if ($posicion !== null) {

        $viaje->eliminarPasajero($posicion);
        $viaje->ordenarArreglo();
    } else {
        echo "== No hay datos relacionados con el Ticket == \n";
    }
}



function menu()
{


    // menu del programa

    $viaje = new Viaje(new ResponsableV(00, 000, "nombrex", "apellidox"), new Pasajero("x", "n", 00, 000), 50, "sin Destino", 0001);

    echo "\n 
    Bienvenido al menu del viaje! \n";


    do {
        echo "\n 
        1.Ingresar datos del viaje \n
        2.Ingresar datos del empleado responsable\n
        3.Añadir un pasajero \n
        4.Modificar datos de pasajero \n
        5.Eliminar pasajero \n
        6.Mostrar datos del viaje \n
        7.Salir \n";

        $opcion = trim(fgets(STDIN));

        switch ($opcion) {

            case 1:

                cargarDatosViaje($viaje);
                break;

            case 2:

                AñadirResponsable($viaje);
                break;

            case 3:

                echo "¿Que tipo de pasajero desea añadir? \n
                  1. Pasajero estandar. \n
                    2. Pasajero Especial. \n
                      3.Pasajero VIP. \n";
                $tipo = trim(fgets(STDIN));

                do {
                    switch ($tipo) {
                        case 1:
                            añadirPasajero($viaje);
                            break;
                        case 2:
                            añadirPasajeroEspecial($viaje);
                            break;
                        case 3:
                            añadirPasajeroVIP($viaje);
                            break;
                        case 4:
                            echo "=== Saliendo de seleccion === \n";
                            break;
                        default:
                            echo "=== Valor erroneo vuelva a intentarlo ===";
                            break;
                    }
                } while ($tipo != 4);

            case 4:

                echo "=== No se encuentra disponible ===";


            case 5:

                quitarPasajero($viaje);
                break;

            case 6:

                echo $viaje;
                break;

            case 7:

                echo "\n Nos vemos en el proximo viaje! \n";
                break;
        }
    } while ($opcion != 7);
}

menu();

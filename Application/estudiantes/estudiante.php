<?php

    class Estudiante{

        public $Id;
        public $Nombre;
        public $Apellido;
        public $Carrera;
        public $Status;

        public function __construct($id, $nombre, $apellido, $carrera, $status)
        {

            $this->Id = $id;
            $this->Nombre = $nombre;
            $this->Apellido = $apellido;
            $this->Carrera = $carrera;
            $this->Status = $status;

            
        }

    }

?>
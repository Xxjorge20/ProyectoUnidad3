<?php
    include_once(__DIR__ . '/validacionDatos.php');
    class Patrimonio {


        private const SIGLAS_HERMANDAD = "HGPS";
       

        /* Atributos de la clase */ 
        private string $patrimonioID;
        private String $nombre;
        private String $descripcion;
        private DateTime $fechaAdquisicion;
        private array $fotos = array();
        private String $ubicacion;

        // Constructor de la clase Patrimonio
        public function __construct(?String $id,String $nombre, String $descripcion, DateTime $fechaAdquisicion, array $fotos, String $ubicacion){
           
            if($id !== null){
                $this->patrimonioID = $id;
            }else{
                $this->patrimonioID = $this->generarID();
            }

            ValidarDatos::validarCadenaCaracteres($nombre);
            ValidarDatos::validarCadenaLongitud($nombre);
            $this->nombre = $nombre;

            ValidarDatos::validarCadenaLongitud($descripcion);
            $this->descripcion = $descripcion;

            ValidarDatos::validarFecha($fechaAdquisicion);
            $this->fechaAdquisicion = $fechaAdquisicion;

            $this->fotos = $fotos;

            ValidarDatos::validarCadenaLongitud($ubicacion);
            ValidarDatos::validarCadenaCaracteres($ubicacion);
            $this->ubicacion = $ubicacion;

        }

        

        /* Setter y getter */

        public function getIdPatrimonio() : String{
            return $this->patrimonioID;
        }


        public function setNombre(String $nombre){
            ValidarDatos::validarCadenaLongitud($nombre);
            ValidarDatos::validarCadenaCaracteres($nombre);
            $this->nombre = $nombre;
        }

        public function getNombre() : String{
            return $this->nombre;
        }

        public function setDescripcion(String $descripcion){

            ValidarDatos::validarCadenaLongitud($descripcion);
            ValidarDatos::validarCadenaCaracteres($descripcion);
            $this->descripcion = $descripcion;
        }

        public function getDescripcion() : String{
            return $this->descripcion;
        }

        public function setFechaAdquisicion(DateTime $fechaAdquisicion){
            ValidarDatos::validarFecha($fechaAdquisicion);
            $this->fechaAdquisicion = $fechaAdquisicion;
        }

        public function getFechaAdquisicion() : DateTime{
            return $this->fechaAdquisicion;
        }

        public function setFotos(array $fotos){ // Cambio aquí
            $this->fotos = $fotos;
        }
    
        public function getFotos() : array { // Cambio aquí
            return $this->fotos;
        }

        public function setUbicacion(String $ubicacion){
            ValidarDatos::validarCadenaLongitud($ubicacion);
            ValidarDatos::validarCadenaCaracteres($ubicacion);
            $this->ubicacion = $ubicacion;
        }

        public function getUbicacion() : String{
            return $this->ubicacion;
        }


        /* Metodos de la clase */

        private function generarID() : String{
           $random = random_int(0, 1000000);
            $id = uniqid(self::SIGLAS_HERMANDAD ."-". $random, true);
            return $id;
        }

        public function __toString() : string{
            return "ID: " . $this->patrimonioID . "<br>".
                " Nombre: " . $this->nombre . "<br>" .
                " Descripcion: " . $this->descripcion . "<br>" .
                " Fecha de adquisicion: " . $this->fechaAdquisicion->format('Y-m-d') . "<br>" . // Formatear la fecha
                " Fotos: " . implode(', ', $this->fotos) . "<br>" .  // Convertir el array de fotos a una cadena
                " Ubicacion: " . $this->ubicacion . "<br>";
        }
    }



?>
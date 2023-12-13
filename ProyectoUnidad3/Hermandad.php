<?php
    include_once 'Hermanos.php';

    class Hermandad {
        // Miembros privados de la clase 
        private int $id;
        private string $nombre;
        private DateTime $fechaFundacion;
        private string $ubicacionSede;
        private string $numeroCuenta;
        private array $hermano;
        private array $patrimonio;

        // Constructor
        public function __construct(string $nombre, DateTime $fechaFundacion, string $ubicacionSede, string $numeroCuenta) {
            $this->nombre = $nombre;
            $this->fechaFundacion = $fechaFundacion;
            $this->ubicacionSede = $ubicacionSede;
            $this->numeroCuenta = $numeroCuenta;
            $this->id = 0;
            $this->hermano = [];
            $this->patrimonio = [];
        }

        // Propiedad asociada al miembro privado $id
        public function getId(): string {
            return $this->id = random_int(0, 1000000);
        }

        // Propiedades asociadas al miembro privado $nombre
        public function getNombre(): string {
            return $this->nombre;
        }
        public function setNombre(string $nombre): void {
            $this->nombre = $nombre;
        }

        // Propiedades asociadas al miembro privado $fechaFundacion
        public function getFechaFundacion(): DateTime {
            return $this->fechaFundacion;
        }
        public function setFechaFundacion(DateTime $fechaFundacion): void {
            $this->fechaFundacion = $fechaFundacion;
        }

        // Propiedades asociadas al miembro privado $ubicacionSede
        public function getUbicacionSede(): string {
            return $this->ubicacionSede;
        }
        public function setUbicacionSede(string $ubicacionSede): void {
            $this->ubicacionSede = $ubicacionSede;
        }

        // Propiedades asociadas al miembro privado $numeroCuenta
        public function getNumeroCuenta(): string {
            return $this->numeroCuenta;
        }
        public function setNumeroCuenta(string $numeroCuenta): void {
            $this->numeroCuenta = $numeroCuenta;
        }

        /*
        Funcion que comprueba si el objeto Hermanos h se ha pasado como parámetro, existe en el array hermano
        Un objeto ya existe si tiene el mismo dni y son de la misma clase
        Recibe: el objeto que quiere comprobar Hermanos h
        Devuelve true si existe, false si no existe
        */
        private function hayHermano(Hermanos $h): bool {
            $resultado = false;

            foreach($this->hermano as $key => $value) {
                if ($key === $h->getDni() && get_class($value) === get_class($h)){
                    $resultado = true;
                    break;
                }
            }
            return $resultado;
        }

        /*
        funcion addHermano: añade o modifica un elemento del array
        Recibe: el objeto que quiere añadir o modicar, una variable boolen: $modifica = true cuando quiere modificar , $modifica = false cuando quiere añadir
        Devuelve false si no ha podido añadir o modificar
        Devuelve true si ha podido añadir o modificar
        */
        public function addHermano(Hermanos $h, bool $modifica): bool {
            if(isset($h) && ($h instanceof Hermanos)){
                if ($this->hayHermano($h) && !$modifica){
                    return false;
                }
                elseif (!$this->hayHermano($h) && $modifica){
                    return false;
                }
                else { 
                    $this->hermano[$h->getDni()] = $h; 
                    return true;
                }
            }
            else {
                return false;
            }
        }

        /*
        Funcion que elimina un dato en el array de Hermanos si existe
        Recibe: el objeto de Hermanos h que quiero eliminar 
        Devuelve: true si se ha eliminado correctamente. False si no se ha podido eliminar
        */
        public function deleteHermano(Hermanos $h): bool {
            if(isset($h) && ($h instanceof Hermanos)){
                if ($this->hayHermano($h)){
                    unset($this->hermano[$h->getDni()]); 
                    return true;
                }
            }
            return false;
        }

        /*
        Funcion para obtener los hermanos se pueden obtener por dni, nombre y apellidos dependiendo del que se introduzca asi busca (sobrecarga)
        Recibe: una string
        Devuelve: un objeto de la clase hermnanos
        */
        public function obtenerHermano(string $dni = null, string $nombre = null, string $apellidos = null): ?Hermanos {
            $hermanosEncontrados = null;

            if ($dni !== null) {
                // Buscar solo por DNI
                foreach ($this->hermano as $hermano) {
                    if ($hermano->getDni() === $dni) {
                        $hermanosEncontrados = $hermano;
                    }
                }
            } elseif ($nombre !== null && $apellidos !== null) {
                // Buscar solo por nombre y apellidos
                foreach ($this->hermano as $hermano) {
                    if ($hermano->getNombre() === $nombre && $hermano->getApellidos() === $apellidos) {
                        $hermanosEncontrados = $hermano;
                    }
                }
            }

            return $hermanosEncontrados;
        }

        /*
        Funcion para mostrar todos los hermanos que hay registrados
        Recibe: nada
        Devuelve: un array de hermanos
        */
        public function mostrarHermanos(): array {
            $hermanos = [];
            foreach ($this->hermano as $valor) {
                $hermanos[] = $valor;
            }
            return $hermanos;
        }
        

        /*
        funcion que comprueba si el objeto Patrimonio p se ha pasado como parámetro, existe en el array patrimonio
        Un objeto ya existe si tiene el mismo dni y son de la misma clase
        Recibe: el objeto que quiere comprobar Patrimonio p
        Devuelve: true si existe, false si no existe
        */
        private function hayPatrimonio(Patrimonio $p): bool{
            $resultado = false;

            foreach($this->patrimonio as $key => $value) {
                if ($key === $p->getIdPatrimonio() && get_class($value) === get_class($p)){
                    $resultado = true;
                    break;
                }
            }
            return $resultado;
        }

        /*
        Funcion addPatrimonio: añade o modifica un elemento del array
        Recibe: el objeto que quiere añadir o modicar, una variable boolen: $modifica = true cuando quiere modificar , $modifica = false cuando quiere añadir
        Devuelve: false si no ha podido añadir o modificar
        Devuelve: true si ha podido añadir o modificar
        */
        public function addPatrimonio(Patrimonio $p, bool $modifica): bool {
            if(isset($p) && ($p instanceof Patrimonio)){
                if ($this->hayPatrimonio($p) && !$modifica){
                    return false;
                }
                elseif (!$this->hayPatrimonio($p) && $modifica){
                    return false;
                }
                else { 
                    $this->patrimonio[$p->getIdPatrimonio()] = $p; 
                    return true;
                }
            }
            else {
                return false;
            }
        }

        /*
        Funcion que elimina un dato en el array de patrimonio si existe
        Recibe: el objeto de patrimonio p que quiero eliminar 
        Devuelve: true si se ha eliminado correctamente. False si no se ha podido eliminar
        */
        public function deletePatrimonio(Patrimonio $p): bool {
            if(isset($p) && ($p instanceof Patrimonio)){
                
                if ($this->hayPatrimonio($p)){
                    unset($this->patrimonio[$p->getIdPatrimonio()]);
                    return true;
                }
            }
            return false;
        }

        /*
        Funcion que obtiene un patrimonio Inmueble por su id
        Recibe: la id del patrmonio que se quiere obtener (inmueble)
        Devuelve: un objeto de la clase Inmueble
        */
        public function obtenerPatrimonioInmueble(string $id): ?Inmueble {
            $result = null;
        
            foreach ($this->patrimonio as $value) {
                if ($value->getIdPatrimonio() === $id) {
                    $result = $value;
                    break; 
                }
            }
        
            return $result;
        }

        /*
        Funcion que obtiene un patrimonio Mueble por su id
        Recibe: la id del patrmonio que se quiere obtener (mueble)
        Devuelve: un objeto de la clase Mueble
        */
        public function obtenerPatrimonioMueble(string $id): ?Mueble {
            $result = null;

            foreach ($this->patrimonio as $value) {
                if ($value->getIdPatrimonio() === $id) {
                    $result = $value;
                    break; 
                }
            }

            return $result;
        }

        /*
        Funcion para mostrar todos los patrimonios que hay registrados
        Recibe: nada
        Devuelve: un array de patrimonio
        */
        public function mostrarPatrimonio(): array {
            $patrimonios = [];
            foreach ($this->patrimonio as $clave => $valor) {
                $patrimonios[] = $valor;
            }
            return $patrimonios;
        }
        

        /*
        Funcion para mostrar los datos de la hermandad
        Recibe: nada 
        Devuelve: una string. Con la información
        */
        public function __toString (): string {
            $result = "<br>Fecha Fundacion: ".$this->fechaFundacion->format('Y-m-d').
            "<br>Ubicacion de la Sede: ".$this->ubicacionSede."<br>".
            "Numero de Hermanos: ".count($this->hermano)."<br>";

            return $result;
        }
    }
?>
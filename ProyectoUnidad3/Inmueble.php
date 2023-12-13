<?php
    include_once(__DIR__ . '/validacionDatos.php');
    enum TipoInmueble : String {
        case CASA = 'Casa';
        case CASA_HERMANDAD = 'Casa Hermandad';
        case MUSEO = 'Museo';
        case IGLESIA = 'Iglesia';
        case CAPILLA = 'Capilla';
        case OTRO = 'Otro';
    }


    class Inmueble extends Patrimonio {

        // Atributos de la clase
        private TipoInmueble $tipoInmueble;
        private string $valorCultural;
        private string $reconocimientos;
        private string $uso;

        // Constructor de la clase
        public function __construct(?string $id, String $nombre, String $descripcion, DateTime $fechaAdquisicion, array $fotos, String $ubicacion, TipoInmueble $tipoInmueble, string $valorCultural, string $reconocimientos, string $uso){
            parent::__construct($id,$nombre, $descripcion, $fechaAdquisicion, $fotos, $ubicacion);
            $this->tipoInmueble = $tipoInmueble;

            ValidarDatos::validarCadenaLongitud($valorCultural);
            ValidarDatos::validarCadenaCaracteres($valorCultural);
            $this->valorCultural = $valorCultural;

            ValidarDatos::validarCadenaLongitud($reconocimientos);
            $this->reconocimientos = $reconocimientos;

            ValidarDatos::validarCadenaLongitud($uso);
            $this->uso = $uso;
            
        }

        // Setter y getter

        public function setTipoInmueble(TipoInmueble $tipoInmueble){
            $this->tipoInmueble = $tipoInmueble;
        }

        public function getTipoInmueble() : TipoInmueble{
            return $this->tipoInmueble;
        }


        public function setValorCultural(string $valorCultural){
            ValidarDatos::validarCadenaLongitud($valorCultural);
            ValidarDatos::validarCadenaCaracteres($valorCultural);
            $this->valorCultural = $valorCultural;
        }

        public function getValorCultural() : string{
            return $this->valorCultural;
        }

        public function setReconocimientos(string $reconocimientos){
            ValidarDatos::validarCadenaLongitud($reconocimientos);
            $this->reconocimientos = $reconocimientos;
        }

        public function getReconocimientos() : string{
            return $this->reconocimientos;
        }

        public function setUso(string $uso){
            ValidarDatos::validarCadenaLongitud($uso);
            $this->uso = $uso;
        }

        public function getUso() : string{
            return $this->uso;
        }

        
        public function __toString() : string {
            return parent::__toString() . 
                "Tipo de inmueble: " . $this->getTipoInmueble()->value . "<br>".
                "\n" . "Valor cultural: " . $this->valorCultural . "<br>".
                "\n" . "Reconocimientos: " . $this->reconocimientos . "<br>".
                "\n" . "Uso: " . $this->uso . "<br>";
        }
        

    }


?>
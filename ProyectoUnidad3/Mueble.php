<?php
    include_once(__DIR__ . '/validacionDatos.php');
    enum TipoMueble : string{
        case escultura = 'Escultura';
        case pintura = 'Pintura';
        case orfebreria = 'Orfebrería';
        case mobiliario = 'Mobiliario';
        case otro = 'Otro';
    }



    class Mueble extends Patrimonio{

        // Atributos de la clase
        private TipoMueble $tipoMueble;
        private string $estado;
        private float $valor;
        private string $historia;
        private string $autor;

        // Constructor de la clase
        public function __construct(?String $id,String $nombre, String $descripcion, DateTime $fechaAdquisicion, array $fotos, String $ubicacion, TipoMueble $tipoMueble, string $estado, float $valor, string $historia, string $autor){
            parent::__construct($id,$nombre, $descripcion, $fechaAdquisicion, $fotos, $ubicacion);
            $this->tipoMueble = $tipoMueble;

            ValidarDatos::validarCadenaLongitud($estado);
            ValidarDatos::validarCadenaCaracteres($estado);
            $this->estado = $estado;

            ValidarDatos::validarFloat($valor);
            $this->valor = $valor;

            ValidarDatos::validarCadenaLongitud($historia);
            $this->historia = $historia;

            ValidarDatos::validarCadenaLongitud($autor);
            ValidarDatos::validarCadenaCaracteres($autor);
            $this->autor = $autor;
            
        }
        

        

        // Setter y getter

        public function setTipoMueble(TipoMueble $tipoMueble){
            $this->tipoMueble = $tipoMueble;
        }

        public function getTipoMueble() : TipoMueble{
            return $this->tipoMueble;
        }

        public function setEstado(string $estado){
            ValidarDatos::validarCadenaLongitud($estado);
            ValidarDatos::validarCadenaCaracteres($estado);
            $this->estado = $estado;
        }

        public function getEstado() : string{
            return $this->estado;
        }

        public function setValor(float $valor){
            ValidarDatos::validarFloat($valor);
            $this->valor = $valor;
        }

        public function getValor() : float{
            return $this->valor;
        }

        public function setHistoria(string $historia){
            ValidarDatos::validarCadenaLongitud($historia);
            $this->historia = $historia;
        }

        public function getHistoria() : string{
            return $this->historia;
        }

        public function setAutor(string $autor){
            ValidarDatos::validarCadenaLongitud($autor);
            ValidarDatos::validarCadenaCaracteres($autor);
            $this->autor = $autor;
        }

        public function getAutor() : string{
            return $this->autor;
        }

        public function __toString() : string{
            return parent::__toString().    
                " Tipo de mueble: " . $this->getTipoMueble()->value . "<br>".
                " Estado: " . $this->estado . "<br>".
                " Valor: " . $this->valor . "<br>".
                " Historia: " . $this->historia ."<br>".
                " Autor: " . $this->autor . "\n" ."<br>";
        }
        
    }


?>
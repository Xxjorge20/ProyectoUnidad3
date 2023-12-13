<?php
    include_once 'IHermanos.php';

    class Hermanos implements IHermanos{
        // Constante para las siglas que va a llevar el codigo 
        private const SIGLAS_HERMANDAD = "HGPS";

        // Miembros privados de la clase 
        private string $dni;
        private string $nombre;
        private string $apellidos;
        private int $edad;
        private DateTime $dadoAlta;
        private string $domicilio;
        private string $correo;
        private int $telefono;
        private string $codigo;
        private float $cuota;

        // Constructor 
        public function __construct(string $dni, string $nombre, string $apellidos, int $edad, DateTime $dadoAlta, string $domicilio, string $correo, int $telefono) {
            $this->dni = $this->validarDni($dni);
            $this->nombre = $this->validarCadena($nombre);
            $this->apellidos = $this->validarCadena($apellidos);
            $this->edad = $this->validarEdad($edad);
            $this->dadoAlta = $this->validarFecha($dadoAlta);
            $this->domicilio = $this->validarDomicilio($domicilio);
            $this->correo = $this->validarCorreo($correo);
            $this->telefono = $this->validarTelefono($telefono);
            $this->codigo = $this->generarCodigo();
            $this->cuota = 0.00;
        }

        // Propiedad asociada al miembro privado $dni
        public function getDni(): string {
            return $this->dni;
        }
        public function setDni(string $dni): void {
            $this->dni = $dni;
        }

        // Propiedad asociada al miembro privado $nombre
        public function getNombre(): string {
            return $this->nombre;
        }
        public function setNombre(string $nombre): void {
            $this->nombre = $nombre;
        }

        // Propiedad asociada al miembro privado $apellidos
        public function getApellidos(): string {
            return $this->apellidos;
        }
        public function setApellidos(string $apellidos): void {
            $this->apellidos = $apellidos;
        }

        // Propiedad asociada al miembro privado $edad
        public function getEdad(): int {
            return $this->edad;
        }
        public function setEdad(int $edad): void {
            $this->edad = $edad;
        }

        // Propiedad asociada al miembro privado $dadoalta
        public function getDadoAlta(): DateTime {
            return $this->dadoAlta;
        }
        public function setDadoAlta(DateTime $dadoAlta): void {
            $this->dadoAlta = $dadoAlta;
        }

        // Propiedad asociada al miembro privado $domicilio
        public function getDomicilio(): string {
            return $this->domicilio;
        }
        public function setDomicilio(string $domiilio): void {
            $this->domicilio = $domicilio;
        }

        // Propiedad asociada al miembro privado $correo
        public function getCorreo(): string {
            return $this->correo;
        }
        public function setCorreo(string $correo): void {
            $this->correo = $correo;
        }

        // Propiedad asociada al miembro privado $telefono
        public function getTelefono(): int {
            return $this->telefono;
        }
        public function setTelefono(int $telefono): void {
            $this->telefono = $telefono;
        }

        // Propiedad asociadas al miembro $codigo
        public function getCodigo(): string{
            return $this->codigo;
        }

        // Propiedad asociadas al miembro $cuota
        public function getCuota(): float{
            return $this->cuota;
        }

        /*
        Funcion para generar un codigo interno para el hermano 
        Recibe: nada 
        Devuelve: una string con la id
        */
        public function generarCodigo(): string{
            $numRandom = random_int(0, 1000000);
            $id = uniqid(self::SIGLAS_HERMANDAD ."-". $numRandom, true);
            return $id;
        }
        /*
        Funcion para calcular la cuota del hermano (no se implementado de momento)
        Recibe: nada 
        Devuelve: un float con la cuota calculada
        */
        public function calcularCuota(): float {

        }
        
        /*
        Funcion para mostrar los datos de los hermanos
        Recibe: nada 
        Devuelve: una string. Con la información
        */
        public function __toString (): string {
            $result = "<br><br>Dni: ".$this->dni."<br>".
            "Nombre: ".$this->nombre."<br>".
            "Apellidos: ".$this->apellidos."<br>".
            "Edad: ".$this->edad."<br>".
            "Dado de alta: ".$this->dadoAlta->format('Y-m-d')."<br>".
            "Domicilio: ".$this->domicilio."<br>".
            "Correo: ".$this->correo."<br>".
            "Telefono: ".$this->telefono."<br>";

            return $result;
        }

        /*
        Funcion para validar el dni que sea totalmente valido
        Recibe: un string que seria el dni
        Devuelve: un string con el dni validado
        */
        private function validarDni(string $dni): string {
            // Eliminar espacios en blanco al inicio y al final de la cadena
            $dni = trim($dni);
        
            if (empty($dni)) {
                throw new InvalidArgumentException("El DNI no puede estar vacío");
            }
        
            // Comprobar si tiene 9 caracteres el DNI
            if (strlen($dni) !== 9) {
                throw new InvalidArgumentException("El DNI debe tener exactamente 9 caracteres");
            } else {
                // Obtener la parte numérica del DNI
                $parteNumerica = substr($dni, 0, 8);
        
                // Obtener la letra del DNI
                $letraDni = strtoupper(substr($dni, -1));
        
                // Verificar si la parte numérica es un número
                if (!is_numeric($parteNumerica)) {
                    throw new InvalidArgumentException("La parte numérica del DNI es incorrecta");
                } else {
                    // Letras del DNI
                    $letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
        
                    // Calcular el resultado para verificar la letra
                    $resultado = $parteNumerica % 23;
        
                    // Obtener la letra correcta
                    $letraCorrecta = $letras[$resultado];
        
                    // Verificar si las letras son iguales
                    if ($letraCorrecta != $letraDni) {
                        throw new InvalidArgumentException("La letra del DNI es incorrecta");
                    }
                }
            }
        
            return $dni;
        }

        /*
        Funcion para validar la cadena que no tenga numeros ni caracteres especiales
        Recibe: un string que seria la cadena 
        Devuelve: un string con la cadena validada
        */
        private function validarCadena(string $cadena): string {
            if (strlen($cadena) > 255) {
                throw new Exception("La cadena tiene mas caracteres de los permitidos");
            }
        
            // Modificar la expresión regular según tus requisitos
            if (!preg_match("/^[a-zA-ZáéíóúüñÑ\s]*$/u", $cadena)) {
                throw new Exception("La cadena no puede contener números ni caracteres especiales");
            }
        
            return $cadena;
        }
        
        /*
        Funcion para validar el domicilio que no tenga muchos caracteres
        Recibe: un string que seria el domicilio 
        Devuelve: un string con el domicilio validado
        */
        private function validarDomicilio(string $cadena): string {
            if (strlen($cadena) > 255) {
                throw new Exception("La cadena tiene mas caracteres de los permitidos");
            }
        
            return $cadena;
        }  

        /*
        Funcion para validar la edad que no sea menor a 0 ni mayor a 100 años
        Recibe: un int que seria la edad
        Devuelve: un int con la edad validada
        */
        private function validarEdad(int $edad): int {
            if ($edad < 0 || $edad > 100) {
                throw new Exception("La edad no es correcta");
            }

            return $edad;
        }

        /*
        Funcion para validar el telefono no puede tener mas caracteres de los permitidos
        Recibe: un int que seria el telefono
        Devuelve: un int con el telefono validado
        */
        private function validarTelefono(int $telefono): int {
            if (strlen($telefono) > 9) {
                throw new Exception("El telefono tiene mas de 9 caracteres");
            }

            return $telefono;
        }

        /*
        Funcion para validar una fecha que no puede ser mayor a la actual ni menor a la actual 
        Recibe: un DateTime que seria la fecha
        Devuelve: un DateTime con la fecha validada
        */
        private function validarFecha(DateTime $fecha): DateTime {
            $fechaActual = new DateTime();
            $diferencia = $fechaActual->diff($fecha);
            
            if ($diferencia->invert == 0 || $diferencia->days > 0) {
                throw new Exception("La fecha no es correcta");
            }
        
            return $fecha;
        }
        
        /*
        Funcion para validar una correo para que tenga el formato correcto
        Recibe: un string que seria el correo
        Devuelve: un string con el correo validado
        */
        private function validarCorreo(string $correo): string {
            // Eliminar espacios en blanco al inicio y al final de la cadena
            $correo = trim($correo);
        
            if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("El formato del correo electrónico es inválido");
            }
        
            list(, $dominio) = explode('@', $correo, 2);
        
            if (!preg_match("/^[a-zA-Z.-]+[a-zA-Z]$/", $dominio)) {
                throw new Exception("El formato del dominio en el correo electrónico es inválido");
            }
        
            return $correo;
        }
    }
?>
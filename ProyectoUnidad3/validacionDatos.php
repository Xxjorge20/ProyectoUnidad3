<?php

    class ValidarDatos{

        /**
         * Valida que una cadena no supere los 255 caracteres.
         *
         * @param string $cadena La cadena a validar.
         * @throws Exception Si la entrada no es una cadena o si la cadena supera los 255 caracteres.
         */
        public static function validarCadenaLongitud(string $cadena) {
            if (!is_string($cadena)) {
                throw new Exception("La entrada no es una cadena");
            }
        }

        /**
         * Valida que una cadena no contenga caracteres especiales.
         *
         * @param string $cadena La cadena a validar.
         * @throws Exception Si la cadena contiene números o caracteres especiales.
         */
        public static function validarCadenaCaracteres(string $cadena) {
            if (!preg_match("/^[a-zA-ZáéíóúüñÑ\s]*$/u", $cadena)) {
                throw new Exception("La cadena no puede contener números ni caracteres especiales, solo letras y espacios");
            }
        }
        
        /**
         * Valida que la fecha no sea mayor a la fecha actual.
         *
         * @param DateTime $fecha La fecha a validar.
         * @throws Exception Si la fecha es mayor a la fecha actual.
         */
        public static function validarFecha(DateTime $fecha) {
            $fechaActual = new DateTime();
            $diferencia = $fechaActual->diff($fecha);
            
            if ($diferencia->invert == 0) {
                throw new Exception("La fecha no puede ser mayor a la fecha actual");
            }
        }


        /**
         * Valida si el valor de una cadena es un número decimal positivo.
         *
         * @param string $cadena La cadena a validar.
         * @throws Exception Si el valor no es un número decimal o es menor a 0.
         */
        public static function validarFloat(string $cadena) {
            if (!filter_var($cadena, FILTER_VALIDATE_FLOAT)) {
                throw new Exception("El valor no es un número decimal");
            }

            $valorFloat = (float)$cadena;

            if ($valorFloat < 0) {
                throw new Exception("El valor debe ser mayor o igual a 0");
            }
        }
        
    }



?>
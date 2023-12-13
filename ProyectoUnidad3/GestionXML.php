<?php

    include_once(__DIR__ . '/Hermandad.php');
    include_once(__DIR__ . '/Patrimonio.php');
    include_once(__DIR__ . '/Mueble.php');
    include_once(__DIR__ . '/Inmueble.php');
    session_start();

    class GestionXML{
        
        /**
         * Lee el archivo XML "Patrimonio.xml" y extrae la información de los patrimonios inmateriales y materiales.
         * Crea objetos de tipo Inmueble y Mueble con los datos obtenidos y los agrega al array correspondiente.
         * Finalmente, imprime los patrimonios inmateriales y materiales en formato de texto.
         *
         * @throws DOMException Si ocurre un error al procesar el documento XML.
         * @throws Exception Si ocurre un error inesperado.
         */

        public static function leerXMLPatrimonio(){
        
            try {
                // Variables
                $patrimonioInmaterial = array();
                $patrimonioMaterial = array();
        
                // Paso 1: Crear el objeto DOMDocument y cargar el fichero XML
                $dom = new DOMDocument("1.0", "utf-8");
                $dom->load("Patrimonio.xml");
        
                // Paso 2: Obtener el elemento raíz del documento
                $raiz = $dom->documentElement;
        
                // Paso 3: Obtener la lista de nodos que tienen etiqueta "Patrimonios-Inmateriales"
                $listaPatrimonio = $raiz->getElementsByTagName("Patrimonios-Inmateriales")->item(0)->getElementsByTagName("Inmaterial");
        
    
                // Paso 4 recorrer la lista de nodos de patrimonio-Inmaterial
                foreach ($listaPatrimonio as $listaInmaterial) {
                    // Paso 5 obtener los datos de cada nodo
                    $id = $listaInmaterial->getElementsByTagName("id")->item(0)->nodeValue;
                    $nombre = $listaInmaterial->getElementsByTagName("nombre")->item(0)->nodeValue;
                    $descripcion = $listaInmaterial->getElementsByTagName("descripcion")->item(0)->nodeValue;
                    $fechaAdquisicion = $listaInmaterial->getElementsByTagName("fechaAdquisicion")->item(0)->nodeValue;
                    $fotos = $listaInmaterial->getElementsByTagName("fotos")->item(0)->nodeValue;
                    $ubicacion = $listaInmaterial->getElementsByTagName("ubicacion")->item(0)->nodeValue;
                    $tipoInmueble = $listaInmaterial->getElementsByTagName("tipoInmueble")->item(0)->nodeValue;
                    $valorCultural = $listaInmaterial->getElementsByTagName("valorCultural")->item(0)->nodeValue;
                    $reconocimientos = $listaInmaterial->getElementsByTagName("reconocimientos")->item(0)->nodeValue;
                    $uso = $listaInmaterial->getElementsByTagName("uso")->item(0)->nodeValue;
    
                    $fechaAdquisicion = new DateTime($fechaAdquisicion);
                    $fotos = explode(",", $fotos);
    
                    switch ($tipoInmueble) {
                        case 'Casa':
                            $tipoInmueble = TipoInmueble::CASA;
                            break;
                        case 'Casa Hermandad':
                            $tipoInmueble = TipoInmueble::CASA_HERMANDAD;
                            break;
                        case 'Museo':
                            $tipoInmueble = TipoInmueble::MUSEO;
                            break;
                        case 'Iglesia':
                            $tipoInmueble = TipoInmueble::IGLESIA;
                            break;
                        case 'Capilla':
                            $tipoInmueble = TipoInmueble::CAPILLA;
                            break;
                        case 'Otro':
                            $tipoInmueble = TipoInmueble::OTRO;
                            break;
                        default:
                            $tipoInmueble = TipoInmueble::OTRO;
                            break;
                    }
    
                    // Paso 6 crear el objeto Patrimonio
                    $inmaterial = new Inmueble($id, $nombre, $descripcion, $fechaAdquisicion, $fotos, $ubicacion, $tipoInmueble, $valorCultural, $reconocimientos, $uso);
    
                    // Paso 7 añadir el objeto Patrimonio al array
                    array_push($patrimonioInmaterial, $inmaterial);
    
                    // Paso 8 añadir el objeto Patrimonio al objeto Hermandad
                    $_SESSION['hermandad']->addPatrimonio($inmaterial, false);
    
       
                }
                // Paso 10: Obtener la lista de nodos que tienen etiqueta "Patrimonio-Material"
                $listaPatrimonioMaterial = $raiz->getElementsByTagName("Patrimonio-Material")->item(0)->getElementsByTagName("Material");

                // Paso 11 recorrer la lista de nodos de patrimonio-Material
                foreach ($listaPatrimonioMaterial as $listaMaterial) {
                    
                    $id = $listaMaterial->getElementsByTagName("id")->item(0)->nodeValue;
                    $nombre = $listaMaterial->getElementsByTagName("nombre")->item(0)->nodeValue;
                    $descripcion = $listaMaterial->getElementsByTagName("descripcion")->item(0)->nodeValue;
                    $fechaAdquisicion = $listaMaterial->getElementsByTagName("fechaAdquisicion")->item(0)->nodeValue;
                    $fotos = $listaMaterial->getElementsByTagName("fotos")->item(0)->nodeValue;
                    $ubicacion = $listaMaterial->getElementsByTagName("ubicacion")->item(0)->nodeValue;
                    $tipoMueble = $listaMaterial->getElementsByTagName("tipoMueble")->item(0)->nodeValue;
                    $estado = $listaMaterial->getElementsByTagName("estado")->item(0)->nodeValue;
                    $valor = $listaMaterial->getElementsByTagName("valor")->item(0)->nodeValue;
                    $historia = $listaMaterial->getElementsByTagName("historia")->item(0)->nodeValue;
                    $autor = $listaMaterial->getElementsByTagName("autor")->item(0)->nodeValue;
    
                    $fechaAdquisicion = new DateTime($fechaAdquisicion);
                    $fotos = explode(",", $fotos);
    
                    switch ($tipoMueble) {
                        case 'Escultura':
                            $tipoMueble = TipoMueble::escultura;
                            break;
                        case 'Pintura':
                            $tipoMueble = TipoMueble::pintura;
                            break;
                        case 'Orfebrería':
                            $tipoMueble = TipoMueble::orfebreria;
                            break;
                        case 'Mobiliario':
                            $tipoMueble = TipoMueble::mobiliario;
                            break;
                        case 'Otro':
                            $tipoMueble = TipoMueble::OTRO;
                            break;
                        default:
                            $tipoMueble = TipoMueble::OTRO;
                            break;
                    }
    
                   
                    $material = new Mueble($id, $nombre, $descripcion, $fechaAdquisicion, $fotos, $ubicacion, $tipoMueble, $estado, $valor, $historia, $autor);
                    array_push($patrimonioMaterial, $material);
    
                    
                    $_SESSION['hermandad']->addPatrimonio($material, false);
                    
   
                 
                }
                
                echo "<h2>Patrimonio Inmaterial</h2>";
                // Imprimir el array de patrimonio-Inmaterial
                foreach ($patrimonioInmaterial as $inmaterial) {
                    print_r($inmaterial->__toString());
                    echo "<br>";
                }

                echo "<h2>Patrimonio Material</h2>";
                // Imprimir el array de patrimonio-Material
                foreach ($patrimonioMaterial as $material) {
                    print_r($material->__toString());
                    echo "<br>";
                }

            } catch (DOMException $e) {
                echo "Error al procesar el documento XML: " . $e->getMessage();
            } catch (Exception $e) {
                echo "Error inesperado: " . $e->getMessage();
            }
        }
    
        /**
         * Método estático que se encarga de escribir un archivo XML con el patrimonio de la hermandad.
         * 
         * @throws DOMException Si ocurre un error al procesar el documento XML.
         * @throws Exception Si ocurre un error inesperado.
         */
        public static function escribirXMLPatrimonio(){
            try {

                $patrimoniObtenido = $_SESSION['hermandad']->mostrarPatrimonio();
                $arrayPatrimonioInmaterial = array();
                $arrayPatrimonioMaterial = array();
                
                // Paso 0 obtener el array de patrimonio-Inmaterial
                foreach ($patrimoniObtenido as $patrimonio) {
                    if ($patrimonio instanceof Inmueble) {
                        array_push($arrayPatrimonioInmaterial, $patrimonio);
                    }
                }

                // Paso 0 obtener el array de patrimonio-Material
                foreach ($patrimoniObtenido as $patrimonio) {
                    if ($patrimonio instanceof Mueble) {
                        array_push($arrayPatrimonioMaterial, $patrimonio);
                    }
                }


                // Paso 1 crear el objeto DOMDocument
                $dom = new DOMDocument("1.0","utf-8");
    
                // Paso 2 crear el nodo raíz y añadirlo al documento
                $raiz = $dom->createElement("Patrimonios");
                $dom->appendChild($raiz);
    
                // Paso 3 crear el nodo patrimonio-Inmaterial y añadirlo al nodo raíz
                $patrimonioInmateriales = $dom->createElement("Patrimonios-Inmateriales");
                $raiz->appendChild($patrimonioInmateriales);

                // Paso 4 si el array de patrimonio-Inmaterial es distinto de null
                if(isset($arrayPatrimonioInmaterial)){
                    // Paso 5 recorrer el array de patrimonio-Inmaterial
                    foreach ($arrayPatrimonioInmaterial as $patrimonio) {

                        anadirPatrimonio($patrimonio, $patrimonioInmateriales, $dom);

                    }
                }

                // Paso 3 crear el nodo patrimonio-Material y añadirlo al nodo raíz
                $patrimonioMaterial = $dom->createElement("Patrimonio-Material");
                $raiz->appendChild($patrimonioMaterial);

                // paso 4 si el array de patrimonio-Material es distinto de null
                if(isset($arrayPatrimonioMaterial)){
                    
                    // Paso 5 recorrer el array de patrimonio-Material
                    foreach ($arrayPatrimonioMaterial as $patrimonio) {
                            
                        anadirPatrimonio($patrimonio, $patrimonioMaterial, $dom);
                    }

                }
                
                // Paso 6 guardar el fichero XML y darle formato
                $dom->formatOutput = true;
                $dom->save("Patrimonio.xml");
           
            } catch (DOMException $e) {
                echo "Error al procesar el documento XML: " . $e->getMessage();
            } catch (Exception $e) {
                echo "Error inesperado: " . $e->getMessage();
            }
        }


    }


    /**
     * Añade un patrimonio al documento XML.
     *
     * @param mixed $patrimonio El patrimonio a añadir.
     * @param DOMElement $tipoPatrimonio El elemento DOM que representa el tipo de patrimonio.
     * @param DOMDocument $dom El documento DOM.
     * @return void
     */

    function anadirPatrimonio($patrimonio, $tipoPatrimonio, $dom){

        if($patrimonio instanceof Inmueble){
            // paso 4 crear el nodo Inmaterial 
            $inmueble = $dom->createElement("Inmaterial");
            $tipoPatrimonio->appendChild($inmueble);

            // Paso 5 crear el nodo id y añadirlo al nodo Inmaterial
            $id = $dom->createElement("id", $patrimonio->getIdPatrimonio());
            $inmueble->appendChild($id);

            // Paso 6 crear el nodo nombre y añadirlo al nodo Inmaterial
            $nombre = $dom->createElement("nombre", $patrimonio->getNombre());
            $inmueble->appendChild($nombre);

            // Paso 7 crear el nodo descripcion y añadirlo al nodo Inmaterial
            $descripcion = $dom->createElement("descripcion", $patrimonio->getDescripcion());
            $inmueble->appendChild($descripcion);

            // Paso 8 crear el nodo fechaAdquisicion y añadirlo al nodo Inmaterial
            $fechaAdquisicion = $dom->createElement("fechaAdquisicion", $patrimonio->getFechaAdquisicion()->format('Y-m-d'));
            $inmueble->appendChild($fechaAdquisicion);

            // Paso 9 crear el nodo fotos y añadirlo al nodo Inmaterial
            $fotos = $dom->createElement("fotos", implode(",", $patrimonio->getFotos()));
            $inmueble->appendChild($fotos);

            // Paso 10 crear el nodo ubicacion y añadirlo al nodo Inmaterial
            $ubicacion = $dom->createElement("ubicacion", $patrimonio->getUbicacion());
            $inmueble->appendChild($ubicacion);

            // Paso 11 crear el nodo tipoInmueble y añadirlo al nodo Inmaterial
            $tipoInmueble = $dom->createElement("tipoInmueble", $patrimonio->getTipoInmueble()->value);
            $inmueble->appendChild($tipoInmueble);

            // Paso 12 crear el nodo valorCultural y añadirlo al nodo Inmaterial
            $valorCultural = $dom->createElement("valorCultural", $patrimonio->getValorCultural());
            $inmueble->appendChild($valorCultural);

            // Paso 13 crear el nodo reconocimientos y añadirlo al nodo Inmaterial
            $reconocimientos = $dom->createElement("reconocimientos", $patrimonio->getReconocimientos());
            $inmueble->appendChild($reconocimientos);

            // Paso 14 crear el nodo uso y añadirlo al nodo Inmaterial
            $uso = $dom->createElement("uso", $patrimonio->getUso());
            $inmueble->appendChild($uso);

        } else if($patrimonio instanceof Mueble){
            // Paso 18 crear el nodo patrimonio-Material y añadirlo al nodo raíz
            $patrimonioMaterial = $dom->createElement("Material");
            $tipoPatrimonio->appendChild($patrimonioMaterial);

            // Paso 19 crear el nodo id y añadirlo al nodo patrimonio-Material
            $id = $dom->createElement("id", $patrimonio->getIdPatrimonio());
            $patrimonioMaterial->appendChild($id);

            // Paso 20 crear el nodo nombre y añadirlo al nodo patrimonio-Material
            $nombre = $dom->createElement("nombre", $patrimonio->getNombre());
            $patrimonioMaterial->appendChild($nombre);

            // Paso 21 crear el nodo descripcion y añadirlo al nodo patrimonio-Material
            $descripcion = $dom->createElement("descripcion", $patrimonio->getDescripcion());
            $patrimonioMaterial->appendChild($descripcion);

            // Paso 22 crear el nodo fechaAdquisicion y añadirlo al nodo patrimonio-Material
            $fechaAdquisicion = $dom->createElement("fechaAdquisicion", $patrimonio->getFechaAdquisicion()->format('Y-m-d'));
            $patrimonioMaterial->appendChild($fechaAdquisicion);

            // Paso 23 crear el nodo fotos y añadirlo al nodo patrimonio-Material
            $fotos = $dom->createElement("fotos", implode(",", $patrimonio->getFotos()));
            $patrimonioMaterial->appendChild($fotos);

            // Paso 24 crear el nodo ubicacion y añadirlo al nodo patrimonio-Material
            $ubicacion = $dom->createElement("ubicacion", $patrimonio->getUbicacion());
            $patrimonioMaterial->appendChild($ubicacion);

            // Paso 25 crear el nodo tipoMueble y añadirlo al nodo patrimonio-Material
            $tipoMueble = $dom->createElement("tipoMueble", $patrimonio->getTipoMueble()->value);
            $patrimonioMaterial->appendChild($tipoMueble);

            // Paso 26 crear el nodo estado y añadirlo al nodo patrimonio-Material
            $estado = $dom->createElement("estado", $patrimonio->getEstado());
            $patrimonioMaterial->appendChild($estado);

            // Paso 27 crear el nodo valor y añadirlo al nodo patrimonio-Material
            $valor = $dom->createElement("valor", $patrimonio->getValor());
            $patrimonioMaterial->appendChild($valor);

            // Paso 28 crear el nodo historia y añadirlo al nodo patrimonio-Material
            $historia = $dom->createElement("historia", $patrimonio->getHistoria());
            $patrimonioMaterial->appendChild($historia);

            // Paso 29 crear el nodo autor y añadirlo al nodo patrimonio-Material
            $autor = $dom->createElement("autor", $patrimonio->getAutor());
            $patrimonioMaterial->appendChild($autor);
        }

    }
?>
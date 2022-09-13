<?php
// clase que nos facilitar� la tarea de subir ficheros
// haciendo todas las comprobaciones necesarias
class Upload{
    
    // m�todo para comprobar si llega un fichero
    public static function arrive(string $key='file'):bool{
        return !empty($_FILES[$key]) && $_FILES[$key]['error']!=4;
    }
    
    // m�todo que genera nombres �nicos
    private static function uniqueName(
        string $extension='',    // extensi�n del fichero
        string $prefix=''       // prefijo para el nombre �nico
        ):string{
            // genera el nombre �nico con un prefijo
            $nombre = uniqid($prefix);
            // retorna el nuevo nombre con la extensi�n (si se indic�)
            return $extension ? "$nombre.$extension" : $nombre;
    }
    
    // procesa la subida de un fichero y hace todas las comprobaciones
    public static function save(
        string $key = 'file',  // clave de $_FILES (nombre del input)
        string $folder = '',   // carpeta de destino
        bool $unique = true,   // generar nombre �nico?
        int $max = 0,          // tama�o max del fichero (0 ilimitado)
        string $mime = '.',    // tipo MIME (image/jpeg, image/*, etc)
        string $prefix = ''    // prefijo para el nombre del fichero
        ):string{
            
            // comprobar que llega algo con la clave indicada
            if(!self::arrive($key))
                throw new Exception("No se recibi� fichero con la clave $key");
                
                $file = $_FILES[$key]; // recupera la info del fichero
                
                // comprobar que no se ha producido un error en la subida
                if($e = $file['error'])
                    throw new Exception("Error en la subida del fichero con c�digo $e");
                    
                    // comprobar que el fichero no supera el tama�o m�ximo
                    if($max && $file['size']>$max)
                        throw new Exception("El fichero supera los $max bytes");
                        
                        $rutaTmp = $file['tmp_name']; // ruta temporal
                        
                        // COMPROBACION DEL TIPO DE FICHERO
                        // recupera el tipo MIME
                        $tipo = (new finfo(FILEINFO_MIME_TYPE))->file($rutaTmp);
                        
                        // retoques para que no falle la expresi�n regular en la comprobaci�n
                        $mimetmp = str_replace('*','',$mime); //quito el * (si lo tiene)
                        $mimetmp = preg_quote($mimetmp,'/');  //escapo los caracteres especiales
                        
                        // comprobaci�n del tipo mediante regexp
                        if(!preg_match("/^$mimetmp/i",$tipo))
                            throw new Exception("El fichero no es de tipo $mime");
                            
                            // Calcular la ruta final, dependiendo de si el nombre del fichero
                            // tiene que ser �nico o no
                            $ruta = $unique ?
                            $folder."/".self::uniqueName(pathinfo($file['name'], PATHINFO_EXTENSION), $prefix):
                            $folder."/".$file['name'];
                            
                            // MOVER EL FICHERO A DESTINO
                            if(!move_uploaded_file($rutaTmp, $ruta))
                                throw new Exception("Error al mover de $rutaTmp a $ruta");
                                
                                return $ruta;
    }
}
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Anuncio
 *
 * @author José Esquinas
 */
class Anuncio {

    private $id;
    private $titulo;
    private $descripcion;
    private $precio;
    private $fecha_creacion;
    private $fecha_modificacion;
    private $Usuarios_id;
    private $fotos;

    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getFecha_creacion() {
        return $this->fecha_creacion;
    }

    function getFecha_modificacion() {
        return $this->fecha_modificacion;
    }

    function getUsuarios_id() {
        return $this->Usuarios_id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    function setFecha_creacion($fecha_creacion) {
        $this->fecha_creacion = $fecha_creacion;
    }

    function setFecha_modificacion($fecha_modificacion) {
        $this->fecha_modificacion = $fecha_modificacion;
    }

    function setUsuarios_id($Usuarios_id) {
        $this->Usuarios_id = $Usuarios_id;
    }

    function getFotos() {
        return $this->fotos;
    }

    function setFotos($fotos) {
        $this->fotos = $fotos;
    }

    public function cargar_fotos() {
        $foto = new Foto();
        $fotos = $foto->obtener($this->getId());
        $this->setFotos($fotos);
    }

    function obtener($id) {
        //limpiamos los datos de entrada
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        //Conectamos con la BD
        $con = ConexionDB::conectar();
        $sql = "SELECT * FROM anuncios WHERE  id = ?";
        //Preparamos la consulta
        if (!$consulta_preparada = $con->prepare($sql)) {
            die('Error al preparar la consulta: ' . $con->error);
        }
        //Asociamos parámetros
        $consulta_preparada->bind_param('i', $id);
        //Ejecutamos la consulta
        if (!$resultado = $consulta_preparada->execute()) {
            die("Error al ejecutar la consulta" . $con->error);
        }
        //Obtenemos el resultado
        if (!$resultado = $consulta_preparada->get_result()) {
            die('Error al obtener el resultado: ' . $con->error);
        }
        //Obteniemos un array con los datos del usuario
        if ($anuncio_array = $resultado->fetch_assoc()) {

            //Asignamos los valores obtenidos de la BD a las propiedades del objeto
            $this->setId($anuncio_array['id']);
            $this->setTitulo($anuncio_array['titulo']);
            $this->setDescripcion($anuncio_array['descripcion']);
            $this->setFecha_creacion($anuncio_array['fecha_creacion']);
            $this->setFecha_modificacion($anuncio_array['fecha_mod']);
            $this->setUsuarios_id($anuncio_array['Usuarios_id']);

            //Cerramos la conexión 
            $con->close();
            return true;
        } else {
            //Cerramos la conexión
            $con->close();
            return false;
        }
    }

    static function obtener_todos() {
        $con = ConexionDB::conectar();
        $sql = "select * from anuncios order by id desc";
        $result = $con->query($sql);
        if (!$result) {
            die("Error en la sql" . $con->error);
        } else {
            while ($anuncio = $result->fetch_object("Anuncio")) {
                $anuncio->cargar_fotos();
                $anuncios_array[] = $anuncio;
            }

            if (!empty($anuncios_array)) {
                return $anuncios_array;
            } else {
                return false;
            }
        }
    }

    function actualizar() {
        //Conectamos con la BD
        $con = ConexionDB::conectar();
        $sql = "UPDATE anuncio SET titulo=?, descripcion=?, precio=?, fecha_mod=?, Usuarios_id=? "
                . "WHERE id=?";
        //Preparamos la consulta
        if (!$consulta_preparada = $con->prepare($sql)) {
            die('Error al preparar la consulta: ' . $con->error);
        }
        //Asociamos parámetros
        $titulo = $this->getTitulo();
        $descripcion = $this->getDescripcion();
        $precio = $this->getId_usuario();
        $fecha_creacion = $this->getId_mensaje_padre();
        $fecha_mod = $this->getFecha_modificacion();
        $Usuarios_id = $this->getUsuarios_id();
        $consulta_preparada->bind_param('ssisi', $titulo, $descripcion, $precio, $fecha_mod, $Usuarios_id);
        //Ejecutamos la consulta
        if (!$resultado = $consulta_preparada->execute()) {
            die("Error al ejecutar la consulta" . $con->error);
        }
        //Cerramos la conexión
        $con->close();

        return $resultado;
    }

    function borrar($token) {
        if ($token = $_SESSION['token']) {
            $con = ConexionDB::conectar();
            $sql = "DELETE FROM anuncios WHERE id= ?";
            //Preparamos la consulta
            if (!$consulta_preparada = $con->prepare($sql)) {
                die('Error al preparar la consulta: ' . $con->error);
            }
            //Asociamos parámetros
            $id = $this->getId();
            $consulta_preparada->bind_param('i', $id);
            //Ejecutamos la consulta
            if (!$resultado = $consulta_preparada->execute()) {
                die("Error al ejecutar la consulta" . $con->error);
            }
            //Comprobamos si se ha borrado algún usuario
            if ($consulta_preparada->affected_rows) {
                $con->close();
                return true;
            } else {
                $con->close();
                return false;
            }
        } else {
            Utils::guardar_mensaje("Token no igual");
            header('location:' . RUTA);
        }
    }

    function insertar() {
        $con = ConexionDB::conectar();

        //Preparamos la consulta
        //Asociamos parámetros
        $titulo = $this->getTitulo();
        $descripcion = $this->getDescripcion();
        $Usuarios_id = $this->getUsuarios_id();
        $precio = $this->getPrecio();
        if (is_null($this->getFecha_creacion())) {

            $sql = "INSERT INTO anuncios (titulo, descripcion, precio, fecha_creacion, fecha_mod, Usuarios_id) VALUES (?,?,?,default,default,?)";
            if (!$consulta_preparada = $con->prepare($sql)) {
                die('Error al preparar la consulta: ' . $con->error);
            }

            $consulta_preparada->bind_param('ssii', $titulo, $descripcion, $precio, $Usuarios_id);
        } else {

            $sql = "INSERT INTO anuncios (titulo, descripcion, precio, fecha_creacion, fecha_mod, Usuarios_id) VALUES (?,?,?,default,default,?)";
            if (!$consulta_preparada = $con->prepare($sql)) {
                die('Error al preparar la consulta: ' . $con->error);
            }

            $consulta_preparada->bind_param('ssii', $titulo, $descripcion, $precio, $Usuarios_id);
        }


        //Ejecutamos la consulta
        if (!$resultado = $consulta_preparada->execute()) {
            die("Error al ejecutar la consulta" . $con->error);
        }
        //Asignamos a la propiedad id el id asignado por la BD.
        $this->id = $consulta_preparada->insert_id;

        //Cerramos la conexión
        $con->close();

        return $resultado;
    }

}

<?php

/**
 * Description of Foto
 *
 * @author Usuario1
 */
class Foto {
    private $id;
    private $nombre;
    private $principal;
    private $Anuncios_id;
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getPrincipal() {
        return $this->principal;
    }

    function getAnuncios_id() {
        return $this->Anuncios_id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setPrincipal($principal) {
        $this->principal = $principal;
    }

    function setAnuncios_id($Anuncios_id) {
        $this->Anuncios_id = $Anuncios_id;
    }

    static function obtener($id){
        
        $con = ConexionDB::conectar();
        $sql = "select * from fotos where Anuncios_id = $id";
        $result = $con->query($sql);
    }
}


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
    
    function obtener($id){
        
        
    }

    static function obtener_todas($id_anuncio) {

        $con = ConexionDB::conectar();
        $sql = "select * from fotos where Anuncios_id = $id_anuncio";
        $result = $con->query($sql);
        $todas_fotos = array();
        while($fotos = $result->fetch_assoc()) {
           $foto = new Foto();
           
           $foto->setId($fotos['id']);
           $foto->setNombre($fotos['nombre']);
           $foto->setPrincipal($fotos['principal']);
           $foto->setAnuncios_id($fotos['Anuncios_id']);
           $todas_fotos[] = $foto;
        } 
        
        return $todas_fotos;
    }

}

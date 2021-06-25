<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Bases_model extends CI_Model
{   

    private $idBase;
    private $nombre;
    private $direccion;
    private $deparamento;
    private $provincia;
    private $distrito;
    private $fechainicio;
    private $ubigeo;
    private $latitud;
    private $longitud;

    public function setidBase($data){
        $this->idBase = $this->db->escape_str($data);
    }
    public function setNombre($data){
        $this->nombre = $this->db->escape_str($data);
    }
    public function setDireccion($data){
        $this->direccion = $this->db->escape_str($data);
    }
    public function setDepartamento($data){
        $this->departamento = $this->db->escape_str($data);
    }
    public function setProvincia($data){
        $this->provincia = $this->db->escape_str($data);
    }
    public function setDistrito($data){
        $this->distrito = $this->db->escape_str($data);
    }
    public function setFechainicio($data){
        $this->fechainicio = $this->db->escape_str($data);
    }
    public function setUbigeo($data){
        $this->ubigeo = $this->db->escape_str($data);
    }
    public function setLatitud($data){
        $this->latitud = $this->db->escape_str($data);
    }
    public function setLongitud($data){
        $this->longitud = $this->db->escape_str($data);
    }

    public function __construct()
    {
        parent::__construct();
    }
    public function obtenerBases()
    {
        $this->db->select("lb.*");
        $this->db->from("lista_bases lb");
        $this->db->order_by("lb.idbase ASC");
        return $this->db->get();
    }
   
    public function guardarBase()
    {
        $data = array(
            "nombre" => $this->nombre,
            "domicilio" => $this->direccion,
            "ubigeo" => $this->ubigeo,
            "fecha" => $this->fechainicio,
            "latitud" => $this->latitud,
            "longitud" => $this->longitud
        );
        if($this->db->insert("base", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
}
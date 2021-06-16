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

    public function __construct()
    {
        parent::__construct();
    }
    public function obtenerBases()
    {
        $this->db->select("b.idbase, b.nombre, b.domicilio, b.ubigeo, CONCAT_WS( ' - ', u.departamento, u.provincia, u.distrito ) AS 'ubicacion', b.fecha, b.activo");
        $this->db->from("base b");
        $this->db->join("ubigeo u","u.ubigeo = b.ubigeo");
        $this->db->order_by("b.idbase ASC");
        return $this->db->get();
    }
   
    public function guardarBase()
    {
        $data = array(
            "nombre" => $this->nombre,
            "domicilio" => $this->direccion,
            "ubigeo" => $this->ubigeo,
            "fecha" => $this->fechainicio
        );
        if($this->db->insert("base", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
}
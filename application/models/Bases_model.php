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

    public function __construct()
    {
        parent::__construct();
    }
    public function obtenerBases()
    {
        $this->db->select("bs.*");
        $this->db->from("base bs");
        $this->db->order_by("bs.idbase ASC");
        return $this->db->get();
    }
   
    public function guardarBase()
    {
        $data = array(
            "nombre" => $this->nombre,
            "direccion" => $this->direccion,
            "departamento" => $this->departamento,
            "provincia" => $this->provincia,
            "distrito" => $this->distrito
        );
        if($this->db->insert("base", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
}
<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Combustibles_model extends CI_Model
{
    private $idtipocombustible;
    
    public function setidtipocombustible($data)
    {
        $this->idtipocombustible = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function obtenerTiposCombustibles()
    {
        $this->db->select("idtipocombustible,combustible");
        $this->db->from("tipo_combustible");
        $this->db->where("activo =", "1");
        return $this->db->get();
    }
   
}
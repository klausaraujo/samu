<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Marcas_model extends CI_Model
{
    private $idmarca;
    
    public function setidmarca($data)
    {
        $this->idmarca = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function obtenerMarcas()
    {
        $this->db->select("idmarca,marca");
        $this->db->from("marca");
        $this->db->where("activo =", "1");
        return $this->db->get();
    }
   
}
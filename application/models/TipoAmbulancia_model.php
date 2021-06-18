<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class TipoAmbulancia_model extends CI_Model
{
    private $idtipoambulancia;
    
    public function setidtipoambulancia($data)
    {
        $this->idtipoambulancia = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function obtenerTiposAmbulancias()
    {
        $this->db->select("idtipoambulancia,tipo");
        $this->db->from("tipo_ambulancia");
        $this->db->where("activo =", "1");
        return $this->db->get();
    }
   
}
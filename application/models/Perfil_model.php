<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Perfil_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function obtenerPerfil()
    {
        $this->db->select("*");
        $this->db->from("perfil");
        return $this->db->get();
    }
   
}
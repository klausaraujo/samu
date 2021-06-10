<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Bases_model extends CI_Model
{
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
   
}
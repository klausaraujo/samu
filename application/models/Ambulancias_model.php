<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Ambulancias_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function obtenerAmbulancias()
    {
        $this->db->select("am.*");
        $this->db->from("ambulancia am");
        $this->db->order_by("am.idambulancia ASC");
        return $this->db->get();
    }
   
}
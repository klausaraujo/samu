<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    private $idmodulo;
	
    /*public function setIdUsusario($data)
    {
        $this->idusuario = $this->db->escape_str($data);
    }*/
	
	public function setIdModulo($data)
    {
        $this->idmodulo = $this->db->escape_str($data);
    }
	
    public function __construct()
    {
        parent::__construct();
    }
	
	public function modulos()
	{
		$this->db->select("idmodulo,descripcion,menu,icono,activo");
		$this->db->from("modulo");
		//$this->db->where("idmenu",$this->idmenu);
        $this->db->order_by("orden","ASC");
		return $this->db->get();
		
	}
	
	public function submenu()
	{
		$this->db->select("idmodulo,idmenu,descripcion,url,nivel,activo");
		$this->db->from("menu");
		$this->db->where("idmodulo",$this->idmodulo);
		return $this->db->get();
		
	}
}
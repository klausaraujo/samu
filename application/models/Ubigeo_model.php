<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Ubigeo_model extends CI_Model
{
    private $cod_dep;
    private $cod_pro;
    private $cod_dis;
    public function setcod_dep($data)
    {
        $this->cod_dep = $this->db->escape_str($data);
    }
    public function setcod_pro($data)
    {
        $this->cod_pro = $this->db->escape_str($data);
    }
    public function setcod_dis($data)
    {
        $this->cod_dis = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function obtenerRegiones()
    {
        $this->db->select("Codigo_Region,UPPER(Nombre_Region) Nombre_Region");
        $this->db->from("region");
        $this->db->where("Activo =", "1");
        return $this->db->get();
    }
    public function departamentos()
    {
        $this->db->select("cod_dep,departamento");
        $this->db->from("lista_departamentos");
        return $this->db->get();
    }
    public function provincias()
    {
        $this->db->select("cod_dep,cod_pro,provincia");
        $this->db->from("lista_provincias");
        $this->db->where("cod_dep", $this->cod_dep);
        return $this->db->get();
    }
    public function distritos()
    {
        $this->db->select("cod_dep,cod_pro,cod_dis,distrito,latitud,longitud");
        $this->db->from("lista_distritos");
        $this->db->where("cod_dep", $this->cod_dep);
        $this->db->where("cod_pro", $this->cod_pro);
        return $this->db->get();
    }

    public function ubigeo() {
        $this->db->select("fn_departamento(SUBSTRING(ubigeo,1,2)) departamento");
        $this->db->select("fn_provincia(SUBSTRING(ubigeo,1,2),SUBSTRING(ubigeo,3,2)) provincia");
        $this->db->select("Nombre distrito");
        $this->db->from("ubigeo");
        $this->db->where("cod_dep", $this->cod_dep);
        $this->db->where("cod_pro", $this->cod_pro);
        $this->db->where("cod_dis", $this->cod_dis);
        return $this->db->get();
    }
}
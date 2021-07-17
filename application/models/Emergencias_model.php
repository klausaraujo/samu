<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Emergencias_model extends CI_Model
{
    private $idEmergencia;
    private $telf;
    private $tipoLlamada;
    private $telf2;
    private $tipoDoc;
    private $nroDoc;
    private $tipoIncid;
    private $fecha;
    private $priori;
    private $direccion;
    private $region;
    private $provincia;
    private $distrito;

    public function setidEmergencia($data){
        $this->idEmergencia = $this->db->escape_str($data);
    }
    public function setTelf($data){
        $this->telf = $this->db->escape_str($data);
    }
    public function setTipoLlamada($data){
        $this->tipoLlamada = $this->db->escape_str($data);
    }
    public function setTelf2($data){
        $this->telf2 = $this->db->escape_str($data);
    }
    public function setTipoDoc($data){
        $this->tipoDoc = $this->db->escape_str($data);
    }
    public function setNroDoc($data){
        $this->nroDoc = $this->db->escape_str($data);
    }
    public function setTipoIncid($data){
        $this->tipoIncid = $this->db->escape_str($data);
    }
    public function setFecha($data){
        $this->fecha = $this->db->escape_str($data);
    }
    public function setPrioridad($data){
        $this->priori = $this->db->escape_str($data);
    }
    public function setDireccion($data){
        $this->direccion = $this->db->escape_str($data);
    }
    public function setRegion($data){
        $this->region = $this->db->escape_str($data);
    }
    public function setProvincia($data){
        $this->provincia = $this->db->escape_str($data);
    }
    public function setDistrito($data){
        $this->distrito = $this->db->escape_str($data);
    }

    public function tipoLlamada()
    {
        $this->db->select("*");
        $this->db->from("tipo_llamada");
        $this->db->where("activo = 1");
        return $this->db->get();
    }

    public function tipoIncidente()
    {
        $this->db->select("*");
        $this->db->from("tipo_incidente");
        $this->db->where("activo = 1");
        return $this->db->get();
    }

    public function prioriEmergencia()
    {
        $this->db->select("*");
        $this->db->from("prioridad_emergencia");
        $this->db->where("activo = 1");
        return $this->db->get();
    }
}
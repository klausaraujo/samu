<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Ambulancias_model extends CI_Model
{
    private $idambulancia;
    private $placa;
    private $idmarca;
    private $modelo;
    private $idtipocombustible;
    private $gps;
    private $idtipoambulancia;
    private $serie_motor;
    private $codigo_patrimonial;
    private $fabricacion_anio;
    private $modelo_anio;
    private $condicion;
    private $tarjeta;
    private $fotografia;

    public function setidambulancia($data){
        $this->idambulancia = $this->db->escape_str($data);
    }
    public function setplaca($data){
        $this->placa = $this->db->escape_str($data);
    }
    public function setidmarca($data){
        $this->idmarca = $this->db->escape_str($data);
    }
    public function setidtipocombustible($data){
        $this->idtipocombustible = $this->db->escape_str($data);
    }
    public function setgps($data){
        $this->gps = $this->db->escape_str($data);
    }
    public function setidtipoambulancia($data){
        $this->idtipoambulancia = $this->db->escape_str($data);
    }
    public function setserie_motor($data){
        $this->serie_motor = $this->db->escape_str($data);
    }
    public function setcodigo_patrimonial($data){
        $this->codigo_patrimonial = $this->db->escape_str($data);
    }
    public function setmodelo_anio($data){
        $this->modelo_anio = $this->db->escape_str($data);
    }
    public function setcondicion($data){
        $this->condicion = $this->db->escape_str($data);
    }
    public function settarjeta($data){
        $this->tarjeta = $this->db->escape_str($data);
    }
    public function setfotografia($data){
        $this->fotografia = $this->db->escape_str($data);
    }
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
    public function guardarAmbulancia()
    {
        $data = array(
            "placa" => $this->placa,
            "idmarca" => $this->idmarca,
            "modelo" => $this->modelo,
            "idtipocombustible" => $this->idtipocombustible,
            "gps" => $this->gps,
            "idtipoambulancia" => $this->idtipoambulancia,
            "serie_motor" => $this->serie_motor,
            "codigo_patrimonial" => $this->codigo_patrimonial,
            "fabricacion_anio" => $this->fabricacion_anio,
            "modelo_anio" => $this->modelo_anio,
            "condicion" => $this->condicion,
            "tarjeta" => $this->tarjeta,
            "fotografia" => $this->fotografia
        );
        if($this->db->insert("ambulancia", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
}


    
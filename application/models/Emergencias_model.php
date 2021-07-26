<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Emergencias_model extends CI_Model
{
    private $idUsuario;
    private $fechaActual;
    private $idEmergencia;
    private $telf;
    private $idTipoLlamada;
    private $telf2;
    private $tipoDoc;
    private $nroDoc;
    private $nombres;
    private $apellidos;
    private $paciente;
    private $masivo;
    private $tipoIncid;
    private $fecha;
    private $priori;
    private $direccion;
    private $region;
    private $provincia;
    private $distrito;
    private $latitud;
    private $longitud;
    private $fechaNac = "";

    public function setIdUsuario($data){
        $this->idUsuario = $this->db->escape_str($data);
    }
    public function setFechaActual($data){
        $this->fechaActual = $this->db->escape_str($data);
    }
    public function setidEmergencia($data){
        $this->idEmergencia = $this->db->escape_str($data);
    }
    public function setTelf($data){
        $this->telf = $this->db->escape_str($data);
    }
    public function setTipoLlamada($data){
        $this->idTipoLlamada = $this->db->escape_str($data);
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
    public function setApellidos($data){
        $this->apellidos = $this->db->escape_str($data);
    }
    public function setNombres($data){
        $this->nombres = $this->db->escape_str($data);
    }
    public function setPaciente($data){
        $this->paciente = $this->db->escape_str($data);
    }
    public function setMasivo($data){
        $this->masivo = $this->db->escape_str($data);
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
    public function setLatitud($data){
        $this->latitud = $this->db->escape_str($data);
    }
    public function setLongitud($data){
        $this->longitud = $this->db->escape_str($data);
    }
    public function setFechaNac($data){
        $this->fechaNac = $this->db->escape_str($data);
    }

    public function guardarEmergencia(){
        
        $data = array(
            "telefono01" => $this->telf,
            "telefono02" => $this->telf2,
            "idtipollamada" => $this->idTipoLlamada,
            "tipo_documento" => $this->tipoDoc,
            "numero_documento" => $this->nroDoc,
            "apellidos" => $this->apellidos,
            "nombres" => $this->nombres,
            "es_paciente" => $this->paciente,
            "masivo" => $this->masivo,
            "fecha_nacimiento" => $this->fechaNac,
            "ubigeo" => $this->region.$this->provincia.$this->distrito,
            "latitud" => $this->latitud,
            "longitud" => $this->longitud,
            "idtipoincidente" => $this->tipoIncid,
            "fecha_incidente" => $this->fecha,
            "idusuario_registro" => $this->idUsuario,
            "fecha_registro" => $this->fechaActual,
            "activo" => 1
        );
        if($this->db->insert("emergencia", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }

    }

    public function actualizarEmergencia(){
        $data = array(
            "telefono02" => $this->telf2,
            "idtipollamada" => $this->idTipoLlamada,
            "es_paciente" => $this->paciente,
            "masivo" => $this->masivo,
            "idtipoincidente" => $this->tipoIncid,
            "idusuario_modificacion" => $this->idUsuario,
            "fecha_modificacion" => $this->fechaActual,
        );

        $this->db->where("idemergencia",$this->idEmergencia);
        $result = $this->db->update("emergencia", $data);
        if($result) return true;
        else return false;
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

    public function listarEmergencias(){
        $sel = "em.idemergencia,em.telefono01,em.telefono02,em.idtipollamada,em.tipo_documento,".
                "em.numero_documento,em.apellidos,em.nombres,em.ubigeo,em.latitud,em.longitud,".
                "em.idtipoincidente,em.fecha_incidente,em.activo,tl.tipo_llamada,ti.tipo_incidente";
        $this->db->select($sel);
        $this->db->from("emergencia em");
        $this->db->join("tipo_llamada tl","tl.idtipollamada=em.idtipollamada");
        $this->db->join("tipo_incidente ti","em.idtipoincidente=ti.idtipoincidente");
        return $this->db->get();
    }

    public function extraeEmergencia(){
        $sel = "em.idemergencia,em.telefono01,em.telefono02,em.idtipollamada,em.tipo_documento,".
                "em.numero_documento,em.apellidos,em.nombres,em.es_paciente,em.masivo,em.ubigeo,em.latitud,".
                "em.longitud,em.idtipoincidente,em.fecha_incidente,em.activo,tl.tipo_llamada,ti.tipo_incidente";
        $this->db->select($sel);
        $this->db->from("emergencia em");
        $this->db->join("tipo_llamada tl","tl.idtipollamada=em.idtipollamada");
        $this->db->join("tipo_incidente ti","em.idtipoincidente=ti.idtipoincidente");
        $this->db->where("idemergencia",$this->idEmergencia);
        return $this->db->get();
    }
}
<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Usuarios_model extends CI_Model
{
    private $id;
    private $dni;
    private $avatar;
    private $nombres;
    private $apellidos;
    private $region;
    private $perfil;
    private $estatus;
    private $user;
    private $pass;
    
    public function setIdUsuario($data){
        $this->id = $this->db->escape_str($data);
    }
    public function setDni($data){
        $this->dni = $this->db->escape_str($data);
    }
    public function setAvatar($data){
        $this->avatar = $this->db->escape_str($data);
    }
    public function setNombres($data){
        $this->nombres = $this->db->escape_str($data);
    }
    public function setApellidos($data){
        $this->apellidos = $this->db->escape_str($data);
    }
    public function setRegion($data){
        $this->region = $this->db->escape_str($data);
    }
    public function setPerfil($data){
        $this->perfil = $this->db->escape_str($data);
    }
    public function setEstatus($data){
        $this->estatus = $this->db->escape_str($data);
    }
    public function setUser($data){
        $this->user = $this->db->escape_str($data);
    }
    public function setPassword($data){
        $this->pass = $this->db->escape_str($data);
    }
    
    public function __construct()
    {
        parent::__construct();
    }
    public function obtenerUsuarios()
    {
        /*$this->db->select("u.idusuario,u.dni,u.avatar,u.apellidos,u.nombres,u.usuario,u.passwd,u.idperfil,u.idregion,u.activo,p.perfil,r.region");
        $this->db->from("usuarios u");
        $this->db->join("perfil p", "u.idperfil=p.idperfil");
        $this->db->join("region r", "r.idregion=u.idregion");
        $this->db->order_by("u.idusuario ASC");*/
        $this->db->select("*");
        $this->db->from("lista_usuarios u");
        $this->db->order_by("u.idusuario ASC");
        return $this->db->get();
    }

    public function guardarUsuario()
    {
        $data = array(
            "dni" => $this->dni,
            "apellidos" => $this->apellidos,
            "nombres" => $this->nombres,
            "usuario" => $this->user,
            "passwd" => sha1($this->pass),
            "idperfil" => $this->perfil,
            //"idregion" => $this->region,
            "activo" => $this->estatus
        );
        if($this->db->insert("usuarios", $data))
            return $this->db->insert_id();
        else 
            return 0;
    }

    public function actualizarUsuario()
    {
         $data = array(
            //"dni" => $this->dni,
            "apellidos" => $this->apellidos,
            "nombres" => $this->nombres,
            //"usuario" => $this->user,
            //"passwd" => sha1($this->pass),
            "idperfil" => $this->perfil,
            //"idregion" => $this->region,
            //"activo" => $this->estatus
        );

        $this->db->where("idusuario",$this->id);
        $result = $this->db->update("usuarios", $data);
        if($result) return true;
        else return false;
    }

    public function extraeUsuario()
    {   
        $this->db->select("u.idusuario,u.dni,u.apellidos,u.nombres,u.idperfil,u.activo,ur.idregion,r.region,p.perfil");
        $this->db->from("usuarios u");
        $this->db->join("usuarios_region ur","ur.idusuario=u.idusuario");
        $this->db->join("region r", "ur.idregion=r.idregion");
        $this->db->join("perfil p", "p.idperfil=u.idperfil");
        $this->db->where("u.dni", $this->dni);
        $this->db->order_by("ur.idregion ASC");
        return $this->db->get();
    }

    public function extraeId()
    {
        $this->db->select("*");
        $this->db->from("usuarios");
        $this->db->where("dni", $this->dni);
        return $this->db->get();
    }

    public function guardarRegionesUsuario(){
        $data = array(
            "idusuario" => $this->id,
            "idregion" => $this->region,
            "activo" => $this->estatus
        );
        if($this->db->insert("usuarios_region", $data))
            return $this->db->insert_id();
        else 
            return 0;
    }

    public function borrarRegionesUsuario(){
        $this->db->where( 'idusuario' ,  $this->id);
        if($this->db->delete("usuarios_region"))
            return 1;
        else
            return 0;
    }

    public function extraeRegionesUsuario(){
        $this->db->select("ur.idregion,r.region");
        $this->db->from("usuarios_region ur");
        $this->db->join("region r","ur.idregion=r.idregion");
        $this->db->where("idusuario", $this->id);
        return $this->db->get();
    }
   
}
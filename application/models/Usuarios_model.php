<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Usuarios_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function obtenerUsuarios()
    {
        $this->db->select("u.idusuario,u.dni,u.avatar,u.apellidos,u.nombres,u.usuario,u.passwd,u.idperfil,u.idregion,u.activo,p.perfil,r.region");
        $this->db->from("usuarios u");
        $this->db->join("perfil p", "u.idperfil=p.idperfil");
        $this->db->join("region r", "r.idregion=u.idregion");
        $this->db->order_by("u.idusuario ASC");
        return $this->db->get();


    }
   
}
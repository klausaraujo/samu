<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class User extends CI_Model
{
    private $user;
    private $password;

    public function setUser($data)
    {
        $this->user = $this->db->escape_str($data);
    }

    public function setPassword($data)
    {
        $this->password = $this->db->escape_str($data);
    }

    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        $this->db->select("*");
        $this->db->from("usuarios");
        $this->db->where("usuario", $this->user);
        $this->db->where("passwd", sha1($this->password));
        return $this->db->get();
    }

}
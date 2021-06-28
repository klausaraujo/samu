<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

    public function index() {

        $this->load->model("Usuarios_model");
        $this->load->model("Ubigeo_model");
        $this->load->model("Perfil_model");

        $listaUsuarios = $this->Usuarios_model->obtenerUsuarios();
        $departamentos = $this->Ubigeo_model->obtenerRegiones();
        $perfiles = $this->Perfil_model->obtenerPerfil();

        if ($listaUsuarios->num_rows() > 0) {
            $listaUsuarios = $listaUsuarios->result();
        } else {
            $listaUsuarios = array();
        }

        $data = array(
            "listaUsuarios" => json_encode($listaUsuarios),
            "departamentos" => $departamentos->result(),
            "perfiles" => $perfiles->result()
        );
        
        $this->load->view("usuarios/main_usuarios", $data);
                
    }

    public function guardarUsuario() {

        $this->load->model("Usuarios_model");
        
        $dni = $this->input->post("dni");
        $nombre = $this->input->post("nombres");
        $apellido = $this->input->post("apellidos");
        $region = $this->input->post("region");
        $perfil = $this->input->post("perfil");
        $estatus = $this->input->post("estatus");
        $user = $this->input->post("user");
        $pass = $this->input->post("pass");

        $this->Usuarios_model->setDni($dni);
        $this->Usuarios_model->setNombres($nombre);
        $this->Usuarios_model->setApellidos($apellido);
        $this->Usuarios_model->setRegion($region);
        $this->Usuarios_model->setPerfil($perfil);
        $this->Usuarios_model->setEstatus($estatus);
        $this->Usuarios_model->setUser($user);
        $this->Usuarios_model->setPassword($pass);

        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        if ($this->input->post("act") > 0) {
            $this->Usuarios_model->setIdUsuario($this->input->post("iduser"));
            if ($this->Usuarios_model->actualizarUsuario()) {
                $status = 200;
                $message = "Usuario actualizado exitosamente";
            }
        } else {
            if ($this->Usuarios_model->guardarUsuario()) {
                $status = 200;
                $message = "Usuario registrado exitosamente";
            }
        }

        $data = array(
            "status" => $status,
            "message" => $message
        );

        echo json_encode($data);
    }

    public function listausuarios() {

        $this->load->model("Usuarios_model");

        $listaUsuarios = $this->Usuarios_model->obtenerUsuarios();
       
        if ($listaUsuarios->num_rows() > 0) {
            $listaUsuarios = $listaUsuarios->result();
        } else {
            $listaUsuarios = array();
        }

        $detalle = array(
          "listaUsuarios" => $listaUsuarios
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);

    }

    public function extraeUsuario() {

        $this->load->model("Usuarios_model");
        $this->load->model("Ubigeo_model");
        $this->load->model("Perfil_model");
        
        $this->Usuarios_model->setDni($this->input->post("dni"));
        
        $usuario = $this->Usuarios_model->extraeUsuario();
        $regiones = $this->Ubigeo_model->obtenerRegiones();
        $perfiles = $this->Perfil_model->obtenerPerfil();
       
        if ($usuario->num_rows() > 0) {
            $status = 200;
            $usuario = $usuario->result();
            $regiones = $regiones->result();
            $perfiles = $perfiles->result();
        } else {
            $status = 500;
            $usuario = array();
            $regiones = array();
            $perfiles = array();
        }

        $data = array(
            "status" => $status,
            "data" => $usuario,
            "perfiles" => $perfiles,
            "regiones" => $regiones
        );

        echo json_encode($data);

    }
	
}

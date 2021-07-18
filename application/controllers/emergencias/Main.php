<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

    public function index() {

        $this->load->model("Emergencias_model");
        $this->load->model("Ubigeo_model");

        $tipoLlamada = $this->Emergencias_model->tipoLlamada();
        $incid = $this->Emergencias_model->tipoIncidente();
        $prioriEm = $this->Emergencias_model->prioriEmergencia();
        $departamentos = $this->Ubigeo_model->departamentos();

        $data = array(
            "departamentos" => $departamentos->result(),
            "tipoLlamada" => $tipoLlamada->result(),
            "incid" => $incid->result(),
            "priori" => $prioriEm->result()
        );
        
        $this->load->view("emergencias/main_emergencias",$data);
                
    }

    public function guardarEmergencia(){
        
        $this->load->model("Emergencias_model");
        $status = "";
        $message = "";

        $dtz = new DateTimeZone("America/Lima");
        $dt = new DateTime("now", $dtz);
        $fechaActual = $dt->format("Y-m-d h:i:s a");

        $user = $this->session->userdata("token");
        $this->Emergencias_model->setIdUsuario($user->idusuario);
        $this->Emergencias_model->setFechaActual($fechaActual);
        
        //$this->Emergencias_model->setidEmergencia($this->input->post("idem"));
        $this->Emergencias_model->setTelf($this->input->post("tlf"));
        $this->Emergencias_model->setTipoLlamada($this->input->post("tipoLl"));
        $this->Emergencias_model->setTelf2($this->input->post("tlf2"));        
        $this->Emergencias_model->setTipoDoc($this->input->post("tipoDoc"));
        $this->Emergencias_model->setNroDoc($this->input->post("doc"));
        $this->Emergencias_model->setApellidos($this->input->post("apellidos"));
        $this->Emergencias_model->setNombres($this->input->post("nombres"));
        $this->Emergencias_model->setPaciente($this->input->post("sipaciente"));
        $this->Emergencias_model->setMasivo($this->input->post("simasivo"));
        $this->Emergencias_model->setTipoIncid($this->input->post("incidente"));
        $this->Emergencias_model->setFecha($this->input->post("fecha"));
        $this->Emergencias_model->setPrioridad($this->input->post("prioridad"));
        $this->Emergencias_model->setDireccion($this->input->post("direccion"));
        $this->Emergencias_model->setRegion($this->input->post("departamento"));
        $this->Emergencias_model->setProvincia($this->input->post("provincia"));
        $this->Emergencias_model->setDistrito($this->input->post("distrito"));
        $this->Emergencias_model->setLatitud($this->input->post("latitud"));
        $this->Emergencias_model->setLongitud($this->input->post("longitud"));

        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        if ($this->input->post("act") > 0) {
            
        } else {
            if ($this->Emergencias_model->guardarEmergencia()) {
                $status = 200;
                $message = "Emergencia registrada exitosamente";
            }
        }

        $data = array(
            "status" => $status,
            "msg" => $message
        );

        echo json_encode($data);
        //echo json_encode($this->Emergencias_model->guardarEmergencia());
    }

    public function cargarProvincias()
    {
        $this->load->model("Ubigeo_model");
        
        $departamento = $this->input->post("departamento");
        
        $this->Ubigeo_model->setcod_dep($departamento);
        
        $lista = $this->Ubigeo_model->provincias();
        
        $data = array(
            "lista" => $lista->result()
        );
        
        echo json_encode($data);
    }

    public function cargarDistritos()
    {
        $this->load->model("Ubigeo_model");
        
        $departamento = $this->input->post("departamento");
        $provincia = $this->input->post("provincia");
        
        $this->Ubigeo_model->setcod_dep($departamento);
        $this->Ubigeo_model->setcod_pro($provincia);
        
        $lista = $this->Ubigeo_model->distritos();
        
        $data = array(
            "lista" => $lista->result()
        );
        
        echo json_encode($data);
    }
	
}
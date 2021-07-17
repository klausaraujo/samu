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
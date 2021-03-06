<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
    /*
    private $permisos = null;
    
    function __construct() {

      parent::__construct();
    
      $token = $this->session->userdata("token");
    
      (strlen($token)>0)?$token = JWT::decode($token,getenv("SECRET_SERVER_KEY"),false):redirect("login");
    
      $this->session->set_userdata("idmodulo", 2);
    
      ($this->session->userdata("idusuario"))?$usuario=$this->session->userdata("idusuario"):redirect("login");
    
      if(sha1($usuario)==$token->usuario){
    
          if (count($token->modulos)>0) {
    
              $listaModulos = $token->modulos;
    
              $permanecer = false;
    
              foreach ($listaModulos as $row) :
              if ($row->idmodulo == 14 and $row->estado == 1)
                  $permanecer = true;
                  endforeach
                  ;
    
                  if ($permanecer == false)
                      redirect('errores/accesoDenegado');
          } else {
              redirect("login");
          }

          if($this->permisos==null){ if($this->session->userdata("menu")) $this->permisos = $this->session->userdata("menu");}
    
      }else{
          redirect("login");
      }
      
    }*/

    public function index() {
        /*
        $nivel = 1;
        $idmenu = 16;

        validarPermisos($nivel,$idmenu,$this->permisos);
        */
        $this->load->model("Bases_model");
        $this->load->model("Ubigeo_model");

        $listaBases = $this->Bases_model->obtenerBases();
        $departamentos = $this->Ubigeo_model->departamentos();

        if ($listaBases->num_rows() > 0) {
            $listaBases = $listaBases->result();
        } else {
            $listaBases = array();
        }

        $data = array(
            "listaBases" => json_encode($listaBases),
            "departamentos" => $departamentos->result()
        );
        
        $this->load->view("bases/main_bases", $data);
        //$this->load->view("bases/main_bases");
        
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

    public function guardarBase() {

        $this->load->model("Bases_model");
        
        $idbase = $this->input->post("idbase");
        $nombre = $this->input->post("nombre");
        $direccion = $this->input->post("direccion");
        $departamento = $this->input->post("departamento");
        $provincia = $this->input->post("provincia");
        $distrito = $this->input->post("distrito");
        $fechainicio = $this->input->post("fechainicio");
        $latitud = $this->input->post("latitud");
        $longitud = $this->input->post("longitud");

        $foto = $_FILES["file"];

        $ubigeo = $departamento . $provincia . $distrito;

        $fechainicio = $fechainicio .' 00:00:00';

        $this->Bases_model->setidBase($idbase);
        $this->Bases_model->setNombre($nombre);
        $this->Bases_model->setDireccion($direccion);
        $this->Bases_model->setUbigeo($ubigeo);
        $this->Bases_model->setFechainicio($fechainicio);
        $this->Bases_model->setLatitud($latitud);
        $this->Bases_model->setLongitud($longitud);

        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        if ($this->input->post("act") > 0) {
            $this->Bases_model->setidBase($this->input->post("idbase"));
            if ($this->Bases_model->actualizarBase()) {
                $status = 200;
                $message = "Base actualizada exitosamente";
            }
        } else {
            if ($this->Bases_model->guardarBase()) {
                $status = 200;
                $message = "Base registrada exitosamente";
            }
        }
        
        $data = array(
            "status" => $status,
            "message" => $message
        );

        echo json_encode($data);
    }

    public function listabases() {

        $this->load->model("Bases_model");

        $listaBases = $this->Bases_model->obtenerBases();
       
        if ($listaBases->num_rows() > 0) {
            $listaBases = $listaBases->result();
        } else {
            $listaBases = array();
        }

        $detalle = array(
          "listaBases" => $listaBases
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);

    }

    public function extraerBase() {

        $provincias;
        $distritos;
        $data;
        $base;
        $status;
        $cod_dep;$cod_pro;$cod_dis;
        $this->load->model("Bases_model");
        $this->load->model("Ubigeo_model");

        $departamentos = $this->Ubigeo_model->departamentos();        
        $this->Bases_model->setNombre($this->input->post("base"));
        $listaBase = $this->Bases_model->extraerBase();
       
        if ($listaBase->num_rows() > 0) {
            $status = 200;
            $base = $listaBase->result();
            $departamentos = $departamentos->result();
            foreach($base as $mod){
                $this->Ubigeo_model->setcod_ubicgeo($mod->ubigeo);
            }
            $provDist = $this->Ubigeo_model->extraeProDist();
            $provDist = $provDist->result();
            foreach($provDist as $dep){
                $cod_dep = $dep->cod_dep;
                $cod_pro = $dep->cod_pro;
                $cod_dis = $dep->cod_dis;
            }
            $this->Ubigeo_model->setcod_dep($cod_dep);
            $this->Ubigeo_model->setcod_pro($cod_pro);
            $provincias = $this->Ubigeo_model->provincias();
            $distritos = $this->Ubigeo_model->distritos();
        } else {
            $status = 500;
            $base = array();
            $departamentos = array();
            $provincias = array();
            $distritos = array();
        }

        $data = array(
            "status" => $status,
            "base" => $base,
            "departamentos" => $departamentos,
            "provincias" => $provincias->result(),
            "distritos" => $distritos->result(),
            'departamento' => $cod_dep,
            'provincia' => $cod_pro,
            'distrito' => $cod_dis
        );

        echo json_encode($data);

    }

}

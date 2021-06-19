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
        $this->load->model("Ambulancias_model");
        $this->load->model("Marcas_model");
        $this->load->model("Combustibles_model");
        $this->load->model("TipoAmbulancia_model");

        $listaAmbulancias = $this->Ambulancias_model->obtenerAmbulancias();
        $listaMarcas = $this->Marcas_model->obtenerMarcas();
        $listaCombustibles = $this->Combustibles_model->obtenerTiposCombustibles();
        $listaTiposAmbulancias = $this->TipoAmbulancia_model->obtenerTiposAmbulancias();

        if ($listaAmbulancias->num_rows() > 0) {
            $listaAmbulancias = $listaAmbulancias->result();
        } else {
            $listaAmbulancias = array();
        }

        $data = array(
            "listaAmbulancias" => json_encode($listaAmbulancias),
            "listaMarcas" => $listaMarcas->result(),
            "listaCombustibles" => $listaCombustibles->result(),
            "listaTiposAmbulancias" => $listaTiposAmbulancias->result()

        );
        
        $this->load->view("ambulancias/main_ambulancias", $data);
                
    }
    public function guardarAmbulancia() {

        $this->load->model("Ambulancias_model");
        
        //ESTO TE FALTÓ

        $idambulancia = $this->input->post("idambulancia");
        $placa = $this->input->post("placa");
        $idmarca = $this->input->post("idmarca");
        $modelo = $this->input->post("modelo");
        $idtipocombustible = $this->input->post("idtipocombustible");
        $gps = $this->input->post("gps");
        $idtipoambulancia = $this->input->post("idtipoambulancia");
        $serie_motor = $this->input->post("serie_motor");
        $codigo_patrimonial = $this->input->post("codigo_patrimonial");
        $fabricacion_anio = $this->input->post("fabricacion_anio");
        $modelo_anio = $this->input->post("modelo_anio");
        $condicion = $this->input->post("condicion");
        $tarjeta = $this->input->post("tarjeta");
        $fotografia = $this->input->post("fotografia");

        //GRRR

        $this->Ambulancias_model->setidambulancia($idambulancia);
        $this->Ambulancias_model->setplaca ($placa);
        $this->Ambulancias_model->setidmarca ($idmarca);
        $this->Ambulancias_model->setmodelo ($modelo);
        $this->Ambulancias_model->setidtipocombustible ($idtipocombustible);
        $this->Ambulancias_model->setgps ($gps);
        $this->Ambulancias_model->setidtipoambulancia ($idtipoambulancia);
        $this->Ambulancias_model->setserie_motor ($serie_motor);
        $this->Ambulancias_model->setcodigo_patrimonial ($codigo_patrimonial);
        $this->Ambulancias_model->setfabricacion_anio ($fabricacion_anio);
        $this->Ambulancias_model->setmodelo_anio ($modelo_anio);
        $this->Ambulancias_model->setcondicion ($condicion);
        $this->Ambulancias_model->settarjeta ($tarjeta);
        $this->Ambulancias_model->setfotografia ($fotografia);

        $fotografia = $_FILES["file"];
       
        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        if ($idambulancia > 0) {
            if ($this->Bases_model->actualizarAmbulancia()) {
                $status = 200;
                $message = "Base actualizada exitosamente";
            }
        } else {
            if ($this->Bases_model->guardarAmbulancia()) {
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
	
}

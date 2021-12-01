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
        $this->load->model("Fichaatencion_model");
        $this->load->model("Marcas_model");
        $this->load->model("Combustibles_model");
        $this->load->model("TipoAmbulancia_model");
        

        $listaFichaAtencion = $this->Fichaatencion_model->obtenerFichaAtencion();
        $listaMarcas = $this->Marcas_model->obtenerMarcas();
        $listaCombustibles = $this->Combustibles_model->obtenerTiposCombustibles();
        $listaTiposAmbulancias = $this->TipoAmbulancia_model->obtenerTiposAmbulancias();

        if ($listaFichaAtencion->num_rows() > 0) {
            $listaFichaAtencion = $listaFichaAtencion->result();
        } else {
            $listaFichaAtencion = array();
        }

        $data = array(
            "listaFichaAtencion" => json_encode($listaFichaAtencion),
            "listaMarcas" => $listaMarcas->result(),
            "listaCombustibles" => $listaCombustibles->result(),
            "listaTiposAmbulancias" => $listaTiposAmbulancias->result()

        );
        
        $this->load->view("fichaatencion/main_fichaatencion", $data);
                
    }
    public function guardarAmbulancia() {

       $this->load->model("Ambulancias_model");
        
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
            if ($this->Ambulancias_model->actualizarAmbulancia()) {
                $status = 200;
                $message = "Base actualizada exitosamente";
            }
        } else {
            if ($this->Ambulancias_model->guardarAmbulancia()) {
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

    public function listaambulancias() {

        $this->load->model("Ambulancias_model");

        $listaAmbulancias = $this->Ambulancias_model->obtenerAmbulancias();
       
        if ($listaAmbulancias->num_rows() > 0) {
            $listaAmbulancias = $listaAmbulancias->result();
        } else {
            $listaAmbulancias = array();
        }

        $detalle = array(
          "listaAmbulancias" => $listaAmbulancias
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);

    }


    public function extraerAmbulancia() {

        $status;
        $this->load->model("Ambulancias_model");
        $this->load->model("Combustibles_model");
        $this->load->model("Marcas_model");
        $this->load->model("TipoAmbulancia_model");
        //$this->load->model("Ubigeo_model");
        //$this->load->model("Perfil_model");
        
        
        $this->Ambulancias_model->setplaca($this->input->post("placa"));
        
        $amb = $this->Ambulancias_model->extraerAmbulancia();
        $marca = $this->Marcas_model->obtenerMarcas();
        $tipoAmb = $this->TipoAmbulancia_model->obtenerTiposAmbulancias();
        $tipoComb = $this->Combustibles_model-> obtenerTiposCombustibles();
        //$regiones = $this->Ubigeo_model->obtenerRegiones();
        //$perfiles = $this->Perfil_model->obtenerPerfil();
       
        if ($amb->num_rows() > 0) {
            $status = 200;
            $amb = $amb->result();
            $marca = $marca->result();
            $tipoAmb = $tipoAmb->result();
            $tipoComb = $tipoComb->result();
        } else {
            $status = 500;
            $amb = array();
            $marca = array();
            $tipoAmb = array();
            $tipoComb = array();
        }

        $data = array(
            "status" => $status,
            "data" => $amb,
            "marca" => $marca,
            "tipo" => $tipoAmb,
            "comb" => $tipoComb
        );

        echo json_encode($data);

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

    public function curl()
    {
        $tipo_documento = $this->input->post("type");
        $documento = $this->input->post("document");
        $api = "http://mpi.minsa.gob.pe/api/v1/ciudadano/ver/";
        $token = "Bearer d90f5ad5d9c64268a00efaa4bd62a2a0";
        $handler = curl_init();

        curl_setopt($handler, CURLOPT_URL,  $api. $tipo_documento . "/" . $documento . "/");
        curl_setopt($handler, CURLOPT_HEADER, false);
        curl_setopt($handler, CURLOPT_HTTPHEADER, array(
            "Authorization: " . $token,
            "Content-Type: application/json"
        ));
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($handler);
        $code = curl_getinfo($handler, CURLINFO_HTTP_CODE);

        curl_close($handler);

        echo $data;

    }
	
}

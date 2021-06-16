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

        $foto = $_FILES["file"];
        /*
        if ($estado) {
           $estado = 1;
        } else {
           $estado = 0;
        }
        */
        $this->Bases_model->setidBase($idbase);
        $this->Bases_model->setNombre($nombre);
        $this->Bases_model->setDireccion($direccion);
        $this->Bases_model->setDepartamento($departamento);
        $this->Bases_model->setProvincia($provincia);
        $this->Bases_model->setDistrito($distrito);
        /*
        $this->Articulo_model->setPeso($peso);
        $this->Articulo_model->setIdColor($color);
        $this->Articulo_model->setIdClasificacion($clasificacion);
        $this->Articulo_model->setFichaTecnica($fichaTecnica);
        $this->Articulo_model->setMedida($medida);
        $this->Articulo_model->setEstado($estado);
        $this->Articulo_model->setObservacion($observacion);
        $this->Articulo_model->setUsuarioRegistro($this->session->userdata("idusuario"));
        */
        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        /*
        $dataFoto = $this->agregarFoto($foto);
        if($dataFoto["estado"] > 0){
            $this->Articulo_model->setImagen($dataFoto["foto"]);
        }
        $archivo = false;
        if (filesize($_FILES["ficha"]["tmp_name"])>0) {
            $archivo = $this->cargarArchivo($_FILES["ficha"], false, 0);
        }

        if ($archivo != false) {
            $this->Articulo_model->setFichaTecnica($archivo);
        }
        */
        
        if ($idbase > 0) {
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

}

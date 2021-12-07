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
        $listaDepartamentos = $this->Fichaatencion_model->listarDepartamentos();
        $listadocumento = $this->Fichaatencion_model->obtenerTipoDocumento();
        $listabase = $this->Fichaatencion_model->obtenerBases();
        $listaambulancia = $this->Fichaatencion_model->obtenerAmbulancias();
        $listaprioridademergencia = $this->Fichaatencion_model->obtenerPrioridademergencia();
        $listaTipoSeguro = $this->Fichaatencion_model->obtenerTipoSeguro();

        if ($listaFichaAtencion->num_rows() > 0) {
            $listaFichaAtencion = $listaFichaAtencion->result();
        } else {
            $listaFichaAtencion = array();
        }

        $data = array(
            "listaFichaAtencion" => json_encode($listaFichaAtencion),
            "listaMarcas" => $listaMarcas->result(),
            "listaCombustibles" => $listaCombustibles->result(),
            "listaTiposAmbulancias" => $listaTiposAmbulancias->result(),
            "listaDepartamentos" => $listaDepartamentos->result(),
            "listadocumento" => $listadocumento->result(),
            "listabase" => $listabase->result(),
            "listaambulancia" => $listaambulancia->result(),
            "listaprioridademergencia" => $listaprioridademergencia->result(),
            "listaTipoSeguro" => $listaTipoSeguro->result()
        );
        
        $this->load->view("fichaatencion/main_fichaatencion", $data);
                
    }
    public function guardarFichaAtencion() {

       $this->load->model("Fichaatencion_model");
       
       $departamento = $this->input->post("departamento");
       $provincia = $this->input->post("provincia");
       $distrito = $this->input->post("distrito");

       $idfichaatencion = $this->input->post("idfichaatencion");
       $idtiposeguro = $this->input->post("idtiposeguro");
       $seguro = $this->input->post("seguro");
       $idbase = $this->input->post("idbase");
       $idambulancia = $this->input->post("idambulancia");
       //$fecha_emision = formatearFechaParaBD($this->input->post("fecha_emision"));
       $fecha_ocurrencia = $this->input->post("fecha_ocurrencia");

       $despacho_ambulancia = $this->input->post("despacho_ambulancia");
       $salida_base = $this->input->post("salida_base");
       $llegada_foco = $this->input->post("llegada_foco");
       $salida_foco = $this->input->post("salida_foco");
       $llegada_base = $this->input->post("llegada_base");
       $lugar_atencion = $this->input->post("lugar_atencion");
       $motivo_emergencia = $this->input->post("motivo_emergencia");
       $idprioridademergencia = $this->input->post("idprioridademergencia");
       $fallecido = $this->input->post("fallecido");
       $idtipodocumento = $this->input->post("idtipodocumento");
       $numero_documento = $this->input->post("numero_documento");
       $paciente_apellidos = $this->input->post("paciente_apellidos");
       $paciente_nombes = $this->input->post("paciente_nombes");
       //$fecha_nacimiento = formatearFechaParaBD($this->input->post("fecha_nacimiento"));
       $fecha_nacimiento = $this->input->post("fecha_nacimiento");
       $edad_actual = $this->input->post("edad_actual");
       $sexo = $this->input->post("sexo");
       $direccion_atencion = $this->input->post("direccion_atencion");
       $ubigeo = $departamento . '' . $provincia . '' . $distrito;
       $referencia = $this->input->post("referencia");
       $latitud = $this->input->post("latitud");
       $longitud = $this->input->post("longitud");
       
       $deamb = explode(":", $despacho_ambulancia);        
       $horadeamb = $deamb[0] . " " . $deamb[1] . ":00";



       /*
       $d = explode("/", $fecha_ocurrencia);
       $fecha_ocu = $d[2] . "-" . $d[1] . "-" . $d[0];

       $f = explode("/", $fecha_nacimiento);
       $fecha_nac = $f[2] . "-" . $f[1] . "-" . $f[0];
       */

       $this->Fichaatencion_model->setidfichaatencion($idfichaatencion);
       $this->Fichaatencion_model->setidtiposeguro($idtiposeguro);
       $this->Fichaatencion_model->setseguro($seguro);
       $this->Fichaatencion_model->setidbase($idbase);
       $this->Fichaatencion_model->setidambulancia($idambulancia);
       //$this->Fichaatencion_model->setfecha_emision($fecha_emision);
       $this->Fichaatencion_model->setfecha_ocurrencia($fecha_ocurrencia);
       $this->Fichaatencion_model->setdespacho_ambulancia($horadeamb);
       $this->Fichaatencion_model->setsalida_base($salida_base);
       /*
       
       $this->Fichaatencion_model->setllegada_foco($llegada_foco);
       $this->Fichaatencion_model->setsalida_foco($salida_foco);
       $this->Fichaatencion_model->setllegada_base($llegada_base);
       $this->Fichaatencion_model->setlugar_atencion($lugar_atencion);
       $this->Fichaatencion_model->setmotivo_emergencia($motivo_emergencia);
       */
       $this->Fichaatencion_model->setidprioridademergencia($idprioridademergencia);
       /*
       $this->Fichaatencion_model->setfallecido($fallecido);
       */
       $this->Fichaatencion_model->setidtipodocumento($idtipodocumento);
       $this->Fichaatencion_model->setfecha_nacimiento($fecha_nacimiento);
       /*
       $this->Fichaatencion_model->setnumero_documento($numero_documento);
       $this->Fichaatencion_model->setpaciente_apellidos($paciente_apellidos);
       $this->Fichaatencion_model->setpaciente_nombes($paciente_nombes);
       
       $this->Fichaatencion_model->setedad_actual($edad_actual);
       $this->Fichaatencion_model->setsexo($sexo);
       $this->Fichaatencion_model->setdireccion_atencion($direccion_atencion);
       $this->Fichaatencion_model->setubigeo($ubigeo);
       $this->Fichaatencion_model->setreferencia($referencia);
       $this->Fichaatencion_model->setlatitud($latitud);
       $this->Fichaatencion_model->setlongitud($longitud);
       */
       
       //$fotografia = $_FILES["file"];
       
        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        if ($idfichaatencion > 0) {
            if ($this->Fichaatencion_model->actualizarFichaAtencion()) {
                $status = 200;
                $message = "Ficha de Atención actualizada exitosamente";
            }
        } else {
            if ($this->Fichaatencion_model->guardarFichaAtencion()) {
                $status = 200;
                $message = "Ficha de Atención registrada exitosamente";
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

    public function listarFichasAtencion(){
        
        $this->load->model("Usuarios_model");
        $this->load->model("Fichaatencion_model");

        $this->user = $this->session->userdata("token");
        $this->Usuarios_model->setIdUsuario($this->user->idusuario);
        $departamentos = $this->Usuarios_model->extraeRegionesUsuario();
        $fichaatencion = $this->Fichaatencion_model->obtenerFichaAtencion();
        
        $reg = array();
        $emerg = array();
        foreach($departamentos->result() as $row):
            //$this->Emergencias_model->setRegion($row->idregion);
            $listaFa = $this->Fichaatencion_model->obtenerFichaAtencion();
            if ($listaFa->num_rows() > 0) {
                foreach($listaFa->result_array() as $em):
                    $emerg[] = $em;
                endforeach;
                $reg[] = $row->idregion;
            }
        endforeach;

        $data = array(
            "listarFichasAtencion" => $emerg//,
            //"departamentos" => $departamentos->result()
        );

        if($this->input->post("actualiza"))
            echo json_encode($emerg);
        else
            return $data;
            
    }
	
}

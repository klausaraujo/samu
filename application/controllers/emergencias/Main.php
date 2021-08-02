<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
    private $user;

    public function index() {

        $this->load->model("Usuarios_model");
        $this->load->model("Emergencias_model");
        $this->load->model("Ubigeo_model");

        $this->user = $this->session->userdata("token");
        $this->Usuarios_model->setIdUsuario($this->user->idusuario);
        $departamentos = $this->Usuarios_model->extraeRegionesUsuario();

        $tipoLlamada = $this->Emergencias_model->tipoLlamada();
        $incid = $this->Emergencias_model->tipoIncidente();
        $prioriEm = $this->Emergencias_model->prioriEmergencia();
        //$departamentos = $this->Ubigeo_model->departamentos();
        $listaEm = $this->Emergencias_model->listarEmergencias();

        if ($listaEm->num_rows() > 0) {
            $listaEm = $listaEm->result();
        } else {
            $listaEm = array();
        }

        $data = array(
            "listaEmergencias" => json_encode($listaEm),
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
        $region;
        $prov;
        $dist;

        $dtz = new DateTimeZone("America/Lima");
        $dt = new DateTime("now", $dtz);
        $fechaActual = $dt->format("Y-m-d h:i:s a");

        $this->user = $this->session->userdata("token");
        $this->Emergencias_model->setIdUsuario($this->user->idusuario);
        $this->Emergencias_model->setFechaActual($fechaActual);
        
        //$this->Emergencias_model->setidEmergencia($this->input->post("idem"));
        $this->Emergencias_model->setTelf($this->input->post("tlf"));
        $this->Emergencias_model->setTelf2($this->input->post("tlf2"));
        $this->Emergencias_model->setTipoLlamada($this->input->post("tipoLl"));               
        $this->Emergencias_model->setTipoDoc($this->input->post("tipoDoc"));
        $this->Emergencias_model->setNroDoc($this->input->post("doc"));
        $this->Emergencias_model->setApellidos($this->input->post("apellidos"));
        $this->Emergencias_model->setNombres($this->input->post("nombres"));
        $this->Emergencias_model->setPaciente($this->input->post("sipaciente"));
        $this->Emergencias_model->setMasivo($this->input->post("simasivo"));
        $this->Emergencias_model->setFechaNac($this->input->post("fechNac"));
        $this->Emergencias_model->setDireccion($this->input->post("direccion"));
        $this->Emergencias_model->setLatitud($this->input->post("latitud"));
        $this->Emergencias_model->setLongitud($this->input->post("longitud"));
        $this->Emergencias_model->setTipoIncid($this->input->post("incidente"));
        $this->Emergencias_model->setFechaIncid($this->input->post("fechaIncid"));
        $this->Emergencias_model->setPrioridad($this->input->post("prioridad"));
        
        $region = (strlen($this->input->post("departamento")) < 2)? "0".$this->input->post("departamento") : $this->input->post("departamento");
        $prov = (strlen($this->input->post("provincia")) < 2)? "0".$this->input->post("provincia") : $this->input->post("provincia");
        $dist = (strlen($this->input->post("distrito")) < 2)? "0".$this->input->post("distrito") : $this->input->post("distrito");

        $this->Emergencias_model->setRegion($region);
        $this->Emergencias_model->setProvincia($prov);
        $this->Emergencias_model->setDistrito($dist);

        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        if ($this->input->post("act") > 0) {
            $this->Emergencias_model->setidEmergencia($this->input->post("idem"));
            if ($this->Emergencias_model->actualizarEmergencia()) {
                $status = 200;
                $message = "Emergencia actualizada exitosamente";
            }
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

    public function extraeEmergencia(){
        
        $this->load->model("Emergencias_model");
        $this->load->model("Ubigeo_model");
        $this->Emergencias_model->setidEmergencia($this->input->post("id"));
        $data = $this->Emergencias_model->extraeEmergencia();
        $tipoLlamada = $this->Emergencias_model->tipoLlamada();
        $incid = $this->Emergencias_model->tipoIncidente();
        $prioriEm = $this->Emergencias_model->prioriEmergencia();

        $pro = null;
        $dis = null;
        $status = 500;
        $msg = "";

        if ($data->num_rows() > 0) {
            $data = $data->result();
            foreach($data as $ub):
                if($ubic = $ub->ubigeo){
                    $this->Ubigeo_model->setcod_dep(substr($ubic,0,2));
                    $this->Ubigeo_model->setcod_pro(substr($ubic,2,2));
                    $pro = $this->Ubigeo_model->provincias();
                    $dis = $this->Ubigeo_model->distritos();
                }
            endforeach;
            $tipoLlamada = $tipoLlamada->result();
            $incid = $incid->result();
            $prioriEm = $prioriEm->result();
            $pro = $pro->result();
            $dis = $dis->result();
            $status = 200;
        } else {
            $data = array();
        }

        $data = array(
            "data" => $data[0],
            "status" => $status,
            "tipo" => $tipoLlamada,
            "incid" => $incid,
            "priori" => $prioriEm,
            "prov" => $pro,
            "dist" => $dis
        );

        echo json_encode($data);

    }

    public function listarEmergencias(){
        $this->load->model("Emergencias_model");

        $listaEm = $this->Emergencias_model->listarEmergencias();

        if ($listaEm->num_rows() > 0) {
            $listaEm = $listaEm->result();
        } else {
            $listaEm = array();
        }

        $data = array(
            "listaEmergencias" => $listaEm
        );

        echo json_encode($data);
    }
	
}
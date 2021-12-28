<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
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
        $listaArticulos = $this->Fichaatencion_model->obtenerArticulosFarmacia();
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

        if ($listaArticulos->num_rows() > 0) {
            $listaArticulos = $listaArticulos->result();
        } else {
            $listaArticulos = array();
        }

        $data = array(
            "listaFichaAtencion" => json_encode($listaFichaAtencion),
            "listaArticulos" => json_encode($listaArticulos),
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


       $patologias_previas = $this->input->post("patologias_previas");
       $fur = $this->input->post("fur");
       $fpp = $this->input->post("fpp");
       $medicacion = $this->input->post("medicacion");
       $fug = $this->input->post("fug");
       $g = $this->input->post("g");
       $p1 = $this->input->post("p1");
       $p2 = $this->input->post("p2");
       $p3 = $this->input->post("p3");
       $p4 = $this->input->post("p4");
       $alergias = $this->input->post("alergias");
       $otros = $this->input->post("otros");
       $enfermedad_dias = $this->input->post("enfermedad_dias");
       $enfermedad_horas = $this->input->post("enfermedad_horas");
       $enfermedad_minutos = $this->input->post("enfermedad_minutos");
       $enfermedad_inicio = $this->input->post("enfermedad_inicio");
       $enfermedad_curso = $this->input->post("enfermedad_curso");       
       $relato_evento = $this->input->post("relato_evento");     


       $examen_cabeza = $this->input->post("examen_cabeza");
       $examen_cuello = $this->input->post("examen_cuello");
       $examen_piel_tcsc = $this->input->post("examen_piel_tcsc");
       $examen_aparato_respiratorio = $this->input->post("examen_aparato_respiratorio");
       $examen_aparato_cardiovascular = $this->input->post("examen_aparato_cardiovascular");
       $examen_aparato_digestivo = $this->input->post("examen_aparato_digestivo");
       $examen_genito_urinario = $this->input->post("examen_genito_urinario");
       $examen_sistema_osteomioaticular = $this->input->post("examen_sistema_osteomioaticular");
       $examen_neurologico = $this->input->post("examen_neurologico");
 
       
       $tipo = $this->input->post("tipo");
       $temperaperatura = $this->input->post("temperaperatura");
       $frecuencia_cardiaca = $this->input->post("frecuencia_cardiaca");
       $presion_arterial = $this->input->post("presion_arterial");
       $frecuencia_respiratoria = $this->input->post("frecuencia_respiratoria");
       $saturacion_exigeno = $this->input->post("saturacion_exigeno");
       $glicemia = $this->input->post("glicemia");
       $glasgow_ocular = $this->input->post("glasgow_ocular");
       $glasgow_verbal = $this->input->post("glasgow_verbal");
       $glasgow_motora = $this->input->post("glasgow_motora");
       //$glasgow_total = $this->input->post("glasgow_total");
       $pupilas_tipo = $this->input->post("pupilas_tipo");
       $pupilas_reactiva = $this->input->post("pupilas_reactiva");
       

       $tipo_victima = $this->input->post("tipo_victima");
       $tipo_vehiculo = $this->input->post("tipo_vehiculo");
       $tipo_vehiculo_descripcion = $this->input->post("tipo_vehiculo_descripcion");
       $bolsa = $this->input->post("bolsa");
       $cinturon = $this->input->post("cinturon");
       $casco = $this->input->post("casco");
       $ropa = $this->input->post("ropa");
       $cinamatica = $this->input->post("cinamatica");
       $ubicacion = $this->input->post("ubicacion");

       $oxigenoterapia = $this->input->post("oxigenoterapia");
       $fluidoterapia = $this->input->post("fluidoterapia");
       $rcp = $this->input->post("rcp");
       $uso_dea = $this->input->post("uso_dea");
       $cardioversion = $this->input->post("cardioversion");
       $cardioversion_selectiva = $this->input->post("cardioversion_selectiva");
       $monitoreo_cardiaco = $this->input->post("monitoreo_cardiaco");
       $ventilacion_mecanica = $this->input->post("ventilacion_mecanica");
       $ippb = $this->input->post("ippb");
       $tratamiento_inhalacion = $this->input->post("tratamiento_inhalacion");
       $inmovilizacion_completa = $this->input->post("inmovilizacion_completa");
       $inmovilizacion_parcial = $this->input->post("inmovilizacion_parcial");
       $vendaje = $this->input->post("vendaje");
       $sondaje = $this->input->post("sondaje");
       $sedacion = $this->input->post("sedacion");
       $intubacion = $this->input->post("intubacion");
       $traqueostomia = $this->input->post("traqueostomia");
       $curacion = $this->input->post("curacion");
       $satura = $this->input->post("satura");
       $cuerpo_extrano = $this->input->post("cuerpo_extrano");
       $hemostacia = $this->input->post("hemostacia");
       $taponamiento_nasal = $this->input->post("taponamiento_nasal");
       $infusion_intraosea = $this->input->post("infusion_intraosea");
       $aspiracion_secreciones = $this->input->post("aspiracion_secreciones");
       $hemoglucotest = $this->input->post("hemoglucotest");
       $nebulizacion = $this->input->post("nebulizacion");
       $ocurrencias_atencion = $this->input->post("ocurrencias_atencion");
              
       $idtipodocumento_medico = $this->input->post("idtipodocumento_medico");
       $numero_documento_medico = $this->input->post("numero_documento_medico");
       $nombre_completo_medico = $this->input->post("nombre_completo_medico");
       $idtipodocumento_enfermero = $this->input->post("idtipodocumento_enfermero");
       $numero_documento_enfermero = $this->input->post("numero_documento_enfermero");
       $nombre_completo_enfermero = $this->input->post("nombre_completo_enfermero");
       $idtipodocumento_piloto = $this->input->post("idtipodocumento_piloto");
       $numero_documento_piloto = $this->input->post("numero_documento_piloto");
       $nombre_completo_piloto = $this->input->post("nombre_completo_piloto");
       $idtipodocumento_medico_regulador = $this->input->post("idtipodocumento_medico_regulador");
       $numero_documento_medico_regulador = $this->input->post("numero_documento_medico_regulador");
       $nombre_completo_medico_regulador = $this->input->post("nombre_completo_medico_regulador");
       $ficha_regulacion = $this->input->post("ficha_regulacion");
       $idtipodocumento_profesional_receptor = $this->input->post("idtipodocumento_profesional_receptor");
       $numero_documento_profesional_receptor = $this->input->post("numero_documento_profesional_receptor");
       $nombre_completo_profesional_receptor = $this->input->post("nombre_completo_profesional_receptor");
       $idtipodocumento_medico_receptor = $this->input->post("idtipodocumento_medico_receptor");
       $numero_documento_medico_receptor = $this->input->post("numero_documento_medico_receptor");
       $nombre_completo_medico_receptor = $this->input->post("nombre_completo_medico_receptor");
       $idrenipress = $this->input->post("idrenipress");
       $hora_llegada_es = $this->input->post("hora_llegada_es");
       $hora_recepcion_paciente = $this->input->post("hora_recepcion_paciente");
       $hora_salida_es = $this->input->post("hora_salida_es");
       $camilla_retenida = $this->input->post("camilla_retenida");
       $camilla_retenida_minutos = $this->input->post("camilla_retenida_minutos");
       $numero_colegiatura_medico = $this->input->post("numero_colegiatura_medico");
       $numero_colegiatura_enfermero = $this->input->post("numero_colegiatura_enfermero");
       $numero_licencia_piloto = $this->input->post("numero_licencia_piloto");
       $numero_colegiatura_medico_regulador = $this->input->post("numero_colegiatura_medico_regulador");
       $numero_colegiatura_medico_receptor = $this->input->post("numero_colegiatura_medico_receptor");
              

       $dosis = $this->input->post("dosis");
       $hora = $this->input->post("hora");
       $idarticulo = $this->input->post("idarticulo");

       $cie10lista = $this->input->post("cie10lista");
       //$momentolista = $this->input->post("momentolista");
       
       $this->Fichaatencion_model->setidfichaatencion($idfichaatencion);
       $this->Fichaatencion_model->setidtiposeguro($idtiposeguro);
       $this->Fichaatencion_model->setseguro($seguro);
       $this->Fichaatencion_model->setidbase($idbase);
       $this->Fichaatencion_model->setidambulancia($idambulancia);
       //$this->Fichaatencion_model->setfecha_emision($fecha_emision);
       $this->Fichaatencion_model->setfecha_ocurrencia($fecha_ocurrencia);
       $this->Fichaatencion_model->setdespacho_ambulancia($despacho_ambulancia);
       $this->Fichaatencion_model->setsalida_base($salida_base);      
       $this->Fichaatencion_model->setllegada_foco($llegada_foco);
       $this->Fichaatencion_model->setsalida_foco($salida_foco);
       $this->Fichaatencion_model->setllegada_base($llegada_base);
       $this->Fichaatencion_model->setlugar_atencion($lugar_atencion);
       $this->Fichaatencion_model->setmotivo_emergencia($motivo_emergencia);       
       $this->Fichaatencion_model->setidprioridademergencia($idprioridademergencia);       
       $this->Fichaatencion_model->setfallecido($fallecido);       
       $this->Fichaatencion_model->setidtipodocumento($idtipodocumento);
       $this->Fichaatencion_model->setfecha_nacimiento($fecha_nacimiento);       
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
       

       $this->Fichaatencion_model->setpatologias_previas($patologias_previas);
       $this->Fichaatencion_model->setfur($fur);
       $this->Fichaatencion_model->setfpp($fpp);
       $this->Fichaatencion_model->setmedicacion($medicacion);
       $this->Fichaatencion_model->setfug($fug);
       $this->Fichaatencion_model->setg($g);
       $this->Fichaatencion_model->setp1($p1);
       $this->Fichaatencion_model->setp2($p2);
       $this->Fichaatencion_model->setp3($p3);
       $this->Fichaatencion_model->setp4($p4);
       $this->Fichaatencion_model->setalergias($alergias);
       $this->Fichaatencion_model->setotros($otros);
       $this->Fichaatencion_model->setenfermedad_dias($enfermedad_dias);
       $this->Fichaatencion_model->setenfermedad_horas($enfermedad_horas);
       $this->Fichaatencion_model->setenfermedad_minutos($enfermedad_minutos);
       $this->Fichaatencion_model->setenfermedad_inicio($enfermedad_inicio);
       $this->Fichaatencion_model->setenfermedad_curso($enfermedad_curso);
       $this->Fichaatencion_model->setrelato_evento($relato_evento);


       $this->Fichaatencion_model->setexamen_cabeza($examen_cabeza);
       $this->Fichaatencion_model->setexamen_cuello($examen_cuello);
       $this->Fichaatencion_model->setexamen_piel_tcsc($examen_piel_tcsc);
       $this->Fichaatencion_model->setexamen_aparato_respiratorio($examen_aparato_respiratorio);
       $this->Fichaatencion_model->setexamen_aparato_cardiovascular($examen_aparato_cardiovascular);
       $this->Fichaatencion_model->setexamen_aparato_digestivo($examen_aparato_digestivo);
       $this->Fichaatencion_model->setexamen_genito_urinario($examen_genito_urinario);
       $this->Fichaatencion_model->setexamen_sistema_osteomioaticular($examen_sistema_osteomioaticular);
       $this->Fichaatencion_model->setexamen_neurologico($examen_neurologico);
       
       $this->Fichaatencion_model->settipo_victima($tipo_victima);
       $this->Fichaatencion_model->settipo_vehiculo($tipo_vehiculo);
       $this->Fichaatencion_model->settipo_vehiculo_descripcion($tipo_vehiculo_descripcion);
       $this->Fichaatencion_model->setbolsa($bolsa);
       $this->Fichaatencion_model->setcinturon($cinturon);
       $this->Fichaatencion_model->setcasco($casco);
       $this->Fichaatencion_model->setropa($ropa);
       $this->Fichaatencion_model->setcinamatica($cinamatica);
       $this->Fichaatencion_model->setubicacion($ubicacion);

       $this->Fichaatencion_model->setoxigenoterapia($oxigenoterapia);
       $this->Fichaatencion_model->setfluidoterapia($fluidoterapia);
       $this->Fichaatencion_model->setrcp($rcp);
       $this->Fichaatencion_model->setuso_dea($uso_dea);
       $this->Fichaatencion_model->setcardioversion($cardioversion);
       $this->Fichaatencion_model->setcardioversion_selectiva($cardioversion_selectiva);
       $this->Fichaatencion_model->setmonitoreo_cardiaco($monitoreo_cardiaco);
       $this->Fichaatencion_model->setventilacion_mecanica($ventilacion_mecanica);
       $this->Fichaatencion_model->setippb($ippb);
       $this->Fichaatencion_model->settratamiento_inhalacion($tratamiento_inhalacion);
       $this->Fichaatencion_model->setinmovilizacion_completa($inmovilizacion_completa);
       $this->Fichaatencion_model->setinmovilizacion_parcial($inmovilizacion_parcial);
       $this->Fichaatencion_model->setvendaje($vendaje);
       $this->Fichaatencion_model->setsondaje($sondaje);
       $this->Fichaatencion_model->setsedacion($sedacion);
       $this->Fichaatencion_model->setintubacion($intubacion);
       $this->Fichaatencion_model->settraqueostomia($traqueostomia);
       $this->Fichaatencion_model->setcuracion($curacion);
       $this->Fichaatencion_model->setsatura($satura);
       $this->Fichaatencion_model->setcuerpo_extrano($cuerpo_extrano);
       $this->Fichaatencion_model->sethemostacia($hemostacia);
       $this->Fichaatencion_model->settaponamiento_nasal($taponamiento_nasal);
       $this->Fichaatencion_model->setinfusion_intraosea($infusion_intraosea);
       $this->Fichaatencion_model->setaspiracion_secreciones($aspiracion_secreciones);
       $this->Fichaatencion_model->sethemoglucotest($hemoglucotest);
       $this->Fichaatencion_model->setnebulizacion($nebulizacion);
       $this->Fichaatencion_model->setocurrencias_atencion($ocurrencias_atencion);
       
       $this->Fichaatencion_model->setidtipodocumento_medico($idtipodocumento_medico);
       $this->Fichaatencion_model->setnumero_documento_medico($numero_documento_medico);
       $this->Fichaatencion_model->setidtipodocumento_enfermero($idtipodocumento_enfermero);
       $this->Fichaatencion_model->setnumero_documento_enfermero($numero_documento_enfermero);
       $this->Fichaatencion_model->setidtipodocumento_piloto($idtipodocumento_piloto);
       $this->Fichaatencion_model->setnumero_documento_piloto($numero_documento_piloto);
       $this->Fichaatencion_model->setidtipodocumento_medico_regulador($idtipodocumento_medico_regulador);
       $this->Fichaatencion_model->setnumero_documento_medico_regulador($numero_documento_medico_regulador);
       $this->Fichaatencion_model->setficha_regulacion($ficha_regulacion);
       $this->Fichaatencion_model->setidtipodocumento_profesional_receptor($idtipodocumento_profesional_receptor);
       $this->Fichaatencion_model->setnumero_documento_profesional_receptor($numero_documento_profesional_receptor);
       $this->Fichaatencion_model->setidtipodocumento_medico_receptor($idtipodocumento_medico_receptor);
       $this->Fichaatencion_model->setnumero_documento_medico_receptor($numero_documento_medico_receptor);
       $this->Fichaatencion_model->setidrenipress($idrenipress);
       $this->Fichaatencion_model->sethora_llegada_es($hora_llegada_es);
       $this->Fichaatencion_model->sethora_recepcion_paciente($hora_recepcion_paciente);
       $this->Fichaatencion_model->sethora_salida_es($hora_salida_es);
       $this->Fichaatencion_model->setcamilla_retenida($camilla_retenida);
       $this->Fichaatencion_model->setcamilla_retenida_minutos($camilla_retenida_minutos);
       $this->Fichaatencion_model->setnumero_colegiatura_medico($numero_colegiatura_medico);
       $this->Fichaatencion_model->setnumero_colegiatura_enfermero($numero_colegiatura_enfermero);
       $this->Fichaatencion_model->setnumero_licencia_piloto($numero_licencia_piloto);
       $this->Fichaatencion_model->setnumero_colegiatura_medico_regulador($numero_colegiatura_medico_regulador);
       $this->Fichaatencion_model->setnumero_colegiatura_medico_receptor($numero_colegiatura_medico_receptor);

       $this->Fichaatencion_model->setnombre_completo_medico($nombre_completo_medico);
       $this->Fichaatencion_model->setnombre_completo_enfermero($nombre_completo_enfermero);
       $this->Fichaatencion_model->setnombre_completo_piloto($nombre_completo_piloto);
       $this->Fichaatencion_model->setnombre_completo_medico_regulador($nombre_completo_medico_regulador);
       $this->Fichaatencion_model->setnombre_completo_profesional_receptor($nombre_completo_profesional_receptor);
       $this->Fichaatencion_model->setnombre_completo_medico_receptor($nombre_completo_medico_receptor);
              
       
       
       //$fotografia = $_FILES["file"];
       
        $status = 500;
        $message = "Error al registrar, vuelva a intentar";
        
        if ($idfichaatencion > 0) {
            if ($this->Fichaatencion_model->actualizarFichaAtencion()) {
                $status = 200;
                $message = "Ficha de Atención actualizada exitosamente";
            }
        } else {
            
            $id = $this->Fichaatencion_model->guardarFichaAtencion();

            if ($id > 0) {
                $this->Fichaatencion_model->setidfichaatencion($id);
                $this->Fichaatencion_model->guardarFichaAtencion_antecedentes();
                $this->Fichaatencion_model->guardarFichaAtencion_examen_fisico();
                //$this->Fichaatencion_model->guardarFichaAtencion_momento_evaluacion();
                $this->Fichaatencion_model->guardarFichaAtencion_mecanismo_lesion();
                $this->Fichaatencion_model->guardarFichaAtencion_procedimientos();
                $this->Fichaatencion_model->guardarFichaAtencion_tripulacion();

                $generateId = $this->crearCIE10($cie10lista, $id);
                //$generateId1 = $this->crearMomentoEvaluacion($momentolista, $id);
                $generateId1 = $this->crearMomentoEvaluacion($id, $tipo, $temperaperatura, $frecuencia_cardiaca, $presion_arterial, $frecuencia_respiratoria,
                $saturacion_exigeno, $glicemia, $glasgow_ocular, $glasgow_verbal, $glasgow_motora, $pupilas_tipo, $pupilas_reactiva);
                $generateId2 = $this->crearFichaMedicamentos($id, $dosis, $hora,$idarticulo);
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

    private function crearCIE10($cie10lista, $id) {
        //$alertapro = $this->Fichaatencion_model->crear2();
        /*
        if ( $alertapro > 0 ) 
        {*/
            $this->load->model("Fichaatencion_model");
            
            $cie10lista = explode("|", $cie10lista);
            foreach($cie10lista as $idcie10):
                $cie10 = $idcie10;
            $this->Fichaatencion_model->setidfichaatencion($id);
            $this->Fichaatencion_model->setcie10($cie10);
            $this->Fichaatencion_model->guardarFichaAtencion_cie10();
            endforeach;

            //$this->session->set_flashdata('messageOK', 'Aviso Registrado Correctamente');
            //return $alertapro;
        /*
        } else {
            $this->session->set_flashdata('messageError', 'No se pudo registrar el Aviso.');
            return 0;
        }*/

    }

    private function crearMomentoEvaluacion($id, $tipo, $temperaperatura, $frecuencia_cardiaca, $presion_arterial, $frecuencia_respiratoria,
    $saturacion_exigeno, $glicemia, $glasgow_ocular,  $glasgow_verbal, $glasgow_motora, $pupilas_tipo, $pupilas_reactiva) {
        //$alertapro = $this->Fichaatencion_model->crear2();
        /*
        if ( $alertapro > 0 ) 
        {*/
            $this->load->model("Fichaatencion_model");
            
            $tipo = explode("|", $tipo);
            $temperaperatura = explode("|", $temperaperatura);
            $frecuencia_cardiaca = explode("|", $frecuencia_cardiaca);
            $presion_arterial = explode("|", $presion_arterial);
            $frecuencia_respiratoria = explode("|", $frecuencia_respiratoria);
            $saturacion_exigeno = explode("|", $saturacion_exigeno);
            $glicemia = explode("|", $glicemia);
            $glasgow_ocular = explode("|", $glasgow_ocular);
            $glasgow_verbal = explode("|", $glasgow_verbal);
            $glasgow_motora = explode("|", $glasgow_motora);
            $pupilas_tipo = explode("|", $pupilas_tipo);
            $pupilas_reactiva = explode("|", $pupilas_reactiva);

            foreach($tipo as $key => $idmoment):

            $this->Fichaatencion_model->setidfichaatencion($id);
            $this->Fichaatencion_model->settipo($idmoment);
            $this->Fichaatencion_model->settemperaperatura($temperaperatura[$key]);
            $this->Fichaatencion_model->setfrecuencia_cardiaca($frecuencia_cardiaca[$key]);
            $this->Fichaatencion_model->setpresion_arterial($presion_arterial[$key]);
            $this->Fichaatencion_model->setfrecuencia_respiratoria($frecuencia_respiratoria[$key]);
            $this->Fichaatencion_model->setsaturacion_exigeno($saturacion_exigeno[$key]);
            $this->Fichaatencion_model->setglicemia($glicemia[$key]);
            $this->Fichaatencion_model->setglasgow_ocular($glasgow_ocular[$key]);
            $this->Fichaatencion_model->setglasgow_verbal($glasgow_verbal[$key]);
            $this->Fichaatencion_model->setglasgow_motora($glasgow_motora[$key]);
            $this->Fichaatencion_model->setpupilas_tipo($pupilas_tipo[$key]);
            $this->Fichaatencion_model->setpupilas_reactiva($pupilas_reactiva[$key]);
            $this->Fichaatencion_model->guardarFichaAtencion_momento_evaluacion();
            endforeach;
            
            //$this->session->set_flashdata('messageOK', 'Aviso Registrado Correctamente');
            //return $alertapro;
        /*
        } else {
            $this->session->set_flashdata('messageError', 'No se pudo registrar el Aviso.');
            return 0;
        }*/

    }

    private function crearFichaMedicamentos($id, $dosis, $hora, $idarticulo) {
        //$alertapro = $this->Fichaatencion_model->crear2();
        /*
        if ( $alertapro > 0 ) 
        {*/
            $this->load->model("Fichaatencion_model");
            
            $idarticulo = explode("|", $idarticulo);
            $dosis = explode("|", $dosis);
            $hora = explode("|", $hora);

            foreach($idarticulo as $key => $idficmed):

            $this->Fichaatencion_model->setidfichaatencion($id);
            $this->Fichaatencion_model->setidarticulo($idficmed);
            $this->Fichaatencion_model->setdosis($dosis[$key]);
            $this->Fichaatencion_model->sethora($hora[$key]);

            $this->Fichaatencion_model->guardarFichaAtencion_medicacion();
            endforeach;
            
            //$this->session->set_flashdata('messageOK', 'Aviso Registrado Correctamente');
            //return $alertapro;
        /*
        } else {
            $this->session->set_flashdata('messageError', 'No se pudo registrar el Aviso.');
            return 0;
        }*/

    }

    private function crearMomentoEvaluacion1($id, $tipo, $temperaperatura, $frecuencia_cardiaca, $presion_arterial, $frecuencia_respiratoria,
    $saturacion_exigeno, $glicemia, $glasgow_ocular,  $glasgow_verbal, $glasgow_motora, $pupilas_tipo, $pupilas_reactiva) {
        //$alertapro = $this->Fichaatencion_model->crear2();
        /*
        if ( $alertapro > 0 ) 
        {*/
            $this->load->model("Fichaatencion_model");
            
            $tipo = explode("|", $tipo);
            foreach($tipo as $tipo):
                $tipo = $tipo;
            
            $this->Fichaatencion_model->setidfichaatencion($id);
            $this->Fichaatencion_model->settipo($tipo[0]);

            $this->Fichaatencion_model->settemperaperatura($momentolista[1]);
            $this->Fichaatencion_model->setfrecuencia_cardiaca($momentolista[2]);
            $this->Fichaatencion_model->setpresion_arterial($momentolista[3]);
            $this->Fichaatencion_model->setfrecuencia_respiratoria($momentolista[4]);
            $this->Fichaatencion_model->setsaturacion_exigeno($momentolista[5]);
            $this->Fichaatencion_model->setglicemia($momentolista[6]);
            $this->Fichaatencion_model->setglasgow_ocular($momentolista[7]);
            $this->Fichaatencion_model->setglasgow_verbal($momentolista[8]);
            $this->Fichaatencion_model->setglasgow_motora($momentolista[9]);
            $this->Fichaatencion_model->setpupilas_tipo($momentolista[10]);
            $this->Fichaatencion_model->setpupilas_reactiva($momentolista[11]);

            $this->Fichaatencion_model->guardarFichaAtencion_momento_evaluacion();
            endforeach;

            //$this->session->set_flashdata('messageOK', 'Aviso Registrado Correctamente');
            //return $alertapro;
        /*
        } else {
            $this->session->set_flashdata('messageError', 'No se pudo registrar el Aviso.');
            return 0;
        }*/

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

    public function listaFichaAtencion(){
        
        $this->load->model("Fichaatencion_model");

        $fichaatencion = $this->Fichaatencion_model->obtenerFichaAtencion();
       
        if ($fichaatencion->num_rows() > 0) {
            $fichaatencion = $fichaatencion->result();
        } else {
            $fichaatencion = array();
        }

        $detalle = array(
          "listaFichaAtencion" => $fichaatencion
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
                   
    }

    public function listaArticulos(){
        
        $this->load->model("Fichaatencion_model");

        $listaArticulos = $this->Fichaatencion_model->obtenerArticulosFarmacia();
       
        if ($listaArticulos->num_rows() > 0) {
            $listaArticulos = $listaArticulos->result();
        } else {
            $listaArticulos = array();
        }

        $detalle = array(
          "listaArticulos" => $listaArticulos
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
                   
    }

    /* Inicio de obtención de info para Edición */

    public function obtener_Principal_Ficha(){
        $this->load->model("Fichaatencion_model");
        $this->Fichaatencion_model->setidfichaatencion($this->input->post("idfichaatencion"));

        $lista = $this->Fichaatencion_model->obtener_Principal_Ficha();
        $detalle = array(
            "lista" => $lista->num_rows()? $lista->result() : array()
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

    public function obtener_Antecedentes_Ficha(){
        $this->load->model("Fichaatencion_model");
        $this->Fichaatencion_model->setidfichaatencion($this->input->post("idfichaatencion"));

        $lista = $this->Fichaatencion_model->obtener_Antecedentes_Ficha();
        $detalle = array(
            "lista" => $lista->num_rows()? $lista->result() : array()
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

    public function obtener_Examen_Fisico_Ficha(){
        $this->load->model("Fichaatencion_model");
        $this->Fichaatencion_model->setidfichaatencion($this->input->post("idfichaatencion"));

        $lista = $this->Fichaatencion_model->obtener_Examen_Fisico_Ficha();
        $detalle = array(
            "lista" => $lista->num_rows()? $lista->result() : array()
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

    public function obtener_Momento_Evaluacion_Ficha(){
        $this->load->model("Fichaatencion_model");
        $this->Fichaatencion_model->setidfichaatencion($this->input->post("idfichaatencion"));

        $lista = $this->Fichaatencion_model->obtener_Momento_Evaluacion_Ficha();
        $detalle = array(
            "lista" => $lista->num_rows()? $lista->result() : array()
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

    public function obtener_Mecanismo_Lesion_Ficha(){
        $this->load->model("Fichaatencion_model");
        $this->Fichaatencion_model->setidfichaatencion($this->input->post("idfichaatencion"));

        $lista = $this->Fichaatencion_model->obtener_Mecanismo_Lesion_Ficha();
        $detalle = array(
            "lista" => $lista->num_rows()? $lista->result() : array()
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

    public function obtener_CIE10_Ficha(){
        $this->load->model("Fichaatencion_model");
        $this->Fichaatencion_model->setidfichaatencion($this->input->post("idfichaatencion"));

        $lista = $this->Fichaatencion_model->obtener_CIE10_Ficha();
        $detalle = array(
            "lista" => $lista->num_rows()? $lista->result() : array()
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

    public function obtener_Procedimientos_Ficha(){
        $this->load->model("Fichaatencion_model");
        $this->Fichaatencion_model->setidfichaatencion($this->input->post("idfichaatencion"));

        $lista = $this->Fichaatencion_model->obtener_Procedimientos_Ficha();
        $detalle = array(
            "lista" => $lista->num_rows()? $lista->result() : array()
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

    public function obtener_Medicacion_Ficha(){
        $this->load->model("Fichaatencion_model");
        $this->Fichaatencion_model->setidfichaatencion($this->input->post("idfichaatencion"));

        $lista = $this->Fichaatencion_model->obtener_Medicacion_Ficha();
        $detalle = array(
            "lista" => $lista->num_rows()? $lista->result() : array()
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

    public function obtener_Tripulacion_Ficha(){
        $this->load->model("Fichaatencion_model");
        $this->Fichaatencion_model->setidfichaatencion($this->input->post("idfichaatencion"));

        $lista = $this->Fichaatencion_model->obtener_Tripulacion_Ficha();
        $detalle = array(
            "lista" => $lista->num_rows()? $lista->result() : array()
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

    /* Fin de Obtención de Datps */

	
}

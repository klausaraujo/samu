<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Fichaatencion_model extends CI_Model
{
    private $idfichaatencion;
    private $idtiposeguro;
    private $seguro;
    private $idbase;
    private $idambulancia;
    private $fecha_emision;
    private $fecha_ocurrencia;
    private $despacho_ambulancia;
    private $salida_base;
    private $llegada_foco;
    private $salida_foco;
    private $llegada_base;
    private $lugar_atencion;
    private $motivo_emergencia;
    private $idprioridademergencia;
    private $fallecido;
    private $idtipodocumento;
    private $numero_documento;
    private $paciente_apellidos;
    private $paciente_nombes;
    private $fecha_nacimiento;
    private $edad_actual;
    private $sexo;
    private $direccion_atencion;
    private $ubigeo;
    private $referencia;
    private $latitud;
    private $longitud;

    private $patologias_previas;
    private $fur;
    private $fpp;
    private $medicacion;
    private $fug;
    private $g;
    private $p1;
    private $p2;
    private $p3;
    private $p4;
    private $alergias;
    private $otros;
    private $enfermedad_dias;
    private $enfermedad_horas;
    private $enfermedad_minutos;
    private $enfermedad_inicio;
    private $enfermedad_curso;
    private $relato_evento;

    private $examen_cabeza;
    private $examen_cuello;
    private $examen_piel_tcsc;
    private $examen_aparato_respiratorio;
    private $examen_aparato_cardiovascular;
    private $examen_aparato_digestivo;
    private $examen_genito_urinario;
    private $examen_sistema_osteomioaticular;
    private $examen_neurologico;

    private $tipo;
    private $temperaperatura;
    private $frecuencia_cardiaca;
    private $presion_arterial;
    private $frecuencia_respiratoria;
    private $saturacion_exigeno;
    private $glicemia;
    private $glasgow_ocular;
    private $glasgow_verbal;
    private $glasgow_motora;
    private $glasgow_total;
    private $pupilas_tipo;
    private $pupilas_reactiva;
        
    private $tipo_victima;
    private $tipo_vehiculo;
    private $tipo_vehiculo_descripcion;
    private $bolsa;
    private $cinturon;
    private $casco;
    private $ropa;
    private $cinamatica;
    private $ubicacion;
    
    private $oxigenoterapia;
    private $fluidoterapia;
    private $rcp;
    private $uso_dea;
    private $cardioversion;
    private $cardioversion_selectiva;
    private $monitoreo_cardiaco;
    private $ventilacion_mecanica;
    private $ippb;
    private $tratamiento_inhalacion;
    private $inmovilizacion_completa;
    private $inmovilizacion_parcial;
    private $vendaje;
    private $sondaje;
    private $sedacion;
    private $intubacion;
    private $traqueostomia;
    private $curacion;
    private $satura;
    private $cuerpo_extrano;
    private $hemostacia;
    private $taponamiento_nasal;
    private $infusion_intraosea;
    private $aspiracion_secreciones;
    private $hemoglucotest;
    private $nebulizacion;
    private $ocurrencias_atencion;
    
    private $idtipodocumento_medico;
    private $numero_documento_medico;
    private $nombre_completo_medico;
    private $idtipodocumento_enfermero;
    private $numero_documento_enfermero;
    private $nombre_completo_enfermero;    
    private $idtipodocumento_piloto;
    private $numero_documento_piloto;
    private $nombre_completo_piloto;
    private $idtipodocumento_medico_regulador;
    private $numero_documento_medico_regulador;
    private $nombre_completo_medico_regulador;
    private $ficha_regulacion;
    private $idtipodocumento_profesional_receptor;
    private $numero_documento_profesional_receptor;
    private $nombre_completo_profesional_receptor;
    private $idtipodocumento_medico_receptor;
    private $numero_documento_medico_receptor;
    private $nombre_completo_medico_receptor;
    private $idrenipress;
    private $hora_llegada_es;
    private $hora_recepcion_paciente;
    private $hora_salida_es;
    private $camilla_retenida;
    private $camilla_retenida_minutos;
    private $numero_colegiatura_medico;
    private $numero_colegiatura_enfermero;
    private $numero_licencia_piloto;
    private $numero_colegiatura_medico_regulador;
    private $numero_colegiatura_medico_receptor;
        

    private $idarticulo;
    private $dosis;
    private $hora;

    private $cie10;
    private $momentolista;
    
    public function setidfichaatencion($data){$this->idfichaatencion=$this->db->escape_str($data);}
    public function setidtiposeguro($data){$this->idtiposeguro=$this->db->escape_str($data);}
    public function setseguro($data){$this->seguro=$this->db->escape_str($data);}
    public function setidbase($data){$this->idbase=$this->db->escape_str($data);}
    public function setidambulancia($data){$this->idambulancia=$this->db->escape_str($data);}
    public function setfecha_emision($data){$this->fecha_emision=$this->db->escape_str($data);}
    public function setfecha_ocurrencia($data){$this->fecha_ocurrencia=$this->db->escape_str($data);}
    public function setdespacho_ambulancia($data){$this->despacho_ambulancia=$this->db->escape_str($data);}
    public function setsalida_base($data){$this->salida_base=$this->db->escape_str($data);}
    public function setllegada_foco($data){$this->llegada_foco=$this->db->escape_str($data);}
    public function setsalida_foco($data){$this->salida_foco=$this->db->escape_str($data);}
    public function setllegada_base($data){$this->llegada_base=$this->db->escape_str($data);}
    public function setlugar_atencion($data){$this->lugar_atencion=$this->db->escape_str($data);}
    public function setmotivo_emergencia($data){$this->motivo_emergencia=$this->db->escape_str($data);}
    public function setidprioridademergencia($data){$this->idprioridademergencia=$this->db->escape_str($data);}
    public function setfallecido($data){$this->fallecido=$this->db->escape_str($data);}
    public function setidtipodocumento($data){$this->idtipodocumento=$this->db->escape_str($data);}
    public function setnumero_documento($data){$this->numero_documento=$this->db->escape_str($data);}
    public function setpaciente_apellidos($data){$this->paciente_apellidos=$this->db->escape_str($data);}
    public function setpaciente_nombes($data){$this->paciente_nombes=$this->db->escape_str($data);}
    public function setfecha_nacimiento($data){$this->fecha_nacimiento=$this->db->escape_str($data);}
    public function setedad_actual($data){$this->edad_actual=$this->db->escape_str($data);}
    public function setsexo($data){$this->sexo=$this->db->escape_str($data);}
    public function setdireccion_atencion($data){$this->direccion_atencion=$this->db->escape_str($data);}
    public function setubigeo($data){$this->ubigeo=$this->db->escape_str($data);}
    public function setreferencia($data){$this->referencia=$this->db->escape_str($data);}
    public function setlatitud($data){$this->latitud=$this->db->escape_str($data);}
    public function setlongitud($data){$this->longitud=$this->db->escape_str($data);}

    public function setpatologias_previas($data){$this->patologias_previas=$this->db->escape_str($data);}
    public function setfur($data){$this->fur=$this->db->escape_str($data);}
    public function setfpp($data){$this->fpp=$this->db->escape_str($data);}
    public function setmedicacion($data){$this->medicacion=$this->db->escape_str($data);}
    public function setfug($data){$this->fug=$this->db->escape_str($data);}
    public function setg($data){$this->g=$this->db->escape_str($data);}
    public function setp1($data){$this->p1=$this->db->escape_str($data);}
    public function setp2($data){$this->p2=$this->db->escape_str($data);}
    public function setp3($data){$this->p3=$this->db->escape_str($data);}
    public function setp4($data){$this->p4=$this->db->escape_str($data);}
    public function setalergias($data){$this->alergias=$this->db->escape_str($data);}
    public function setotros($data){$this->otros=$this->db->escape_str($data);}
    public function setenfermedad_dias($data){$this->enfermedad_dias=$this->db->escape_str($data);}
    public function setenfermedad_horas($data){$this->enfermedad_horas=$this->db->escape_str($data);}
    public function setenfermedad_minutos($data){$this->enfermedad_minutos=$this->db->escape_str($data);}
    public function setenfermedad_inicio($data){$this->enfermedad_inicio=$this->db->escape_str($data);}
    public function setenfermedad_curso($data){$this->enfermedad_curso=$this->db->escape_str($data);}
    public function setrelato_evento($data){$this->relato_evento=$this->db->escape_str($data);}

    public function setexamen_cabeza($data){$this->examen_cabeza=$this->db->escape_str($data);}
    public function setexamen_cuello($data){$this->examen_cuello=$this->db->escape_str($data);}
    public function setexamen_piel_tcsc($data){$this->examen_piel_tcsc=$this->db->escape_str($data);}
    public function setexamen_aparato_respiratorio($data){$this->examen_aparato_respiratorio=$this->db->escape_str($data);}
    public function setexamen_aparato_cardiovascular($data){$this->examen_aparato_cardiovascular=$this->db->escape_str($data);}
    public function setexamen_aparato_digestivo($data){$this->examen_aparato_digestivo=$this->db->escape_str($data);}
    public function setexamen_genito_urinario($data){$this->examen_genito_urinario=$this->db->escape_str($data);}
    public function setexamen_sistema_osteomioaticular($data){$this->examen_sistema_osteomioaticular=$this->db->escape_str($data);}
    public function setexamen_neurologico($data){$this->examen_neurologico=$this->db->escape_str($data);}

    public function settipo($data){$this->tipo=$this->db->escape_str($data);}
    public function settemperaperatura($data){$this->temperaperatura=$this->db->escape_str($data);}
    public function setfrecuencia_cardiaca($data){$this->frecuencia_cardiaca=$this->db->escape_str($data);}
    public function setpresion_arterial($data){$this->presion_arterial=$this->db->escape_str($data);}
    public function setfrecuencia_respiratoria($data){$this->frecuencia_respiratoria=$this->db->escape_str($data);}
    public function setsaturacion_exigeno($data){$this->saturacion_exigeno=$this->db->escape_str($data);}
    public function setglicemia($data){$this->glicemia=$this->db->escape_str($data);}
    public function setglasgow_ocular($data){$this->glasgow_ocular=$this->db->escape_str($data);}
    public function setglasgow_verbal($data){$this->glasgow_verbal=$this->db->escape_str($data);}
    public function setglasgow_motora($data){$this->glasgow_motora=$this->db->escape_str($data);}
    public function setglasgow_total($data){$this->glasgow_total=$this->db->escape_str($data);}
    public function setpupilas_tipo($data){$this->pupilas_tipo=$this->db->escape_str($data);}
    public function setpupilas_reactiva($data){$this->pupilas_reactiva=$this->db->escape_str($data);}
    
    public function settipo_victima($data){$this->tipo_victima=$this->db->escape_str($data);}
    public function settipo_vehiculo($data){$this->tipo_vehiculo=$this->db->escape_str($data);}
    public function settipo_vehiculo_descripcion($data){$this->tipo_vehiculo_descripcion=$this->db->escape_str($data);}
    public function setbolsa($data){$this->bolsa=$this->db->escape_str($data);}
    public function setcinturon($data){$this->cinturon=$this->db->escape_str($data);}
    public function setcasco($data){$this->casco=$this->db->escape_str($data);}
    public function setropa($data){$this->ropa=$this->db->escape_str($data);}
    public function setcinamatica($data){$this->cinamatica=$this->db->escape_str($data);}
    public function setubicacion($data){$this->ubicacion=$this->db->escape_str($data);}

    public function setoxigenoterapia($data){$this->oxigenoterapia=$this->db->escape_str($data);}
    public function setfluidoterapia($data){$this->fluidoterapia=$this->db->escape_str($data);}
    public function setrcp($data){$this->rcp=$this->db->escape_str($data);}
    public function setuso_dea($data){$this->uso_dea=$this->db->escape_str($data);}
    public function setcardioversion($data){$this->cardioversion=$this->db->escape_str($data);}
    public function setcardioversion_selectiva($data){$this->cardioversion_selectiva=$this->db->escape_str($data);}
    public function setmonitoreo_cardiaco($data){$this->monitoreo_cardiaco=$this->db->escape_str($data);}
    public function setventilacion_mecanica($data){$this->ventilacion_mecanica=$this->db->escape_str($data);}
    public function setippb($data){$this->ippb=$this->db->escape_str($data);}
    public function settratamiento_inhalacion($data){$this->tratamiento_inhalacion=$this->db->escape_str($data);}
    public function setinmovilizacion_completa($data){$this->inmovilizacion_completa=$this->db->escape_str($data);}
    public function setinmovilizacion_parcial($data){$this->inmovilizacion_parcial=$this->db->escape_str($data);}
    public function setvendaje($data){$this->vendaje=$this->db->escape_str($data);}
    public function setsondaje($data){$this->sondaje=$this->db->escape_str($data);}
    public function setsedacion($data){$this->sedacion=$this->db->escape_str($data);}
    public function setintubacion($data){$this->intubacion=$this->db->escape_str($data);}
    public function settraqueostomia($data){$this->traqueostomia=$this->db->escape_str($data);}
    public function setcuracion($data){$this->curacion=$this->db->escape_str($data);}
    public function setsatura($data){$this->satura=$this->db->escape_str($data);}
    public function setcuerpo_extrano($data){$this->cuerpo_extrano=$this->db->escape_str($data);}
    public function sethemostacia($data){$this->hemostacia=$this->db->escape_str($data);}
    public function settaponamiento_nasal($data){$this->taponamiento_nasal=$this->db->escape_str($data);}
    public function setinfusion_intraosea($data){$this->infusion_intraosea=$this->db->escape_str($data);}
    public function setaspiracion_secreciones($data){$this->aspiracion_secreciones=$this->db->escape_str($data);}
    public function sethemoglucotest($data){$this->hemoglucotest=$this->db->escape_str($data);}
    public function setnebulizacion($data){$this->nebulizacion=$this->db->escape_str($data);}
    public function setocurrencias_atencion($data){$this->ocurrencias_atencion=$this->db->escape_str($data);}
        
    public function setidtipodocumento_medico($data){$this->idtipodocumento_medico=$this->db->escape_str($data);}
    public function setnumero_documento_medico($data){$this->numero_documento_medico=$this->db->escape_str($data);}
    public function setnombre_completo_medico($data){$this->nombre_completo_medico=$this->db->escape_str($data);}
    public function setidtipodocumento_enfermero($data){$this->idtipodocumento_enfermero=$this->db->escape_str($data);}
    public function setnumero_documento_enfermero($data){$this->numero_documento_enfermero=$this->db->escape_str($data);}
    public function setnombre_completo_enfermero($data){$this->nombre_completo_enfermero=$this->db->escape_str($data);}
    public function setidtipodocumento_piloto($data){$this->idtipodocumento_piloto=$this->db->escape_str($data);}
    public function setnumero_documento_piloto($data){$this->numero_documento_piloto=$this->db->escape_str($data);}
    public function setnombre_completo_piloto($data){$this->nombre_completo_piloto=$this->db->escape_str($data);}
    public function setidtipodocumento_medico_regulador($data){$this->idtipodocumento_medico_regulador=$this->db->escape_str($data);}
    public function setnumero_documento_medico_regulador($data){$this->numero_documento_medico_regulador=$this->db->escape_str($data);}
    public function setnombre_completo_medico_regulador($data){$this->nombre_completo_medico_regulador=$this->db->escape_str($data);}
    public function setficha_regulacion($data){$this->ficha_regulacion=$this->db->escape_str($data);}
    public function setidtipodocumento_profesional_receptor($data){$this->idtipodocumento_profesional_receptor=$this->db->escape_str($data);}
    public function setnumero_documento_profesional_receptor($data){$this->numero_documento_profesional_receptor=$this->db->escape_str($data);}
    public function setnombre_completo_profesional_receptor($data){$this->nombre_completo_profesional_receptor=$this->db->escape_str($data);}
    public function setidtipodocumento_medico_receptor($data){$this->idtipodocumento_medico_receptor=$this->db->escape_str($data);}
    public function setnumero_documento_medico_receptor($data){$this->numero_documento_medico_receptor=$this->db->escape_str($data);}
    public function setnombre_completo_medico_receptor($data){$this->nombre_completo_medico_receptor=$this->db->escape_str($data);}
    public function setidrenipress($data){$this->idrenipress=$this->db->escape_str($data);}
    public function sethora_llegada_es($data){$this->hora_llegada_es=$this->db->escape_str($data);}
    public function sethora_recepcion_paciente($data){$this->hora_recepcion_paciente=$this->db->escape_str($data);}
    public function sethora_salida_es($data){$this->hora_salida_es=$this->db->escape_str($data);}
    public function setcamilla_retenida($data){$this->camilla_retenida=$this->db->escape_str($data);}
    public function setcamilla_retenida_minutos($data){$this->camilla_retenida_minutos=$this->db->escape_str($data);}
    public function setnumero_colegiatura_medico($data){$this->numero_colegiatura_medico=$this->db->escape_str($data);}
    public function setnumero_colegiatura_enfermero($data){$this->numero_colegiatura_enfermero=$this->db->escape_str($data);}
    public function setnumero_licencia_piloto($data){$this->numero_licencia_piloto=$this->db->escape_str($data);}
    public function setnumero_colegiatura_medico_regulador($data){$this->numero_colegiatura_medico_regulador=$this->db->escape_str($data);}
    public function setnumero_colegiatura_medico_receptor($data){$this->numero_colegiatura_medico_receptor=$this->db->escape_str($data);}       

    public function setcie10($data){$this->cie10=$this->db->escape_str($data);}
    public function setmomentolista($data){$this->momentolista=$this->db->escape_str($data);}

    public function setidarticulo($data){$this->idarticulo=$this->db->escape_str($data);}
    public function setdosis($data){$this->dosis=$this->db->escape_str($data);}
    public function sethora($data){$this->hora=$this->db->escape_str($data);}
    

    public function obtenerFichaAtencion()
    {
        $this->db->select("fa.*, if(fa.activo = 1, 'Activo', 'Inactivo') as estado, td.tipo_documento, DATE_FORMAT(fa.fecha_nacimiento,'%d/%m/%Y') as fecha_nacimiento, DATE_FORMAT(fa.fecha_ocurrencia,'%d/%m/%Y') as fecha_ocurrencia ");
        $this->db->from("ficha_atencion fa, tipo_documento td");
        $this->db->where("fa.idtipodocumento = td.idtipodocumento");
        $this->db->order_by("fa.idfichaatencion desc");
        return $this->db->get();
        
    }
    public function obtenerTipoDocumento()
    {
        $this->db->select("l.*");
        $this->db->from("tipo_documento l");
        $this->db->order_by("l.idtipodocumento ASC");
        return $this->db->get();
        
    }
    public function obtenerBases()
    {
        $this->db->select("l.*");
        $this->db->from("base l");
        $this->db->order_by("l.idbase ASC");
        return $this->db->get();
        
    }
    public function obtenerAmbulancias()
    {
        $this->db->select("l.*");
        $this->db->from("ambulancia l");
        $this->db->order_by("l.idambulancia ASC");
        return $this->db->get();
        
    }
    public function obtenerPrioridademergencia()
    {
        $this->db->select("l.*");
        $this->db->from("prioridad_emergencia l");
        $this->db->order_by("l.idprioridademergencia ASC");
        return $this->db->get();
        
    }
    public function obtenerTipoSeguro()
    {
        $this->db->select("l.*");
        $this->db->from("tipo_seguro l");
        $this->db->order_by("l.idtiposeguro ASC");
        return $this->db->get();
        
    }

    public function obtenerArticulosFarmacia()
    {
        $this->db->select("l.*");
        $this->db->from("farmacia_articulo l");
        $this->db->order_by("l.idarticulo ASC");
        return $this->db->get();
        
    }


    public function guardarFichaAtencion()
    {
        $data = array(
            "idtiposeguro" => $this->idtiposeguro,
            "seguro" => $this->seguro,
            "idbase" => $this->idbase,
            "idambulancia" => $this->idambulancia,
            "fecha_emision" => $this->fecha_emision,
            "fecha_ocurrencia" => $this->fecha_ocurrencia,
            "despacho_ambulancia" => $this->despacho_ambulancia,
            "salida_base" => $this->salida_base,
            "llegada_foco" => $this->llegada_foco,
            "salida_foco" => $this->salida_foco,
            "llegada_base" => $this->llegada_base,
            "lugar_atencion" => $this->lugar_atencion,
            "motivo_emergencia" => $this->motivo_emergencia,
            "idprioridademergencia" => $this->idprioridademergencia,
            "fallecido" => $this->fallecido,
            "idtipodocumento" => $this->idtipodocumento,
            "numero_documento" => $this->numero_documento,
            "paciente_apellidos" => $this->paciente_apellidos,
            "paciente_nombes" => $this->paciente_nombes,
            "fecha_nacimiento" => $this->fecha_nacimiento,
            "edad_actual" => $this->edad_actual,
            "sexo" => $this->sexo,
            "direccion_atencion" => $this->direccion_atencion,
            "ubigeo" => $this->ubigeo,
            "referencia" => $this->referencia,
            "latitud" => $this->latitud,
            "longitud" => $this->longitud

        );
        if($this->db->insert("ficha_atencion", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }

    public function guardarFichaAtencion_antecedentes()
    {
        $data = array(
            
            "idfichaatencion" => $this->idfichaatencion,
            "patologias_previas" => $this->patologias_previas,
            "fur" => $this->fur,
            "fpp" => $this->fpp,
            "medicacion" => $this->medicacion,
            "fug" => $this->fug,
            "g" => $this->g,
            "p1" => $this->p1,
            "p2" => $this->p2,
            "p3" => $this->p3,
            "p4" => $this->p4,
            "alergias" => $this->alergias,
            "otros" => $this->otros,
            "enfermedad_dias" => $this->enfermedad_dias,
            "enfermedad_horas" => $this->enfermedad_horas,
            "enfermedad_minutos" => $this->enfermedad_minutos,
            "enfermedad_inicio" => $this->enfermedad_inicio,
            "enfermedad_curso" => $this->enfermedad_curso,
            "relato_evento" => $this->relato_evento

        );
        if($this->db->insert("ficha_atencion_antecedentes", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }

    public function guardarFichaAtencion_examen_fisico()
    {
        $data = array(
            
            "idfichaatencion" => $this->idfichaatencion,
            "examen_cabeza" => $this->examen_cabeza,
            "examen_cuello" => $this->examen_cuello,
            "examen_piel_tcsc" => $this->examen_piel_tcsc,
            "examen_aparato_respiratorio" => $this->examen_aparato_respiratorio,
            "examen_aparato_cardiovascular" => $this->examen_aparato_cardiovascular,
            "examen_aparato_digestivo" => $this->examen_aparato_digestivo,
            "examen_genito_urinario" => $this->examen_genito_urinario,
            "examen_sistema_osteomioaticular" => $this->examen_sistema_osteomioaticular,
            "examen_neurologico" => $this->examen_neurologico
        );
        if($this->db->insert("ficha_atencion_examen_fisico", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }

    public function guardarFichaAtencion_momento_evaluacion()
    {
        $data = array(
            
            "idfichaatencion" => $this->idfichaatencion,
            "tipo" => $this->tipo,
            "temperaperatura" => $this->temperaperatura,
            "frecuencia_cardiaca" => $this->frecuencia_cardiaca,
            "presion_arterial" => $this->presion_arterial,
            "frecuencia_respiratoria" => $this->frecuencia_respiratoria,
            "saturacion_exigeno" => $this->saturacion_exigeno,
            "glicemia" => $this->glicemia,
            "glasgow_ocular" => $this->glasgow_ocular,
            "glasgow_verbal" => $this->glasgow_verbal,
            "glasgow_motora" => $this->glasgow_motora,
            //"glasgow_total" => $this->glasgow_total,
            "pupilas_tipo" => $this->pupilas_tipo,
            "pupilas_reactiva" => $this->pupilas_reactiva

        );
        if($this->db->insert("ficha_atencion_momento_evaluacion", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }

    
    public function guardarFichaAtencion_medicacion()
    {
        $data = array(
            
            "idfichaatencion" => $this->idfichaatencion,
            "dosis" => $this->dosis,
            "hora" => $this->hora,
            "idarticulo" => $this->idarticulo

        );
        if($this->db->insert("ficha_atencion_medicacion", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }

    public function guardarFichaAtencion_mecanismo_lesion()
    {
        $data = array(
            
            "idfichaatencion" => $this->idfichaatencion,
            "tipo_victima" => $this->tipo_victima,
            "tipo_vehiculo" => $this->tipo_vehiculo,
            "tipo_vehiculo_descripcion" => $this->tipo_vehiculo_descripcion,
            "bolsa" => $this->bolsa,
            "cinturon" => $this->cinturon,
            "casco" => $this->casco,
            "ropa" => $this->ropa,
            "cinamatica" => $this->cinamatica,
            "ubicacion" => $this->ubicacion          
                        
        );
        if($this->db->insert("ficha_atencion_mecanismo_lesion", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }

    public function guardarFichaAtencion_procedimientos()
    {
        $data = array(
            
            "idfichaatencion" => $this->idfichaatencion,
            "oxigenoterapia" => $this->oxigenoterapia,
            "fluidoterapia" => $this->fluidoterapia,
            "rcp" => $this->rcp,
            "uso_dea" => $this->uso_dea,
            "cardioversion" => $this->cardioversion,
            "cardioversion_selectiva" => $this->cardioversion_selectiva,
            "monitoreo_cardiaco" => $this->monitoreo_cardiaco,
            "ventilacion_mecanica" => $this->ventilacion_mecanica,
            "ippb" => $this->ippb,
            "tratamiento_inhalacion" => $this->tratamiento_inhalacion,
            "inmovilizacion_completa" => $this->inmovilizacion_completa,
            "inmovilizacion_parcial" => $this->inmovilizacion_parcial,
            "vendaje" => $this->vendaje,
            "sondaje" => $this->sondaje,
            "sedacion" => $this->sedacion,
            "intubacion" => $this->intubacion,
            "traqueostomia" => $this->traqueostomia,
            "curacion" => $this->curacion,
            "satura" => $this->satura,
            "cuerpo_extrano" => $this->cuerpo_extrano,
            "hemostacia" => $this->hemostacia,
            "taponamiento_nasal" => $this->taponamiento_nasal,
            "infusion_intraosea" => $this->infusion_intraosea,
            "aspiracion_secreciones" => $this->aspiracion_secreciones,
            "hemoglucotest" => $this->hemoglucotest,
            "nebulizacion" => $this->nebulizacion,
            "ocurrencias_atencion" => $this->ocurrencias_atencion
                        
        );
        if($this->db->insert("ficha_atencion_procedimientos", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }

    public function guardarFichaAtencion_tripulacion()
    {
        $data = array(
            
            "idfichaatencion" => $this->idfichaatencion,
            "idtipodocumento_medico" => $this->idtipodocumento_medico,
            "numero_documento_medico" => $this->numero_documento_medico,
            "nombre_completo_medico" => $this->nombre_completo_medico,
            "idtipodocumento_enfermero" => $this->idtipodocumento_enfermero,
            "numero_documento_enfermero" => $this->numero_documento_enfermero,
            "nombre_completo_enfermero" => $this->nombre_completo_enfermero,
            "idtipodocumento_piloto" => $this->idtipodocumento_piloto,
            "numero_documento_piloto" => $this->numero_documento_piloto,
            "nombre_completo_piloto" => $this->nombre_completo_piloto,
            "idtipodocumento_medico_regulador" => $this->idtipodocumento_medico_regulador,
            "numero_documento_medico_regulador" => $this->numero_documento_medico_regulador,
            "nombre_completo_medico_regulador" => $this->nombre_completo_medico_regulador,
            "ficha_regulacion" => $this->ficha_regulacion,
            "idtipodocumento_profesional_receptor" => $this->idtipodocumento_profesional_receptor,
            "numero_documento_profesional_receptor" => $this->numero_documento_profesional_receptor,
            "nombre_completo_profesional_receptor" => $this->nombre_completo_profesional_receptor,
            "idtipodocumento_medico_receptor" => $this->idtipodocumento_medico_receptor,
            "numero_documento_medico_receptor" => $this->numero_documento_medico_receptor,
            "nombre_completo_medico_receptor" => $this->nombre_completo_medico_receptor,
            "idrenipress" => $this->idrenipress,
            "hora_llegada_es" => $this->hora_llegada_es,
            "hora_recepcion_paciente" => $this->hora_recepcion_paciente,
            "hora_salida_es" => $this->hora_salida_es,
            "camilla_retenida" => $this->camilla_retenida,
            "camilla_retenida_minutos" => $this->camilla_retenida_minutos,
            "numero_colegiatura_medico" => $this->numero_colegiatura_medico,
            "numero_colegiatura_enfermero" => $this->numero_colegiatura_enfermero,
            "numero_licencia_piloto" => $this->numero_licencia_piloto,
            "numero_colegiatura_medico_regulador" => $this->numero_colegiatura_medico_regulador,
            "numero_colegiatura_medico_receptor" => $this->numero_colegiatura_medico_receptor
        );
        if($this->db->insert("ficha_atencion_tripulacion", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }

    public function guardarFichaAtencion_cie10()
    {
        $data = array(
            
            "idfichaatencion" => $this->idfichaatencion,
            "cie10" => $this->cie10  
                        
        );
        if($this->db->insert("ficha_atencion_cie10", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }

    public function actualizarFichaAtencion()
    {
        $data = array(

            "idtiposeguro" => $this->idtiposeguro,
            "seguro" => $this->seguro,
            "idbase" => $this->idbase,
            "idambulancia" => $this->idambulancia,
            "fecha_emision" => $this->fecha_emision,
            "fecha_ocurrencia" => $this->fecha_ocurrencia,
            "despacho_ambulancia" => $this->despacho_ambulancia,
            "salida_base" => $this->salida_base,
            "llegada_foco" => $this->llegada_foco,
            "salida_foco" => $this->salida_foco,
            "llegada_base" => $this->llegada_base,
            "lugar_atencion" => $this->lugar_atencion,
            "motivo_emergencia" => $this->motivo_emergencia,
            "idprioridademergencia" => $this->idprioridademergencia,
            "fallecido" => $this->fallecido,
            "idtipodocumento" => $this->idtipodocumento,
            "numero_documento" => $this->numero_documento,
            "paciente_apellidos" => $this->paciente_apellidos,
            "paciente_nombes" => $this->paciente_nombes,
            "fecha_nacimiento" => $this->fecha_nacimiento,
            "edad_actual" => $this->edad_actual,
            "sexo" => $this->sexo,
            "direccion_atencion" => $this->direccion_atencion,
            "ubigeo" => $this->ubigeo,
            "referencia" => $this->referencia,
            "latitud" => $this->latitud,
            "longitud" => $this->longitud
        );
        $this->db->where("idfichaatencion",$this->idfichaatencion);
        $result = $this->db->update("ficha_atencion", $data);
        if($result) return true;
        else return false;
    }

    public function actualizarFichaAtencion_antecedentes()
    {
        $data = array(

            "patologias_previas" => $this->patologias_previas,
            "fur" => $this->fur,
            "fpp" => $this->fpp,
            "medicacion" => $this->medicacion,
            "fug" => $this->fug,
            "g" => $this->g,
            "p1" => $this->p1,
            "p2" => $this->p2,
            "p3" => $this->p3,
            "p4" => $this->p4,
            "alergias" => $this->alergias,
            "otros" => $this->otros,
            "enfermedad_dias" => $this->enfermedad_dias,
            "enfermedad_horas" => $this->enfermedad_horas,
            "enfermedad_minutos" => $this->enfermedad_minutos,
            "enfermedad_inicio" => $this->enfermedad_inicio,
            "enfermedad_curso" => $this->enfermedad_curso,
            "relato_evento" => $this->relato_evento

        );
        $this->db->where("idfichaatencion",$this->idfichaatencion);
        $result = $this->db->update("ficha_atencion_antecedentes", $data);
        if($result) return true;
        else return false;
    }

    public function actualizarFichaAtencion_examen_fisico()
    {
        $data = array(

            "examen_cabeza" => $this->examen_cabeza,
            "examen_cuello" => $this->examen_cuello,
            "examen_piel_tcsc" => $this->examen_piel_tcsc,
            "examen_aparato_respiratorio" => $this->examen_aparato_respiratorio,
            "examen_aparato_cardiovascular" => $this->examen_aparato_cardiovascular,
            "examen_aparato_digestivo" => $this->examen_aparato_digestivo,
            "examen_genito_urinario" => $this->examen_genito_urinario,
            "examen_sistema_osteomioaticular" => $this->examen_sistema_osteomioaticular,
            "examen_neurologico" => $this->examen_neurologico

        );
        $this->db->where("idfichaatencion",$this->idfichaatencion);
        $result = $this->db->update("ficha_atencion_examen_fisico", $data);
        if($result) return true;
        else return false;
    }

    public function actualizarFichaAtencion_mecanismo_lesion()
    {
        $data = array(

            "tipo_victima" => $this->tipo_victima,
            "tipo_vehiculo" => $this->tipo_vehiculo,
            "tipo_vehiculo_descripcion" => $this->tipo_vehiculo_descripcion,
            "bolsa" => $this->bolsa,
            "cinturon" => $this->cinturon,
            "casco" => $this->casco,
            "ropa" => $this->ropa,
            "cinamatica" => $this->cinamatica,
            "ubicacion" => $this->ubicacion 

        );
        $this->db->where("idfichaatencion",$this->idfichaatencion);
        $result = $this->db->update("ficha_atencion_mecanismo_lesion", $data);
        if($result) return true;
        else return false;
    }

    
    public function actualizarFichaAtencion_procedimientos()
    {
        $data = array(

            "oxigenoterapia" => $this->oxigenoterapia,
            "fluidoterapia" => $this->fluidoterapia,
            "rcp" => $this->rcp,
            "uso_dea" => $this->uso_dea,
            "cardioversion" => $this->cardioversion,
            "cardioversion_selectiva" => $this->cardioversion_selectiva,
            "monitoreo_cardiaco" => $this->monitoreo_cardiaco,
            "ventilacion_mecanica" => $this->ventilacion_mecanica,
            "ippb" => $this->ippb,
            "tratamiento_inhalacion" => $this->tratamiento_inhalacion,
            "inmovilizacion_completa" => $this->inmovilizacion_completa,
            "inmovilizacion_parcial" => $this->inmovilizacion_parcial,
            "vendaje" => $this->vendaje,
            "sondaje" => $this->sondaje,
            "sedacion" => $this->sedacion,
            "intubacion" => $this->intubacion,
            "traqueostomia" => $this->traqueostomia,
            "curacion" => $this->curacion,
            "satura" => $this->satura,
            "cuerpo_extrano" => $this->cuerpo_extrano,
            "hemostacia" => $this->hemostacia,
            "taponamiento_nasal" => $this->taponamiento_nasal,
            "infusion_intraosea" => $this->infusion_intraosea,
            "aspiracion_secreciones" => $this->aspiracion_secreciones,
            "hemoglucotest" => $this->hemoglucotest,
            "nebulizacion" => $this->nebulizacion,
            "ocurrencias_atencion" => $this->ocurrencias_atencion 

        );
        $this->db->where("idfichaatencion",$this->idfichaatencion);
        $result = $this->db->update("ficha_atencion_procedimientos", $data);
        if($result) return true;
        else return false;
    }

    public function actualizarFichaAtencion_tripulacion()
    {
        $data = array(

            "idtipodocumento_medico" => $this->idtipodocumento_medico,
            "numero_documento_medico" => $this->numero_documento_medico,
            "nombre_completo_medico" => $this->nombre_completo_medico,
            "idtipodocumento_enfermero" => $this->idtipodocumento_enfermero,
            "numero_documento_enfermero" => $this->numero_documento_enfermero,
            "nombre_completo_enfermero" => $this->nombre_completo_enfermero,
            "idtipodocumento_piloto" => $this->idtipodocumento_piloto,
            "numero_documento_piloto" => $this->numero_documento_piloto,
            "nombre_completo_piloto" => $this->nombre_completo_piloto,
            "idtipodocumento_medico_regulador" => $this->idtipodocumento_medico_regulador,
            "numero_documento_medico_regulador" => $this->numero_documento_medico_regulador,
            "nombre_completo_medico_regulador" => $this->nombre_completo_medico_regulador,
            "ficha_regulacion" => $this->ficha_regulacion,
            "idtipodocumento_profesional_receptor" => $this->idtipodocumento_profesional_receptor,
            "numero_documento_profesional_receptor" => $this->numero_documento_profesional_receptor,
            "nombre_completo_profesional_receptor" => $this->nombre_completo_profesional_receptor,
            "idtipodocumento_medico_receptor" => $this->idtipodocumento_medico_receptor,
            "numero_documento_medico_receptor" => $this->numero_documento_medico_receptor,
            "nombre_completo_medico_receptor" => $this->nombre_completo_medico_receptor,
            "idrenipress" => $this->idrenipress,
            "hora_llegada_es" => $this->hora_llegada_es,
            "hora_recepcion_paciente" => $this->hora_recepcion_paciente,
            "hora_salida_es" => $this->hora_salida_es,
            "camilla_retenida" => $this->camilla_retenida,
            "camilla_retenida_minutos" => $this->camilla_retenida_minutos,
            "numero_colegiatura_medico" => $this->numero_colegiatura_medico,
            "numero_colegiatura_enfermero" => $this->numero_colegiatura_enfermero,
            "numero_licencia_piloto" => $this->numero_licencia_piloto,
            "numero_colegiatura_medico_regulador" => $this->numero_colegiatura_medico_regulador,
            "numero_colegiatura_medico_receptor" => $this->numero_colegiatura_medico_receptor

        );
        $this->db->where("idfichaatencion",$this->idfichaatencion);
        $result = $this->db->update("ficha_atencion_tripulacion", $data);
        if($result) return true;
        else return false;
    }

    public function actualizarAmbulancia()
    {
        $data = array(
            "placa" => $this->placa,
            "idmarca" => $this->idmarca,
            "modelo" => $this->modelo,
            "idtipocombustible" => $this->idtipocombustible,
            "gps" => $this->gps,
            "idtipoambulancia" => $this->idtipoambulancia,
            "serie_motor" => $this->serie_motor,
            "codigo_patrimonial" => $this->codigo_patrimonial,
            "fabricacion_anio" => $this->fabricacion_anio,
            "modelo_anio" => $this->modelo_anio,
            "condicion" => $this->condicion,
            "tarjeta" => $this->tarjeta,
            "fotografia" => $this->fotografia
        );
        $this->db->where("idambulancia",$this->idambulancia);
        $result = $this->db->update("ambulancia", $data);
        if($result) return true;
        else return false;
    }

    public function extraerAmbulancia(){
        $this->db->select("*");
        $this->db->from("lista_ambulancias");
        $this->db->where("placa", $this->placa);
        return $this->db->get();
    }
    
    public function listarDepartamentos(){
        $this->db->select("cod_dep as idregion, departamento as region");
        $this->db->from("lista_departamentos");
        return $this->db->get();
    }

    /* Inicio de obtención de info para Edición */

    public function obtener_Principal_Ficha()
    {
        $this->db->select("fa.*, if(fa.activo = 1, 'Activo', 'Inactivo') as estado, td.tipo_documento, DATE_FORMAT(fa.fecha_nacimiento,'%Y/%m/%d') as fecha_nacimiento, DATE_FORMAT(fa.fecha_ocurrencia,'%Y/%m/%d') as fecha_ocurrencia ");
        $this->db->from("ficha_atencion fa, tipo_documento td");
        $this->db->where("fa.idtipodocumento = td.idtipodocumento");
        $this->db->where("fa.idfichaatencion", $this->idfichaatencion);
        return $this->db->get();
    }

    public function obtener_Antecedentes_Ficha()
    {
        $this->db->select("faa.*");
        $this->db->from("ficha_atencion_antecedentes faa");
        //$this->db->join("lista_articulos_busqueda_farmacia iar","fid.idarticulo = iar.idarticulo");
        $this->db->where("faa.idfichaatencion", $this->idfichaatencion);
        return $this->db->get();
    }

    public function obtener_Examen_Fisico_Ficha()
    {
        $this->db->select("faef.*");
        $this->db->from("ficha_atencion_examen_fisico faef");
        //$this->db->join("lista_articulos_busqueda_farmacia iar","fid.idarticulo = iar.idarticulo");
        $this->db->where("faef.idfichaatencion", $this->idfichaatencion);
        return $this->db->get();
    }

    public function obtener_CIE10_Ficha()
    {
        $this->db->select("fac.*, c1.descripcion_cie10 as descripcion, activo as editar");
        $this->db->from("ficha_atencion_cie10 fac");
        $this->db->join("cie10 c1","c1.cie10 = fac.cie10");
        $this->db->where("fac.idfichaatencion", $this->idfichaatencion);
        return $this->db->get();
    }

    public function obtener_Mecanismo_Lesion_Ficha()
    {
        $this->db->select("faml.*");
        $this->db->from("ficha_atencion_mecanismo_lesion faml");
        //$this->db->join("lista_articulos_busqueda_farmacia iar","fid.idarticulo = iar.idarticulo");
        $this->db->where("faml.idfichaatencion", $this->idfichaatencion);
        return $this->db->get();
    }

    public function obtener_Medicacion_Ficha()
    {
        $this->db->select("fam.*, fa.descripcion, fp.descripcion as via");
        $this->db->from("ficha_atencion_medicacion fam");
        $this->db->join("farmacia_articulo fa","fa.idarticulo = fam.idarticulo");
        $this->db->join("farmacia_presentacion fp","fa.idpresentacion = fp.idpresentacion");
        $this->db->where("fam.idfichaatencion", $this->idfichaatencion);
        return $this->db->get();
    }

    public function obtener_Momento_Evaluacion_Ficha()
    {
        $this->db->select("fame.*, case fame.tipo when '1' then 'Inicial' when '2' then 'Traslado' when '3' then 'Llegada' end as tipo_text, ");
        $this->db->select("case fame.glasgow_ocular when '1' then 'Ninguna' when '2' then 'Dolor' when '3' then 'Voz' when '4' then 'Espontánea' end as glasgow_ocular_text,");
        $this->db->select("case fame.glasgow_verbal when '1' then 'Ninguna' when '2' then 'Sonidos' when '3' then 'Inapropiada' when '4' then 'Confusa' when '5' then 'Orientada' end as glasgow_verbal_text,");
        $this->db->select("case fame.glasgow_motora when '1' then 'Ninguna' when '2' then 'Extensión' when '3' then 'Flexión' when '4' then 'Retirada' when '5' then 'Localiza' when '6' then 'Obedece' end as glasgow_motora_text,");
        $this->db->select("case fame.pupilas_tipo when '1' then 'Izquierdo' when '2' then 'Derecho' end as pupilas_tipo_text,");
        $this->db->select("case fame.pupilas_reactiva when '1' then 'SI' when '2' then 'NO' end as pupilas_reactiva_text");
        $this->db->from("ficha_atencion_momento_evaluacion fame");
        //$this->db->join("lista_articulos_busqueda_farmacia iar","fid.idarticulo = iar.idarticulo");
        $this->db->where("fame.idfichaatencion", $this->idfichaatencion);
        return $this->db->get();
    }

    public function obtener_Procedimientos_Ficha()
    {
        $this->db->select("fap.*");
        $this->db->from("ficha_atencion_procedimientos fap");
        //$this->db->join("lista_articulos_busqueda_farmacia iar","fid.idarticulo = iar.idarticulo");
        $this->db->where("fap.idfichaatencion", $this->idfichaatencion);
        return $this->db->get();
    }

    public function obtener_Tripulacion_Ficha()
    {
        $this->db->select("fat.*");
        $this->db->from("ficha_atencion_tripulacion fat");
        //$this->db->join("lista_articulos_busqueda_farmacia iar","fid.idarticulo = iar.idarticulo");
        $this->db->where("fat.idfichaatencion", $this->idfichaatencion);
        return $this->db->get();
    }

    public function obtener_Zona_Afectada_Ficha()
    {
        $this->db->select("faza.*");
        $this->db->from("ficha_atencion_zona_afecada faza");
        //$this->db->join("lista_articulos_busqueda_farmacia iar","fid.idarticulo = iar.idarticulo");
        $this->db->where("faza.idfichaatencion", $this->idfichaatencion);
        return $this->db->get();
    }

    /* Fin de Obtención de Datps */

    public function eliminarMomentoEvaluacion()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("idfichaatencion", $this->idfichaatencion);
        $error = array();
        if ($this->db->delete('ficha_atencion_momento_evaluacion'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }

    public function eliminarCIE10()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("idfichaatencion", $this->idfichaatencion);
        $error = array();
        if ($this->db->delete('ficha_atencion_cie10'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }

    public function eliminarFichaMedicamentos()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("idfichaatencion", $this->idfichaatencion);
        $error = array();
        if ($this->db->delete('ficha_atencion_medicacion'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
}


    
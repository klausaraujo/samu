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


    public function obtenerFichaAtencion()
    {
        $this->db->select("l.*");
        $this->db->from("ficha_atencion l");
        $this->db->order_by("l.idfichaatencion desc");
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
}


    
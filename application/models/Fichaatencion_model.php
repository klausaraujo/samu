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

    public function obtenerFichaAtencion()
    {
        $this->db->select("l.*");
        $this->db->from("ficha_atencion l");
        $this->db->order_by("l.idfichaatencion ASC");
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


    
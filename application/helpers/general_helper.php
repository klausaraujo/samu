<?php

if (! defined('BASEPATH'))
    exit('No direct script access allowed');

if (! function_exists('is_logged')) {

    // VERIFICA SI
    function is_logged()
    {
        $CI = & get_instance();

        $tipo = $CI->session->userdata("tipo");
        if (strlen($tipo) > 0)
            return $tipo;
        else
            return 0;
    }
    
    function calcularEdad($fecha){
        $edad = new DateTime($fecha);
        $hoy = new DateTime();
        $annos = $hoy->diff($edad);
        echo $annos->y;
    }
    
    function restarFechas($fechaInicial, $fechaFinal, $tipo)
    {
        // 1. Years - 2. Meses - 3. Dias
        $respuesta = 0;

        $diff = strtotime($fechaFinal) - strtotime($fechaInicial);

        if ($diff < 0)
            return $respuesta;

        $diff = abs($diff);

        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));

        switch ($tipo) {
            case 1:
                $respuesta = floor($diff / (365 * 60 * 60 * 24));
                break;
            case 2:
                $respuesta = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                break;
            case 3:
                $respuesta = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                break;
        }

        return $respuesta;
    }

    // OBTIENE EL NOMBRE DEL MES, SEGUN EL NUMERO DEL MES
    function mesPorNumero($numero)
    {
        $mes = "";
        switch ($numero) {
            case "01":
                $mes = "Enero";
                break;
            case "02":
                $mes = "Febrero";
                break;
            case "03":
                $mes = "Marzo";
                break;
            case "04":
                $mes = "Abril";
                break;
            case "05":
                $mes = "Mayo";
                break;
            case "06":
                $mes = "Junio";
                break;
            case "07":
                $mes = "Julio";
                break;
            case "08":
                $mes = "Agosto";
                break;
            case "0":
                $mes = "Septiembre";
                break;
            case "10":
                $mes = "Octubre";
                break;
            case "11":
                $mes = "Noviembre";
                break;
            case "12":
                $mes = "Diciembre";
                break;
        }

        return $mes;
    }

    function formatearFechaParaBD($fecha)
    {
        if (strlen($fecha) > 0) {

            $d = explode("/", $fecha);

            return $d[2] . "-" . $d[1] . "-" . $d[0];
        } else {
            return "";
        }
    }

    function AniosParaBD($fecha)
    {
        if (strlen($fecha) > 0) {

            $d = explode("/", $fecha);

            return $d[2];
        } else {
            return "";
        }
    }    

    function formatearFechaParaVista($fecha)
    {
        $longitud = strlen($fecha);

        if ($longitud > 0) {

            if ($longitud > 10) {
                $fecha = explode(" ", $fecha);
                $fecha = $fecha[0];
            }

            $d = explode("-", $fecha);

            return $d[2] . "/" . $d[1] . "/" . $d[0];
        } else {
            return "";
        }
    }

    function addCero($numero)
    {
        if ($numero < 10)
            return "0" . $numero;
        else
            return $numero;
    }

    function addCeros($numero)
    {
        if ($numero >= 10 and $numero < 100)
            return "0" . $numero;
        else if ($numero < 10)
            return "00" . $numero;
        else
            return $numero;
    }

    function addCeros4($numero)
    {
        if ($numero >= 100 and $numero < 1000)
            return "0" . $numero;
        else if ($numero >= 10 and $numero < 100)
            return "00" . $numero;
        else if ($numero < 10)
            return "000" . $numero;
        else
            return $numero;
    }


    function addCeros5($numero)
    {
        if ($numero >= 1000 and $numero < 10000)
          return "0" . $numero;
        else if ($numero >= 100 and $numero < 1000)
            return "00" . $numero;
        else if ($numero >= 10 and $numero < 100)
            return "000" . $numero;
        else if ($numero < 10)
            return "0000" . $numero;
        else
            return $numero;
    }

    function validacionAreasDatosUsuario($opcion)
    {
        if ($this->session->userdata("idrol") != "01") {
            $this->db->where_in(opcion, $this->session->userdata("Codigo_Area"));
        }
    }


    function validarPermisos($nivel,$idmenu,$permisos){

      $activo = false;
      if(!empty($permisos)){
        if($nivel==1){
            foreach($permisos as $row):

                foreach($row as $mrow):
                    if($mrow["idmenu"]==$idmenu) $activo = true;
                endforeach;

            endforeach;
        }

        if($nivel==2){
            foreach($permisos as $row):

                foreach($row as $mrow):
                    if($mrow["nivel"]==1){
                        foreach($mrow["submenu"] as $srow):

                            if($srow["idmenudetalle"]==$idmenu) $activo = true;

                        endforeach;
                    }

                endforeach;

            endforeach;
        }
      }
      if($activo == false) redirect('errores/accesoDenegado');

  }

  function validarPermisosOpciones($idopcion,$permisos){

        $activo = false;
        if(!empty($permisos)){
          foreach($permisos as $row):

              if($row->idpermiso == $idopcion) $activo = true;

          endforeach;
        }
        return $activo;

    }


  function seg_a_dhms($seg) {
      $d = floor($seg / 86400);
      $h = floor($seg / 3600);
      $m = floor($seg / 60);

      $data = array("dias"=>$d,"horas"=>$h,"minutos"=>$m);

      return $data;
  }

  function encriptarInforme($id,$orden){
    $qwerty = base64_encode("qwerty");
    $evento  = base64_encode($id);
    $orden  = base64_encode($orden);

    $final = base64_encode($qwerty.".".$evento.".".$orden);
    $cadena = str_replace("==","34W",$final);
    return $cadena;
  }

  function desencriptarInforme($cadena){
    $cadena = str_replace("34W","==",$cadena);

    $split = base64_decode($cadena);

    $array = explode(".",$split);
    ;
    $evento = base64_decode($array[1]);
    $orden = base64_decode($array[2]);

    $arreglo[0] = $evento;
    $arreglo[1] = $orden;
    return $arreglo;
  }
  
  
  function encriptarBrigadista($id){
      $qwerty = base64_encode("qwerty");
      $brigadista  = base64_encode($id);
      
      $final = base64_encode($qwerty.".".$brigadista);
      $cadena = str_replace("==","27lKm",$final);
      return $cadena;
  }
  
  function desencriptarBrigadista($cadena){
      $cadena = str_replace("27lKm","==",$cadena);
      
      $split = base64_decode($cadena);
      
      $array = explode(".",$split);
      ;
      $brigadista = base64_decode($array[1]);
      
      return $brigadista;
  }

}

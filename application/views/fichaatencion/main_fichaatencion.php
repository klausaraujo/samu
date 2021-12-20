<?php
	/*header('Content-type: text/html; charset=UTF-8');
	if(empty($this->session->userdata("token"))){
		header("location:" . $this->config->item('path_url') . "auth/login");
	}*/

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="<?=base_url()?>public/images/favicon.ico">
		<title>Ministerio de Salud - SAMU-106</title>
		<link rel="stylesheet" href="<?=base_url()?>public/css/vendors_css.css">
		<link rel="stylesheet" href="<?=base_url()?>public/css/style.css">
		<link rel="stylesheet" href="<?=base_url()?>public/css/skin_color.css">
		<link rel="stylesheet" href="<?=base_url()?>public/css/fichaatencion/main.css" />
	</head>
	<body class="hold-transition light-skin sidebar-mini theme-primary">
		<div class="wrapper">
			<?php $this->load->view('layout/header'); ?>
			<?php $this->load->view('layout/sidebar'); ?>
			<div class="content-wrapper">
				<div class="container-full">
					<div class="alert alert-success" role="alert" style="display:none;" > Registro exitoso </div>
                    <div class="alert alert-danger" role="alert" style="display:none;" > Ocurrio un error </div>
					<section class="content">
						<div class="col-12">
							<div class="box">
								<div class="box">
									<div class="box-header with-border">
										<h3 class="box-title">Listado de Fichas de Atención</h3>
										<h6 class="box-subtitle">Módulo donde se muestran las Fichas de Atención en el Sistema</h6>
									</div>
									<div class="box-body">
										<div class="col-sm-12 col-md-5 col-md-offset-5 pa-10">
											<button type="button" class="btn btn-primary btn-nuevo" data-toggle="modal" id="btnRegistrar">
												<i class="fa fa-file-text-o" aria-hidden="true"></i>
													Registrar Ficha  
											</button>
										</div>
									</br>
									<div class="table-responsive">
										<table id="dt-fichaatencion" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
											<thead>
												<tr>
													<th>Acciones</th>
													<th>Dirección Atención</th>
													<th>Despacho de Ambulancia</th>
													<th>Motivo Emergencia</th>
													<th>Tipo de Documento</th>
													<th>Número Documento</th>
													<th>Paciente</th>
													<th>Fecha Ocurrencia</th>
													<th>Estado</th>
												</tr>
											</thead>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade modal-fullscreen" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<span class="modal-title" id="editarModalLabel"></span>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="alert alert-warning ingresos__alert" role="alert" hidden>
										<span class="alert__span"></span>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form id="formRegistrar" name="formRegistrar" method="post" action="" autocomplete="off" >
										<div class="modal-body">
											<input type="hidden" name="idfichaatencion" id="idfichaatencion">
											<input type="hidden" id="idEliminar" />
											<input type="hidden" name="act" id="act">
												<h3 class="box-title">Datos de la Base y la Unidad Operativa</h3>												
												<label class="modal-label col-sm-5 col-form-label py-10"></label>
												<div class="row">
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Base: </label>
															<div class="col-sm-5">
																<select class="form-control" name="idbase" id="idbase">
																	<option value="">-- Base --</option>
																	<?php foreach($listabase as $row): ?>
																	<option value="<?=$row->idbase?>"><?=$row->nombre?></option>
																	<?php endforeach; ?>
																</select>
															</div>															
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Ambulancia: </label>
															<div class="col-sm-5">
																<select class="form-control" name="idambulancia" id="idambulancia">
																	<option value="">-- Ambulancia --</option>
																	<?php foreach($listaambulancia as $row): ?>
																	<option value="<?=$row->idambulancia?>"><?=$row->placa?></option>
																	<?php endforeach; ?>
																</select>
															</div>															
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Fecha de Ocurrencia: </label>
															<div class="col-sm-5">
																<input type="date" class="form-control" name="fecha_ocurrencia" id="fecha_ocurrencia" value=""/>
															</div>
														</div>
													</div>																					
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Hora Despacho Ambulancia: </label>
															<div class="col-sm-5">
																<input type="time" class="form-control" required="required" id="despacho_ambulancia" name="despacho_ambulancia" value="<?=date(" H:i")?>" />
															</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Hora Salida Base: </label>
															<div class="col-sm-5">
																<input type="time" class="form-control" required="required" id="salida_base" name="salida_base" value="<?=date(" H:i")?>" />
															</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Hora Llegada a Foco: </label>
															<div class="col-sm-5">
																<input type="time" class="form-control" required="required" id="llegada_foco" name="llegada_foco" value="<?=date(" H:i")?>" />
															</div>
														</div>
													</div>																																												
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10"></label>
															<div class="col-sm-5">
															</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Hora Salida de Foco: </label>
															<div class="col-sm-5">
																<input type="time" class="form-control" required="required" id="salida_foco" name="salida_foco" value="<?=date(" H:i")?>" />
															</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Hora Llegada a Base: </label>
															<div class="col-sm-5">
																<input type="time" class="form-control" required="required" id="llegada_base" name="llegada_base" value="<?=date(" H:i")?>" />
															</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10"></label>
															<div class="col-sm-5">
															</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Prioridad de Emergencia: </label>
															<div class="col-sm-5">
																<select class="form-control" name="idprioridademergencia" id="idprioridademergencia">
																	<option value="">-- Prioridad --</option>
																	<?php foreach($listaprioridademergencia as $row): ?>
																	<option value="<?=$row->idprioridademergencia?>"><?=$row->prioridad_emergencia?></option>
																	<?php endforeach; ?>
																</select>
															</div>															
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Fallecido: </label>
															<div class="col-sm-5">
																<select class="form-control" name="fallecido" id="fallecido">
																	<option value="">-- Lugar Fallecido --</option>
																	<option value="1">Foco</option>
																	<option value="2">Traslado</option>
																</select>
															</div>															
														</div>
													</div>
													
												</div>

												<hr />
												<h3 class="box-title">Datos de la Emergencia</h3>						
												<label class="modal-label col-sm-5 col-form-label py-10"></label>
												<div class="row">
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Atención: </label>
															<div class="col-sm-5">
																<select class="form-control" name="lugar_atencion" id="lugar_atencion">
																	<option value="">-- Lugar Atención --</option>
																	<option value="1">Foco</option>
																	<option value="2">Traslado</option>
																</select>
															</div>															
														</div>
													</div>
													<div class="col-sm-8">
														<div class="form-group row">
															<label class="modal-label col-sm-3 col-form-label py-10">Motivo Emergencia: </label>
															<div class="col-sm-8">
															<input type="text" class="form-control" name="motivo_emergencia" id="motivo_emergencia" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>																					
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Tipo de Documento: </label>
															<div class="col-sm-5">
																<select class="form-control" name="idtipodocumento" id="idtipodocumento">
																	<?php foreach($listadocumento as $row): ?>
																	<option value="<?=$row->idtipodocumento?>"><?=$row->tipo_documento?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Número de Documento: </label>
															<div class="col-sm-4">
																<input type="text" class="form-control" name="numero_documento" id="numero_documento" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
															<div class="col-sm-3">
															<button type="button" id="btn-buscar" class="btn btn-primary">
																<i class="fa fa-search" aria-hidden="true"></i>
															</button>
														</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-3 col-form-label py-10">Paciente: </label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="paciente_apellidos" id="paciente_apellidos" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>																																												
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Nacimiento: </label>
															<div class="col-sm-5">
																<input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value=""/>
															</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Edad Actual: </label>
															<div class="col-sm-5">
																<input type="text" class="form-control" name="edad_actual" id="edad_actual" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Sexo: </label>
															<div class="col-sm-5">
																<select class="form-control" name="sexo" id="sexo">
																	<option value="0">-- Seleccione --</option>
																	<option value="1">Masculino</option>
																	<option value="2">Femenino</option>																
																</select>
															</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Dirección de la Atención: </label>
															<div class="col-sm-5">
																<input type="text" class="form-control" name="direccion_atencion" id="direccion_atencion" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Departamento: </label>
															<div class="col-sm-5">
																<select class="form-control" style="height:30px" name="departamento" id="departamento">
																	<option value="0">-- Departamento --</option>
																	<?php foreach($listaDepartamentos as $row): ?>
																	<option value="<?=$row->idregion?>"><?=$row->region?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Provincia: </label>
															<div class="col-sm-5">
																<select class="form-control" name="provincia" id="provincia">
																	<option value="">-- Elija Provincia --</option>
																</select>
															</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Distrito: </label>
															<div class="col-sm-5">
																<select class="form-control" name="distrito" id="distrito">
																	<option value="">-- Elija Distrito --</option>
																</select>
															</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Referencia: </label>
															<div class="col-sm-7">
																<input type="text" class="form-control" name="referencia" id="referencia" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Tipo de Seguro: </label>
															<div class="col-sm-5">
																<select class="form-control" style="height:30px" name="idtiposeguro" id="idtiposeguro">
																	<option value="0">-- Seleccionar --</option>
																	<?php foreach($listaTipoSeguro as $row): ?>
																	<option value="<?=$row->idtiposeguro?>"><?=$row->tipo_seguro?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>
												</div>

												<hr/>

												<div class="row">
													<h3 class="box-title">Antecedentes</h3>
													<label class="modal-label col-sm-5 col-form-label py-10"></label>
													<div class="col-sm-8">
														<div class="form-group row">
															<label class="modal-label col-sm-2 col-form-label py-10">Patologías Previas: </label>
															<div class="col-sm-9">
															<input type="text" class="form-control" name="patologias_previas" id="patologias_previas" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>	
													<div class="col-sm-2">
														<div class="form-group row">
															<label class="modal-label col-sm-2 col-form-label py-10">FUR: </label>
															<div class="col-sm-8">
																<input type="date" class="form-control" name="fur" id="fur" value=""/>
															</div>
														</div>
													</div>
													<div class="col-sm-2">
														<div class="form-group row">
															<label class="modal-label col-sm-2 col-form-label py-10">FPP: </label>
															<div class="col-sm-8">
																<input type="date" class="form-control" name="fpp" id="fpp" value=""/>
															</div>
														</div>
													</div>
													<div class="col-sm-8">
														<div class="form-group row">
															<label class="modal-label col-sm-2 col-form-label py-10">Medicación: </label>
															<div class="col-sm-9">
															<input type="text" class="form-control" name="medicacion" id="medicacion" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>
													<div class="col-sm-2">
														<div class="form-group row">
															<label class="modal-label col-sm-2 col-form-label py-10">FUG: </label>
															<div class="col-sm-8">
																<input type="date" class="form-control" name="fug" id="fug" value=""/>
															</div>
														</div>														
													</div>
													<div class="col-sm-2">
														<div class="form-group row">
															<label class="modal-label col-sm-2 col-form-label py-10">P: </label>
															<div class="col-sm-2 py-1">
																<input type="text" class="form-control" name="p1" id="p1" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
															<div class="col-sm-2 py-1">
																<input type="text" class="form-control" name="p2" id="p2" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
															<div class="col-sm-2 py-1">
																<input type="text" class="form-control" name="p3" id="p3" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
															<div class="col-sm-2 py-1">
																<input type="text" class="form-control" name="p4" id="p4" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
															
														</div>
													</div>
													<div class="col-sm-8">
														<div class="form-group row">
															<label class="modal-label col-sm-2 col-form-label py-10">Alergias: </label>
															<div class="col-sm-4">
															<input type="text" class="form-control" name="alergias" id="alergias" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
															<label class="modal-label col-sm-1 col-form-label py-10">Otros: </label>
															<div class="col-sm-4">
															<input type="text" class="form-control" name="otros" id="otros" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>	
													<div class="col-sm-2">
														<div class="form-group row">
															<label class="modal-label col-sm-2 col-form-label py-10">G: </label>
															<div class="col-sm-8">
															<input type="text" class="form-control" name="g" id="g" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>																															
												</div>

												<hr/>
												<h3 class="box-title">Enfermedad Actual</h3>
												<label class="modal-label col-sm-5 col-form-label py-10"></label>
												<div class="row">												
													<div class="col-sm-1">
														<div class="form-group row">
															<label class="modal-label col-sm-12 col-form-label py-10">Tiempo de Enfermedad: </label>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-2 col-form-label py-10">Días: </label>
															<div class="col-sm-2 py-1">
																<input type="text" class="form-control" name="enfermedad_dias" id="enfermedad_dias" onkeyup="javascript:this.value=this.value.toUpperCase();" value ="0" />
															</div>
															<label class="modal-label col-sm-2 col-form-label py-10">Horas: </label>
															<div class="col-sm-2 py-1">
																<input type="text" class="form-control" name="enfermedad_horas" id="enfermedad_horas" onkeyup="javascript:this.value=this.value.toUpperCase();" value ="0" />
															</div>
															<label class="modal-label col-sm-2 col-form-label py-10">Minutos: </label>
															<div class="col-sm-2 py-1">
																<input type="text" class="form-control" name="enfermedad_minutos" id="enfermedad_minutos" onkeyup="javascript:this.value=this.value.toUpperCase();" value ="0" />
															</div>															
														</div>
													</div>
												</div>
												<div class="row">		
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-3 col-form-label py-10">Inicio: </label>
															<div class="col-sm-7">
																<input type="text" class="form-control" name="enfermedad_inicio" id="enfermedad_inicio" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>					
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-3 col-form-label py-10">Curso: </label>
															<div class="col-sm-7">
																<input type="text" class="form-control" name="enfermedad_curso" id="enfermedad_curso" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>
												</div>

												<hr/>
												<h3 class="box-title">RELATO DEL EVENTO</h3>
												<label class="modal-label col-sm-5 col-form-label py-10"></label>
												<div class="row">
												
													<div class="col-sm-12">
														<div class="form-group row">
															<div class="col-sm-8">
															<textarea class="form-control" name="relato_evento" id="relato_evento" onkeyup="javascript:this.value=this.value.toUpperCase();"  style= "height:158px"> </textarea>
															</div>
														</div>
													</div>			
													
												</div>

												<hr/>

												<div class="row">
													<h3 class="box-title">Exámen Físico</h3>
													<label class="modal-label col-sm-5 col-form-label py-10"></label>
													<div class="col-sm-8">
														<div class="form-group row">
															<label class="modal-label col-sm-2 col-form-label py-10">Cabeza: </label>
															<div class="col-sm-9">
															<input type="text" class="form-control" name="examen_cabeza" id="examen_cabeza" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>	
													<div class="col-sm-4">
														<div class="form-group row">
															
															<div class="col-sm-8">
																
															</div>
														</div>
													</div>
													<div class="col-sm-8">
														<div class="form-group row">
															<label class="modal-label col-sm-2 col-form-label py-10">Cuello: </label>
															<div class="col-sm-9">
															<input type="text" class="form-control" name="examen_cuello" id="examen_cuello" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>	
													<div class="col-sm-4">
														<div class="form-group row">
															
															<div class="col-sm-8">
																
															</div>
														</div>
													</div>
													<div class="col-sm-8">
														<div class="form-group row">
															<label class="modal-label col-sm-2 col-form-label py-10">Piel y TCSC: </label>
															<div class="col-sm-9">
															<input type="text" class="form-control" name="examen_piel_tcsc" id="examen_piel_tcsc" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>	
													<div class="col-sm-4">
														<div class="form-group row">
															
															<div class="col-sm-8">
																
															</div>
														</div>
													</div>
													<div class="col-sm-8">
														<div class="form-group row">
															<label class="modal-label col-sm-2 col-form-label py-10">Aparato Respiratorio: </label>
															<div class="col-sm-9">
															<input type="text" class="form-control" name="examen_aparato_respiratorio" id="examen_aparato_respiratorio" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>	
													<div class="col-sm-4">
														<div class="form-group row">
															
															<div class="col-sm-8">
																
															</div>
														</div>
													</div>
													<div class="col-sm-8">
														<div class="form-group row">
															<label class="modal-label col-sm-2 col-form-label py-10">Aparato Cardiovascular: </label>
															<div class="col-sm-9">
															<input type="text" class="form-control" name="examen_aparato_cardiovascular" id="examen_aparato_cardiovascular" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>	
													<div class="col-sm-4">
														<div class="form-group row">
															
															<div class="col-sm-8">
																
															</div>
														</div>
													</div>
													<div class="col-sm-8">
														<div class="form-group row">
															<label class="modal-label col-sm-2 col-form-label py-10">Aparato Digestivo: </label>
															<div class="col-sm-9">
															<input type="text" class="form-control" name="examen_aparato_digestivo" id="examen_aparato_digestivo" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>	
													<div class="col-sm-4">
														<div class="form-group row">
															
															<div class="col-sm-8">
																
															</div>
														</div>
													</div>
													<div class="col-sm-8">
														<div class="form-group row">
															<label class="modal-label col-sm-2 col-form-label py-10">Genito-Urinario: </label>
															<div class="col-sm-9">
															<input type="text" class="form-control" name="examen_genito_urinario" id="examen_genito_urinario" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>	
													<div class="col-sm-4">
														<div class="form-group row">
															
															<div class="col-sm-8">
																
															</div>
														</div>
													</div>
													<div class="col-sm-8">
														<div class="form-group row">
															<label class="modal-label col-sm-2 col-form-label py-10">Sistema-Osteomioarticular: </label>
															<div class="col-sm-9">
															<input type="text" class="form-control" name="examen_sistema_osteomioaticular" id="examen_sistema_osteomioaticular" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>	
													<div class="col-sm-4">
														<div class="form-group row">
															
															<div class="col-sm-8">
																
															</div>
														</div>
													</div>
													<div class="col-sm-8">
														<div class="form-group row">
															<label class="modal-label col-sm-2 col-form-label py-10">Neurológico: </label>
															<div class="col-sm-9">
															<input type="text" class="form-control" name="examen_neurologico" id="examen_neurologico" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>	
													<div class="col-sm-4">
														<div class="form-group row">
															
															<div class="col-sm-8">
																
															</div>
														</div>
													</div>
													
																																
												</div>

												<hr/>

												<div class="row">
													<div class="col-xs-12">
														<button type="button" class="btn btn-primary d-block" id="btnClearFields">Agregar Registro</button>
													</div>
												</div>
												<br />
												<div class="row">						
													<div class="col-sm-12">
														<div class="form-group row">
														<div class="table-responsive tb-responsive">	
															<table id="tbListar" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
																<thead>
																	<th>MOMENTO DE LA EVALUACIÓN </th>
																	<th>Temperatura °C</th>
																	<th>Frecuencia Cardíaca /min</th>
																	<th>Presión Arterial mmHg</th>
																	<th>Frecuencia Respiratoria /min</th>
																	<th>Saturación de Oxígeno (%)</th>
																	<th>Glicemia</th>
																	<th>Abertura Ocular (4)</th>
																	<th>Respuesta Verbal (5)</th>
																	<th>Respuesta Motora (6)</th>
																	<th>Total (15)</th>
																	<th>Tipo de Pupilas</th>
																	<th>Reactiva</th>
																	<th></th>
																	<th></th>
																	<th></th>
																	<th></th>
																	<th></th>
																	<th></th>
																</thead
																<tbody>
																</tbody>
															</table>
														</div>
														</div>
													</div>
												</div>
												<hr/>
													<h3 class="box-title">Mecanismo de Lesión</h3>
													<label class="modal-label col-sm-5 col-form-label py-10">Accidente de Tránsito</label>
												<div class="row">
													
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Tipo de Víctima: </label>
															<div class="col-sm-5">
																<select class="form-control" name="tipo_victima" id="tipo_victima">
																	<option value="">-- Seleccione --</option>
																	<option value="1">Conductor</option>
																	<option value="2">Pasajero</option>
																	<option value="3">Peatón</option>
																</select>
															</div>															
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Tipo de Vehículo: </label>
															<div class="col-sm-5">
																<select class="form-control" name="tipo_vehiculo" id="tipo_vehiculo">
																	<option value="">-- Seleccione --</option>
																	<option value="1">Mototaxi</option>
																	<option value="2">Automóvil</option>
																	<option value="3">Autobus</option>
																	<option value="4">Motocicleta</option>
																	<option value="5">Bicicleta</option>
																	<option value="6">Otros</option>
																</select>
															</div>															
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Cinemática del Trauma: </label>
															<div class="col-sm-5">
																<select class="form-control" name="cinamatica" id="cinamatica">
																	<option value="">-- Seleccione --</option>
																	<option value="1">Impacto Frontal</option>
																	<option value="2">Impacto Posterior</option>
																	<option value="3">Impacto Lateral</option>
																	<option value="4">Atropello de Vehículo</option>
																	<option value="5">Volcamiento</option>
																	<option value="6">Choque de Vehículo</option>
																	<option value="7">Expulsión de Vehículo</option>
																	<option value="8">Caída de Vehículo</option>
																</select>
															</div>
														</div>
													</div>
													<div class="col-sm-8">
														<label class="modal-label col-sm-5 col-form-label py-10">Implementos de Seguridad: </label>
														<div class="form-group row">
															<div class="col-sm-2">
															<div class="checkbox checkbox-primary">
																<input id="bolsa" type="checkbox" name="bolsa">
																<label for="bolsa">
																Bolsa Inflada
																</label>
															</div>
															</div>
															<div class="col-sm-2">
															<div class="checkbox checkbox-primary">
																<input id="cinturon" type="checkbox" name="cinturon">
																<label for="cinturon">
																Cinturón Colocado
																</label>
															</div>
															</div>
															<div class="col-sm-2">
															<div class="checkbox checkbox-primary">
																<input id="casco" type="checkbox" name="casco">
																<label for="casco">
																Casco Colocado
																</label>
															</div>
															</div>
															<div class="col-sm-2">
															<div class="checkbox checkbox-primary">
																<input id="ropa" type="checkbox" name="ropa">
																<label for="ropa">
																Ropa Protectora
																</label>
															</div>
															</div>
														</div>
													</div>
		
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Ubicación de la Víctima: </label>
															<div class="col-sm-5">
																<select class="form-control" name="ubicacion" id="ubicacion">
																	<option value="">-- Seleccione --</option>
																	<option value="1">En Asiento Posterior</option>
																	<option value="2">Víctima Atrapada</option>
																	<option value="3">Otros</option>
																</select>
															</div>
														</div>
													</div>				
													
												</div>


												<hr/>
													<h3 class="box-title">Diagnóstico(s) Presuntivo(s)</h3>
													<label class="modal-label col-sm-5 col-form-label py-10"></label>
												<div class="row">
													
													<div class="col-xs-12 col-sm-6">
														<div class="form-group">
															<div class="input-group">
																<input type="hidden" class="cLesionado_CIE10_Codigo" name="CIE10_Codigo" /> <input
																	type="text" name="CIE10_Texto"
																	class="form-control detalle-size" autocomplete="off"
																	readonly /> 																	
																	<span class="input-group-btn">
																	<button type="button" class="btn btn-info detalle-size"
																		data-toggle="modal" data-target="#tableEnfermedadesModal"
																		style="color: white">
																		<i class="fa fa-search" aria-hidden="true"></i>
																	</button>
																</span>
															</div>
														</div>
													</div>
													<br /><br /><br />
													<div class="col-xs-12">
														<button type="button" class="btn btn-primary d-block" id="btnClearFields1">Agregar CIE10</button>
													</div>
												</div>
												<br />
												<div class="row">						
													<div class="col-sm-12">
														<div class="form-group row">
														<div class="table-responsive tb-responsive">	
															<table id="tbListar1" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
																<thead>
																	<th>Descripción</th>
																	<th>CIE 10</th>
																	<th>Opciones</th>
																</thead>
																<tbody>
																</tbody>
															</table>
														</div>
														</div>
													</div>
												</div>

												<hr/>
													
													<h3 class="box-title">Procedimiento (s) y Tratamiento (Plan de Atención)</h3>
													<label class="modal-label col-sm-5 col-form-label py-10"></label>
												<div class="row">
													
													<div class="col-sm-3">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Oxigenoterapia: </label>
															<div class="col-sm-5">
															<input type="text" class="form-control" name="oxigenoterapia" id="oxigenoterapia" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>	
													<div class="col-sm-3">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Fluidoterapia: </label>
															<div class="col-sm-5">
															<input type="text" class="form-control" name="fluidoterapia" id="fluidoterapia" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>	
													<div class="col-sm-3">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">RCP: </label>
															<div class="col-sm-5">
																<select class="form-control" name="rcp" id="rcp">
																	<option value="">-- Seleccione --</option>
																	<option value="1">Exitoso</option>
																	<option value="2">No Exitoso</option>																
																</select>
															</div>
														</div>
													</div>	
													<div class="col-sm-3">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Uso de DEA: </label>
															<div class="col-sm-5">
																<select class="form-control" name="uso_dea" id="uso_dea">
																	<option value="">-- Seleccione --</option>
																	<option value="1">SI</option>
																	<option value="2">NO</option>																
																</select>
															</div>
														</div>
													</div>
													<div class="col-sm-12">
														<div class="form-group row">
															<div class="col-sm-2">
															<div class="checkbox checkbox-primary">
																<input id="cardioversion" type="checkbox" name="cardioversion">
																<label for="cardioversion">
																Cardioversión
																</label>
															</div>
															</div>
															<div class="col-sm-2">
															<div class="checkbox checkbox-primary">
																<input id="cardioversion_selectiva" type="checkbox" name="cardioversion_selectiva">
																<label for="cardioversion_selectiva">
																Cardioversión Selectiva
																</label>
															</div>
															</div>
															<div class="col-sm-2">
															<div class="checkbox checkbox-primary">
																<input id="monitoreo_cardiaco" type="checkbox" name="monitoreo_cardiaco">
																<label for="monitoreo_cardiaco">
																Monitoreo Cardíaco
																</label>
															</div>
															</div>
															<div class="col-sm-2">
															<div class="checkbox checkbox-primary">
																<input id="ventilacion_mecanica" type="checkbox" name="ventilacion_mecanica">
																<label for="ventilacion_mecanica">
																Ventilación Mecánica
																</label>
															</div>
															</div>
															<div class="col-sm-2">
															<div class="checkbox checkbox-primary">
																<input id="inmovilizacion_completa" type="checkbox" name="inmovilizacion_completa">
																<label for="inmovilizacion_completa">
																Inmovilización Completa
																</label>
															</div>
															</div>
															<div class="col-sm-2">
															<div class="checkbox checkbox-primary">
																<input id="vendaje" type="checkbox" name="vendaje">
																<label for="vendaje">
																Vendaje
																</label>
															</div>
															</div>
															<div class="col-sm-2">
															<div class="checkbox checkbox-primary">
																<input id="sedacion" type="checkbox" name="sedacion">
																<label for="sedacion">
																Sedación
																</label>
															</div>
															</div>
															<div class="col-sm-2">
															<div class="checkbox checkbox-primary">
																<input id="curacion" type="checkbox" name="curacion">
																<label for="curacion">
																Curación
																</label>
															</div>
															</div>
															<div class="col-sm-2">
															<div class="checkbox checkbox-primary">
																<input id="hemostacia" type="checkbox" name="hemostacia">
																<label for="hemostacia">
																Hemostasia
																</label>
															</div>
															</div>
															<div class="col-sm-2">
															<div class="checkbox checkbox-primary">
																<input id="aspiracion_secreciones" type="checkbox" name="aspiracion_secreciones">
																<label for="aspiracion_secreciones">
																Aspiración de Secreciones
																</label>
															</div>
															</div>
															<div class="col-sm-2">
															<div class="checkbox checkbox-primary">
																<input id="ippb" type="checkbox" name="ippb">
																<label for="ippb">
																IPPB
																</label>
															</div>
															</div>
															<div class="col-sm-4">
															<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Inmovilización Parcial: </label>
															<div class="col-sm-5">
																<select class="form-control" name="inmovilizacion_parcial" id="inmovilizacion_parcial">
																	<option value="">-- Seleccione --</option>
																	<option value="1">MMSS</option>
																	<option value="2">MMII</option>																
																</select>
															</div>
															</div>
															</div>
															<div class="col-sm-4">
															<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Sondaje: </label>
															<div class="col-sm-5">
																<select class="form-control" name="sondaje" id="sondaje">
																	<option value="">-- Seleccione --</option>
																	<option value="1">Sondaje Nasogástrico</option>
																	<option value="2">Sondaje Vesical</option>																
																</select>
															</div>
															</div>
															</div>
															<div class="col-sm-2">
															<div class="checkbox checkbox-primary">
																<input id="intubacion" type="checkbox" name="intubacion">
																<label for="intubacion">
																Intubación
																</label>
															</div>
															</div>
															<div class="col-sm-2">
															<div class="checkbox checkbox-primary">
																<input id="satura" type="checkbox" name="satura">
																<label for="satura">
																Sutura
																</label>
															</div>
															</div>
															<div class="col-sm-2">
															<div class="checkbox checkbox-primary">
																<input id="taponamiento_nasal" type="checkbox" name="taponamiento_nasal">
																<label for="taponamiento_nasal">
																Taponamiento Nasal
																</label>
															</div>
															</div>
															<div class="col-sm-2">
															<div class="checkbox checkbox-primary">
																<input id="hemoglucotest" type="checkbox" name="hemoglucotest">
																<label for="hemoglucotest">
																Hemoglucotest
																</label>
															</div>
															</div>
															<div class="col-sm-2">
															<div class="checkbox checkbox-primary">
																<input id="tratamiento_inhalacion" type="checkbox" name="tratamiento_inhalacion">
																<label for="tratamiento_inhalacion">
																Tratamiento por Inhalación
																</label>
															</div>
															</div>
															<div class="col-sm-2">
															<div class="checkbox checkbox-primary">
																<input id="traqueostomia" type="checkbox" name="traqueostomia">
																<label for="traqueostomia">
																Traqueostomía
																</label>
															</div>
															</div>
															<div class="col-sm-2">
															<div class="checkbox checkbox-primary">
																<input id="cuerpo_extrano" type="checkbox" name="cuerpo_extrano">
																<label for="cuerpo_extrano">
																Cuerpo Extraño
																</label>
															</div>
															</div>
															<div class="col-sm-2">
															<div class="checkbox checkbox-primary">
																<input id="infusion_intraosea" type="checkbox" name="infusion_intraosea">
																<label for="infusion_intraosea">
																Infusión Intrósea
																</label>
															</div>
															</div>
															<div class="col-sm-2">
															<div class="checkbox checkbox-primary">
																<input id="nebulizacion" type="checkbox" name="nebulizacion">
																<label for="nebulizacion">
																Nebulización
																</label>
															</div>
															</div>
														</div>												
													</div>																			
												</div>

												<hr/>

												<div class="row">
													<div class="col-xs-12">
														<button type="button" class="btn btn-primary d-block" id="btnMedicamentos">Agregar Medicamento</button>
													</div>
												</div>
												<br />
												<div class="row">						
													<div class="col-sm-12">
														<div class="form-group row">
														<div class="table-responsive tb-responsive">	
															<table id="tbListarmedicamentos" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
																<thead>
																	<th>Descripcion</th>
																	<th>Dosis</th>
																	<th>Hora</th>
																	<th></th>
																</thead
																<tbody>
																</tbody>
															</table>
														</div>
														</div>
													</div>
												</div>

												<hr/>
												<h3 class="box-title">OCURRENCIAS DURANTE LA ATENCIÓN</h3>
												<label class="modal-label col-sm-5 col-form-label py-10"></label>
												<div class="row">
												
													<div class="col-sm-12">
														<div class="form-group row">
															<div class="col-sm-8">
															<textarea class="form-control" name="ocurrencias_atencion" id="ocurrencias_atencion" onkeyup="javascript:this.value=this.value.toUpperCase();"  style= "height:158px"> </textarea>
															</div>
														</div>
													</div>			
													
												</div>

												<hr/>

												<h3 class="box-title">Responsables de la Atención</h3>
												<h4 class="box-title">Médico</h4>
												<div class="row">
													<div class="col-sm-3">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Tipo de Documento: </label>
															<div class="col-sm-5">
																<select class="form-control" name="idtipodocumento_medico" id="idtipodocumento_medico">
																	<?php foreach($listadocumento as $row): ?>
																	<option value="<?=$row->idtipodocumento?>"><?=$row->tipo_documento?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Número de Documento: </label>
															<div class="col-sm-4">
																<input type="text" class="form-control" name="numero_documento_medico" id="numero_documento_medico" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
															<div class="col-sm-3">
															<button type="button" id="btn-buscarmed" class="btn btn-primary">
																<i class="fa fa-search" aria-hidden="true"></i>
															</button>
														</div>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group row">
															<label class="modal-label col-sm-3 col-form-label py-10">Nombres y Apellidos: </label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="nombapemed" id="nombapemed" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group row">
															<label class="modal-label col-sm-3 col-form-label py-10">N° CMP: </label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="numero_colegiatura_medico" id="numero_colegiatura_medico" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>	
													
												</div>
												<h4 class="box-title">Enfermero</h4>
												<div class="row">
													<div class="col-sm-3">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Tipo de Documento: </label>
															<div class="col-sm-5">
																<select class="form-control" name="idtipodocumento_enfermero" id="idtipodocumento_enfermero">
																	<?php foreach($listadocumento as $row): ?>
																	<option value="<?=$row->idtipodocumento?>"><?=$row->tipo_documento?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Número de Documento: </label>
															<div class="col-sm-4">
																<input type="text" class="form-control" name="numero_documento_enfermero" id="numero_documento_enfermero" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
															<div class="col-sm-3">
															<button type="button" id="btn-buscarenf" class="btn btn-primary">
																<i class="fa fa-search" aria-hidden="true"></i>
															</button>
														</div>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group row">
															<label class="modal-label col-sm-3 col-form-label py-10">Nombres y Apellidos: </label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="nombapeenf" id="nombapeenf" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group row">
															<label class="modal-label col-sm-3 col-form-label py-10">N° CEP: </label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="numero_colegiatura_enfermero" id="numero_colegiatura_enfermero" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>															
												</div>
												<h4 class="box-title">Piloto</h4>
												<div class="row">
													<div class="col-sm-3">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Tipo de Documento: </label>
															<div class="col-sm-5">
																<select class="form-control" name="idtipodocumento_piloto" id="idtipodocumento_piloto">
																	<?php foreach($listadocumento as $row): ?>
																	<option value="<?=$row->idtipodocumento?>"><?=$row->tipo_documento?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Número de Documento: </label>
															<div class="col-sm-4">
																<input type="text" class="form-control" name="numero_documento_piloto" id="numero_documento_piloto" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
															<div class="col-sm-3">
															<button type="button" id="btn-buscarpil" class="btn btn-primary">
																<i class="fa fa-search" aria-hidden="true"></i>
															</button>
														</div>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group row">
															<label class="modal-label col-sm-3 col-form-label py-10">Nombres y Apellidos: </label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="nombapepil" id="nombapepil" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>	
													<div class="col-sm-3">
														<div class="form-group row">
															<label class="modal-label col-sm-3 col-form-label py-10">N° Licencia: </label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="numero_licencia_piloto" id="numero_licencia_piloto" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>														
												</div>
												<h4 class="box-title">Médico Regulador</h4>
												<div class="row">
													<div class="col-sm-3">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Tipo de Documento: </label>
															<div class="col-sm-5">
																<select class="form-control" name="idtipodocumento_medico_regulador" id="idtipodocumento_medico_regulador">
																	<?php foreach($listadocumento as $row): ?>
																	<option value="<?=$row->idtipodocumento?>"><?=$row->tipo_documento?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Número de Documento: </label>
															<div class="col-sm-4">
																<input type="text" class="form-control" name="numero_documento_medico_regulador" id="numero_documento_medico_regulador" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
															<div class="col-sm-3">
															<button type="button" id="btn-buscarmedreg" class="btn btn-primary">
																<i class="fa fa-search" aria-hidden="true"></i>
															</button>
														</div>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group row">
															<label class="modal-label col-sm-3 col-form-label py-10">Nombres y Apellidos: </label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="nombapemedreg" id="nombapemedreg" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group row">
															<label class="modal-label col-sm-3 col-form-label py-10">N° CMP: </label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="numero_colegiatura_medico_regulador" id="numero_colegiatura_medico_regulador" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>	
													<div class="col-sm-6">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">N° Ficha de Regulación: </label>
															<div class="col-sm-12">
																<input type="text" class="form-control" name="ficha_regulacion" id="ficha_regulacion" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Establecimiento de Salud de Destino: </label>
															<div class="col-sm-12">
																<input type="text" class="form-control" name="idrenipress" id="idrenipress" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>														
												</div>
												<h4 class="box-title">Profesional Receptor</h4>
												<div class="row">
													<div class="col-sm-3">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Tipo de Documento: </label>
															<div class="col-sm-5">
																<select class="form-control" name="idtipodocumento_profesional_receptor" id="idtipodocumento_profesional_receptor">
																	<?php foreach($listadocumento as $row): ?>
																	<option value="<?=$row->idtipodocumento?>"><?=$row->tipo_documento?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Número de Documento: </label>
															<div class="col-sm-4">
																<input type="text" class="form-control" name="numero_documento_profesional_receptor" id="numero_documento_profesional_receptor" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
															<div class="col-sm-3">
															<button type="button" id="btn-buscarprofr" class="btn btn-primary">
																<i class="fa fa-search" aria-hidden="true"></i>
															</button>
														</div>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group row">
															<label class="modal-label col-sm-3 col-form-label py-10">Nombres y Apellidos: </label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="nombapeprorec" id="nombapeprorec" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>	
													<div class="col-sm-3">
														<div class="form-group row">
															<label class="modal-label col-sm-3 col-form-label py-10"></label>
															<div class="col-sm-8">
																
															</div>
														</div>
													</div>														
												</div>
												<h4 class="box-title">Médico Receptor</h4>
												<div class="row">
													<div class="col-sm-3">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Tipo de Documento: </label>
															<div class="col-sm-5">
																<select class="form-control" name="idtipodocumento_medico_receptor" id="idtipodocumento_medico_receptor">
																	<?php foreach($listadocumento as $row): ?>
																	<option value="<?=$row->idtipodocumento?>"><?=$row->tipo_documento?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Número de Documento: </label>
															<div class="col-sm-4">
																<input type="text" class="form-control" name="numero_documento_medico_receptor" id="numero_documento_medico_receptor" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
															<div class="col-sm-3">
															<button type="button" id="btn-buscarmedrec" class="btn btn-primary">
																<i class="fa fa-search" aria-hidden="true"></i>
															</button>
														</div>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group row">
															<label class="modal-label col-sm-3 col-form-label py-10">Nombres y Apellidos: </label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="nombapemedrec" id="nombapemedrec" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group row">
															<label class="modal-label col-sm-3 col-form-label py-10">N° CMP: </label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="numero_colegiatura_medico_receptor" id="numero_colegiatura_medico_receptor" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>	
												</div>
												<div class="row">
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Hora Llegada al E.S.: </label>
															<div class="col-sm-5">
																<input type="time" class="form-control" required="required" id="hora_llegada_es" name="hora_llegada_es" value="<?=date(" H:i")?>" />
															</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Hora Recepción del Paciente: </label>
															<div class="col-sm-5">
																<input type="time" class="form-control" required="required" id="hora_recepcion_paciente" name="hora_recepcion_paciente" value="<?=date(" H:i")?>" />
															</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Hora Salida del E.S.: </label>
															<div class="col-sm-5">
																<input type="time" class="form-control" required="required" id="hora_salida_es" name="hora_salida_es" value="<?=date(" H:i")?>" />
															</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Camilla Retenida: </label>
															<div class="col-sm-5">
																<select class="form-control" name="camilla_retenida" id="camilla_retenida">
																	<option value="">-- Seleccione --</option>
																	<option value="1">SI</option>
																	<option value="2">NO</option>
																</select>
															</div>															
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Minutos Retenido: </label>
															<div class="col-sm-5">
																<input type="text" class="form-control" name="camilla_retenida_minutos" id="camilla_retenida_minutos" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
														</div>
													</div>
												</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
											<button id="enviar" type="submit" class="btn btn-primary">Guardar</button>
										</div>	
									</form>
								</div>
							</div>
						
						</div>

						<div class="modal fade modal-fullscreen" id="momentoevaluacionModal" tabindex="-1" role="dialog" aria-labelledby="momentoevaluacionModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="momentoevaluacionModalLabel">Registrar Momento de Evaluación</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form id="formRegistrar1" name="formRegistrar1" action="" method="POST">
									<div class="modal-body">
												<div class="row">
														<div class="col-sm-4">
															<div class="form-group row">
																<label class="modal-label col-sm-5 col-form-label py-10">Momento de la Evaluación: </label>
																<div class="col-sm-5">
																	<select class="form-control" name="tipo" id="tipo">
																		<!--
																		<option value="1">Inicial</option>
																		<option value="2">Traslado</option>
																		<option value="3">Llegada</option>
																		-->
																	</select>
																</div>															
															</div>
														</div>	
														<div class="col-sm-4">
															<div class="form-group row">
																<label class="modal-label col-sm-5 col-form-label py-10">Temperatura °C: </label>
																<div class="col-sm-5">
																	<input type="text" class="form-control" name="temperaperatura" id="temperaperatura" onkeyup="javascript:this.value=this.value.toUpperCase();" />
																</div>															
															</div>
														</div>	
														<div class="col-sm-4">
															<div class="form-group row">
																<label class="modal-label col-sm-5 col-form-label py-10">Frecuencia Cardíaca /min: </label>
																<div class="col-sm-5">
																	<input type="text" class="form-control" name="frecuencia_cardiaca" id="frecuencia_cardiaca" onkeyup="javascript:this.value=this.value.toUpperCase();" />
																</div>															
															</div>
														</div>													
												</div>
												<div class="row">
														<div class="col-sm-4">
															<div class="form-group row">
																<label class="modal-label col-sm-5 col-form-label py-10">Presión Arterial: </label>
																<div class="col-sm-5">
																<input type="text" class="form-control" name="presion_arterial" id="presion_arterial" onkeyup="javascript:this.value=this.value.toUpperCase();" />
																</div>															
															</div>
														</div>	
														<div class="col-sm-4">
															<div class="form-group row">
																<label class="modal-label col-sm-5 col-form-label py-10">Frecuencia Cardíaca: </label>
																<div class="col-sm-5">
																	<input type="text" class="form-control" name="frecuencia_respiratoria" id="frecuencia_respiratoria" onkeyup="javascript:this.value=this.value.toUpperCase();" />
																</div>															
															</div>
														</div>	
														<div class="col-sm-4">
															<div class="form-group row">
																<label class="modal-label col-sm-5 col-form-label py-10">Saturación de Oxígeno: </label>
																<div class="col-sm-5">
																	<input type="text" class="form-control" name="saturacion_exigeno" id="saturacion_exigeno" onkeyup="javascript:this.value=this.value.toUpperCase();" />
																</div>															
															</div>
														</div>													
												</div>
												<div class="row">
														<div class="col-sm-4">
															<div class="form-group row">
																<label class="modal-label col-sm-5 col-form-label py-10">Glicemia: </label>
																<div class="col-sm-5">
																<input type="text" class="form-control" name="glicemia" id="glicemia" onkeyup="javascript:this.value=this.value.toUpperCase();" />
																</div>															
															</div>
														</div>	
														<div class="col-sm-4">
															<div class="form-group row">
																<label class="modal-label col-sm-5 col-form-label py-10">Abertura Ocular: </label>
																<div class="col-sm-5">
																		<select class="form-control" name="glasgow_ocular" id="glasgow_ocular">
																			<option value="1">Ninguna</option>
																			<option value="2">Dolor</option>															
																			<option value="3">Voz</option>
																			<option value="4">Espontánea</option>
																		</select>	
																</div>															
															</div>
														</div>	
														<div class="col-sm-4">
															<div class="form-group row">
																<label class="modal-label col-sm-5 col-form-label py-10">Respuesta Verbal: </label>
																<div class="col-sm-5">
																		<select class="form-control" name="glasgow_verbal" id="glasgow_verbal">
																			<option value="1">Ninguna</option>
																			<option value="2">Sonidos</option>															
																			<option value="3">Inapropiada</option>
																			<option value="4">Confusa</option>
																			<option value="5">Orientada</option>
																		</select>	
																</div>															
															</div>
														</div>													
												</div>
												<div class="row">
														<div class="col-sm-4">
															<div class="form-group row">
																<label class="modal-label col-sm-5 col-form-label py-10">Respuesta Motora: </label>
																<div class="col-sm-5">
																		<select class="form-control" name="glasgow_motora" id="glasgow_motora">
																			<option value="1">Ninguna</option>
																			<option value="2">Extensión</option>															
																			<option value="3">Flexión</option>
																			<option value="4">Retirada</option>
																			<option value="5">Localiza</option>
																			<option value="6">Obedece</option>
																		</select>		
																</div>															
															</div>
														</div>	
														<div class="col-sm-4">
															<div class="form-group row">
																<label class="modal-label col-sm-5 col-form-label py-10">Tipo: </label>
																<div class="col-sm-5">
																		<select class="form-control" name="pupilas_tipo" id="pupilas_tipo">
																			<option value="0">Seleccione</option>
																			<option value="1">Izquierdo</option>
																			<option value="2">Derecho</option>																
																		</select>
																</div>															
															</div>
														</div>	
														<div class="col-sm-4">
															<div class="form-group row">
																<label class="modal-label col-sm-5 col-form-label py-10">Reactiva: </label>
																<div class="col-sm-5">
																		<select class="form-control" name="pupilas_reactiva" id="pupilas_reactiva">
																			<option value="0">Seleccione</option>
																			<option value="1">SI</option>
																			<option value="2">NO</option>																
																		</select>
																</div>															
															</div>
														</div>													
												</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
										<button type="submit" class="btn btn-primary">Agregar</button>
									</div>
								</form>
								</div>
							</div>
						</div>
						
						<!-- MODAL BUSQUEDA -->
						<div class="modal fade" id="tableEnfermedadesModal" tabindex="-1"
							role="dialog" aria-labelledby="tableEnfermedadesModalLabel"
							aria-hidden="true">
							<div class="alert alert-warning ingresos__alerttbenf" role="alert" hidden>
								<span class="alert__spantbenf"></span>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-dialog modal-md" role="document"
								style="padding-top: 10px;">
								<div class="modal-content">
									<div class="modal-body">
										<div class="table-responsive">
											<table id="tableEnfermedades" name="tableEnfermedades" class="tableEnfermedades table table-striped table-bordered table-sm"
												cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>C&oacute;digo</th>
														<th>Descripci&oacute;n</th>
				
													</tr>
												</thead>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- MODAL -->

						<!-- MODAL BUSQUEDA -->
						<div class="modal fade" id="tableMedicamentosModal" tabindex="-1"
							role="dialog" aria-labelledby="tableMedicamentosModalLabel"
							aria-hidden="true">
							<div class="modal-dialog modal-md" role="document"
								style="padding-top: 10px;">
								<div class="modal-content">			
									<div class="modal-body">
													<div class="row">
														<div class="col-sm-12">
															<div class="form-group row">
																<label class="modal-label col-sm-5 col-form-label py-10">Dosis: </label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="dosis" id="dosis" onkeyup="javascript:this.value=this.value.toUpperCase();" />
																</div>															
															</div>
														</div>
														<div class="col-sm-12">
															<div class="form-group row">
																<label class="modal-label col-sm-5 col-form-label py-10">Hora: </label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="hora" id="hora" onkeyup="javascript:this.value=this.value.toUpperCase();" />
																</div>															
															</div>
														</div>	
													</div>
										<div class="table-responsive">
											<table id="tableMedicamentos" name="tableMedicamentos" class="tableMedicamentos table table-striped table-bordered table-sm"
												cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>Descripci&oacute;n</th>				
														<th></th>
													</tr>
												</thead>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- MODAL -->
					</section>

				</div>
			</div>
			<?php $this->load->view('layout/footer'); ?>
		</div>

		<script src="<?=base_url()?>public/js/vendors.min.js"></script>
		<script src="<?=base_url()?>public/assets/icons/feather-icons/feather.min.js"></script>
		<script src="<?=base_url()?>public/assets/vendor_components/datatable/datatables.min.js"></script>
		<script src="<?=base_url()?>public/js/jquery.validate.min.js"></script>
		<script src="<?=base_url()?>public/js/fichaatencion/fichaatencion.js"></script>
		<script> 
			const canDelete = "1";
			const canEdit = "1";
			var lista = JSON.parse('<?=$listaFichaAtencion?>');
		</script>

		<script>fichaatencion("<?=base_url()?>");</script>
		<script src="<?=base_url()?>public//assets/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>
		<script src="<?=base_url()?>public//assets/vendor_components/progressbar.js-master/dist/progressbar.js"></script>
		<script src="<?=base_url()?>public/js/template.js"></script>
		<script src="<?=base_url()?>public/js/pages/dashboard.js"></script>
		<script src="<?=base_url()?>public/js/demo.js"></script>
		
	</body>
</html>

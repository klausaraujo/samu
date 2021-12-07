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
													<th>Lugar Atencion</th>
													<th>Traslado</th>
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
									<form id="formRegistrar" name="formRegistrar" method="post" action="" autocomplete="off" >
										<div class="modal-body">
											<input type="hidden" name="idfichaatencion" id="idfichaatencion">
											<input type="hidden" name="act" id="act">
												<div class="alert alert-warning ingresos__alert" role="alert" hidden>
													<span class="alert__span"></span>
													<button type="button" class="close" data-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>												
												<label class="modal-label col-sm-5 col-form-label py-10">Datos de la Base y la Unidad Operativa</label>
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

												<label class="modal-label col-sm-5 col-form-label py-10">Datos de la Emergencia</label>
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
																<i class="fa fa-search" aria-hidden="true">&nbsp;Buscar</i>
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
																	<option value="">-- Seleccione --</option>
																	<option value="1">Masculino</option>
																	<option value="2">Femenino</option>																
																</select>
															</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Dirección: </label>
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
																	<option value="0">-- Regi&oacute;n --</option>
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
													<label class="modal-label col-sm-5 col-form-label py-10">Antecedentes</label>
													<div class="col-sm-8">
														<div class="form-group row">
															<label class="modal-label col-sm-2 col-form-label py-10">Patologías Previas: </label>
															<div class="col-sm-9">
															<input type="text" class="form-control" name="antecedentes" id="antecedentes" onkeyup="javascript:this.value=this.value.toUpperCase();" />
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
															<!--
															<div class="col-sm-2">
																<label class="col-form-label py-10" for="gestante">G</label>
																<input class="py-10" id="gestante" type="checkbox" name="gestante">
																<label class="modal-label col-sm-2 col-form-label py-10" for="gestante">G</label>
															</div>-->
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
													<div class="col-sm-4">
														<div class="form-group row">
															<div class="col-sm-12">
																<div class="checkbox checkbox-primary">
																	<input id="g" type="checkbox" name="g">
																	<label for="peep_in_view">
																		Gestante
																	</label>
																</div>
															</div>
														</div>
													</div>
																																
												</div>

												<hr/>
												<label class="modal-label col-sm-5 col-form-label py-10">Enfermedad Actual</label>
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
																<input type="text" class="form-control" name="enfermedad_dias" id="enfermedad_dias" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
															<label class="modal-label col-sm-2 col-form-label py-10">Horas: </label>
															<div class="col-sm-2 py-1">
																<input type="text" class="form-control" name="enfermedad_horas" id="enfermedad_horas" onkeyup="javascript:this.value=this.value.toUpperCase();" />
															</div>
															<label class="modal-label col-sm-2 col-form-label py-10">Minutos: </label>
															<div class="col-sm-2 py-1">
																<input type="text" class="form-control" name="enfermedad_minutos" id="enfermedad_minutos" onkeyup="javascript:this.value=this.value.toUpperCase();" />
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

												<label class="modal-label col-sm-5 col-form-label py-10">RELATO DEL EVENTO:</label>
												<div class="row">
												
													<div class="col-sm-12">
														<div class="form-group row">
															<div class="col-sm-8">
															<textarea class="form-control" name="antecedentes" id="antecedentes" onkeyup="javascript:this.value=this.value.toUpperCase();"  style= "height:158px"> </textarea>
															</div>
														</div>
													</div>			
													
												</div>

												<hr/>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
											<button id="enviar" type="submit" class="btn btn-primary">Guardar</button>
										</div>	
									</form>
								</div>
							</div>
						
						</div>
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
		<!-- Florence Admin App -->
		<script src="<?=base_url()?>public/js/template.js"></script>
		<script src="<?=base_url()?>public/js/pages/dashboard.js"></script>
		<script src="<?=base_url()?>public/js/demo.js"></script>
		
	</body>
</html>

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
										<table id="dt-fichaatecion" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
											<thead>
												<tr>
													<th>Foco</th>
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
									<form id="formRegistrar" name="formRegistrar" method="post" action="" autocomplete="off" enctype="multipart/form-data">
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
																	<?php foreach($listaMarcas as $row): ?>
																	<option value="<?=$row->idmarca?>"><?=$row->marca?></option>
																	<?php endforeach; ?>
																</select>
															</div>															
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Fecha de Ocurrencia: </label>
															<div class="col-sm-5">
																<input type="date" class="form-control" name="fechaocurrencia" id="fechaocurrencia" value=""/>
															</div>
														</div>
													</div>																					
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Hora Despacho Ambulancia: </label>
															<div class="col-sm-5">
																<input type="time" class="form-control" required="required" id="hora_desp_ambu" name="hora_desp_ambu" value="<?=date(" H:i")?>" />
															</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Placa: </label>
															<div class="col-sm-5">
																<input type="text" class="form-control" name="placa" id="placa" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="10"/>
															</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Hora Salida Base: </label>
															<div class="col-sm-5">
																<input type="time" class="form-control" required="required" id="hora_salida_base" name="hora_salida_base" value="<?=date(" H:i")?>" />
															</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Hora Llegada a Foco: </label>
															<div class="col-sm-5">
																<input type="time" class="form-control" required="required" id="hora_llegada_foco" name="hora_llegada_foco" value="<?=date(" H:i")?>" />
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
																<input type="time" class="form-control" required="required" id="hora_salida_foco" name="hora_salida_foco" value="<?=date(" H:i")?>" />
															</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Hora Lllegada a Base: </label>
															<div class="col-sm-5">
																<input type="time" class="form-control" required="required" id="hora_llegada_base" name="hora_llegada_base" value="<?=date(" H:i")?>" />
															</div>
														</div>
													</div>
													
												</div>

												<hr />

												<label class="modal-label col-sm-5 col-form-label py-10">Datos de la Emergencia</label>
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group row">
															<label class="modal-label col-sm-4 col-form-label py-10">Atención: </label>
															<div class="col-sm-4">
																<div class="form-group row">
																	<div class="col-sm-12">
																	<div class="checkbox checkbox-primary">
																		<input id="foco" type="checkbox" name="foco">
																		<label for="foco">
																		Foco
																		</label>
																	</div>
																	</div>
																</div>
																</div>
																<div class="col-sm-4">
																<div class="form-group row">
																	<div class="col-sm-12">
																	<div class="checkbox checkbox-primary">
																		<input id="traslado" type="checkbox" name="traslado">
																		<label for="traslado">
																		Traslado
																		</label>
																	</div>
																	</div>
																</div>
																</div>															
															</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group row">
															<label class="modal-label col-sm-3 col-form-label py-10">Motivo Emergencia: </label>
															<div class="col-sm-8">
															<input type="text" class="form-control" name="motivo_emergencia" id="motivo_emergencia" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="10"/>
															</div>
														</div>
													</div>																					
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Tipo de Documento: </label>
															<div class="col-sm-5">
																<select class="form-control" name="idtipodocumento" id="idtipodocumento">
																	<option value="">-- Tipo Documento --</option>
																	<option value="1">DNI</option>
																	<option value="3">CARNET DE EXTRANJERIA</option>
																</select>
															</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Número de Documento: </label>
															<div class="col-sm-5">
																<input type="text" class="form-control" name="numdoc" id="numdoc" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="10"/>
															</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-3 col-form-label py-10">Paciente: </label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="nomb_comp_paciente" id="nomb_comp_paciente" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="10"/>
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
																<input type="text" class="form-control" name="edad_actual" id="edad_actual" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="10"/>
															</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-2 col-form-label py-10">Sexo: </label>
															<div class="col-sm-5">
																<select class="form-control" name="sexo" id="sexo">
																	<option value="">-- Tipo Documento --</option>
																	<option value="1">Femenino</option>
																	<option value="2">Masculino</option>																
																</select>
															</div>
															<div class="form-group row">
																	<div class="col-sm-12">
																	<div class="checkbox checkbox-primary">
																		<input id="gestante" type="checkbox" name="gestante">
																		<label for="gestante">
																		Gestante
																		</label>
																	</div>
																	</div>
															</div>	
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Dirección: </label>
															<div class="col-sm-5">
																<input type="text" class="form-control" name="direccion" id="direccion" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="10"/>
															</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Departamento: </label>
															<div class="col-sm-5">
																<select class="form-control" style="height:30px" name="departamento" id="departamento">
																	<option value="0">-- Regi&oacute;n --</option>
																	<?php foreach($departamentos as $row): ?>
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
															<div class="col-sm-5">
																<input type="text" class="form-control" name="referencia" id="referencia" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="10"/>
															</div>
														</div>
													</div>
												</div>

												<hr/>

												<label class="modal-label col-sm-5 col-form-label py-10">Tipo de Seguro</label>
												<div class="row">
													<div class="col-sm-8">
														<div class="form-group row">
															<div class="col-sm-4">
																<div class="form-group row">
																	<div class="col-sm-12">
																	<div class="checkbox checkbox-primary">
																		<input id="sis" type="checkbox" name="sis">
																		<label for="sis">
																		SIS
																		</label>
																	</div>
																	</div>
																</div>
																</div>
																<div class="col-sm-4">
																<div class="form-group row">
																	<div class="col-sm-12">
																	<div class="checkbox checkbox-primary">
																		<input id="essalud" type="checkbox" name="essalud">
																		<label for="essalud">
																		EsSalud
																		</label>
																	</div>
																	</div>
																</div>
																</div>	
																<div class="col-sm-4">
																<div class="form-group row">
																	<div class="col-sm-4">
																	<div class="checkbox checkbox-primary">
																		<input id="soat" type="checkbox" name="soat">
																		<label for="soat">
																		SOAT
																		</label>
																	</div>
																	</div>
																	<div class="col-sm-8">
																		<select class="form-control" name="idtiposoat" id="idtiposoat">
																			<option value="">-- Tipo SOAT --</option>
																			<?php foreach($listaCombustibles as $row): ?>
																			<option value="<?=$row->idtipocombustible?>"><?=$row->combustible?></option>
																			<?php endforeach; ?>
																		</select>
																	</div>
																</div>
																</div>
																<div class="col-sm-4">
																<div class="form-group row">
																	<div class="col-sm-4">
																	<div class="checkbox checkbox-primary">
																		<input id="eps" type="checkbox" name="eps">
																		<label for="eps">
																		EPS
																		</label>
																	</div>
																	</div>
																	<div class="col-sm-6">
																		<select class="form-control" name="idtipoeps" id="idtipoeps">
																			<option value="">-- Tipo EPS --</option>
																			<?php foreach($listaCombustibles as $row): ?>
																			<option value="<?=$row->idtipocombustible?>"><?=$row->combustible?></option>
																			<?php endforeach; ?>
																		</select>
																	</div>
																</div>
																</div>
																<div class="col-sm-4">
																<div class="form-group row">
																	<div class="col-sm-4">
																	<div class="checkbox checkbox-primary">
																		<input id="otros" type="checkbox" name="otros">
																		<label for="otros">
																		Otros
																		</label>
																	</div>
																	</div>
																	<div class="col-sm-5">
																		<input type="text" class="form-control" name="otros_detalle" id="otros_detalle" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="10"/>
																	</div>
																</div>
																</div>
																<div class="col-sm-4">
																<div class="form-group row">
																	<div class="col-sm-12">
																	<div class="checkbox checkbox-primary">
																		<input id="sinseguro" type="checkbox" name="sinseguro">
																		<label for="sinseguro">
																		Sin Seguro
																		</label>
																	</div>
																	</div>
																</div>
																</div>
															</div>
													</div>
													
												</div>
												
												</hr>
												
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
		<script>ambulancias("<?=base_url()?>");</script>

		<script src="<?=base_url()?>public//assets/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>
		<script src="<?=base_url()?>public//assets/vendor_components/progressbar.js-master/dist/progressbar.js"></script>
		<!-- Florence Admin App -->
		<script src="<?=base_url()?>public/js/template.js"></script>
		<script src="<?=base_url()?>public/js/pages/dashboard.js"></script>
		<script src="<?=base_url()?>public/js/demo.js"></script>
		
	</body>
</html>

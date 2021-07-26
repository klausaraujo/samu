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
		<link rel="stylesheet" href="<?=base_url()?>public/css/bases/main.css" />
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
										<h3 class="box-title">Listado General de Emergencias</h3>
										<h6 class="box-subtitle">Módulo donde se muestran las Emergencias Registradas en el Sistema</h6>
									</div>
									<div class="box-body form-group row">
										<div class="col-sm-12">
											<button type="button" class="btn btn-primary btn-nuevo" data-toggle="modal" id="btnRegistrar" disabled>
												<i class="fa fa-file-text-o" aria-hidden="true">&nbsp;</i>Registrar Emergencias
                                            </button>&nbsp;&nbsp;&nbsp;
											<label class="modal-label">Seleccione la Region: </label>
											<select class="" name="departamento" id="departamento">
												<option value="0">-- Regi&oacute;n --</option>
												<?php foreach($departamentos as $row): ?>
												<option value="<?=$row->idregion?>"><?=$row->region?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="col-sm-12" style="height:30px"></div>
										
										<? 
											$dtz = new DateTimeZone("America/Lima");
											$dt = new DateTime("now", $dtz);
											$fechaActual = $dt->format("Y-m-d");
											//$fechaActual = str_replace("-","/",$fechaActual);
											//echo $fechaActual;
										?>
										<div class="table-responsive">
										<table id="dt-emergencias" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
											<thead>
												<tr>
													<th>Acciones</th>
													<th>Telefono ppal</th>
													<th>Telefono 2</th>
													<th>Nombres</th>
													<th>Apellidos</th>
													<th>Incidente</th>
												</tr>
											</thead>
										</table>

										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade modal-fullscreen" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<span class="modal-title" id="editarModalLabel" style="color:blue;font-size:14pt"></span>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>										
									</div>
									<form id="formRegistrar" name="formRegistrar" method="post" action="" autocomplete="off" enctype="multipart/form-data">
                                    <input type="hidden" name="idem" id="idem" value="" />    
									<input type="hidden" name="act" id="act" value=0 />
									<input type="hidden" name="fechNac" id="fechNac" value="" />
										<div class="modal-body">
                                            <div class="row">
												<div class="col-sm-6 etiq">
													<div class="form-group row">
														<label class="modal-label col-sm-5 col-form-label py-10">Numero de Telefono: </label>
														<div class="col-sm-6">
															<input type="text" class="form-control" name="tlf" id="tlf" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" />
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group row">
														<label class="modal-label col-sm-4 col-form-label py-10 offset-sm-1">Tipo Llamada: </label>
														<div class="col-sm-6">
															<select class="form-control" name="tipoLl" id="tipoLl">
																<option value="">-- Tipo Llamada --</option>
																<?php foreach($tipoLlamada as $row): ?>
																<option value="<?=$row->idtipollamada?>"><?=$row->tipo_llamada?></option>
																<?php endforeach; ?>
															</select>
														</div>
													</div>
												</div>
                                                <div class="col-sm-6">
													<div class="form-group row">
														<label class="modal-label col-sm-5 col-form-label py-10">Numero Alternativo: </label>
														<div class="col-sm-6">
															<input type="text" class="form-control" name="tlf2" id="tlf2" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" />
														</div>
													</div>
												</div>
												<div class="col-sm-6 etiq">
													<div class="form-group row">
														<label class="modal-label col-sm-4 col-form-label py-10 offset-sm-1">Tipo Documento: </label>
														<div class="col-sm-6">
														<select class="form-control" name="tipoDoc" id="tipoDoc">
																<option value="">-- Tipo Documento --</option>
																<option value="01">DNI</option>
																<option value="03">CARNET DE EXTRANJERIA</option>
															</select>
														</div>
													</div>
												</div>
                                                <div class="col-sm-6 etiq">
													<div class="form-group row">
														<label class="modal-label col-sm-5 col-form-label py-10">Numero Documento: </label>
														<div class="col-sm-4">
															<input value ="" type="text" class="form-control" name="doc" id="doc" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="9" />
														</div>
                                                        <div class="col-sm-3">
															<button type="button" id="btn-buscar" class="btn btn-info btn-sm">
																<i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Buscar
															</button>
														</div>
													</div>
												</div>
                                                <div class="col-sm-6 etiq">
													<div class="form-group row" id="datos">
														<div class="col-sm-12"><label ><small>Direccion:&nbsp;&nbsp;</label><span id="dir"></span></small></div>
														<div class="col-sm-12"><label ><small>Fecha de Nacimiento:&nbsp;&nbsp;</label><span id="nac"></span></small></div>
                                                    </div>
												</div>
												<div class="col-sm-6 etiq">
													<div class="form-group row">
														<label class="modal-label col-sm-5 col-form-label py-10">Apellidos: </label>
														<div class="col-sm-6">
															<input type="text" class="form-control" name="apellidos" id="apellidos" readonly />
														</div>
													</div>
												</div>
												<div class="col-sm-6 etiq">
													<div class="form-group row">
														<label class="modal-label col-sm-4 col-form-label py-10  offset-sm-1">Nombres: </label>
														<div class="col-sm-6">
															<input type="text" class="form-control" name="nombres" id="nombres"  readonly />
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group row">
														<div class="form-check col-sm-6">
															<input type="checkbox" class="form-check-input" name="sipaciente" id="sipaciente" value="1" >
															<label class="form-check-label" for="sipaciente"> ¿Es el Paciente? </label>
														</div>
													</div>
												</div>
												<div class="col-sm-6">
												<div class="form-group row">
														<div class="form-check col-sm-6">
															<input type="checkbox" class="form-check-input" name="simasivo" id="simasivo" value="1" >
															<label class="form-check-label" for="simasivo"> ¿Evento Masivo? </label>
														</div>
													</div>
												</div>
                                                <div class="col-sm-6">
													<div class="form-group row">
														<label class="modal-label col-sm-5 col-form-label py-10">Tipo Incidente: </label>
														<div class="col-sm-6">
															<select class="form-control" name="incidente" id="incidente">
																<option value="">-- Tipo Incidente --</option>
																<?php foreach($incid as $row): ?>
																<option value="<?=$row->idtipoincidente?>"><?=$row->tipo_incidente?></option>
																<?php endforeach; ?>
															</select>
														</div>
													</div>
												</div>
												<div class="col-sm-6 etiq">
													<div class="form-group row">
														<label class="modal-label col-sm-4 col-form-label py-10 offset-sm-1">Fecha: </label>
														<div class="col-sm-6">
															<div class="form-group">
																<div class='input-group'>
																	<input type="date" class="form-control" name="fecha" id="fecha" value="<?=$fechaActual?>"/>
																</div>
															</div>
														</div>
													</div>
												</div>
                                                <div class="col-sm-6">
													<div class="form-group row">
														<label class="modal-label col-sm-5 col-form-label py-10">Prioridad: </label>
														<div class="col-sm-6">
															<select class="form-control" name="prioridad" id="prioridad">
																<option value="">-- Prioridad Emergencia --</option>
																<?php foreach($priori as $row): ?>
																<option value="<?=$row->idprioridadincidente?>"><?=$row->prioridad_emergencia?></option>
																<?php endforeach; ?>
															</select>
														</div>
													</div>
												</div>
                                                <div class="col-sm-6">
													<div class="form-group row">
                                                    </div>
												</div>
                                                <div class="col-sm-12">
													<div class="form-group row">
														<label class="modal-label col-sm-3 col-form-label py-10">Direccion Emergencia: </label>
														<div class="col-sm-8">
															<input value ="" type="text" class="form-control" name="direccion" id="direccion" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="50" />
														</div>
													</div>
												</div>
												<div class="col-sm-6 etiq">
													<div class="form-group row">
														<label class="modal-label col-sm-5 col-form-label py-10 offset-sm-1">Provincia: </label>
														<div class="col-sm-6">
															<select class="form-control" name="provincia" id="provincia">
																<option value="">-- Elija Provincia --</option>
															</select>
														</div>
													</div>
												</div>
                                                <div class="col-sm-6 etiq">
													<div class="form-group row">
														<label class="modal-label col-sm-4 col-form-label py-10">Distrito: </label>
														<div class="col-sm-6">
															<select class="form-control" name="distrito" id="distrito">
																<option value="">-- Elija Distrito --</option>
															</select>
														</div>
													</div>
												</div>
                                                <div class="col-sm-6">
													<div class="form-group row">
                                                    </div>
												</div>
												<div class="col-sm-12 etiq">
													<div id="map" class="my-3" style="min-height: 250px; width: 100%;"></div>
													<input type="hidden" class="" name="latitud" id="latitud" value="" />
                                  					<input type="hidden" class="" name="longitud" id="longitud" value="" />
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
					</section>
				</div>
				<?php $this->load->view('layout/footer'); ?>
			</div>
		</div>
		<script src="<?=base_url()?>public/js/vendors.min.js"></script>
		<script src="<?=base_url()?>public/assets/icons/feather-icons/feather.min.js"></script>
		<script src="<?=base_url()?>public/assets/vendor_components/datatable/datatables.min.js"></script>
		<script src="<?=base_url()?>public/js/jquery.validate.min.js"></script>
				
		<script>
			var generalZoom = 15;
			const canDelete = "1";
			const canEdit = "1";
			var emerg = JSON.parse('<?=$listaEmergencias?>');
		</script>

		<script src="<?=base_url()?>public/js/emergencias/initMapMapa.js"></script>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?='AIzaSyByPoOpv9DTDZfL0dnMxewn5RHnzC8LGpc'?>&libraries=places&callback=initMap" ></script>
		<script src="<?=base_url()?>public/js/emergencias/emergencias.js"></script>

        <script>emergencias("<?=base_url()?>");</script>

		<script src="<?=base_url()?>public//assets/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>
		<script src="<?=base_url()?>public//assets/vendor_components/progressbar.js-master/dist/progressbar.js"></script>
		<script src="<?=base_url()?>public/js/template.js"></script>
		<script src="<?=base_url()?>public/js/pages/dashboard.js"></script>
		<script src="<?=base_url()?>public/js/demo.js"></script>
	</body>
</html>
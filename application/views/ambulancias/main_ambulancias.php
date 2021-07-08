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
										<h3 class="box-title">Listado General de Ambulancias</h3>
										<h6 class="box-subtitle">Módulo donde se muestran las Ambulancias Registradas en el Sistema</h6>
									</div>
									<div class="box-body">
										<div class="col-sm-12 col-md-5 col-md-offset-5 pa-10">
											<button type="button" class="btn btn-primary btn-nuevo" data-toggle="modal" id="btnRegistrar">
												<i class="fa fa-file-text-o" aria-hidden="true"></i>
													Registrar Ambulancias  
											</button>
										</div>
									</br>
									<div class="table-responsive">
										<table id="dt-ambulancias" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
											<thead>
												<tr>
													<th>Acciones</th>
													<th>Placa</th>
													<th>Marca</th>
													<th>Modelo</th>
													<th>GPS</th>
													<th>Tipo</th>
													<th>Condicion</th>
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
											<input type="hidden" name="idambulancia" id="idambulancia">
											<input type="hidden" name="act" id="act">
												<div class="alert alert-warning ingresos__alert" role="alert" hidden>
													<span class="alert__span"></span>
													<button type="button" class="close" data-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Placa: </label>
															<div class="col-sm-7">
																<input type="text" class="form-control" name="placa" id="placa" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="6"/>
															</div>															
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group row">
															<label class="modal-label col-sm-4 col-form-label py-10">Marca: </label>
															<div class="col-sm-7">
																<select class="form-control" name="idmarca" id="idmarca">
																	<option value="">-- Marca --</option>
																	<?php foreach($listaMarcas as $row): ?>
																	<option value="<?=$row->idmarca?>"><?=$row->marca?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>																					
													<div class="col-sm-6">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Modelo: </label>
															<div class="col-sm-7">
																<input type="text" class="form-control" name="modelo" id="modelo" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="20"/>
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group row">
															<label class="modal-label col-sm-4 col-form-label py-10">Tipo Combustible: </label>
															<div class="col-sm-7">
																<select class="form-control" name="idtipocombustible" id="idtipocombustible">
																	<option value="">-- Tipo Combustible --</option>
																	<?php foreach($listaCombustibles as $row): ?>
																	<option value="<?=$row->idtipocombustible?>"><?=$row->combustible?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">GPS: </label>
															<div class="col-sm-7">
																<select class="form-control" name="gps" id="gps">
																	<option value="">-- Elija Opcion --</option>
																	<option value="1">SI</option>
																	<option value="0">NO</option>
																</select>
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group row">
															<label class="modal-label col-sm-4 col-form-label py-10">Tipo Ambulancia: </label>
															<div class="col-sm-7">
																<select class="form-control" name="idtipoambulancia" id="idtipoambulancia">
																	<option value="">-- Elija Tipo --</option>
																	<?php foreach($listaTiposAmbulancias as $row): ?>
																	<option value="<?=$row->idtipoambulancia?>"><?=$row->tipo?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>																																												
													<div class="col-sm-6">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Serie del Motor: </label>
															<div class="col-sm-7">
																<input type="text" class="form-control" name="serie_motor" id="serie_motor" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="30" />
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group row">
															<label class="modal-label col-sm-4 col-form-label py-10">Codigo Patrimonial: </label>
															<div class="col-sm-7">
																<input type="text" class="form-control" name="codigo_patrimonial" id="codigo_patrimonial" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="10"/>
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Año Fabricación: </label>
															<div class="col-sm-7">
																<input type="text" value="" maxlength="4" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" class="form-control" name="fabricacion_anio" id="fabricacion_anio" />
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group row">
															<label class="modal-label col-sm-4 col-form-label py-10">Año Modelo: </label>
															<div class="col-sm-7">
																<input type="text" value="" maxlength="4" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" class="form-control" name="modelo_anio" id="modelo_anio" />
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Condición: </label>
															<div class="col-sm-7">
																<select class="form-control" name="condicion" id="condicion">
																	<option value="">-- Elija Opcion --</option>
																	<option value="1">Operativo</option>
																	<option value="0">Inoperativo</option>
																</select>
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group row">
															<label class="modal-label col-sm-4 col-form-label py-10"> </label>
															<div class="col-sm-7">
																
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group row" style="justify-content: center;">
															<div id='product-tumb' class="img_content">
																<img class="img_form" id="imagen" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="/>
															</div>
															<div class="col-sm-12 pt-20">
																<div class="col-sm-12">
																	<input type="file" name="file" id="file" accept="image/*" class="inputfile inputfile-1" aria-describedby="inputGroupFileAddon01" />
																	<label for="file"><i class="fa fa-upload" aria-hidden="true"></i> <span class="custom-file-img">Escoger Imagen&hellip;</span></label>
																</div>
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
					</section>
				</div>
			</div>
			<?php $this->load->view('layout/footer'); ?>
		</div>
		<script src="<?=base_url()?>public/js/vendors.min.js"></script>
		<script src="<?=base_url()?>public/assets/icons/feather-icons/feather.min.js"></script>
		<script src="<?=base_url()?>public/assets/vendor_components/datatable/datatables.min.js"></script>
		<script src="<?=base_url()?>public/js/jquery.validate.min.js"></script>
		<script src="<?=base_url()?>public/js/ambulancias/ambulancias.js"></script>
		<script> 
			const canDelete = "1";
			const canEdit = "1";
			var lista = JSON.parse('<?=$listaAmbulancias?>');  

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

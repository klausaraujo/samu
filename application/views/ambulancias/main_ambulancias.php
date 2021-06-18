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
											<input type="hidden" name="idbase" id="idbase">
												<div class="alert alert-warning ingresos__alert" role="alert" hidden>
													<span class="alert__span"></span>
													<button type="button" class="close" data-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Marca: </label>
															<div class="col-sm-7">
																<select class="form-control" name="marca" id="marca">
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
															<label class="modal-label col-sm-5 col-form-label py-10">Tipo Combustible: </label>
															<div class="col-sm-7">
																<select class="form-control" name="combustible" id="combustible">
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
																<select class="form-control" name="provincia" id="provincia">
																	<option value="">-- Elija Opcion --</option>
																	<option value="1">SI</option>
																	<option value="0">NO</option>
																</select>
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Tipo Ambulancia: </label>
															<div class="col-sm-7">
																<select class="form-control" name="tipoambulancia" id="tipoambulancia">
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
																<input type="text" class="form-control" name="seriemotor" id="seriemotor" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="30" />
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Codigo Patrimonial: </label>
															<div class="col-sm-7">
																<input type="text" class="form-control" name="codigopatrimonial" id="codigopatrimonial" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="10"/>
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Año Fabricación: </label>
															<div class="col-sm-7">
																<input type="text" value="" maxlength="4" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" class="form-control" name="aniofabricacion" id="aniofabricacion" />
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Año Modelo: </label>
															<div class="col-sm-7">
																<input type="text" value="" maxlength="4" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" class="form-control" name="aniomodelo" id="aniomodelo" />
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Condición: </label>
															<div class="col-sm-7">
																<select class="form-control" name="provincia" id="provincia">
																	<option value="">-- Elija Opcion --</option>
																	<option value="1">Operativo</option>
																	<option value="0">Inoperativo</option>
																</select>
															</div>
														</div>
													</div>
												</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
											<button type="submit" class="btn btn-primary">Guardar</button>
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
	</body>
</html>

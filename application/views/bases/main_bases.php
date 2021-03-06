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
										<h3 class="box-title">Listado General de Bases</h3>
										<h6 class="box-subtitle">Módulo donde se muestran las Bases Registradas en el Sistema</h6>
									</div>
									<div class="box-body">
										<div class="col-sm-12 col-md-5 col-md-offset-5 pa-10">
											<button type="button" class="btn btn-primary btn-nuevo" data-toggle="modal" id="btnRegistrar">
												<i class="fa fa-file-text-o" aria-hidden="true"></i>
													Registrar Bases  																				
											</button>
										</div>
									</br>
									<div class="table-responsive">
										<table id="dt-bases" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
											<thead>
												<tr>
													<th>Acciones</th>
													<th>Nombre</th>
													<th>Domicilio</th>
													<th>Ubicación</th>
													<th>F. Registro</th>
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
											<input type="hidden" name="idbase" id="idbase">
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
																<label class="modal-label col-sm-5 col-form-label py-10">Nombre Base: </label>
																<div class="col-sm-7">
																	<input type="text" class="form-control" name="nombre" id="nombre" />
																</div>
															</div>
													</div>																					
													<div class="col-sm-6">
														<div class="form-group row">
															<label class="modal-label col-sm-4 col-form-label py-10">Dirección: </label>
															<div class="col-sm-7">
																<input type="text" class="form-control" name="direccion" id="direccion" />
															</div>
														</div>
													</div>
													<?php
													$region = 15;
													?>
													<div class="col-sm-6">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Region: </label>
															<div class="col-sm-7">
																<select class="form-control" name="departamento" id="departamento">
																	<option value="0">-- Regi&oacute;n --</option>
																	<?php foreach($departamentos as $row): ?>
																	<option value="<?=$row->cod_dep?>"><?=$row->departamento?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group row">
															<label class="modal-label col-sm-4 col-form-label py-10">Provincia: </label>
															<div class="col-sm-7">
																<select class="form-control" name="provincia" id="provincia">
																	<option value="0">-- Elija Provincia --</option>
																</select>
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group row">
															<label class="modal-label col-sm-5 col-form-label py-10">Distrito: </label>
															<div class="col-sm-7">
																<select class="form-control" name="distrito" id="distrito">
																	<option value="0">-- Elija Distrito --</option>
																</select>
															</div>
														</div>
													</div>																																												
													<div class="col-sm-6">
														<div class="form-group row">
															<label class="modal-label col-sm-4 col-form-label py-10">Fecha de Inicio: </label>
															<div class="col-sm-7">
																<div class="form-group">
																	<div class='input-group'>
																		<input type="date" class="form-control" name="fechainicio" id="fechainicio" value=""/>
																	</div>
																</div>
															</div>
														</div>
													</div>																							
												</div>
												<div class="row">
														<div class="col-12 col-sm-6">
															<div class="form-group row" style="justify-content: center;">
																<div id='product-tumb' class="img_content">
																	<img class="img_form" id="imagen" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="/>
																</div>
																<div class="col-sm-12 pt-20">
																	<div class="col-sm-12">
																		<input type="file" name="file" id="file" class="inputfile inputfile-1" aria-describedby="inputGroupFileAddon01" />
																		<label for="file"><i class="fa fa-upload" aria-hidden="true"></i> <span class="custom-file-img">Escoger Imagen&hellip;</span></label>
																	</div>
																</div>
															</div>
														</div>

														<div class="col-12 col-sm-6">
															<div id="map" class="my-3" style="min-height: 400px; width: 100%;"></div>
															<input type="hidden" class="" name="latitud" id="latitud" value="" />
                                  							<input type="hidden" class="" name="longitud" id="longitud" value="" />
														</div>
													</div>
																									
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
													<button id="enviar" type="submit" class="btn btn-primary">Guardar</button>
												</div>
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
		<script src="<?=base_url()?>public/js/bases/bases.js"></script>
		<script>
			var generalZoom = 13;
		</script>
		<script src="<?=base_url()?>public/js/bases/initMapMapa.js"></script>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?='AIzaSyByPoOpv9DTDZfL0dnMxewn5RHnzC8LGpc'?>&libraries=places&callback=initMap" ></script>

		<script src="<?=base_url()?>public//assets/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>
		<script src="<?=base_url()?>public//assets/vendor_components/progressbar.js-master/dist/progressbar.js"></script>
		<!-- Florence Admin App -->
		<script src="<?=base_url()?>public/js/template.js"></script>
		<script src="<?=base_url()?>public/js/pages/dashboard.js"></script>
		<script src="<?=base_url()?>public/js/demo.js"></script>
		
		<script> 
			const canDelete = "1";
			const canEdit = "1";
			var lista = JSON.parse('<?=$listaBases?>');													
		</script>
		<script>bases("<?=$this->config->item('path_url')?>","<?=$region?>");</script>
	</body>
</html>

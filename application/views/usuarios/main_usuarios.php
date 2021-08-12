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
										<h3 class="box-title">Listado General de Usuarios</h3>
										<h6 class="box-subtitle">Módulo donde se muestran los Usuarios Registrados en el Sistema</h6>
									</div>
									<div class="box-body">
										<div class="col-sm-12 col-md-5 col-md-offset-5 pa-10">
											<button type="button" class="btn btn-primary btn-nuevo" data-toggle="modal" id="btnRegistrar">
												<i class="fa fa-file-text-o" aria-hidden="true">&nbsp;</i>Registrar Usuarios
                                            </button>
										</div></br>
										<div class="table-responsive">
											<table id="dt-usuarios" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
												<thead>
													<tr>
														<th>Acciones</th>
														<th>DNI</th>
														<th>Apellidos</th>
														<th>Nombres</th>
														<th>Usuario</th>
														<th>Perfil</th>
                                                        <th>Regiones</th>
														<th>Estado</th>
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
									<input type="hidden" name="iduser" id="iduser" />
									<input type="hidden" name="act" id="act" value=0 />
										<div class="modal-body">
											<div class="alert alert-warning ingresos__alert" role="alert" hidden>
												<span class="alert__span"></span>
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div id="labelStatus">
												<div class="row">
													<div class="col-sm-9"></div>												
													<div class="col-md-3">
														<label>Estatus&nbsp;&nbsp;&nbsp;</label>
														<span id="userStatus" style="padding:2px;padding-left:15px;padding-right:15px;color:white" class=""></span>
													</div>
												</div>
												<div class="row"><span class="col-md-12" style="margin:10px"></span></div>
											</div>
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group row">
														<label class="modal-label col-sm-3 col-form-label py-10">DNI: </label>
														<div class="col-sm-4">
															<input type="text" class="form-control" name="dni" id="dni" maxlength="8" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" />
														</div>
														<div class="col-sm-3">
															<button type="button" id="btn-buscar" class="btn btn-info btn-sm">
																<i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Buscar
															</button>
														</div>														
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group row">
														<label class="modal-label col-sm-3 col-form-label py-10">Nombres: </label>
														<div class="col-sm-7">
															<input value ="" type="text" class="form-control" name="nombres" id="nombres" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="50" />
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group row">
														<label class="modal-label col-sm-3 col-form-label py-10">Apellidos: </label>
														<div class="col-sm-7">
															<input value ="" type="text" class="form-control" name="apellidos" id="apellidos" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="50" />
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group row">
														<label class="modal-label col-sm-3 col-form-label py-10">Perfil: </label>
														<div class="col-sm-7">
															<select class="form-control" name="perfil" id="perfil">
																<option value="" class="lista">-- Perfil --</option>
																<?php foreach($perfiles as $row): ?>
																<option value="<?=$row->idperfil?>"><?=$row->perfil?></option>
																<?php endforeach; ?>
															</select>
														</div>
													</div>
												</div>
												<div id="etiq1" class="col-sm-6">
													<div class="form-group row">
														<label id="etiq" class="modal-label col-sm-3 col-form-label py-10">Usuario: </label>
														<div class="col-sm-7">
															<input value ="" type="text" class="form-control" name="user" id="user" />
														</div>
													</div>
												</div>
												<div id="etiq2" class="col-sm-6">
													<div class="form-group row">
														<label id="etiq1" class="modal-label col-sm-3 col-form-label py-10">Password: </label>
														<div class="col-sm-7">
															<input value ="" type="text" class="form-control" name="pass" id="pass" />
														</div>
													</div>
												</div>
												<div class="col-sm-12">
													


													<div class="form-group row">
														<div id="padreRegion" class="col-sm-6 offset-sm-3">
															<div id="selectRegion" class="row align-items-center">
																<label class="modal-label col-sm-3 col-form-label py-10">Regiones: </label>
																<select size=3 class="form-control col-sm-7" name="region" id="region" multiple>
																	<?php foreach($departamentos as $row): ?>
																	<option value="<?=$row->idregion?>"><?=$row->region?></option>
																	<?php endforeach; ?>
																</select>
																<a id="agregar" href="#">
																	<i class="glyphicon glyphicon-plus-sign col-sm-2 text-success fa-lg" title="Agregar"></i>
																</a>
																<input id="asignar" name="asignar" type="text" style="width:20px" />
															</div>
														</div>
													</div>
												</div>
											</div>
											<div id="grilla" class="row"></div>											
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
		<script src="<?=base_url()?>public/js/usuarios/usuarios.js"></script>
		<script> 
			const canDelete = "1";
			const canEdit = "1";
			var lista = JSON.parse('<?=$listaUsuarios?>');  

		</script>
		<script>usuarios("<?=base_url()?>");</script>

		<script src="<?=base_url()?>public//assets/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>
		<script src="<?=base_url()?>public//assets/vendor_components/progressbar.js-master/dist/progressbar.js"></script>
		<script src="<?=base_url()?>public/js/template.js"></script>
		<script src="<?=base_url()?>public/js/pages/dashboard.js"></script>
		<script src="<?=base_url()?>public/js/demo.js"></script>
	</body>
</html>

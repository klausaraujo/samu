<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1">
					<meta name="description" content="">
						<meta name="author" content="">
							<link rel="icon" href="
								
								<?=base_url()?>public/images/favicon.ico">
								<title>Ministerio de Salud - SAMU-106</title>
								<link rel="stylesheet" href="
									
									<?=base_url()?>public/css/vendors_css.css">
									<!-- Style-->
									<link rel="stylesheet" href="
										
										<?=base_url()?>public/css/style.css">
										<link rel="stylesheet" href="
											
											<?=base_url()?>public/css/skin_color.css">
										</head>
										<body class="hold-transition light-skin sidebar-mini theme-primary">
											<div class="wrapper">
												<?php $this->load->view('layout/header'); ?>
												<?php $this->load->view('layout/sidebar'); ?>
												<div class="content-wrapper">
													<div class="container-full">
														<!-- Main content -->
														<section class="content">
															<div class="col-12">
																<div class="box">
																	<div class="box">
																		<div class="box-header with-border">
																			<h3 class="box-title">Listado General de Bases</h3>
																			<h6 class="box-subtitle">Módulo donde se muestran las Bases Registradas en el Sistema</h6>
																		</div>
																		<!-- /.box-header -->
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
																	<!-- /.box-body -->
																</div>
																<!-- /.box -->
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
																		<form id="formRegistrar" method="post" action="" autocomplete="off" enctype="multipart/form-data">
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
																									<label class="modal-label col-sm-5 col-form-label py-10">Nombre Base: </label>
																									<div class="col-sm-7">
																										<input type="text" class="form-control" name="nombre" id="nombre" />
																									</div>
																								</div>
																						</div>																					
																						<div class="col-sm-6">
																								<div class="form-group row">
																									<label class="modal-label col-sm-5 col-form-label py-10">Dirección: </label>
																									<div class="col-sm-7">
																										<input type="text" class="form-control" name="direccion" id="direccion" />
																									</div>
																								</div>
																						</div>
																						<div class="col-sm-6">
																								<div class="form-group row">
																									<label class="modal-label col-sm-5 col-form-label py-10">Region: </label>
																									<div class="col-sm-7">
																										<select class="form-control" name="departamento" id="departamento">
																											<option value="">-- Regi&oacute;n --</option>
                      								  														<?php foreach($departamentos as $row): ?>
                      								  														<option value="<?=$row->cod_dep?>"><?=$row->departamento?></option>
                      								  														<?php endforeach; ?>
                      																					</select>
																									</div>
																								</div>
																						</div>
																						<div class="col-sm-6">
																								<div class="form-group row">
																									<label class="modal-label col-sm-5 col-form-label py-10">Provincia: </label>
																									<div class="col-sm-7">
																										<select class="form-control" name="provincia" id="provincia">
																											<option value="">-- Elija Provincia --</option>
																										</select>
																									</div>
																								</div>
																						</div>
																						<div class="col-sm-6">
																								<div class="form-group row">
																									<label class="modal-label col-sm-5 col-form-label py-10">Distrito: </label>
																									<div class="col-sm-7">
																										<select class="form-control" name="distrito" id="distrito">
																											<option value="">-- Elija Distrito --</option>
																										</select>
																									</div>
																								</div>
																						</div>																																												
																						<div class="col-sm-6">
																							<div class="form-group row">
																								<label class="modal-label col-sm-5 col-form-label py-10">Fecha de Inicio: </label>
																								<div class="col-sm-7">
																									<div class="form-group">
																										<div class='input-group'>
																											<input type="date" class="form-control" name="fechainicio" id="fechainicio" value="
																												<?php echo date('Y-m-d'); ?>"/>
																											</div>
																										</div>
																									</div>
																								</div>
																							</div>																							
																							
																						</div>
																						<hr />
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
																<!-- /.content -->
															</div>
														</div>
														<?php $this->load->view('layout/footer'); ?>
													</div>
													<!-- ./wrapper -->
													<!-- Vendor JS -->
													<script src="
														<?=base_url()?>public/js/vendors.min.js">
													</script>
													<script src="
														<?=base_url()?>public/assets/icons/feather-icons/feather.min.js">
													</script>
													<script src="								
														<?=base_url()?>public/assets/vendor_components/datatable/datatables.min.js">
													</script>
													<script> 
                        							const canDelete = "1";
                        							const canEdit = "1";
							                        var lista = JSON.parse('<?=$listaBases?>'); 											
													</script>
													<script src="<?=base_url()?>public/js/bases/bases.js">
													</script>
												</body>
											</html>

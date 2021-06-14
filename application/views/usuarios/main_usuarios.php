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
																			<h3 class="box-title">Listado General de Usuarios</h3>
																			<h6 class="box-subtitle">Módulo donde se muestran los Usuarios Registradas en el Sistema</h6>
																		</div>
																		<!-- /.box-header -->
																		<div class="box-body">
																			<div class="col-sm-12 col-md-5 col-md-offset-5 pa-10">
																				<button type="button" class="btn btn-primary btn-nuevo" data-toggle="modal" id="btnRegistrar">
																					<i class="fa fa-file-text-o" aria-hidden="true"></i>
                                            Registrar Usuarios  
																				</button>
																			</div>
																		</br>
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
                                                                                        <th>Region</th>
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
											<!-- Florence Admin App -->
											<script src="
												<?=base_url()?>public/js/template.js">
											</script>
											<script src="
												<?=base_url()?>public/js/demo.js">
											</script>
											<script src="
												<?=base_url()?>public/js/pages/data-table.js">
											</script>
											<script> 
                        const canDelete = "1";
                        const canEdit = "1";
                        var lista = JSON.parse('<?=$listaUsuarios?>');  
											</script>
											<script src="
												<?=base_url()?>public/js/usuarios/usuarios.js">
											</script>
										</body>
									</html>

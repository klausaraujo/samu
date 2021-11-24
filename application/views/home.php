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
	  
	<!-- Style-->  
	<link rel="stylesheet" href="<?=base_url()?>public/css/style.css">
	<link rel="stylesheet" href="<?=base_url()?>public/css/skin_color.css">
  </head>
<body class="hold-transition light-skin sidebar-mini theme-primary">
<div class="wrapper">
    <?php $this->load->view('layout/header'); ?>
    <?php $this->load->view('layout/sidebar'); ?>
  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xl-3 col-md-6 col-12">
					<div class="box">
						<ul class="box-controls pull-right">
						  <li class="dropdown">
							<a data-toggle="dropdown" href="#" class="px-10 pt-5"><i class="ti-more-alt"></i></a>
							<div class="dropdown-menu dropdown-menu-right">
							  <a class="dropdown-item" href="#"><i class="ti-import"></i> Import</a>
							  <a class="dropdown-item" href="#"><i class="ti-export"></i> Export</a>
							  <a class="dropdown-item" href="#"><i class="ti-printer"></i> Print</a>
							  <div class="dropdown-divider"></div>
							  
							</div>
						  </li>
						</ul>
						<div class="box-body pt-0">
							<div class="d-flex align-items-center justify-content-between">
								<div class="icon bg-primary-light rounded-circle">
									<i class="text-primary mr-0 font-size-20 fa fa-heartbeat"></i>
								</div>
								<div>
									<h3 class="text-dark mb-0 font-weight-500">4,235</h3>
									<p class="text-mute mb-0">Total Atenciones</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-md-6 col-12">
					<div class="box">
						<ul class="box-controls pull-right">
						  <li class="dropdown">
							<a data-toggle="dropdown" href="#" class="px-10 pt-5"><i class="ti-more-alt"></i></a>
							<div class="dropdown-menu dropdown-menu-right">
							  <a class="dropdown-item" href="#"><i class="ti-import"></i> Import</a>
							  <a class="dropdown-item" href="#"><i class="ti-export"></i> Export</a>
							  <a class="dropdown-item" href="#"><i class="ti-printer"></i> Print</a>
							  <div class="dropdown-divider"></div>
							  <a class="dropdown-item" href="#"><i class="ti-settings"></i> Settings</a>
							</div>
						  </li>
						</ul>
						<div class="box-body pt-0">
							<div class="d-flex align-items-center justify-content-between">
								<div class="icon bg-info-light rounded-circle">
									<i class="text-info mr-0 font-size-20 fa fa-user-md"></i>
								</div>
								<div>
									<h3 class="text-dark mb-0 font-weight-500">394</h3>
									<p class="text-mute mb-0">Médicos Disponibles</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-md-6 col-12">
					<div class="box">
						<ul class="box-controls pull-right">
						  <li class="dropdown">
							<a data-toggle="dropdown" href="#" class="px-10 pt-5"><i class="ti-more-alt"></i></a>
							<div class="dropdown-menu dropdown-menu-right">
							  <a class="dropdown-item" href="#"><i class="ti-import"></i> Import</a>
							  <a class="dropdown-item" href="#"><i class="ti-export"></i> Export</a>
							  <a class="dropdown-item" href="#"><i class="ti-printer"></i> Print</a>
							  <div class="dropdown-divider"></div>
							  <a class="dropdown-item" href="#"><i class="ti-settings"></i> Settings</a>
							</div>
						  </li>
						</ul>
						<div class="box-body pt-0">
							<div class="d-flex align-items-center justify-content-between">
								<div class="icon bg-warning-light rounded-circle">
									<i class="text-warning mr-0 font-size-20 fa fa-money"></i>
								</div>
								<div>
									<h3 class="text-dark mb-0 font-weight-500">25</h3>
									<p class="text-mute mb-0">Enfermeros Disponibles</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-md-6 col-12">
					<div class="box">
						<ul class="box-controls pull-right">
						  <li class="dropdown">
							<a data-toggle="dropdown" href="#" class="px-10 pt-5"><i class="ti-more-alt"></i></a>
							<div class="dropdown-menu dropdown-menu-right">
							  <a class="dropdown-item" href="#"><i class="ti-import"></i> Import</a>
							  <a class="dropdown-item" href="#"><i class="ti-export"></i> Export</a>
							  <a class="dropdown-item" href="#"><i class="ti-printer"></i> Print</a>
							  <div class="dropdown-divider"></div>
							  <a class="dropdown-item" href="#"><i class="ti-settings"></i> Settings</a>
							</div>
						  </li>
						</ul>
						<div class="box-body pt-0">
							<div class="d-flex align-items-center justify-content-between">
								<div class="icon bg-danger-light rounded-circle">
									<i class="text-danger mr-0 font-size-20 fa fa-ambulance"></i>
								</div>
								<div>
									<h3 class="text-dark mb-0 font-weight-500">35</h3>
									<p class="text-mute mb-0">Ambulancias Operativas</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-7 col-12">
					<div class="box">
						<div class="box-header">
							<h4 class="box-title">Out Patients vs. In Patients Trend</h4>
							<ul class="box-controls pull-right d-md-flex d-none">
							  <li class="dropdown">
								<button class="btn btn-rounded btn-outline btn-primary dropdown-toggle px-10 " data-toggle="dropdown" href="#">Show By Months</button>
								<div class="dropdown-menu dropdown-menu-right">
								  <a class="dropdown-item" href="#"><i class="ti-import"></i> Import</a>
								  <a class="dropdown-item" href="#"><i class="ti-export"></i> Export</a>
								  <a class="dropdown-item" href="#"><i class="ti-printer"></i> Print</a>
								  <div class="dropdown-divider"></div>
								  <a class="dropdown-item" href="#"><i class="ti-settings"></i> Settings</a>
								</div>
							  </li>
							</ul>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-lg-8 col-12">
									<div id="patients-trend"></div>
								</div>
								<div class="col-lg-4 col-12">
									<div id="progressbar1" class="mx-auto w-200 my-25 position-relative text-center"></div>
									<h4 class="text-center">Hospital Bed Availability</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-5 col-12">
					<div class="box">
						<div class="box-header">
							<h4 class="box-title">Pacientes Atendidos por Género</h4>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-lg-6 col-12">
									<div id="progressbar2" class="mx-auto w-200 my-25 position-relative text-center"></div>
									<h4 class="text-center">Varones</h4>
								</div>
								<div class="col-lg-6 col-12">
									<div id="progressbar3" class="mx-auto w-200 my-25 position-relative text-center"></div>
									<h4 class="text-center">Mujeres</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-12">
					<div class="box">
						<div class="box-header">
							<h4 class="box-title">Time Admitted</h4>
						</div>
						<div class="box-body">
							<div id="admitted-trend"></div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-12">
					<div class="box">
						<div class="box-header">
							<h4 class="box-title">Patients By Division</h4>
						</div>
						<div class="box-body">
							<div class="d-flex align-items-center justify-content-between pb-10 pr-20">
								<h5 class="my-0 text-light"><i class="fa fa-home mr-50 w-20"></i>Division</h5>
								<p class="mb-0 text-light">PT.</p>
							</div>
							<div class="pat-div">								
								<div class="d-flex align-items-center justify-content-between my-15 pr-20">
									<h5 class="my-0"><i class="mr-50 w-20 fa fa-heart"></i>Cardiology</h5>
									<p class="mb-0">74</p>
								</div>								
								<div class="d-flex align-items-center justify-content-between my-15 pr-20">
									<h5 class="my-0"><i class="mr-50 w-20 fa fa-user"></i>Neurology</h5>
									<p class="mb-0">32</p>
								</div>								
								<div class="d-flex align-items-center justify-content-between my-15 pr-20">
									<h5 class="my-0"><i class="mr-50 w-20 fa fa-user-md"></i>Surgery</h5>
									<p class="mb-0">15</p>
								</div>							
								<div class="d-flex align-items-center justify-content-between my-15 pr-20">
									<h5 class="my-0"><i class="mr-50 w-20 fa fa-medkit"></i>Covid</h5>
									<p class="mb-0">35</p>
								</div>							
								<div class="d-flex align-items-center justify-content-between my-15 pr-20">
									<h5 class="my-0"><i class="mr-50 w-20 fa fa-stethoscope"></i>General</h5>
									<p class="mb-0">158</p>
								</div>							
								<div class="d-flex align-items-center justify-content-between my-15 pr-20">
									<h5 class="my-0"><i class="mr-50 w-20 fa fa-plus-square"></i>Oncology</h5>
									<p class="mb-0">85</p>
								</div>							
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-12">
					<div class="box overflow-hidden bg-primary">
						<div class="box-body p-0">
							<div class="px-30 pt-20">
								<h4 class="text-white mb-0">34,042 </h4>
								<p class="text-white-50">Patients this month</p>
							</div>
							<div id="statisticschart3"></div>
						</div>
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
	<script src="<?=base_url()?>public/js/vendors.min.js"></script>
    <script src="<?=base_url()?>public//assets/icons/feather-icons/feather.min.js"></script>	
    

	<script src="<?=base_url()?>public//assets/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>
	<script src="<?=base_url()?>public//assets/vendor_components/progressbar.js-master/dist/progressbar.js"></script>
	
	<!-- Florence Admin App -->
	<script src="<?=base_url()?>public/js/template.js"></script>
	<script src="<?=base_url()?>public/js/pages/dashboard.js"></script>
	<script src="<?=base_url()?>public/js/demo.js"></script>
	
	
</body>
</html>

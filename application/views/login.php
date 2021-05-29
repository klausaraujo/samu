<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Ministerio de Salud - Iniciar Sesión</title>
    <?php $this->load->view("layout/resources");?>
    <link rel="stylesheet" href="<?=base_url()?>public/css/style.css">
    <link rel="stylesheet" href="<?=base_url()?>public/css/skin_color.css">
    <link rel="icon" href="<?=base_url()?>public/images/favicon.ico">
</head>
<body class="hold-transition theme-primary bg-img" data-overlay="5">	
	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">	
			<div class="col-12">
				<div class="row justify-content-center no-gutters">
					<div class="col-lg-5 col-md-5 col-12">
						<div class="bg-white rounded30 shadow-lg">
							<div class="content-top-agile p-20 pb-0">
								<h2 class="text-primary">Ingreso al Sistema</h2>
								<p class="mb-0">Ingrese su Usuaro y Clave</p>							
							</div>
							<div class="p-40">
								<form action="<?=base_url()?>auth/doLogin" method="post">
									<div class="form-group">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
											</div>
											<input type="text" name="user" class="form-control pl-15 bg-transparent" placeholder="Usuario" autocomplete="false">
										</div>
									</div>
									<div class="form-group">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text  bg-transparent"><i class="ti-lock"></i></span>
											</div>
											<input type="password" name="password" class="form-control pl-15 bg-transparent" placeholder="Clave" autocomplete=false>
										</div>
									</div>
									  <div class="row">
										<div class="col-12 text-center">
										  <button type="submit" class="btn btn-danger mt-10">INICIAR SESION</button>
										</div>
									  </div>
                                      <?php $message = $this->session->flashdata('error'); ?>
                                        <?php if($message){ ?>
                                        <div class="mt-2 alert alert-danger"><span><?= $message ?></span></div>
                                        <?php } ?>
								</form>	
							</div>						
						</div>
						<div class="text-center">
						  <p class="mt-20 text-white">- Redes Sociales SAMU -</p>
						  <p class="gap-items-2 mb-20">
							  <a class="btn btn-social-icon btn-round btn-facebook" href="#"><i class="fa fa-facebook"></i></a>
							  <a class="btn btn-social-icon btn-round btn-twitter" href="#"><i class="fa fa-twitter"></i></a>
							  <a class="btn btn-social-icon btn-round btn-instagram" href="#"><i class="fa fa-instagram"></i></a>
							</p>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="<?=base_url()?>/public/js/vendors.min.js"></script>
    <script src="<?=base_url()?>/public/assets/icons/feather-icons/feather.min.js"></script>	
</body>
</html>
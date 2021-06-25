<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">	
	    <div class="user-profile px-10 py-15">
			<div class="d-flex align-items-center">			
				<div class="image">
				</div>
				<div class="info ml-10">
          <h5 class="mb-0"><br></h5>
          <h5 class="mb-0">Menú de Opciones</h5>
				</div>
			</div>
        </div>
  
  <ul class="sidebar-menu" data-widget="tree">

      <?php 
            $modulo = $this->session->userdata("modulos");
            $submenu = $this->session->userdata("submenus");
            //echo count($modulo)."  ".count($submenu);
            $i = 0; $j = 0;
            for($i = 0;$i < count($modulo); $i++){                      
      ?>


      <li class="<? echo ($modulo[$i]['activo'] == 1)? 'treeview': '';?>">
        <a href="#">
          <i class="<?echo $modulo[$i]['icono'];?>"></i>
          <span><?echo $modulo[$i]['menu'];?></span>
          <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
        </a>
          <ul class="treeview-menu">
      <?php
          for($j = 0;$j < count($submenu); $j++){
            if($submenu[$j]['idmodulo'] == $modulo[$i]['idmodulo']){
      ?>
        
              <li><a href="<?echo ($submenu[$j]['href'] != NULL)?$submenu[$j]['href']:'#';?>">
                <i class="ti-more"></i>
                <?echo $submenu[$j]['descripcion'];?>
              </a>
          </li>
      <?php
            }
          }
      ?>
          </ul>
        </li>
    <?php } ?>
      </li>
    </ul>
  </section>
</aside>
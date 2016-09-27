      <?php //if($config_template['menu_izquierda']==='template') { ?>
      <!-- Teal page content  -->
      <!-- </div>
    </div> -->
    <?php //} ?>
  <!-- </div>

  <footer class="page-footer orange">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Company Bio</h5>
          <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Settings</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Connect</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a>
      </div>
    </div>
  </footer> 


  

  </body>
</html>-->
<div class="footer-inner">
		<div class="container-fluid">
			<div class="row">
				<div class="container">
				<?php $cont=0;?>
				<?php foreach($cols_pie as $cp):?>
					<?php $cont++;?>
						<!-- <div class="col-md-4 laterales-footer hidden-xs hidden-sm"></div> -->
						<div class="col-md-<?php echo $span; ?> centrado">
						<!--  <div class="col-md-4 centrado">-->
						<?php if($cont == 1){?>
							<!--  <h5 class="tit-footer" style="color:<?php echo $config->cfuentepie;?>;border-top:1px solid <?php echo $config->cbordecabecera;?>"><?php //echo $this->lang->line('cliente_opc_footer_'.$cp->id_opc); ?></h5> -->
						<?php }?>
							<?php if($cp->id_opc == 1){?>
								<ul class="ul-footer">
								<?php foreach($menu_footer as $sec):?>
									<li>
										<?php if ($sec->tipo_seccion == 1):?>
											<a href="<?php echo site_url('site/seccion/'.$sec->url_seo); ?>" style="color:<?php echo $config->cfuentepie;?>"><?php echo $sec->titulo;?></a>
										<?php elseif ($sec->tipo_seccion == 2): ?>
											<a href="<?php echo site_url($sec->url_seo);?>" style="color:<?php echo $config->cfuentepie;?>"><?php echo $sec->titulo; ?></a>
										<?php elseif ($sec->tipo_seccion == 3): ?>
											<a href="<?php echo site_url('blog-articulos');?>" style="color:<?php echo $config->cfuentepie;?>"><?php echo $sec->titulo; ?></a>
										<?php elseif ($sec->tipo_seccion == 4): ?>
											<a href="<?php echo site_url($sec->url_seo);?>" style="color:<?php echo $config->cfuentepie;?>"><?php echo $sec->titulo; ?></a>
										<?php elseif ($sec->tipo_seccion == 6): ?>
											<a href="<?php echo site_url('tienda');?>" style="color:<?php echo $config->cfuentecabecera;?>"><?php echo $sec->titulo; ?></a>
										<?php endif; ?>
									</li>
								<?php endforeach;?>
								</ul>
							<?php }elseif($cp->id_opc == 2){?>
								<?php if($config->facebook != NULL){?>
									<a href="<?php echo $config->facebook;?>"><img src="<?php echo base_url('img/icon-fb.png');?>" onmouseover="src='<?php echo base_url('img/icon-fb.png');?>'" onMouseOut="src='<?php echo base_url('img/icon-fb.png');?>'" class="margin-top-30"/></a>
								<?php }if($config->twitter != NULL){?>
									<a href="<?php echo $config->twitter;?>"><img src="<?php echo base_url('img/twitter.png');?>" onmouseover="src='<?php echo base_url('img/twitter-hover.png');?>'" onMouseOut="src='<?php echo base_url('img/twitter.png');?>'" class="margin-top-30"/></a>
								<?php }if($config->google != NULL){?>
									<a href="<?php echo $config->google;?>"><img src="<?php echo base_url('img/google.png');?>" onmouseover="src='<?php echo base_url('img/google-hover.png');?>'" onMouseOut="src='<?php echo base_url('img/google.png');?>'" class="margin-top-30"/></a>
								<?php }if($config->vimeo != NULL){?>
									<a href="<?php echo $config->vimeo;?>"><img src="<?php echo base_url('img/vimeo.png');?>" onmouseover="src='<?php echo base_url('img/vimeo-hover.png');?>'" onMouseOut="src='<?php echo base_url('img/vimeo.png');?>'" class="margin-top-30"/></a>
								<?php }?>
							<?php }elseif($cp->id_opc == 3){?>
								<?php if($cont == 1){?>
									<div class="texto-pie" style="color:<?php echo $config->cfuentepie;?>">
										<?php echo $codigo1;?>
									</div>
								<?php }elseif($cont == 2){?>
									<div class="texto-pie" style="color:<?php echo $config->cfuentepie;?>">
										<?php echo $codigo2;?>
									</div>
								<?php }elseif($cont == 3){?>
									<div class="texto-pie" style="color:<?php echo $config->cfuentepie;?>">
										<?php echo $codigo3;?>
									</div>
								<?php }elseif($cont == 4){?>
									<div class="texto-pie" style="color:<?php echo $config->cfuentepie;?>">
										<?php echo $codigo4;?>
									</div>
								<?php }?>	
							<?php }?>
						</div>
						<!-- <div class="col-md-4 laterales-footer hidden-xs hidden-sm"></div> -->
				<?php endforeach;?>	
				</div>
			</div>
			
			<div class="row" style="background:#fff;">
				<div class="subfooter">
					<p style="color:#000;"><?php echo $config->nombre.' '.date('Y'); ?>. Todos los derechos reservados</p>
				</div>
			</div>
		</div>
	</div>

<?php if(!$this->input->cookie('cookieLOPD')):?>
<div class="navbar navbar-cookies navbar-fixed-bottom">
	<div class="navbar-inner">
    	<div class="container">
    		Las cookies nos permiten ofrecer nuestros servicios. Al utilizar nuestros servicios, aceptas el uso que hacemos de las cookies.<span class="btn btn-mini btn-success aceptar-cookies">Aceptar</span><a href="<?php echo site_url('aviso-legal#cookies'); ?>"><span class="btn btn-mini">Más info</span></a>
    	</div>
    </div>
</div>
<?php endif; ?>
<style>
td{
	width: 50px;
	height: 50px;
	text-align: center;
	border: 1px solid #e2e0e0;
	font-size: 18px;
	font-weight: bold;
}
td a{
	background-color: red;
	margin-left: -10px;
	margin-right: -10px;
	padding: 13px 13px;
	color:white;
}
th{
	height: 50px;
	padding-bottom: 8px;
	background: #25698d;
	font-size: 20px;
	color: white;
	text-align:center;
}
.prev_sign a, .next_sign a{
	color:white;
	text-decoration: none;
}
tr.week_name{
	font-size: 16px;
	font-weight:400;
	color: #25698d;
	width: 10px;
	background-color: #f5f9fc;
}
.highlight{
	background-color: #25698d;
	color: white;
	height: 50px;
	padding-top: 13px;
	padding-bottom: 7px;
}</style>
<?php 
// Primero defino los campos que voy a necesitar para el formulario
$nombre = array(
		'name'=>'nombre',
		'id'=>'nombre',
		'class'=>'form-control border-radius-8',
		'required' => 'required',
		'placeholder' => '* '.lang('tienda_contacto_nombre_apellidos')
		);
$empresa = array(
		'name'=>'empresa',
		'id'=>'empresa',
		'class'=>'form-control border-radius-8',
		'placeholder' => lang('tienda_contacto_empresa')
);
$email = array(
		'name'=>'email',
		'id'=>'email',
		'class'=>'form-control border-radius-8',
		'required' => 'required',
		'pattern' => "[a-zA-Z0-9.+_-]+@[a-zA-Z0-9.-]+\.[a-zA-Z0-9.-]+",
		'placeholder' => '* '.lang('tienda_contacto_email')
);
$telefono = array(
		'name'=>'telefono',
		'id'=>'telefono',
		'class'=>'form-control border-radius-8',
		'placeholder' => '* '.lang('tienda_contacto_telefono')
);
$mensaje = array(
		'name'=>'mensaje',
		'id'=>'mensaje',
		'class'=>'form-control caja-mensaje border-radius-8',
		'rows'=>4,
		'required' => 'required',
		'placeholder' => '* '.lang('tienda_contacto_mensaje')
);
?>
);?>
<div class="inicio-seccion hidden-xs"></div>
<div class="inicio-seccion-movil hidden-sm hidden-md hidden-lg"></div>
<?php if($inmueble){?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 margin-right-10">
                    <a href="<?php echo $this->utilities->enlace_volver_general(); ?>" class="btn btn-info pull-right">
                        <span class="menu-text">- <?php echo lang('tienda_inmueble_volver');?> -</span>
                    </a>
            </div>
        </div>

        <div class="breadcrumbs margin-top-10" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <a href="<?php echo site_url($this->uri->segment(1).'/browser?referencia=&oferta_id=-1&tipo_id=-1&provincia_id='.$inmueble->provincia_id.'&poblacion_id=&zona_id=&habitaciones=&banios=&precios_desde=&precios_hasta=&metros=&start=0'); ?>"><?php echo $inmueble->nombre_provincia; ?></a>
                </li>
                <li>
                    <a href="<?php echo site_url($this->uri->segment(1).'/browser?referencia=&oferta_id=-1&tipo_id=-1&provincia_id='.$inmueble->provincia_id.'&poblacion_id='.$inmueble->poblacion_id.'&zona_id=&habitaciones=&banios=&precios_desde=&precios_hasta=&metros=&start=0'); ?>"><?php echo $inmueble->nombre_poblacion; ?></a>
                </li>
                <?php if(!empty($inmueble->nombre_zona)) { ?>
                <li>
                    <a href="<?php echo site_url($this->uri->segment(1).'/browser?referencia=&oferta_id=-1&tipo_id=-1&provincia_id='.$inmueble->provincia_id.'&poblacion_id='.$inmueble->poblacion_id.'&zona_id='.$inmueble->zona_id.'&habitaciones=&banios=&precios_desde=&precios_hasta=&metros=&start=0'); ?>"><?php echo $inmueble->nombre_zona; ?></a>
                </li>
                <?php } ?>
            </ul><!-- /.breadcrumb -->
        </div>
    </div>

    <div class="container-fluid background-color-f9">
	<div class="container">
		<div id="aviso-compra">
			<?php if($this->session->flashdata('error')){?>
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>¡Error!</strong> <?php echo $this->session->flashdata('error');?>
				</div>
			<?php }?>
			<?php if($this->session->flashdata('mensaje')){?>
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>¡<?php echo lang('tienda_contacto_enhorabuena'); ?>!</strong> <?php echo $this->session->flashdata('mensaje');?>
				</div>
			<?php }?>
		</div>
		<h1><?php echo $inmueble->titulo; ?></h1>
		<!-- hacerlo en plan slider y que las imágenes mini sean los botoncitos típicos -->
		<div id="mapa" class="col-sm-10 col-md-11 margin-top-20 padding-bottom-20">
			<div class="mapa" id="google_maps_div">            
				<div id="google_maps" class="col-sm-12">
				</div>
			</div>
		</div>
		<div id="galeria" class="col-sm-10 col-md-11 oculto">
			<div class="row">
				<div id="carrusel-img-producto" class="carousel" data-ride="carousel">
				    <div class="carousel-inner" role="listbox">
				    	<?php $primero=true;?>
				    	<?php foreach($imagenes as $it):?>
						    <div class="img-desc-producto item <?php echo ($primero==true)?'active':'';?>">
						      <img src="<?php echo base_url($it->imagen)?>" class="img-responsive" alt="<?php echo $inmueble->titulo;?>" title="<?php echo $inmueble->titulo;?>" />
						    </div>
						    <?php $primero=false;?>
					    <?php endforeach;?>
				    </div>
				</div>
			</div>
			<div class="row">
				<?php $primero=true; $cont=0;?>
			    	<?php foreach($imagenes as $it):?>
			    		<figure data-target="#carrusel-img-producto" data-slide-to="<?php echo $cont;?>" class="mini-producto col-xs-4 col-md-2 <?php echo ($primero==true)?'active':'';?>">
			    			<img src="<?php echo base_url($it->imagen)?>" class="img-responsive" style="width:164px; height:102px;"/>
			    		</figure>
		    		<?php $primero=false; $cont++;?>
				<?php endforeach;?>
		    </div>
		</div>
		<?php if($video){?>
			<div id="video" class="col-sm-10 col-md-11 oculto margin-top-20 padding-bottom-20">
				<div class="mapa">
                                    <?php $video = explode('&', str_replace('https://www.youtube.com/watch?v=', '', $video->url));
                                    $video[0] = str_replace('https://youtu.be/', '', $video[0]);?>
                                    <iframe src="<?php echo "https://www.youtube.com/embed/".$video[0];?>/?&showinfo=0&rel=0&autoplay=0" frameborder="0" allowfullscreen></iframe>
                                </div>
			</div>
		<?php }?>
		<div id="contacto" class="col-sm-10 col-md-11 oculto margin-top-20">
			<?php echo form_open('',array('class'=>'form-horizontal','id'=>'frmInmueble')); ?>
					<div class="col-sm-6">
						<div class="col-sm-12">
								<?php echo form_input($nombre); ?>
								<span><?php echo form_error('nombre'); ?></span>
								<p></p>
						</div>
						<div class="col-sm-12">
								<?php echo form_input($email); ?>
								<span><?php echo form_error('email'); ?></span>
								<p></p>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="col-sm-12">
								<?php echo form_input($empresa); ?>
								<span><?php echo form_error('empresa'); ?></span>
								<p></p>
						</div>
						<div class="col-sm-12">
								<?php echo form_input($telefono); ?>
								<span><?php echo form_error('telefono'); ?></span>
								<p></p>	
						</div>
					</div>
					<div class="col-sm-12">
						<div class="col-sm-12">
							<?php echo form_textarea($mensaje); ?>
							<span><?php echo form_error('mensaje'); ?></span>
							<p></p>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="col-sm-12">
							<button class="g-recaptcha btn-contacto" data-sitekey="<?php echo $this->session->userdata('recaptcha_site_key'); ?>" data-callback="onSubmitInmueble"><?php echo lang('tienda_contacto_enviar'); ?></button>
						</div>
					</div>
					<input type="hidden" name="inmueble" value="<?php echo $inmueble->titulo; ?>"/>
					<input type="hidden" name="referencia" value="<?php echo $inmueble->referencia; ?>"/>
				<?php echo form_close(); ?>
		</div>
                <?php if($enlaces){?>
                    <div id="enlaces" class="col-sm-10 col-md-11 oculto margin-top-20">
                        <?php foreach($enlaces as $enlace){?>
                            <p><a target="_blank" class="text-primary" href="<?php echo $enlace->url;?>">- <?php echo $enlace->titulo;?> -</a></p>
                        <?php }?>
                    </div>
                <?php }?>
		<div class="col-sm-2 col-md-1 padding-left-10">
			<ul class="margin-top-20">
				<li id="imapa" class="item-menu-inmueble cursor-pointer"><i class="fa fa-map fa-lg" aria-hidden="true"></i></li>
				<li id="igaleria" class="item-menu-inmueble cursor-pointer"><i class="fa fa-picture-o fa-lg" aria-hidden="true"></i></li>                                
				<?php if($video){?>
					<li id="ivideo" class="item-menu-inmueble cursor-pointer"><i class="fa fa-video-camera fa-lg" aria-hidden="true"></i></li>
				<?php }?>
				<li id="icontacto" class="item-menu-inmueble cursor-pointer"><i class="fa fa-envelope fa-lg" aria-hidden="true"></i></li>
                                <?php if($enlaces){?>
                                    <li id="ienlaces" class="item-menu-inmueble cursor-pointer"><i class="fa fa-link fa-lg" aria-hidden="true"></i></li>
                                <?php }?>
			</ul>
		</div>
	</div>
    </div>
    <div class="container-fluid">
        <div class="col-sm-12 margin-top-20">
            <h3><?php echo 'Ref. '.$inmueble->referencia;?></h3>
        </div>
        <div class="col-sm-12 margin-top-20">
            <h3><?php echo $this->lang->line('tienda_descripcion_inmueble');?></h3>
            <?php echo $inmueble->descripcion;?>
        </div>
        <div class="col-sm-12 margin-top-20">
            <?php if($inmueble->precio_compra > 0){?>
                <div class="col-sm-6 maring-top-10 padding-left-0">
                    <h3><?php echo $this->lang->line('tienda_inmueble_precio_compra');?></h3>
                        <?php
                        if ($inmueble->precio_compra_anterior > 0) {
                            echo '<h2><s>' . number_format($inmueble->precio_compra_anterior, 2, ",", ".") . ' &euro;</s></h2>';
                            echo '<h2>'.number_format($inmueble->precio_compra, 2, ",", ".") . ' &euro;</h2>';
                        } else {
                            echo '<h2>'.number_format($inmueble->precio_compra, 2, ",", ".") . ' &euro;</h2>';
                        }
                        ?>
                </div>
            <?php } ?>
            <?php if ($inmueble->precio_alquiler > 0) { ?>
                <div class="col-sm-6 maring-top-10 padding-left-0">
                    <h3><?php echo $this->lang->line('tienda_inmueble_precio_alquiler');?></h3>
                        <?php
                        if ($inmueble->precio_alquiler_anterior > 0) {
                            echo '<h2><s>' . number_format($inmueble->precio_alquiler_anterior, 2, ",", ".") . ' &euro; / '.lang('tienda_inmueble_precio_mes').'</s></h2>';
                            echo '<h2>'.number_format($inmueble->precio_alquiler, 2, ",", ".") . ' &euro; / '.lang('tienda_inmueble_precio_mes').'</h2>';
                        } else {
                            echo '<h2>'.number_format($inmueble->precio_alquiler, 2, ",", ".") . ' &euro; / '.lang('tienda_inmueble_precio_mes').'</h2>';
                        }
                        ?> 
                </div>
            <?php } ?>
        </div>
        <div class="col-sm-12 margin-top-20">
            <h3><?php echo $this->lang->line('tienda_caracteristicas_inmueble');?></h3>
            <div class="col-sm-6 inmueble-caracteristicas-1"><?php echo $this->lang->line('tienda_tipo_propiedad');?></div>
            <div class="col-sm-6 inmueble-caracteristicas-2"><?php echo $inmueble->nombre_tipo; ?></div>
            <div class="col-sm-6 inmueble-caracteristicas-1"><?php echo $this->lang->line('tienda_superficie_construida'); ?></div>
            <div class="col-sm-6 inmueble-caracteristicas-2"><?php echo $inmueble->metros; ?></div>
            <div class="col-sm-6 inmueble-caracteristicas-1"><?php echo $this->lang->line('tienda_superficie_util'); ?></div>
            <div class="col-sm-6 inmueble-caracteristicas-2"><?php echo $inmueble->metros_utiles; ?></div>
            <div class="col-sm-6 inmueble-caracteristicas-1"><?php echo $this->lang->line('tienda_banos'); ?></div>
            <div class="col-sm-6 inmueble-caracteristicas-2"><?php echo $inmueble->banios; ?></div>
            <div class="col-sm-6 inmueble-caracteristicas-1"><?php echo $this->lang->line('tienda_dormitorios'); ?></div>
            <div class="col-sm-6 inmueble-caracteristicas-2"><?php echo $inmueble->habitaciones; ?></div>
        </div>
        <?php if($extras){?>
            <div class="col-sm-12 margin-top-20">
                <h3><?php echo $this->lang->line('tienda_extras_inmueble');?></h3>
                <?php foreach($extras as $extra){?>
                    <div class="col-sm-6 margin-top-10"><?php echo $extra->nombre;?></div>
                <?php }?>
            </div>
        <?php }?>
        <?php if($lugares){?>
            <div class="col-sm-12 margin-top-20">
                <h3><?php echo $this->lang->line('tienda_lugares_inmueble');?></h3>
                <?php foreach($lugares as $lugar){?>
                    <div class="col-sm-6 margin-top-10"><?php echo $lugar->nombre;?></div>
                <?php }?>
            </div>
        <?php }?>
        <div class="col-sm-12 margin-top-20">
            <h3><?php echo $this->lang->line('tienda_cenergetica_inmueble');?></h3>
            <?php if($ce->id != 8 && $ce->id != 9){?>
                <img src="<?php echo base_url('assets/public/img/ce_'.$ce->nombre.'.png');?>" class="img-responsive"/>
                <h4><?php echo $ce->kwh_m2_anio.' kwh';?></h4>
            <?php }else{
                if($ce->id == 8)
                {
                    echo '<h4>'.lang('tienda_inmueble_ce_exento').'</h4>';
                }
                else
                {
                    echo '<h4>'.lang('tienda_inmueble_ce_tramite').'</h4>';
                }
            }?>
        </div>
    </div>
    <input type="hidden" id="base_url" value="<?php echo base_url();?>" />
    <input type="hidden" id="site_url" value="<?php echo site_url();?>" />
    <input type="hidden" id="site_idioma" value="<?php echo $this->uri->segment(1);?>" />
<?php }else{?>
    <h3 style="text-align:center;padding-top:40px;"><?php echo $this->lang->line('tienda_inmueble_no_existe');?></h3>
<?php }?>
<script>
$(document).ready(function(){
        // Comprobamos si hay que mostrar mapa google maps
        check_google_maps();
	$('#imapa').click(function(){
		$('#galeria').fadeOut(1);
		$('#video').fadeOut(1);
		$('#contacto').fadeOut(1);
                $('#enlaces').fadeOut(1);
		$('#mapa').fadeIn(1);
	});
	$('#igaleria').click(function(){
		$('#mapa').fadeOut(1);
		$('#video').fadeOut(1);
		$('#contacto').fadeOut(1);
                $('#enlaces').fadeOut(1);
		$('#galeria').fadeIn(1);
	});
	$('#ivideo').click(function(){
		$('#mapa').fadeOut(1);
		$('#galeria').fadeOut(1);
		$('#contacto').fadeOut(1);
                $('#enlaces').fadeOut(1);
		$('#video').fadeIn(1);
	});
	$('#icontacto').click(function(){
		$('#mapa').fadeOut(1);
		$('#galeria').fadeOut(1);
		$('#video').fadeOut(1);
                $('#enlaces').fadeOut(1);
		$('#contacto').fadeIn(1);
	});
        $('#ienlaces').click(function(){
		$('#mapa').fadeOut(1);
		$('#galeria').fadeOut(1);
		$('#video').fadeOut(1);
		$('#contacto').fadeOut(1);
                $('#enlaces').fadeIn(1);
	});
});
function check_google_maps() {
    var pais_id=64;      
    var direccion="<?php echo $inmueble->direccion_publica;?>";

    if(pais_id!='' && direccion!='')
    {
        $('#google_maps_div').show();     
        
        var poblacion_id="<?php echo $inmueble->poblacion_id;?>";
        var provincia_id="<?php echo $inmueble->provincia_id;?>";

        if(poblacion_id!='' && provincia_id!='')
        {
            var url='/common/single_google_map?direccion='+direccion+'&provincia_id='+provincia_id+'&poblacion_id='+poblacion_id+'&pais_id='+pais_id;
        }
        else
        {
            var url='/common/single_google_map?direccion='+direccion+'&pais_id='+pais_id;
        }
        
        var url_encode = encodeURI(url);

        $('#google_maps').load('<?php echo site_url();?>'+url_encode);
    }
    else
    {
        $('#google_maps_div').hide();
    }
}
</script>

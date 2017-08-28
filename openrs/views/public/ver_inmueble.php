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
<?php $nombre = array(
		'name'=>'nombre',
		'id'=>'nombre',
		'class'=>'form-control border-radius-8',
		'required' => 'required',
		'placeholder' => '* Nombre y Apellidos'
		);
$empresa = array(
		'name'=>'empresa',
		'id'=>'empresa',
		'class'=>'form-control border-radius-8',
		'placeholder' => 'Empresa'
);
$email = array(
		'name'=>'email',
		'id'=>'email',
		'class'=>'form-control border-radius-8',
		'required' => 'required',
		'pattern' => "[a-zA-Z0-9.+_-]+@[a-zA-Z0-9.-]+\.[a-zA-Z0-9.-]+",
		'placeholder' => '* Email'
);
$telefono = array(
		'name'=>'telefono',
		'id'=>'telefono',
		'class'=>'form-control border-radius-8',
		'placeholder' => '* Teléfono'
);
$mensaje = array(
		'name'=>'mensaje',
		'id'=>'mensaje',
		'class'=>'form-control caja-mensaje border-radius-8',
		'rows'=>4,
		'required' => 'required',
		'placeholder' => 'Mensaje',
		'onkeypress'=>'onTestChange()'
);?>
<div class="inicio-seccion hidden-xs"></div>
<div class="inicio-seccion-movil hidden-sm hidden-md hidden-lg"></div>
<?php if($inmueble){?>
    <div class="container-fluid background-color-f9">
	<div class="container">
		<div id="aviso-compra"></div>
		<h1><?php echo $inmueble->titulo; ?></h1>
		<!-- hacerlo en plan slider y que las imágenes mini sean los botoncitos típicos -->
		<div id="galeria" class="col-sm-11">
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
			    		<figure data-target="#carrusel-img-producto" data-slide-to="<?php echo $cont;?>" class="mini-producto col-xs-2 <?php echo ($primero==true)?'active':'';?>">
			    			<img src="<?php echo base_url($it->imagen)?>" class="img-responsive" style="width:164px; height:102px;"/>
			    		</figure>
		    		<?php $primero=false; $cont++;?>
				<?php endforeach;?>
		    </div>
		</div>
		<div id="mapa" class="col-sm-11 oculto margin-top-20 padding-bottom-20">
				<!--<div class="mapa"><?php echo $producto->mapa;?></div>-->
                    <div class="mapa" id="google_maps_div">            
                        <div id="google_maps" class="col-sm-12">
                        </div>
                    </div>
                </div>
		<?php if($video){?>
			<div id="video" class="col-sm-11 oculto margin-top-20 padding-bottom-20">
				<div class="mapa">
                                    <?php $video = explode('&', str_replace('https://www.youtube.com/watch?v=', '', $video->url));
                                    $video[0] = str_replace('https://youtu.be/', '', $video[0]);?>
                                    <iframe src="<?php echo "https://www.youtube.com/embed/".$video[0];?>/?&showinfo=0&rel=0&autoplay=0" frameborder="0" allowfullscreen></iframe>
                                </div>
			</div>
		<?php }?>
		<div id="contacto" class="col-sm-11 oculto margin-top-20">
			<?php echo form_open('',array('class'=>'form-horizontal','id'=>'frmInmueble')); ?>
					<div class="col-sm-6">
						<div class="form-group margin-right-0">
								<?php echo form_input($nombre); ?>
								<span><?php echo form_error('nombre'); ?></span>
								<p></p>
						</div>
						<div class="form-group margin-right-0">
								<?php echo form_input($email); ?>
								<span><?php echo form_error('email'); ?></span>
								<p></p>
						</div>
						<div class="form-group margin-right-0">
							<?php echo form_textarea($mensaje); ?>
							<span><?php echo form_error('mensaje'); ?></span>
							<p></p>
						</div>
						<div class="form-group row">
							<button class="g-recaptcha btn-contacto" data-sitekey="6LdIfh4UAAAAAJXul7Q7JWfUnz-IcuOdv-fIHDfp" data-callback="onSubmitInmueble">Enviar</button>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group margin-left-0">
								<?php echo form_input($empresa); ?>
								<span><?php echo form_error('empresa'); ?></span>
								<p></p>
						</div>
						<div class="form-group margin-left-0">
								<?php echo form_input($telefono); ?>
								<span><?php echo form_error('telefono'); ?></span>
								<p></p>	
						</div>
					</div>
					<input type="hidden" name="inmueble" value="<?php echo $inmueble->titulo; ?>"/>
				<?php echo form_close(); ?>
		</div>
                <?php if($enlaces){?>
                    <div id="enlaces" class="col-sm-11 oculto margin-top-20">
                        <?php foreach($enlaces as $enlace){?>
                            <p><a href="<?php echo $enlace->url;?>"><?php echo $enlace->titulo;?></a></p>
                        <?php }?>
                    </div>
                <?php }?>
		<div class="col-sm-1 padding-left-0">
			<ul class="margin-top-20">
				<li id="igaleria" class="item-menu-inmueble cursor-pointer"><i class="fa fa-picture-o fa-lg" aria-hidden="true"></i></li>
                                <li id="imapa" class="item-menu-inmueble cursor-pointer"><i class="fa fa-map fa-lg" aria-hidden="true"></i></li>
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
                <div class="col-sm-6 maring-top-10">
                    <h3>Precio compra</h3>
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
                <div class="col-sm-6 maring-top-10">
                    <h3>Precio alquiler</h3>
                        <?php
                        if ($inmueble->precio_alquiler_anterior > 0) {
                            echo '<h2><s>' . number_format($inmueble->precio_alquiler_anterior, 2, ",", ".") . ' &euro; / mes</s></h2>';
                            echo '<h2>'.number_format($inmueble->precio_alquiler, 2, ",", ".") . ' &euro; / mes</h2>';
                        } else {
                            echo '<h2>'.number_format($inmueble->precio_alquiler, 2, ",", ".") . ' &euro; / mes</h2>';
                        }
                        ?> 
                </div>
            <?php } ?>
        </div>
        <div class="col-sm-12 margin-top-20">
            <h3><?php echo $this->lang->line('tienda_caracteristicas_inmueble');?></h3>
            <div class="col-sm-6 inmueble-caracteristicas-1"><?php echo $this->lang->line('tienda_producto_tipo_propiedad');?></div>
            <div class="col-sm-6 inmueble-caracteristicas-2"><?php echo $inmueble->nombre_tipo; ?></div>
            <div class="col-sm-6 inmueble-caracteristicas-1"><?php echo $this->lang->line('tienda_producto_superficie_construida'); ?></div>
            <div class="col-sm-6 inmueble-caracteristicas-2"><?php echo $inmueble->metros; ?></div>
            <div class="col-sm-6 inmueble-caracteristicas-1"><?php echo $this->lang->line('tienda_producto_superficie_util'); ?></div>
            <div class="col-sm-6 inmueble-caracteristicas-2"><?php echo $inmueble->metros_utiles; ?></div>
            <div class="col-sm-6 inmueble-caracteristicas-1"><?php echo $this->lang->line('tienda_producto_banos'); ?></div>
            <div class="col-sm-6 inmueble-caracteristicas-2"><?php echo $inmueble->banios; ?></div>
            <div class="col-sm-6 inmueble-caracteristicas-1"><?php echo $this->lang->line('tienda_producto_dormitorios'); ?></div>
            <div class="col-sm-6 inmueble-caracteristicas-2"><?php echo $inmueble->habitaciones; ?></div>
        </div>
        <?php if($extras){?>
            <div class="col-sm-12 margin-top-20">
                <h3><?php echo $this->lang->line('tienda_extras_inmueble');?></h3>
                <ul style="margin-left:20px;">
                <?php foreach($extras as $extra){?>
                    <li><?php echo $extra->nombre;?></li>
                <?php }?>
                </ul>
            </div>
        <?php }?>
        <?php if($lugares){?>
            <div class="col-sm-12 margin-top-20">
                <h3><?php echo $this->lang->line('tienda_lugares_inmueble');?></h3>
                <ul style="margin-left:20px;">
                <?php foreach($lugares as $lugar){?>
                    <li><?php echo $lugar->nombre;?></li>
                <?php }?>
                </ul>
            </div>
        <?php }?>
        <div class="col-sm-12 margin-top-20">
            <h3><?php echo $this->lang->line('tienda_cenergetica_inmueble');?></h3>
            <?php if($ce->id != 8 && $ce->id != 9){?>
                <img src="<?php echo base_url('uploads/general/img/ce_'.$ce->nombre.'.png');?>" class="img-responsive"/>
            <?php }else{
                echo '<h4>'.$ce->nombre.'</h4>';
            }?>
        </div>
    </div>
    <input type="hidden" id="base_url" value="<?php echo base_url();?>" />
    <input type="hidden" id="site_url" value="<?php echo site_url();?>" />
    <input type="hidden" id="site_idioma" value="<?php echo $this->uri->segment(1);?>" />
<?php }else{?>
    <h3 style="text-align:center;padding-top:40px;">Inmueble inexistente o no publicado</h3>
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
		$('#mapa').fadeIn(500);
	});
	$('#igaleria').click(function(){
		$('#mapa').fadeOut(1);
		$('#video').fadeOut(1);
		$('#contacto').fadeOut(1);
                $('#enlaces').fadeOut(1);
		$('#galeria').fadeIn(500);
	});
	$('#ivideo').click(function(){
		$('#mapa').fadeOut(1);
		$('#galeria').fadeOut(1);
		$('#contacto').fadeOut(1);
                $('#enlaces').fadeOut(1);
		$('#video').fadeIn(500);
	});
	$('#icontacto').click(function(){
		$('#mapa').fadeOut(1);
		$('#galeria').fadeOut(1);
		$('#video').fadeOut(1);
                $('#enlaces').fadeOut(1);
		$('#contacto').fadeIn(500);
	});
        $('#ienlaces').click(function(){
		$('#mapa').fadeOut(1);
		$('#galeria').fadeOut(1);
		$('#video').fadeOut(1);
		$('#contacto').fadeOut(1);
                $('#enlaces').fadeIn(500);
	});
});
function check_google_maps() {
    var pais_id=64;      
    var direccion="<?php echo $inmueble->direccion;?>";

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

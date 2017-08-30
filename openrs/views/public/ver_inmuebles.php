<div class="inicio-seccion hidden-xs"></div>
<div class="inicio-seccion-movil hidden-sm hidden-md hidden-lg"></div>
<div class="container-fluid">
	<div class="row">
		<div style="background:#30b481;">
				<form action="<?php echo site_url($this->uri->segment('1').'/browser');?>" method="get" class="form-inline padding-10 centrado margin-top-5" id="frmFiltro">
					<div class="container background-color-white">
                                                                    <div class="col-sm-12 margin-top-20 margin-bottom-10">
                                                                        <div class="col-sm-2">
                                                                                <input type="text" name="referencia" class="form-control" placeholder="Referencia"/>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <?php echo form_dropdown('oferta_id',$ofertas,$filtros['oferta_id'],'class="form-control"');?>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                                <?php echo form_dropdown('tipo_id',$tipos_inmuebles,$filtros['tipo_id'],'class="form-control"');?>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                                <?php echo form_dropdown('provincia_id',$provincias,$filtros['provincia_id'],'class="form-control" id="provincia"');?>
                                                                        </div>
                                                                        <div class="col-sm-2 oculto" id="localidad">

                                                                        </div>
                                                                        <div class="col-sm-2 oculto" id="zona">

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12 margin-bottom-20">
                                                                        <div class="col-sm-2">
                                                                            <select name="habitaciones" class="form-control">
                                                                                <option value="">- Habitaciones -</option>
                                                                                <option value="1" <?php echo ($filtros['habitaciones_desde'] == 1)?'selected':'';?>>+1</option>
                                                                                <option value="2" <?php echo ($filtros['habitaciones_desde'] == 2)?'selected':'';?>>+2</option>
                                                                                <option value="3" <?php echo ($filtros['habitaciones_desde'] == 3)?'selected':'';?>>+3</option>
                                                                                <option value="4" <?php echo ($filtros['habitaciones_desde'] == 4)?'selected':'';?>>+4</option>
                                                                                <option value="5" <?php echo ($filtros['habitaciones_desde'] == 5)?'selected':'';?>>+5</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <select name="banios" class="form-control">
                                                                                <option value="">- Baños -</option>
                                                                                <option value="1" <?php echo ($filtros['banios_desde'] == 1)?'selected':'';?>>+1</option>
                                                                                <option value="2" <?php echo ($filtros['banios_desde'] == 2)?'selected':'';?>>+2</option>
                                                                                <option value="3" <?php echo ($filtros['banios_desde'] == 3)?'selected':'';?>>+3</option>
                                                                                <option value="4" <?php echo ($filtros['banios_desde'] == 4)?'selected':'';?>>+4</option>
                                                                                <option value="5" <?php echo ($filtros['banios_desde'] == 5)?'selected':'';?>>+5</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                                <input type="text" name="precios_desde" class="form-control" placeholder="Precio desde" value="<?php echo $filtros['precios_desde'];?>"/>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                                <input type="text" name="precios_hasta" class="form-control" placeholder="Precio hasta" value="<?php echo $filtros['precios_hasta'];?>"/>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                                <input type="text" name="metros" class="form-control" placeholder="Sup. desde" value="<?php echo $filtros['metros_desde'];?>"/>
                                                                        </div>
                                                                        <button type="submit" class="btn btn-primary col-sm-2">BUSCAR</button>
                                                                    </div>
                                                                </div>
					<input type="hidden" name="start" id="start" value="<?php echo $filtros['start'];?>">
				</form>
		</div>
	</div>
	<div class="container">
		<?php if(isset($inmuebles) && $inmuebles){?>
            <div class="col-sm-12">
                    <a class="btn btn-info pull-right" onclick="check_multiple_google_maps('public');">
                        <i class="menu-icon fa fa-map-marker"></i>
                        <span class="menu-text"> Ver en mapa</span>
                    </a>
            </div>
                    <div class="row" id="google_maps_div" style="display:none;">      
                        <div class="space-10"></div>
                        <div class="col-xs-12">
                            <div id="google_maps">
                            </div>
                            <strong>El mapa está cargándose, espere unos segundos... Aparecerá centrado en la provincia o población seleccionado en su criterio de búsqueda. Si no seleccionó ninguna de las dos, entonces se centrará en el municipio del primer inmueble listado.</strong>
                        </div>
                    </div>
                    <?php $cont=1;
                    foreach($inmuebles as $inmueble){
	        	if($cont==1){?>
	        		<div class="col-sm-12 margin-bottom-20">
	        	<?php }?>
	        	<div class="col-sm-4" data-cont="<?php echo $cont;?>">
                            <div class="col-sm-12 padding-0">
                                <a href="<?php echo site_url($this->uri->segment('1').'/inmueble/'.$inmueble->idinmueble.'-'.$inmueble->url_seo);?>">
                                    <img src="<?php echo base_url($inmueble->imagen); ?>" class="img-producto width-100p img-responsive" alt="<?php echo $inmueble->titulo; ?>" title="<?php echo $inmueble->titulo; ?>" style="height:255px;"/>
                                    <?php if($inmueble->precio_compra > 0 && $inmueble->precio_alquiler == 0){?>
                                        <p class="tipo-inmueble"><?php echo $this->lang->line('tienda_inmueble_venta');?></p>
                                    <?php }elseif($inmueble->precio_alquiler > 0 && $inmueble->precio_compra == 0){?>
                                        <p class="tipo-inmueble"><?php echo $this->lang->line('tienda_inmueble_alquiler');?></p>
                                    <?php }else{?>
                                        <p class="tipo-inmueble"><?php echo $this->lang->line('tienda_inmueble_venta_alquiler');?></p>
                                    <?php }?>
                                    <?php if($inmueble->precio_compra_anterior > 0 || $inmueble->precio_alquiler_anterior > 0){?>
                                        <span class="tipo-oferta"><?php echo $this->lang->line('tienda_inmueble_oferta');?></span>
                                    <?php }?>
                                </a>
                            </div>
                            <div class="col-sm-12 caja-contenido-inmuble" style="margin-top:-10px;">
                                <a href="<?php echo site_url($this->uri->segment('1').'/inmueble/'.$inmueble->idinmueble.'-'.$inmueble->url_seo);?>">
                                    <h4 class="padding-top-10" id="nom2<?php echo $cont;?>"><?php echo $inmueble->titulo; ?></h4>
                                </a>
                            </div>
                            <div class="col-sm-12 caja-contenido-inmuble">
                                <p><?php echo substr($inmueble->descripcion,0,100).'...';?></p>
                            </div>
                            <div class="col-sm-12 caja-contenido-inmuble">
                                <p class="text-right"><?php echo '<b>Ref. '.$inmueble->referencia.' </b>';?></p>
                            </div>
                            <div class="col-sm-12 borders-inmueble">
                                <div class="col-sm-4"><i class="fa fa-home" aria-hidden="true"></i> <?php echo $inmueble->metros.' m²';?></div>
                                <div class="col-sm-4"><i class="fa fa-bath" aria-hidden="true"></i> <?php echo $inmueble->banios; ?></div>
                                <div class="col-sm-4"><i class="fa fa-bed" aria-hidden="true"></i> <?php echo $inmueble->habitaciones; ?></div>
                            </div>
                            <div class="col-sm-12 padding-0">
                                <?php if($inmueble->precio_compra > 0 && $inmueble->precio_alquiler > 0){?>
                                    <div class="col-sm-12 padding-0 background-color-ver">
                                        <div class="col-sm-6 precio-inmueble">
                                            <?php if($inmueble->precio_compra_anterior > 0){
                                                echo '<s>'.number_format($inmueble->precio_compra_anterior,2,",",".").' &euro;</s><br>';
                                                echo number_format($inmueble->precio_compra,2,",",".").' &euro;';
                                            }else{
                                                echo number_format($inmueble->precio_compra,2,",",".").' &euro;';
                                            }?>
                                            <?php echo '<br>';?>
                                            <?php if($inmueble->precio_alquiler_anterior > 0){
                                                echo '<s>'.number_format($inmueble->precio_alquiler_anterior,2,",",".").' &euro; / mes</s><br>';
                                                echo number_format($inmueble->precio_alquiler,2,",",".").' &euro; / mes';
                                            }else{
                                                echo number_format($inmueble->precio_alquiler,2,",",".").' &euro; / mes';
                                            }?> 
                                        </div>
                                        <div class="col-sm-6 ver-inmueble" style="padding:10%;">
                                            <a href="<?php echo site_url($this->uri->segment('1').'/inmueble/'.$inmueble->idinmueble.'-'.$inmueble->url_seo);?>">VER</a>
                                        </div>
                                    </div>
                                <?php }elseif($inmueble->precio_compra > 0){?>
                                    <div class="col-sm-12 padding-0 background-color-ver">
                                        <div class="col-sm-6 precio-inmueble">
                                            <?php if($inmueble->precio_compra_anterior > 0){
                                                echo '<s>'.number_format($inmueble->precio_compra_anterior,2,",",".").' &euro;</s><br>';
                                                echo number_format($inmueble->precio_compra,2,",",".").' &euro;';
                                            }else{
                                                echo number_format($inmueble->precio_compra,2,",",".").' &euro;';
                                            }?>
                                        </div>
                                        <div class="col-sm-6 ver-inmueble">
                                            <a href="<?php echo site_url($this->uri->segment('1').'/inmueble/'.$inmueble->idinmueble.'-'.$inmueble->url_seo);?>">VER</a>
                                        </div>
                                    </div>
                                <?php }elseif($inmueble->precio_alquiler > 0){?>
                                    <div class="col-sm-12 padding-0 background-color-ver">
                                        <div class="col-sm-6 precio-inmueble">
                                            <?php if($inmueble->precio_alquiler_anterior > 0){
                                                echo '<s>'.number_format($inmueble->precio_alquiler_anterior,2,",",".").' &euro; / mes</s><br>';
                                                echo number_format($inmueble->precio_alquiler,2,",",".").' &euro; / mes';
                                            }else{
                                                echo number_format($inmueble->precio_alquiler,2,",",".").' &euro; / mes';
                                            }?> 
                                        </div>
                                        <div class="col-sm-6 ver-inmueble">
                                            <a href="<?php echo site_url($this->uri->segment('1').'/inmueble/'.$inmueble->idinmueble.'-'.$inmueble->url_seo);?>">VER</a>
                                        </div>
                                    </div>
                                <?php }?>
                            </div>
                        </div>
                        <?php if($cont % 3 == 0){?>
                            </div><div class="col-sm-12 margin-bottom-20">
                        <?php }
                        $cont++;?>
                    <?php }?>
	         	</div>
                    <?php if($total && $total > 12){?>
	         		<div class="col-xs-12">
	         			<p>
	         				<?php if($filtros['start'] < 0){
	         					echo '<b>Total: 12/'.$total.'</b>';
	         				}else{
	         					$totalpagina = $filtros['start']+12;
								if($totalpagina > $total){
									echo '<b>Total: '.$total.'/'.$total.'</b>';
								}else{
									echo '<b>Total: '.$totalpagina.'/'.$total.'</b>';
								}
	         				}?>
	         			</p>
	         		</div>
				    <div class="centrado col-xs-12">
				    	<div class="col-xs-3">
				    		<?php if($filtros['start'] > 0){?>
				    			<button class="btn btn-paginacion" id="paginicio" data-pag="0"><i class="fa fa-angle-double-left fa-3x" aria-hidden="true"></i></button>
						    <?php }?>
					    </div>
					    <div class="col-xs-3">
					    	<?php if($filtros['start'] > 0){?>
					    		<button class="btn btn-paginacion" id="pagant" data-pag="<?php echo $filtros['start']-12;?>"><i class="fa fa-angle-left fa-3x" aria-hidden="true"></i></button>
						    <?php }?>
					    </div>
					    <div class="col-xs-3">
					    	<?php if($filtros['start']+12 < $total ){?>
					    		<button class="btn btn-paginacion" id="pagsig" data-pag="<?php echo $filtros['start']+12;?>"><i class="fa fa-angle-right fa-3x" aria-hidden="true"></i></button>
						    <?php }?>
					    </div>
					    <div class="col-xs-3">
					    	<?php if($filtros['start']+12 < $total ){?>
					    		<button class="btn btn-paginacion" id="pagfinal" data-pag="<?php echo $total-12;?>"><i class="fa fa-angle-double-right fa-3x" aria-hidden="true"></i></button>
							<?php }?>
					    </div>
				    </div>
                    <?php }
		}else{
                    echo '<h3>No se han encontrado inmuebles con estas características</h3>';
                }?>
	</div>
</div>
<script>
$(document).ready(function(){
	$('#provincia').on('change', function(){
        var provincia = $(this).val();
		if(provincia > 0){
			$('#localidad').fadeIn(500);
			$('#localidad').load('<?php echo site_url('seccion/cargar_localidades');?>/'+provincia);
		}else{
			$('#localidad').fadeOut(500);
		}
    });
    $('#paginicio').on('click',function(){
        var pag = $(this).data('pag');
        $('#start').val(pag);
        document.getElementById("frmFiltro").submit();
    });
    $('#pagfinal').on('click',function(){
        var pag = $(this).data('pag');
        $('#start').val(pag);
        document.getElementById("frmFiltro").submit();
    });
    $('#pagsig').on('click',function(){
        var pag = $(this).data('pag');
        $('#start').val(pag);
        document.getElementById("frmFiltro").submit();
    });
    $('#pagant').on('click',function(){
        var pag = $(this).data('pag');
        $('#start').val(pag);
        document.getElementById("frmFiltro").submit();
    });
});
function check_multiple_google_maps(infowindow_type) {
        $('#google_maps_div').toggle('slow');
        $('#google_maps').load('<?php echo site_url($this->uri->segment('1').'/seccion/multiple_google_map/');?>'+infowindow_type);
    }
</script>

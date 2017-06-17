<?php menu_inmuebles ($inmueble->id,"inmuebles_imagenes"); ?>

<div class="space-4"></div>
<div class="page-header">
    <div class="row">
        <div class="col-xs-12">
            <h1>
                Imágenes del inmueble <?php echo $inmueble->referencia; ?>
            </h1>
        </div>
    </div>
</div>

<?php $this->load->view('common/message', $this->data); ?>

<div class="row">
    <div class="col-xs-12">
        <a class="btn btn-info pull-right" href="<?php echo site_url($_controller . '/insert/' . $inmueble->id); ?>">
            <i class="menu-icon fa fa-upload"></i>
            <span class="menu-text"> Subir imágenes </span>
        </a>
    </div>
</div>

<div class="space-10"></div>

<div class="row">
    <div class="col-xs-12">
         <?php
        if($elements)
        {
        ?>
            <ul class="ace-thumbnails clearfix">
        <?php
            foreach ($elements as $element)
            {
        ?>        
                <li>
                    <a href="<?php echo base_url($element->imagen); ?>" title="<?php echo basename($element->imagen); ?>" data-rel="colorbox">
                        <img width="250" height="250" alt="250x250" src="<?php echo base_url($element->imagen); ?>" />
                    </a>

                    <div class="tags">
                        <?php if($element->portada) { ?>
                            <span class="label-holder">
                                <span class="label label-info">Portada</span>
                            </span>
                        <?php } ?>                        
                        <?php if($element->publicada) { ?>
                            <span class="label-holder">
                                <span class="label label-success">Publicada</span>
                            </span>
                        <?php } else { ?>
                            <span class="label-holder">
                                <span class="label label-danger">No publicada</span>
                            </span>
                        <?php } ?>
                    </div>

                    <div class="tools">      
                        <?php if($element->publicada && !$element->portada) { ?>
                            <a href="<?php echo site_url('inmuebles_imagenes/set_portada/'.$element->id); ?>" title="Poner como portada">
                                <i class="ace-icon fa fa-pinterest-square"></i>
                            </a>
                        <?php } ?>
                        <?php if($element->publicada) { ?>
                            <a href="<?php echo site_url('inmuebles_imagenes/publicar/'.$element->id.'/0'); ?>" title="Quitar publicación">
                                <i class="ace-icon fa fa-times red"></i>
                            </a>
                        <?php } else { ?>
                            <a href="<?php echo site_url('inmuebles_imagenes/publicar/'.$element->id.'/1'); ?>" title="Publicar">
                                <i class="ace-icon fa fa-check"></i>
                            </a>
                        <?php } ?>
                        <a href="<?php echo site_url('inmuebles_imagenes/download/'.$element->id); ?>" title="Descargar">
                            <i class="ace-icon fa fa-download"></i>
                        </a>
                        <a class="borrar-elemento" href="#" data-id="<?php echo $element->id; ?>" title="Borrar">
                            <i class="ace-icon fa fa-trash"></i>
                        </a>
                    </div>
                </li>
           <?php 
                }
            ?>
        </ul>
        <?php
        }
        else
        {
        ?>
             <p><i class="ace-icon fa fa-info-circle"></i> Actualmente no hay imágenes subidas para el inmueble actual</p>
        <?php
        }
        ?>
        <?php
        /*
        <table class="table table-striped table-bordered table-hover" id="tabgrid">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($elements)
                {
                    foreach ($elements as $element)
                    {
                ?>
                        <tr>
                            <td>
                                <a target="_blank" href="<?php echo base_url($element->imagen); ?>"><?php echo $element->imagen; ?></a>
                            </td>
                            <td>
                                <div class="hidden-sm hidden-xs action-buttons">
                                    <a class="red borrar-elemento" data-id="<?php echo $element->id; ?>" href="#" title="Borrar">
                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                    </a>
                                </div>

                                <div class="hidden-md hidden-lg">
                                    <div class="inline pos-rel">
                                        <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                            <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                        </button>

                                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                            <li>
                                                <a href="#" class="tooltip-error borrar-elemento" data-id="<?php echo $element->id; ?>" data-rel="tooltip" title="Borrar">
                                                    <span class="red">
                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>                    
                            </td>
                        </tr>
                <?php 
                    }
                } 
                ?>
            </tbody>
        </table>
         * 
         */
        ?>
    </div>
</div>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function ($) {
        
        var $overflow = '';
	var colorbox_params = {
		rel: 'colorbox',
		reposition:true,
		scalePhotos:true,
		scrolling:false,
		previous:'<i class="ace-icon fa fa-arrow-left"></i>',
		next:'<i class="ace-icon fa fa-arrow-right"></i>',
		close:'&times;',
		current:'{current} of {total}',
		maxWidth:'100%',
		maxHeight:'100%',
		onOpen:function(){
			$overflow = document.body.style.overflow;
			document.body.style.overflow = 'hidden';
		},
		onClosed:function(){
			document.body.style.overflow = $overflow;
		},
		onComplete:function(){
			$.colorbox.resize();
		}
	};

	$('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
	$("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange fa-spin'></i>");//let's add a custom loading icon	
	
	$(document).one('ajaxloadstart.page', function(e) {
		$('#colorbox, #cboxOverlay').remove();
        });

        $('.borrar-elemento').click(function () {
            var id = $(this).data("id");
            bootbox.confirm("¿Estás seguro/a de eliminar la imagen seleccionada?", function (result) {
                if (result) {
                    window.location = '<?php echo site_url($_controller); ?>/delete/' + id;
                }
            });
        });
        
       show_submenu();
    })
</script>
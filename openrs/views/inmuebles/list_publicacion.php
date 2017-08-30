<table class="table table-striped table-bordered table-hover" id="tabgrid_publicacion" >
    <thead>
        <tr>
            <th>Ref.</th>
            <th>Tipo</th>
            <th>Municipio</th>
            <th>Zona</th>
            <th>Direc. Pública</th>
            <th>Precio<br> Compra</th>
            <th>Precio<br> Alquiler</th>
            <th>Met.</th>
            <th>Hab.</th>
            <th>Bañ.</th>
            <th>Pub.</th>
            <th>Dest.</th>
            <th>Oport.</th>
            <th>URL</th>
            <th>Portada</th>
            <th>Img.</th>
            <th>Cartel</th>
            <th>Vídeo</th>
            <th>Enlaces</th>            
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
                <td><?php echo $element->referencia; ?></td>
                <td><?php echo $element->nombre_tipo; ?></td>
                <td><?php echo $element->nombre_poblacion; ?></td>
                <td><?php echo $element->nombre_zona; ?></td>
                <td>
                    <?php 
                    if(trim($element->direccion_publica)==trim($element->direccion))
                    {
                        echo "<strong>".$element->direccion_publica."</strong>"; 
                    }
                    else
                    {
                        echo $element->direccion_publica;
                    }
                    ?>
                </td>
                <td><?php echo number_format($element->precio_compra, 0, ",", "."); ?></td>
                <td><?php echo number_format($element->precio_alquiler, 0, ",", "."); ?></td>
                <td><?php echo $element->metros; ?></td>
                <td><?php echo $element->habitaciones; ?></td>
                <td><?php echo $element->banios; ?></td>
                <td>
                    <a href="<?php echo site_url('inmuebles/edit/'.$element->id); ?>#publicacion">
                        <?php echo format_si_no($element->publicado); ?>
                    </a>                    
                </td>
                <td>
                    <a href="<?php echo site_url('inmuebles/edit/'.$element->id); ?>#publicacion">
                        <?php echo format_si_no($element->destacado); ?>
                    </a>
                </td>
                <td>
                    <a href="<?php echo site_url('inmuebles/edit/'.$element->id); ?>#publicacion">
                        <?php echo format_si_no($element->oportunidad); ?>
                    </a>
                </td>
                <td>
                    <?php
                    if($element->url_publica)
                    {
                    ?>
                        <a target="_blank" href="<?php echo $element->url_publica; ?>">Ver</a>
                    <?php
                    }
                    else
                    {
                    ?>
                        <a href="<?php echo site_url('inmuebles/edit/'.$element->id); ?>#publicacion">NO</a>
                    <?php
                    }
                    ?>
                </td> 
                <td>
                    <?php
                    if($element->portada)
                    {
                    ?>
                        <a target="_blank" href="<?php echo base_url($element->portada->imagen); ?>" title="<?php echo basename($element->portada->imagen); ?>" data-rel="colorbox">
                            <img width="150" height="100" alt="100x150" src="<?php echo base_url($element->portada->imagen); ?>" />
                        </a>
                    <?php
                    }
                    else
                    {
                    ?>
                        <a href="<?php echo site_url('inmuebles_imagenes/index/'.$element->id); ?>">Sin especificar</a>
                    <?php
                    }
                    ?>
                </td> 
                <td>
                    <?php
                    if($element->num_imagenes>0)
                    {
                    ?>
                        <a href="<?php echo site_url('inmuebles_imagenes/index/'.$element->id); ?>"><?php echo $element->num_imagenes; ?></a>
                    <?php
                    }
                    else
                    {
                    ?>
                        <a href="<?php echo site_url('inmuebles_imagenes/insert/'.$element->id); ?>"><?php echo $element->num_imagenes; ?></a>
                    <?php
                    }
                    ?>
                </td> 
                <td>
                    <a href="<?php echo site_url('inmuebles_carteles/index/'.$element->id); ?>"><?php echo format_cartel_impreso($element->cartel_impreso); ?></a>
                </td>
                <td>
                    <?php
                    if($element->video)
                    {
                    ?>
                        <a target="_blank" href="<?php echo $element->video->url; ?>" title="<?php echo $element->video->titulo; ?>">
                            Ver
                        </a>
                    <?php
                    }
                    else
                    {
                    ?>
                        <a href="<?php echo site_url('inmuebles_enlaces/insert/'.$element->id); ?>">NO</a>
                    <?php
                    }
                    ?>
                </td> 
                <td>
                    <?php
                    if($element->num_enlaces>0)
                    {
                    ?>
                        <a href="<?php echo site_url('inmuebles_enlaces/index/'.$element->id); ?>"><?php echo $element->num_enlaces; ?></a>
                    <?php
                    }
                    else
                    {
                    ?>
                        <a href="<?php echo site_url('inmuebles_enlaces/insert/'.$element->id); ?>"><?php echo $element->num_enlaces; ?></a>
                    <?php
                    }
                    ?>
                </td>                 
            </tr>
        <?php 
            }
        }
        ?>
    </tbody>
</table>

<!-- inline scripts related to this page -->
<script type="text/javascript">
        
    jQuery(function ($) {
        
        $('#tabgrid_publicacion').dataTable({
            "iDisplayLength": 100,
            "oLanguage": {"sUrl": "<?php echo base_url('assets/admin/js/dataTables.spanish.txt'); ?>"},
            "aoColumns": [
                null, 
                null,
                null,                
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null
            ]
        });
    })
</script>
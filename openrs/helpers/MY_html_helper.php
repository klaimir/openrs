<?php

function set_active_menu($active_section, $options)
{
    if (in_array($active_section, $options))
    {
        return "active open";
    }
    else
    {
        return NULL;
    }
}

function set_active_option($active_section, $option)
{
    if ($active_section == $option)
    {
        return "active";
    }
    else
    {
        return NULL;
    }
}

function label($line, $for, $attributes = array())
{
    $line = '<label for="' . $for . '"' . _stringify_attributes($attributes) . '>' . $line . '</label>';

    return $line;
}

function menu_clientes($cliente_id,$active_section)
{
    ?>
    <div class="hidden">
        <button data-target="#sidebar2" data-toggle="collapse" type="button" class="pull-left navbar-toggle collapsed">
            <span class="sr-only">Toggle sidebar</span>

            <i class="ace-icon fa fa-dashboard white bigger-125"></i>
        </button>

        <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse">
            <ul class="nav nav-list">
                <li class="hover <?php echo set_active_option($active_section, "clientes"); ?>">
                    <a href="<?php echo site_url('clientes/edit/'.$cliente_id); ?>">
                        <i class="menu-icon fa fa-users"></i>
                        <span class="menu-text"> DATOS DEL CLIENTE </span>
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="hover">
                    <a href="#">
                        <i class="menu-icon fa fa-calendar"></i>

                        <span class="menu-text">
                            FICHAS DE VISITA
                            <span title="" class="badge badge-transparent tooltip-error" data-original-title="2 Important Events">
                                <i class="ace-icon fa fa-exclamation-triangle red bigger-130"></i>
                            </span>
                        </span>
                    </a>

                    <b class="arrow"></b>
                </li>
                <?php /*
                <li class="hover">
                    <a href="#">
                        <i class="menu-icon fa fa-picture-o"></i>
                        <span class="menu-text"> DEMANDAS </span>
                    </a>

                    <b class="arrow"></b>
                </li>
                 * 
                 */
                ?>

                <li class="hover <?php echo set_active_option($active_section, "clientes_ficheros"); ?>">
                    <a href="<?php echo site_url('clientes_ficheros/index/'.$cliente_id); ?>">
                        <i class="menu-icon fa fa-paperclip"></i>
                        <span class="menu-text"> FICHEROS ADJUNTOS </span>
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="hover">
                    <a href="<?php echo site_url('fichas_cliente/index/'.$cliente_id); ?>">
                        <i class="menu-icon fa fa-file-pdf-o"></i>
                        <span class="menu-text"> FICHAS DEL CLIENTE </span>
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul><!-- /.nav-list -->
        </div><!-- .sidebar -->
    </div>
    <?php
}

function menu_inmuebles($inmueble_id,$active_section)
{
    ?>
    <div class="hidden">
        <button data-target="#sidebar2" data-toggle="collapse" type="button" class="pull-left navbar-toggle collapsed">
            <span class="sr-only">Toggle sidebar</span>

            <i class="ace-icon fa fa-dashboard white bigger-125"></i>
        </button>

        <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse">
            <ul class="nav nav-list">
                <li class="hover <?php echo set_active_option($active_section, "inmuebles"); ?>">
                    <a href="<?php echo site_url('inmuebles/edit/'.$inmueble_id); ?>">
                        <i class="menu-icon fa fa-building"></i>
                        <span class="menu-text"> DATOS DEL INMUEBLE </span>
                    </a>
                    <b class="arrow"></b>
                </li>
                
                <li class="hover <?php echo set_active_option($active_section, "inmuebles_imagenes"); ?>">
                    <a href="<?php echo site_url('inmuebles_imagenes/index/'.$inmueble_id); ?>">
                        <i class="menu-icon fa fa-image"></i>
                        <span class="menu-text"> FOTOGRAFIAS </span>
                    </a>

                    <b class="arrow"></b>
                </li>
                
                <li class="hover <?php echo set_active_option($active_section, "inmuebles_enlaces"); ?>">
                    <a href="<?php echo site_url('inmuebles_enlaces/index/'.$inmueble_id); ?>">
                        <i class="menu-icon fa fa-link"></i>
                        <span class="menu-text"> ENLACES </span>
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="hover <?php echo set_active_option($active_section, "inmuebles_ficheros"); ?>">
                    <a href="<?php echo site_url('inmuebles_ficheros/index/'.$inmueble_id); ?>">
                        <i class="menu-icon fa fa-paperclip"></i>
                        <span class="menu-text"> FICHEROS ADJUNTOS </span>
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="hover">
                    <a href="<?php echo site_url('inmuebles_fichas/index/'.$inmueble_id); ?>">
                        <i class="menu-icon fa fa-file-pdf-o"></i>
                        <span class="menu-text"> FICHAS DEL INMUEBLE </span>
                    </a>
                    <b class="arrow"></b>
                </li>
                
                <li class="hover <?php echo set_active_option($active_section, "inmuebles_carteles"); ?>">
                    <a href="<?php echo site_url('inmuebles_carteles/index/'.$inmueble_id); ?>">
                        <i class="menu-icon fa fa-qrcode"></i>
                        <span class="menu-text"> CARTELES </span>
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul><!-- /.nav-list -->
        </div><!-- .sidebar -->
    </div>
    <?php
}

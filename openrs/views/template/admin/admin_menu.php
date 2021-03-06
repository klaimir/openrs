<li class="<?php echo set_active_option($_active_section,"auth"); ?>">
    <a href="<?php echo site_url('auth'); ?>" onClick="return show_confirm_exit_message();">
        <i class="menu-icon fa fa-users"></i>
        <span class="menu-text"> Usuarios </span>
    </a>

    <b class="arrow"></b>
</li>

<li class="<?php echo set_active_option($_active_section,"backup"); ?>">
    <a href="<?php echo site_url('backup'); ?>" onClick="return show_confirm_exit_message();">
        <i class="menu-icon fa fa-database"></i>
        <span class="menu-text"> Copias Seguridad </span>
    </a>

    <b class="arrow"></b>
</li>

<li class="<?php echo set_active_menu($_active_section,array("estados","tipos_ficheros","tipos_inmueble","plantillas_documentacion","opciones_extras","lugares_interes","provincias","medios_captacion")); ?>">
    <a href="#" class="dropdown-toggle">
        <i class="menu-icon fa fa-cog"></i>
        <span class="menu-text"> Configuración </span>

        <b class="arrow fa fa-angle-down"></b>
    </a>

    <b class="arrow"></b>

    <ul class="submenu">
        <li class="<?php echo set_active_option($_active_section,'estados'); ?>">
            <a href="<?php echo site_url('estados'); ?>" onClick="return show_confirm_exit_message();">
                <i class="menu-icon fa fa-caret-right"></i>
                <span class="menu-text"> Estados </span>
            </a>

            <b class="arrow"></b>
        </li>
        
        <li class="<?php echo set_active_option($_active_section,'plantillas_documentacion'); ?>">
            <a href="<?php echo site_url('plantillas_documentacion'); ?>" onClick="return show_confirm_exit_message();">
                <i class="menu-icon fa fa-caret-right"></i>
                <span class="menu-text"> Plantillas Doc. </span>
            </a>

            <b class="arrow"></b>
        </li>
        
        <li class="<?php echo set_active_option($_active_section,'tipos_ficheros'); ?>" onClick="return show_confirm_exit_message();">
            <a href="<?php echo site_url('tipos_ficheros'); ?>">
                <i class="menu-icon fa fa-caret-right"></i>
                <span class="menu-text"> Tipos ficheros </span>
            </a>

            <b class="arrow"></b>
        </li>        
        
        <li class="<?php echo set_active_option($_active_section,'provincias'); ?>" onClick="return show_confirm_exit_message();">
            <a href="<?php echo site_url('provincias'); ?>">
                <i class="menu-icon fa fa-caret-right"></i>
                <span class="menu-text"> Poblaciones y Zonas </span>
            </a>

            <b class="arrow"></b>
        </li>
        
        <li class="<?php echo set_active_option($_active_section,'config'); ?>" onClick="return show_confirm_exit_message();">
            <a href="<?php echo site_url('config'); ?>">
                <i class="menu-icon fa fa-caret-right"></i>
                <span class="menu-text"> Preferencias </span>
            </a>

            <b class="arrow"></b>
        </li>
        
        <li class="<?php echo set_active_menu($_active_section,array("medios_captacion")); ?>">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-caret-right"></i>
                Clientes
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">                
                <li class="<?php echo set_active_option($_active_section,'medios_captacion'); ?>">
                    <a href="<?php echo site_url('medios_captacion'); ?>" onClick="return show_confirm_exit_message();">
                        <i class="menu-icon fa fa-caret-right"></i>
                        <span class="menu-text"> Medios Captación </span>
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
        
        <li class="<?php echo set_active_menu($_active_section,array("tipos_inmueble","opciones_extras","lugares_interes")); ?>">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-caret-right"></i>
                Inmuebles
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">                

                <li class="<?php echo set_active_option($_active_section,'tipos_inmueble'); ?>" onClick="return show_confirm_exit_message();">
                    <a href="<?php echo site_url('tipos_inmueble'); ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        <span class="menu-text"> Tipos </span>
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="<?php echo set_active_option($_active_section,'opciones_extras'); ?>" onClick="return show_confirm_exit_message();">
                    <a href="<?php echo site_url('opciones_extras'); ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        <span class="menu-text"> Características </span>
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="<?php echo set_active_option($_active_section,'lugares_interes'); ?>" onClick="return show_confirm_exit_message();">
                    <a href="<?php echo site_url('lugares_interes'); ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        <span class="menu-text"> Sitios cercanos </span>
                    </a>

                    <b class="arrow"></b>
                </li>  
            </ul>
        </li>
    </ul>
</li>

<li class="<?php echo set_active_menu($_active_section,array("idiomas","cabecera","pie","secciones","noticias")); ?>">
    <a href="#" class="dropdown-toggle">
        <i class="menu-icon fa fa-globe"></i>
        <span class="menu-text"> Zona Pública </span>

        <b class="arrow fa fa-angle-down"></b>
    </a>

    <b class="arrow"></b>

    <ul class="submenu">
        <li class="<?php echo set_active_option($_active_section,'idiomas'); ?>">
            <a href="<?php echo site_url('admin/gestionar_idiomas'); ?>" onClick="return show_confirm_exit_message();">
                <i class="menu-icon fa fa-caret-right"></i>
                <span class="menu-text"> Idiomas </span>
            </a>

            <b class="arrow"></b>
        </li>
        
        <li class="<?php echo set_active_option($_active_section,'cabecera'); ?>">
            <a href="<?php echo site_url('admin/cabecera');?>" onClick="return show_confirm_exit_message();">
                <i class="menu-icon fa fa-caret-right"></i>
                Aspecto
            </a>

            <b class="arrow"></b>
        </li>

        <li class="<?php echo set_active_option($_active_section,'pie'); ?>">
            <a href="<?php echo site_url('admin/pie');?>" onClick="return show_confirm_exit_message();">
                <i class="menu-icon fa fa-caret-right"></i>
                Pie
            </a>

            <b class="arrow"></b>
        </li>
        
        <li class="<?php echo set_active_option($_active_section,'secciones'); ?>">
            <a href="<?php echo site_url('Page/listar_secciones'); ?>" onClick="return show_confirm_exit_message();">
                <i class="menu-icon fa fa-caret-right"></i>
                <span class="menu-text"> Secciones </span>
            </a>

            <b class="arrow"></b>
        </li>
        
        <li class="<?php echo set_active_option($_active_section,'noticias'); ?>">
            <a href="<?php echo site_url('blog/listar_articulos'); ?>" onClick="return show_confirm_exit_message();">
                <i class="menu-icon fa fa-caret-right"></i>
                <span class="menu-text"> Noticias </span>
            </a>

            <b class="arrow"></b>
        </li>
        
        <li>
            <a target="_blank" href="<?php echo site_url('es/inicio'); ?>">
                <i class="menu-icon fa fa-caret-right"></i>
                <span class="menu-text"> Ver Web </span>
            </a>

            <b class="arrow"></b>
        </li>
    </ul>
</li>						
								
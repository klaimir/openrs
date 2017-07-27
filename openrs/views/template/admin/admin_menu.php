<li>
    <a href="<?php echo site_url('auth'); ?>" onClick="return show_confirm_exit_message();">
        <i class="menu-icon fa fa-users"></i>
        <span class="menu-text"> Usuarios </span>
    </a>

    <b class="arrow"></b>
</li>

<li>
    <a href="<?php echo site_url('backup'); ?>" onClick="return show_confirm_exit_message();">
        <i class="menu-icon fa fa-database"></i>
        <span class="menu-text"> Copias Seguridad </span>
    </a>

    <b class="arrow"></b>
</li>

<li class="<?php echo set_active_menu($_active_section,array("estados","tipos_ficheros","tipos_inmueble","plantillas_documentacion","opciones_extras","lugares_interes","provincias")); ?>">
    <a href="#" class="dropdown-toggle">
        <i class="menu-icon fa fa-building"></i>
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
                <span class="menu-text"> Plantillas Documentación </span>
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

        <li class="<?php echo set_active_option($_active_section,'tipos_inmueble'); ?>" onClick="return show_confirm_exit_message();">
            <a href="<?php echo site_url('tipos_inmueble'); ?>">
                <i class="menu-icon fa fa-caret-right"></i>
                <span class="menu-text"> Tipos inmueble </span>
            </a>

            <b class="arrow"></b>
        </li>
        
        <li class="<?php echo set_active_option($_active_section,'opciones_extras'); ?>" onClick="return show_confirm_exit_message();">
            <a href="<?php echo site_url('opciones_extras'); ?>">
                <i class="menu-icon fa fa-caret-right"></i>
                <span class="menu-text"> Opciones extras </span>
            </a>

            <b class="arrow"></b>
        </li>
        
        <li class="<?php echo set_active_option($_active_section,'lugares_interes'); ?>" onClick="return show_confirm_exit_message();">
            <a href="<?php echo site_url('lugares_interes'); ?>">
                <i class="menu-icon fa fa-caret-right"></i>
                <span class="menu-text"> Lugares Interés </span>
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
    </ul>
</li>

<li class="">
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
                Cabecera
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
        
        <li class="<?php echo set_active_option($_active_section,'Noticias'); ?>">
            <a href="<?php echo site_url('noticias'); ?>" onClick="return show_confirm_exit_message();">
                <i class="menu-icon fa fa-caret-right"></i>
                <span class="menu-text"> Noticias </span>
            </a>

            <b class="arrow"></b>
        </li>
    </ul>
</li>						
								
<!--<li class="active">
    <a href="#">
        -<span class="menu-text"> ADMINISTRADOR </span>-
    </a>

    <b class="arrow"></b>
</li>

    <li class="">
    <a href="#" class="dropdown-toggle">
        <i class="menu-icon fa fa-desktop"></i>
        <span class="menu-text">
            UI &amp; Elements
        </span>

        <b class="arrow fa fa-angle-down"></b>
    </a>

    <b class="arrow"></b>

    <ul class="submenu">
        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-caret-right"></i>

                Layouts
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="">
                    <a href="top-menu.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Top Menu
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="two-menu-1.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Two Menus 1
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="two-menu-2.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Two Menus 2
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="mobile-menu-1.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Default Mobile Menu
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="mobile-menu-2.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Mobile Menu 2
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="mobile-menu-3.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Mobile Menu 3
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>

        <li class="">
            <a href="typography.html">
                <i class="menu-icon fa fa-caret-right"></i>
                Typography
            </a>

            <b class="arrow"></b>
        </li>

        <li class="">
            <a href="elements.html">
                <i class="menu-icon fa fa-caret-right"></i>
                Elements
            </a>

            <b class="arrow"></b>
        </li>

        <li class="">
            <a href="buttons.html">
                <i class="menu-icon fa fa-caret-right"></i>
                Buttons &amp; Icons
            </a>

            <b class="arrow"></b>
        </li>

        <li class="">
            <a href="content-slider.html">
                <i class="menu-icon fa fa-caret-right"></i>
                Content Sliders
            </a>

            <b class="arrow"></b>
        </li>

        <li class="">
            <a href="treeview.html">
                <i class="menu-icon fa fa-caret-right"></i>
                Treeview
            </a>

            <b class="arrow"></b>
        </li>

        <li class="">
            <a href="jquery-ui.html">
                <i class="menu-icon fa fa-caret-right"></i>
                jQuery UI
            </a>

            <b class="arrow"></b>
        </li>

        <li class="">
            <a href="nestable-list.html">
                <i class="menu-icon fa fa-caret-right"></i>
                Nestable Lists
            </a>

            <b class="arrow"></b>
        </li>

        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-caret-right"></i>

                Three Level Menu
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="">
                    <a href="#">
                        <i class="menu-icon fa fa-leaf green"></i>
                        Item #1
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="#" class="dropdown-toggle">
                        <i class="menu-icon fa fa-pencil orange"></i>

                        4th level
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu">
                        <li class="">
                            <a href="#">
                                <i class="menu-icon fa fa-plus purple"></i>
                                Add Product
                            </a>

                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="#">
                                <i class="menu-icon fa fa-eye pink"></i>
                                View Products
                            </a>

                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</li>-->

<li>
    <a href="<?php echo site_url('auth'); ?>">
        <i class="menu-icon fa fa-users"></i>
        <span class="menu-text"> Usuarios </span>
    </a>

    <b class="arrow"></b>
</li>

<li>
    <a href="<?php echo site_url('backup'); ?>">
        <i class="menu-icon fa fa-database"></i>
        <span class="menu-text"> Copias Seguridad </span>
    </a>

    <b class="arrow"></b>
</li>

<li class="<?php echo set_active_menu($_active_section,array("tipos_ficheros","tipos_inmueble","plantillas_documentacion")); ?>">
    <a href="#" class="dropdown-toggle">
        <i class="menu-icon fa fa-building"></i>
        <span class="menu-text"> Config. Datos </span>

        <b class="arrow fa fa-angle-down"></b>
    </a>

    <b class="arrow"></b>

    <ul class="submenu">
        <li class="<?php echo set_active_option($_active_section,'plantillas_documentacion'); ?>">
            <a href="<?php echo site_url('plantillas_documentacion'); ?>">
                <i class="menu-icon fa fa-caret-right"></i>
                <span class="menu-text"> Plantillas Documentación </span>
            </a>

            <b class="arrow"></b>
        </li>
        
        <li class="<?php echo set_active_option($_active_section,'tipos_ficheros'); ?>">
            <a href="<?php echo site_url('tipos_ficheros'); ?>">
                <i class="menu-icon fa fa-caret-right"></i>
                <span class="menu-text"> Tipos ficheros </span>
            </a>

            <b class="arrow"></b>
        </li>

        <li class="<?php echo set_active_option($_active_section,'tipos_inmueble'); ?>">
            <a href="<?php echo site_url('tipos_inmueble'); ?>">
                <i class="menu-icon fa fa-caret-right"></i>
                <span class="menu-text"> Tipos inmueble </span>
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
        <li class="">
            <a href="<?php echo site_url('admin/cabecera');?>">
                <i class="menu-icon fa fa-caret-right"></i>
                Cabecera
            </a>

            <b class="arrow"></b>
        </li>

        <li class="">
            <a href="<?php echo site_url('admin/pie');?>">
                <i class="menu-icon fa fa-caret-right"></i>
                Pie
            </a>

            <b class="arrow"></b>
        </li>
    </ul>
</li>
<li class="">
    <a href="#" class="dropdown-toggle">
        <i class="menu-icon fa fa-globe"></i>
        <span class="menu-text"> Secciones </span>

        <b class="arrow fa fa-angle-down"></b>
    </a>

    <b class="arrow"></b>

    <ul class="submenu">
        <li class="">
        	<a href="<?php echo site_url('Page/listar_secciones'); ?>">
                <i class="menu-icon fa fa-caret-right"></i>
                Listado
            </a>

            <b class="arrow"></b>
        </li>
        <li class="">
        	<a href="<?php echo site_url('Page/ordenar_secciones'); ?>">
                <i class="menu-icon fa fa-caret-right"></i>
                Ordenar
            </a>

            <b class="arrow"></b>
        </li>
        <li class="">
        	<a href="<?php echo site_url('Page/crear_seccion'); ?>">
                <i class="menu-icon fa fa-caret-right"></i>
                Nueva
            </a>

            <b class="arrow"></b>
        </li>
	</ul>					
</li>							
								
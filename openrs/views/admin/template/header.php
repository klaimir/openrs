<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php printf($this->config->item('federacion_' . $comunidad_autonoma), $username_login); ?></title>

        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />

        <!--basic styles-->
        <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo base_url();?>assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css" />      
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap-wysihtml5.css"></link>
        <!--[if IE 7]>
                        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome-ie7.min.css" />
                        <![endif]-->

        <!--page specific plugin styles-->

        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-timepicker.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/chosen.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/colorbox.css" />

        <!--fonts-->

        <link rel="stylesheet"
              href="<?php echo base_url();?>assets/css/ace-fonts.css" />

        <!--ace styles-->

        <link rel="stylesheet"
              href="<?php echo base_url();?>assets/css/ace.min.css" />
        <link rel="stylesheet"
              href="<?php echo base_url();?>assets/css/ace-responsive.min.css" />
        <link rel="stylesheet"
              href="<?php echo base_url();?>assets/css/ace-skins.min.css" />
        <!--[if lte IE 8]>
                          <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-ie.min.css" />
                        <![endif]-->

        <!--inline styles related to this page-->

        <!--[if !IE]>-->

        <script type="text/javascript">
            window.jQuery || document.write("<script src='<?php echo base_url();?>assets/js/jquery-2.0.3.min.js'>" + "<" + "/script>");
        </script>

        <!--<![endif]-->

        <!--[if IE]>
        <script type="text/javascript">
            window.jQuery || document.write("<script src='<?php echo base_url();?>assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
        </script>
        <![endif]-->

        <!--ace settings handler-->

        <script>
            var BASEURL = '<?php echo site_url('/'); ?>';
        </script>
        <script src="<?php echo base_url();?>assets/js/ace-extra.min.js"></script>

        <link rel="stylesheet"
              href="<?php echo base_url();?>assets/css/panel.css" />
        
        <?php include_once(APPPATH.'third_party/analyticstracking.php'); ?>
    </head>

    <body class="navbar-fixed">
        <div id="ace-settings-navbar" style="display:none;"></div>
        <div id="ace-settings-sidebar" style="display:none;"></div>
        <div id="ace-settings-breadcrumbs" style="display:none;"></div>	
        <div class="navbar navbar-fixed-top" id="navbar">
            <script type="text/javascript">
            try {
                ace.settings.check('navbar', 'fixed')
            } catch (e) {
            }
            $(document).ready(function () {
                $('#bletradni').on('click', function () {
                    if ($('#tletradni').val() != 'undefined')
                    {
                        var valor = $('#tletradni').val();
                        if (valor != "")
                        {
                            $('#tletradni').val('Calculando...');
                            $.get('<?php echo site_url(); ?>/sanciones/calculardni/' + valor, function (e) {
                                if (e != "") {
                                    $('#tletradni').val(valor + e.toString());
                                } else {
                                    $('#tletradni').val(valor);
                                }
                            });
                        }
                    }
                });
                $('#tletradni').on('focus', function () {
                    $('#tletradni').val('');
                });
            });
            </script>

            <div class="navbar-inner">
                <div class="container-fluid">
                    <a href="#" class="brand"> <small> 
                            <img style="width:22px;height:22px;" src="<?php echo base_url();?>assets/images/logofederacion_<?php echo $comunidad_autonoma; ?>.jpg" alt="logo federacion" class="img-circle noautowidth" />
                            <?php printf($this->config->item('federacion_' . $comunidad_autonoma), $username_login); ?>
                        </small>
                    </a>

                    <!--/.brand-->

                    <ul class="nav ace-nav pull-right">                            
                        <li class="light-blue">
                            <a data-toggle="dropdown" class="dropdown-toggle">
                                <?php echo $estadousuario; ?>
                            </a>
                        </li>
                        <?php if ($esadmin) { ?>
                            <li class="light-blue">
                                <div>
                                    <input id="tletradni" style="width: 80px; padding-left: 10px; margin-left: 10px; margin-top: 6px; height: 16px;" name="tletradni" class="nav-search-input" placeholder="¿Letra DNI?" type="text">
                                    <button id="bletradni" class="btn btn-mini btn-default tooltip-info" style="padding-bottom: 0px; margin-bottom: 9px; margin-right: 5px;" data-placement="bottom" data-rel="tooltip" data-original-title="Esta utilidad le permite obtener el NIF a partir de un nº de licencia">
                                        <i class="icon-gear"></i>
                                    </button>
                                </div>
                            </li>
                            <li class="light-blue"><a data-toggle="dropdown" class="dropdown-toggle"
                                                      href="#"> <i class="icon-envelope icon-animated-vertical"></i> <span
                                        class="badge badge-success numincidencias"><?php echo $numincidencias ?> </span>
                                </a>
                                <ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-closer">
                                    <li class="nav-header"><i class="icon-envelope"></i> <?php echo $numincidencias ?>&nbsp;Incidencias
                                    </li>
                                    <?php
                                    // Limitamos sólo a 6
                                    if ($numincidencias > 0) {
                                        foreach ($incidencias_reducido as $incidencia) {
                                            $url_notif = site_url() . '/incidencias';
                                            ?>
                                            <li>
                                                <a href="<?php echo $url_notif; ?>"> 
                                                    <img src="<?php if (!$incidencia->avatar && $incidencia->avatar!='') echo base_url($incidencia->avatar); ?>"
                                                         class="msg-photo" alt="Avatar" /> <span class="msg-body"> <span
                                                            class="msg-title"> <span class="blue"><?php echo $incidencia->first_name . " " . $incidencia->last_name; ?>:</span>
                                                            <?php echo $incidencia->texto; ?> ...
                                                        </span> <span class="msg-time"> <i class="icon-time"></i> <span><?php echo date('d/m/Y H:i:s', strtotime($incidencia->fecha)); ?>
                                                            </span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <li>
                                        <?php echo anchor('incidencias', 'Ver todos las incidencias'); ?>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                        <li class="light-blue"><a data-toggle="dropdown" class="dropdown-toggle"
                                                  href="#"> <i class="icon-bell-alt icon-animated-vertical"></i> <span
                                    class="badge badge-warning"><?php echo $numnotificaciones ?> </span>
                            </a>

                            <ul
                                class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-closer">
                                <li class="nav-header"><i class="icon-bell-alt"></i> <?php echo $numnotificaciones ?>&nbsp;Avisos
                                </li>
                                <?php
                                if ($numnotificaciones > 0) {
                                    foreach ($notificaciones_reducido as $notificacion) {
                                        if (is_null($notificacion->url))
                                            $url_notif = site_url() . '/notificaciones';
                                        else
                                            $url_notif = $notificacion->url;
                                        ?>
                                        <li>
                                            <a href="<?php echo $url_notif; ?>"> 
                                                <img src="<?php if ($notificacion->avatar) echo base_url($notificacion->avatar); else echo base_url('assets/avatars/avatar.png'); ?>"
                                                     class="msg-photo" alt="Avatar" /> <span class="msg-body"> <span
                                                        class="msg-title"> <span class="blue"><?php echo $notificacion->first_name . " " . $notificacion->last_name; ?>:</span>
                                                        <?php echo $notificacion->notificacion; ?> ...
                                                    </span> <span class="msg-time"> <i class="icon-time"></i> <span><?php echo date('d/m/Y H:i:s', strtotime($notificacion->fecha)); ?>
                                                        </span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                                <li class="nav-header"><?php echo anchor('notificaciones', 'Ver todos los avisos'); ?></li>
                            </ul>
                        </li>     
                       <!--
                        <li class="light-blue">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle"> <img class="nav-user-photo" src="<?php echo base_url($avatar_login); ?>" alt="Avatar" />
                                <span class="user-info"> <small>Bienvenido,</small> <?php echo $username_login; ?></span>
                                <i class="icon-caret-down"></i>
                            </a>
                            <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
                                <li><?php echo anchor('usuarios/cuenta/' . $id, '<i class="icon-user"></i>Mi Cuenta'); ?></li>
                                <li class="divider"></li>
                                <li><?php echo anchor('auth/logout', '<i class="icon-off"></i>Salir'); ?></li>
                            </ul>
                        </li>-->
                       <li class="light-blue">
                           <a data-toggle="dropdown" class="dropdown-toggle">
                           <img class="nav-user-photo" src="<?php echo base_url($avatar_login); ?>" alt="Avatar" />
                           <span class="user-info white"> <small>Bienvenido,</small> <?php echo $username_login; ?></span>
                           </a>
                        </li>
                        <li class="light-blue"> <?php echo anchor('usuarios/cuenta/' . $id, '<i class="icon-user"></i>'); ?></li>
                        <li class="light-blue">
                            <?php echo anchor('auth/logout', '<i class="icon-off"></i>'); ?>
                        </li>
                    </ul>
                    <!--/.ace-nav-->
                </div>
                <!--/.container-fluid-->
            </div>
            <!--/.navbar-inner-->
        </div>

        <div class="main-container container-fluid">
            <a class="menu-toggler" id="menu-toggler" href="#"> <span
                    class="menu-text"></span>
            </a>

            <div class="sidebar" id="sidebar">
                <script type="text/javascript">
                    try {
                        ace.settings.check('sidebar', 'fixed')
                    } catch (e) {
                    }
                </script>

                <?php if ($essuperadmin) { ?>
                    <ul class="nav nav-list">
                        <li><?php echo anchor('usuarios/index', '<i class="icon-home"></i><span class="menu-text"> Inicio </span>'); ?>
                        </li>
                        <li><?php echo anchor('notificaciones', '<i class="icon-bell-alt"></i><span class="menu-text"> Avisos <span class="badge badge-warning ">' . $numnotificaciones . '</span></span>'); ?>
                        </li>
                        <li><?php echo anchor('comunidades', '<i class="icon-group"></i><span class="menu-text"> Comunidades Autónomas</span>'); ?>
                        </li>
                        <li><?php echo anchor('configsuperadmin/editarConfig', '<i class="icon-star"></i><span class="menu-text"> Configuración</span>'); ?>
                        </li>
                        <li>
                            <a class="dropdown-toggle" href="#">
                                <i class="icon-list"></i>
                                <span class="menu-text"> Tablas auxiliares </span>
                                <b class="arrow icon-angle-down"></b>
                            </a>
                            <ul class="submenu" style="display: none;">
                                <li>
                                    <?php echo anchor('tablasauxgen/agrupamientoslistado', '<i class="icon-double-angle-right"></i><span class="menu-text"> Agrupamientos </span>'); ?>
                                </li> 
                                <li>
                                    <?php echo anchor('categorias/listacategorias', '<i class="icon-double-angle-right"></i><span class="menu-text"> Categorias Licencias </span>'); ?>
                                </li> 
                                <li>
                                    <?php echo anchor('documentos/listatiposdocumentos', '<i class="icon-double-angle-right"></i><span class="menu-text"> Tipos de Documentos</span>'); ?>
                                </li>
                                <li>
                                    <?php echo anchor('tareasplantillas/listado', '<i class="icon-double-angle-right"></i><span class="menu-text"> Plantillas de Tareas</span>'); ?>
                                </li>
                                <li>
                                    <?php echo anchor('permisos/index', '<i class="icon-double-angle-right"></i><span class="menu-text"> Permisos RFEC</span>'); ?>
                                </li>
                            </ul>
                        </li>
                        <li><?php echo anchor('usuarios/listausuarios', '<i class="icon-user"></i><span class="menu-text"> Usuarios </span>'); ?>
                    </ul>
                <?php } else if ($esrfec) { ?>
                    <ul class="nav nav-list">
                        <li><?php echo anchor('usuarios/index', '<i class="icon-home"></i><span class="menu-text"> Inicio </span>'); ?>
                        </li>
                        <li><?php echo anchor('licencias/listalicencias', '<i class="icon-credit-card"></i><span class="menu-text"> Licencias </span>'); ?>
                        </li>
                        <li><?php echo anchor('carreras/listacarreras', '<i class="icon-time"></i><span class="menu-text"> Pruebas </span>'); ?>
                        </li>
                        <li>
                            <a class="dropdown-toggle" href="#">
                                <i class="icon-list-ol"></i>
                                <span class="menu-text"> Clasificaciones </span>
                                <b class="arrow icon-angle-down"></b>
                            </a>
                            <ul class="submenu" style="display: none;">
                                <li><?php echo anchor('clasificaciones/circuitoslistado', '<i class="icon-list-ol"></i><span class="menu-text"> Clasificaciones </span>'); ?></li>
                                <li><?php echo anchor('clasificacionescircuitos/circuitoslistado', '<i class="icon-list"></i><span class="menu-text"> Circuitos </span>'); ?>                                     
                                </li>
                                <li><?php echo anchor('clasificacionescategorias/listado', '<i class="icon-list"></i><span class="menu-text"> Categorías </span>'); ?>                                     
                                </li>
                                <li><?php echo anchor('clasificacionesplantillasptos/listado', '<i class="icon-list"></i><span class="menu-text"> Plant. Ptos. Generales </span>'); ?>                                     
                                </li>
                                <li><?php echo anchor('clasificacionesplantillasptosetapas/listado', '<i class="icon-list"></i><span class="menu-text"> Plant. Ptos. Etapas </span>'); ?>                                     
                                </li>
                            </ul>
                        </li>
                        <li><?php echo anchor('equipos/listaequipos', '<i class="icon-html5"></i><span class="menu-text"> Equipos <span class="badge badge-warning ">' . $numequiposrfec . '</span></span>'); ?>
                        </li>
                        <li><?php echo anchor('federados/listafederadosadmin', '<i class="icon-shield"></i><span class="menu-text"> Autorizados Club </span>'); ?>
                        </li>
                        <li>
                            <a class="dropdown-toggle" href="#">
                                <i class="icon-group"></i>
                                <span class="menu-text"> Clubes </span>
                                <b class="arrow icon-angle-down"></b>
                            </a>
                            <ul class="submenu" style="display: none;">
                                <li><?php echo anchor('clubes/listado/0', '<i class="icon-group"></i><span class="menu-text"> Clubes Nacionales </span>'); ?>
                                </li>
                                <li><?php echo anchor('clubes/listado/1', '<i class="icon-group"></i><span class="menu-text"> Clubes Extranjeros </span>'); ?>
                                </li>
                            </ul>
                        </li>
                       
                        <li><?php echo anchor('arbitros/listado', '<i class="icon-group"></i><span class="menu-text"> Arbitros</span>'); ?>
                        </li>
                        <li><?php echo anchor('entrenadores/listado', '<i class="icon-group"></i><span class="menu-text"> Entrenadores</span>'); ?>
                        </li>
                        <li><?php echo anchor('reuniones/listado', '<i class="icon-briefcase"></i><span class="menu-text"> Reuniones </span>'); ?>
                        </li> 
                        <li><?php echo anchor('certificados/listado', '<i class="icon-bookmark"></i><span class="menu-text"> Certificados RFEC</span>'); ?>
                        <li>
                            <a class="dropdown-toggle" href="#">
                                <i class="icon-list"></i>
                                <span class="menu-text"> Tablas auxiliares </span>
                                <b class="arrow icon-angle-down"></b>
                            </a>
                            <ul class="submenu" style="display: none;">
                                <li><a href="" style="background-color:#ECF2F7;cursor:default;"><i class="icon-list"></i><span class="menu-text">1. Licencias </span></a></li>
                                <li><?php echo anchor('categorias/listacategorias', '<i class="icon-list"></i><span class="menu-text"> Categor&iacute;as </span>'); ?>
                                </li>  
                                <li><?php echo anchor('documentos/listadoportiposlicencias', '<i class="icon-list"></i><span class="menu-text"> Tipos de Documentos</span>'); ?>
                                </li>
                                <li><?php echo anchor('especialidades/especialidadeslistado', '<i class="icon-list"></i><span class="menu-text"> Especialidades </span>'); ?>
                                </li>
                                <li><?php echo anchor('circuitos/circuitoslistado', '<i class="icon-list"></i><span class="menu-text"> Circuitos </span>'); ?>
                                </li> 
                                <li><a href="" style="background-color:#ECF2F7;cursor:default;"><i class="icon-list"></i><span class="menu-text">2. Pruebas </span></a></li>
                                <li><?php echo anchor('categoriascarreras/listacategoriascarreras', '<i class="icon-list"></i><span class="menu-text"> Clases </span>'); ?>
                                </li>
                                <li><?php echo anchor('categoriascarrerasnombres/listacategoriasnombres', '<i class="icon-list"></i><span class="menu-text"> Categorias Pruebas </span>'); ?>
                                </li>
                                <li><?php echo anchor('opcionesextranombres/listado', '<i class="icon-list"></i><span class="menu-text"> Tasas Por Servicios</span>'); ?>
                                </li> 
                                <li><?php echo anchor('carrerascircuitos/circuitoslistado', '<i class="icon-list"></i><span class="menu-text"> Circuitos </span>'); ?>                                     
                                </li>                                
                                <li><?php echo anchor('especialidadescarreras/especialidadescarreraslistado', '<i class="icon-list"></i><span class="menu-text"> Especialidades </span>'); ?>
                                </li>
                                <li><?php echo anchor('documentoscarrerastipos/listado', '<i class="icon-list"></i><span class="menu-text"> Tipos de Documentos </span>'); ?>
                                </li>
                                <li><?php echo anchor('cron/listado', '<i class="icon-list"></i><span class="menu-text"> Avisos automáticos </span>'); ?>
                                </li>
                                <li><a href="" style="background-color:#ECF2F7;cursor:default;"><i class="icon-list"></i><span class="menu-text">3. Tablas Generales </span></a></li>
                                <li><?php echo anchor('provincias/listado', '<i class="icon-list"></i><span class="menu-text"> Provincias </span>'); ?>
                                </li>
                                <li><?php echo anchor('poblaciones/listadoporprovincias', '<i class="icon-list"></i><span class="menu-text"> Poblaciones </span>'); ?>
                                </li>
                                <li><a href="" style="background-color:#ECF2F7;cursor:default;"><i class="icon-list"></i><span class="menu-text">4. Ventas </span></a></li>
                                <li><?php echo anchor('grupos/listado', '<i class="icon-list"></i><span class="menu-text"> Grupos </span>'); ?>
                                </li>
                                <li><?php echo anchor('articulos/listado', '<i class="icon-list"></i><span class="menu-text"> Articulos </span>'); ?>
                                </li>
                                <?php if ($habilitar_credito == 1) { ?>
                                    <li><?php echo anchor('credito/listado', '<i class="icon-list"></i><span class="menu-text"> Credito </span>'); ?>
                                    </li>
                                <?php } ?>
                                <li><?php echo anchor('gastos/listado', '<i class="icon-list"></i><span class="menu-text"> Gastos Arbitros </span>'); ?>
                                </li>   
                                <li><a href="" style="background-color:#ECF2F7;cursor:default;"><i class="icon-list"></i><span class="menu-text">5. Configuración </span></a></li>
                                <li><?php echo anchor('config/editarconfig', '<i class="icon-list"></i><span class="menu-text"> Temporada Actual </span>'); ?>
                                </li>  
                                <li><?php echo anchor('comunidades/editarcomunidad/' . $comunidad_autonoma, '<i class="icon-list"></i><span class="menu-text"> Configuracion </span>'); ?>
                                </li>  
                                <li><?php echo anchor('comunidades/listadocumentos', '<i class="icon-list"></i><span class="menu-text"> Documentos Config. </span>'); ?>
                                </li>
                                <li><a href="" style="background-color:#ECF2F7;cursor:default;"><i class="icon-list"></i><span class="menu-text">6. Plantillas </span></a></li>
                                <li><?php echo anchor('plantillas/listado/' . $comunidad_autonoma, '<i class="icon-list"></i><span class="menu-text"> Plantillas Certificados </span>'); ?>
                                </li> 
                                <li><?php echo anchor('plantillas/listadocumentos', '<i class="icon-list"></i><span class="menu-text"> Documentos Plantillas </span>'); ?>
                                </li> 

                                <li><?php echo anchor('encuestasplantillas/listado', '<i class="icon-comment"></i><span class="menu-text"> Plantillas de Encuestas </span>'); ?>                                     
                                </li>
                                <li><?php echo anchor('formulariosplantillas/listado', '<i class="icon-comment"></i><span class="menu-text"> Plantillas de Formularios </span>'); ?>  
                            </ul>
                        </li>
                        <?php
                        /*
                        <li>
                            <a class="dropdown-toggle" href="#">
                                <i class="icon-list-ol"></i>
                                <span class="menu-text"> Inventarios </span>
                                <b class="arrow icon-angle-down"></b>
                            </a>
                            <ul class="submenu" style="display: none;">
                                <li><?php echo anchor('inventarios/articulos', '<i class="icon-list-ol"></i><span class="menu-text"> Articulos </span>'); ?></li>
                                <li><?php echo anchor('inventarios/movimientos', '<i class="icon-list"></i><span class="menu-text"> Movimientos </span>'); ?>                                     
                                </li>                              
                            </ul>
                        </li>
                         * 
                         */
                        ?>
                        <li><?php echo anchor('incidencias', '<i class="icon-envelope"></i><span class="menu-text"> Incidencias <span class="badge badge-success numincidencias">' . $numincidencias . '</span><span class="badge badge-warning numincidencias_cerradas">' . $numincidencias_cerradas . '</span></span>'); ?>
                        </li>
                        <li><?php echo anchor('notificaciones', '<i class="icon-bell-alt"></i><span class="menu-text"> Avisos <span class="badge badge-warning ">' . $numnotificaciones . '</span></span>'); ?>
                        </li>
                        <li><?php echo anchor('usuarios/listausuarios', '<i class="icon-user"></i><span class="menu-text"> Usuarios </span>'); ?>
                        </li>
                    </ul>
                    <!--/.nav-list-->
                <?php } else if ($esadmin) { ?>
                    <ul class="nav nav-list">
                        <li><?php echo anchor('usuarios/index', '<i class="icon-home"></i><span class="menu-text"> Inicio </span>'); ?>
                        </li>
                        <li>
                            <a class="dropdown-toggle" href="#">
                                <i class="icon-credit-card"></i>
                                <span class="menu-text"> Licencias <?php echo '<span class="badge badge-pink">' . $num_licencias_pend_pago . '</span><span class="badge badge-warning ">' . $num_licencias_pend_validar . '</span>'; ?></span>
                                <b class="arrow icon-angle-down"></b>
                            </a>
                            <ul class="submenu" style="display: none;">
                                <li><?php echo anchor('licencias/listalicencias', '<i class="icon-credit-card"></i><span class="menu-text"> Consultar </span>'); ?></li>
                                <li><?php echo anchor('licencias/solicitaradmin', '<i class="icon-credit-card"></i><span class="menu-text"> Solicitar licencia </span>'); ?></li>                                
                                <li><?php echo anchor('licencias/exportarcsvintranet', '<i class="icon-credit-card"></i><span class="menu-text"> Exportar intranet </span>'); ?></li>
                                <li><?php echo anchor('importar/licenciaimportar', '<i class="icon-credit-card"></i><span class="menu-text"> Importar </span>'); ?></li>
                            </ul>
                        </li>                      
                        <li>
                            <a class="dropdown-toggle" href="#">
                                <i class="icon-time"></i>
                                <span class="menu-text"> Pruebas <?php echo '<span class="badge badge-info ">' . $numcarreras . '</span>'; ?></span>
                                <b class="arrow icon-angle-down"></b>
                            </a>
                            <ul class="submenu" style="display: none;">
                                <li><?php echo anchor('carreras/listacarreras', '<i class="icon-time"></i><span class="menu-text">Consultar </span>'); ?></li>
                                <li><?php echo anchor('carreras/nuevacarrera/nacional', '<i class="icon-time"></i><span class="menu-text">Nueva Nacional</span>'); ?></li>
                                <li><?php echo anchor('carreras/nuevacarrera/autonomica', '<i class="icon-time"></i><span class="menu-text">Nueva Autónomica</span>'); ?></li>
                                <li><?php echo anchor('sanciones/listadoadmin', '<i class="icon-time"></i><span class="menu-text">Sancionados </span>'); ?></li>                                
                                <li><?php echo anchor('carreras/inscritos', '<i class="icon-time"></i><span class="menu-text"> Inscritos </span>'); ?></li>                                
                            </ul>
                        </li>
                        <li>
                            <a class="dropdown-toggle" href="#">
                                <i class="icon-list-ol"></i>
                                <span class="menu-text"> Clasificaciones </span>
                                <b class="arrow icon-angle-down"></b>
                            </a>
                            <ul class="submenu" style="display: none;">
                                <li><?php echo anchor('clasificaciones/circuitoslistado', '<i class="icon-list-ol"></i><span class="menu-text"> Clasificaciones </span>'); ?></li>
                                <li><?php echo anchor('clasificacionescircuitos/circuitoslistado', '<i class="icon-list"></i><span class="menu-text"> Circuitos </span>'); ?>                                     
                                </li>
                                <li><?php echo anchor('clasificacionescategorias/listado', '<i class="icon-list"></i><span class="menu-text"> Categorías </span>'); ?>                                     
                                </li>
                                <li><?php echo anchor('clasificacionesplantillasptos/listado', '<i class="icon-list"></i><span class="menu-text"> Plant. Ptos. Generales </span>'); ?>                                     
                                </li>
                                <li><?php echo anchor('clasificacionesplantillasptosetapas/listado', '<i class="icon-list"></i><span class="menu-text"> Plant. Ptos. Etapas </span>'); ?>                                     
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="dropdown-toggle" href="#">
                                <i class="icon-group"></i>
                                <span class="menu-text"> Clubes </span>
                                <b class="arrow icon-angle-down"></b>
                            </a>
                            <ul class="submenu" style="display: none;">
                                <li><?php echo anchor('clubes/listado/0', '<i class="icon-group"></i><span class="menu-text"> Clubes Nacionales </span>'); ?>
                                </li>
                                <?php /*
                                <li><?php echo anchor('clubes/listado/1', '<i class="icon-group"></i><span class="menu-text"> Clubes Extranjeros </span>'); ?>
                                </li>
                                 * 
                                 */
                                ?>
                            </ul>
                        </li>
                        <li><?php echo anchor('arbitros/listado', '<i class="icon-group"></i><span class="menu-text"> Arbitros</span>'); ?>
                        </li>
                        <li><?php echo anchor('entrenadores/listado', '<i class="icon-group"></i><span class="menu-text"> Entrenadores</span>'); ?>
                        </li>
                        <li><?php echo anchor('equipos/listaequipos', '<i class="icon-html5"></i><span class="menu-text"> Equipos <span class="badge badge-warning ">' . $numequipos . '</span></span>'); ?>
                        </li>
                        <li><?php echo anchor('federados/listafederadosadmin', '<i class="icon-shield"></i><span class="menu-text"> Autorizados Club </span>'); ?>
                        </li> 
                        <li><?php echo anchor('reuniones/listado', '<i class="icon-briefcase"></i><span class="menu-text"> Reuniones </span>'); ?>
                        </li> 
                        <?php if ($habilitar_promo) { ?><li><?php echo anchor('promociones/listado', '<i class="icon-gift"></i><span class="menu-text"> Promociones </span>'); ?></li><?php } ?>
                        <?php if ($habilitar_noticias) { ?><li><?php echo anchor('noticias/listado', '<i class="icon-camera"></i><span class="menu-text"> Noticias web <span class="badge badge-info numnoticias">' . $numnoticias . '</span></span>'); ?></li><?php } ?>
                        <li>
                            <a class="dropdown-toggle" href="#">
                                <i class="icon-cloud-upload"></i>
                                <span class="menu-text"> Envio a RFEC <?php echo '<span class="badge badge-warning ">' . $enviorfec_licencias . '</span><span class="badge badge-pink">' . $enviorfec_club . '</span>'; ?></span>
                                <b class="arrow icon-angle-down"></b>
                            </a>
                            <ul class="submenu" style="display: none;">
                                <li><?php echo anchor('enviorfec/clubes', '<i class="icon-cloud-upload"></i><span class="menu-text"> Clubes </span><span class="badge-pink" style="font-size:11px;float:right;margin-right:5px;color:#ffffff;border-radius:9px;padding-left: 3px;padding-right: 3px;">'. $enviorfec_club .'</span>'); ?></li>                                 
                                <li><?php echo anchor('enviorfec/licencias', '<i class="icon-cloud-upload"></i><span class="menu-text"> Licencias </span><span class="badge-warning" style="font-size:11px;float:right;margin-right:5px;color:#ffffff;border-radius:9px;padding-left: 3px;padding-right: 3px;">' . $enviorfec_licencias . '</span>'); ?></li>
                            </ul>
                        </li>
                         <li><?php echo anchor('certificados/listado', '<i class="icon-bookmark"></i><span class="menu-text"> Certificados RFEC</span>'); ?>
                        </li>
                        <li>
                            <a class="dropdown-toggle" href="#">
                                <i class="icon-list"></i>
                                <span class="menu-text"> Tablas auxiliares </span>
                                <b class="arrow icon-angle-down"></b>
                            </a>
                            <ul class="submenu" style="display: none;">
                                <li><a href="" style="background-color:#ECF2F7;cursor:default;"><i class="icon-list"></i><span class="menu-text">1. Licencias </span></a></li>
                                <li><?php echo anchor('categorias/listacategorias', '<i class="icon-list"></i><span class="menu-text"> Categor&iacute;as </span>'); ?>
                                </li>    
                                <li><?php echo anchor('documentos/listadoportiposlicencias', '<i class="icon-list"></i><span class="menu-text"> Tipos de Documentos</span>'); ?>
                                </li>
                                <li><?php echo anchor('circuitos/circuitoslistado', '<i class="icon-list"></i><span class="menu-text"> Circuitos </span>'); ?>
                                </li>  
                                <li><a href="" style="background-color:#ECF2F7;cursor:default;"><i class="icon-list"></i><span class="menu-text">2. Pruebas </span></a></li>
                                <li><?php echo anchor('categoriascarreras/listacategoriascarreras', '<i class="icon-list"></i><span class="menu-text"> Clases </span>'); ?>
                                </li>
                                <li><?php echo anchor('categoriascarrerasnombres/listacategoriasnombres', '<i class="icon-list"></i><span class="menu-text"> Categorias Pruebas </span>'); ?>
                                </li>
                                <li><?php echo anchor('opcionesextranombres/listado', '<i class="icon-list"></i><span class="menu-text"> Tasas Por Servicios</span>'); ?>
                                </li>
                                <li><?php echo anchor('carrerascircuitos/circuitoslistado', '<i class="icon-list"></i><span class="menu-text"> Circuitos </span>'); ?>                                     
                                </li>                                 
                                <li><?php echo anchor('especialidadescarreras/especialidadescarreraslistado', '<i class="icon-list"></i><span class="menu-text"> Especialidades </span>'); ?>
                                </li>
                                <li><?php echo anchor('documentoscarrerastipos/listado', '<i class="icon-list"></i><span class="menu-text"> Tipos de Documentos</span>'); ?>
                                </li>
                                <li><?php echo anchor('cron/listado', '<i class="icon-list"></i><span class="menu-text"> Avisos automáticos </span>'); ?>
                                </li>
                                <li><a href="" style="background-color:#ECF2F7;cursor:default;"><i class="icon-list"></i><span class="menu-text">3. Tablas Generales </span></a></li>
                                <li><?php echo anchor('provincias/listado', '<i class="icon-list"></i><span class="menu-text"> Provincias </span>'); ?>
                                </li>
                                <li><?php echo anchor('poblaciones/listadoporprovincias', '<i class="icon-list"></i><span class="menu-text"> Poblaciones </span>'); ?>
                                </li>
                                <li><a href="" style="background-color:#ECF2F7;cursor:default;"><i class="icon-list"></i><span class="menu-text">4. Ventas </span></a></li>
                                <li><?php echo anchor('grupos/listado', '<i class="icon-list"></i><span class="menu-text"> Grupos </span>'); ?>
                                </li>
                                <li><?php echo anchor('articulos/listado', '<i class="icon-list"></i><span class="menu-text"> Articulos </span>'); ?>
                                </li>
                                <?php if ($habilitar_credito == 1) { ?>
                                    <li><?php echo anchor('credito/listado', '<i class="icon-list"></i><span class="menu-text"> Credito </span>'); ?>
                                    </li>
                                <?php } ?>
                                <li><a href="" style="background-color:#ECF2F7;cursor:default;"><i class="icon-list"></i><span class="menu-text">5. Configuración </span></a></li>
                                <li><?php echo anchor('config/editarconfig', '<i class="icon-list"></i><span class="menu-text"> Temporada Actual </span>'); ?>
                                </li>  
                                <li><?php echo anchor('comunidades/editarcomunidad/' . $comunidad_autonoma, '<i class="icon-list"></i><span class="menu-text"> Datos Federación </span>'); ?>
                                </li>  
                                <li><?php echo anchor('comunidades/listadocumentos', '<i class="icon-list"></i><span class="menu-text"> Documentos Config. </span>'); ?>
                                </li>
                                <?php /* ?>
                                    <li><?php echo anchor('notificacionesapi/listado', '<i class="icon-list"></i><span class="menu-text"> Tipos notificación api</span>'); ?>
                                    </li> 
                                <?php */ ?>
                                <li><a href="" style="background-color:#ECF2F7;cursor:default;"><i class="icon-list"></i><span class="menu-text">6. Plantillas </span></a></li>
                                <li><?php echo anchor('plantillas/listado/' . $comunidad_autonoma, '<i class="icon-list"></i><span class="menu-text"> Plantillas Certificados </span>'); ?>
                                </li> 
                                <li><?php echo anchor('plantillas/listadocumentos', '<i class="icon-list"></i><span class="menu-text"> Documentos Plantillas </span>'); ?>
                                </li>                                
                                <li><?php echo anchor('encuestasplantillas/listado', '<i class="icon-list"></i><span class="menu-text"> Plantillas de Encuestas </span>'); ?>                                     
                                </li>
                                <li><?php echo anchor('formulariosplantillas/listado', '<i class="icon-list"></i><span class="menu-text"> Plantillas de Formularios </span>'); ?>                                     
                                </li>
                            </ul>
                        </li>
                        <li><?php echo anchor('incidencias', '<i class="icon-envelope"></i><span class="menu-text"> Incidencias <span class="badge badge-success numincidencias">' . $numincidencias . '</span><span class="badge badge-warning numincidencias_cerradas">' . $numincidencias_cerradas . '</span></span>'); ?>
                        </li>
                        <li><?php echo anchor('notificaciones', '<i class="icon-bell-alt"></i><span class="menu-text"> Avisos <span class="badge badge-warning ">' . $numnotificaciones . '</span></span>'); ?>
                        </li>  
                        <li>
                            <a class="dropdown-toggle" href="#">
                                <i class="icon-euro"></i>
                                <span class="menu-text"> Contabilidad </span>
                                <b class="arrow icon-angle-down"></b>
                            </a>
                            <ul class="submenu" style="display: none;">
                                <li><?php echo anchor('delegaciones/ventas', '<i class="icon-eur"></i><span class="menu-text"> Ventas </span>'); ?></li>
                                <li><?php echo anchor('contabilidad', '<i class="icon-eur"></i><span class="menu-text"> Exportar a Contaplus </span>'); ?></li>
                            </ul>
                        </li>
                        <li><?php echo anchor('usuarios/listausuarios', '<i class="icon-user"></i><span class="menu-text"> Usuarios </span>'); ?>
                        </li>
                    </ul>
                    <!--/.nav-list-->
                <?php } else if ($esorganizador) { ?>
                    <ul class="nav nav-list">
                        <li><?php echo anchor('usuarios/index', '<i class="icon-home"></i><span class="menu-text"> Inicio </span>'); ?>
                        </li>
                        <li><?php echo anchor('usuarios/cuenta/' . $id, '<i class="icon-user"></i><span class="menu-text"> Mi Cuenta </span>'); ?>
                        </li>
                        <li><?php echo anchor('documentos/indexpublico', '<i class="icon-file"></i><span class="menu-text"> Mis Documentos </span>'); ?>
                        </li>
                        <li><?php echo anchor('licencias/listalicencias', '<i class="icon-credit-card"></i><span class="menu-text"> Mis Licencias </span>'); ?>
                        </li>
                        <li><?php echo anchor('incidencias', '<i class="icon-envelope"></i><span class="menu-text"> Incidencias <span class="badge badge-success numincidencias">' . $numincidencias . '</span><span class="badge badge-warning numincidencias_cerradas">' . $numincidencias_cerradas . '</span></span>'); ?>
                        </li>  
                        <li><?php echo anchor('notificaciones', '<i class="icon-bell-alt"></i><span class="menu-text"> Avisos <span class="badge badge-warning ">' . $numnotificaciones . '</span></span>'); ?>
                        </li>
                        <li><?php echo anchor('carreras/listacarreras', '<i class="icon-time"></i><span class="menu-text"> Pruebas </span>'); ?>
                        </li>
                    </ul>
                    <!--/.nav-list-->
                <?php
                } else {
                ?>
                    <ul class="nav nav-list">
                        <li><?php echo anchor('usuarios/index', '<i class="icon-home"></i><span class="menu-text"> Inicio </span>'); ?>
                        </li>
                        <li><?php echo anchor('usuarios/cuenta/' . $id, '<i class="icon-user"></i><span class="menu-text"> Mi Cuenta </span>'); ?>
                        </li>
                        <?php if ($esusuariovalidado || $esclub) { ?>
                            <li><?php echo anchor('documentos/indexpublico', '<i class="icon-file"></i><span class="menu-text"> Mis Documentos </span>'); ?>
                            </li>
                        <?php } ?>
                        <?php if (!$esdelegacion && !$estienda) { ?>
                            <li><?php echo anchor('licencias/listalicencias', '<i class="icon-credit-card"></i><span class="menu-text"> Mis Licencias </span>'); ?>
                            </li>
                            <?php if (!$esclub && $esfederado) { ?>
                            <li><?php echo anchor('carreras/listamiscarreras', '<i class="icon-time"></i><span class="menu-text"> Mis Pruebas </span>'); ?>
                            </li>
                            <li><?php echo anchor('carreras/getclasificacionescircuitos', '<i class="icon-list-ol"></i><span class="menu-text"> Mis Circuitos </span>'); ?>
                            </li>
                            <?php } ?>
                            <?php if ($habilitar_promo && ($esfederado || $esclub || $esarbitro)) { ?><li><?php echo anchor('promociones/listado', '<i class="icon-gift"></i><span class="menu-text"> Promociones <span class="badge badge-info">' . $numpromociones . '</span></span>'); ?></li><?php } ?>
                        <?php } else if (!$estienda) { ?>
                            <li>
                                <a class="dropdown-toggle" href="#">
                                    <i class="icon-list"></i>
                                    <span class="menu-text"> Licencias </span>
                                    <b class="arrow icon-angle-down"></b>
                                </a>
                                <ul class="submenu" style="display: none;">
                                    <li><?php echo anchor('licencias/consultalicencias', '<i class="icon-eur"></i><span class="menu-text"> Consulta Licencias </span>'); ?>
                                    </li>
                                    <li><?php echo anchor('licencias/pagolicencias', '<i class="icon-eur"></i><span class="menu-text"> Pago Licencias </span>'); ?>
                                    </li>                                                                       
                                </ul>
                            </li>
                            <li>
                                <a class="dropdown-toggle" href="#">
                                    <i class="icon-list"></i>
                                    <span class="menu-text"> Contabilidad </span>
                                    <b class="arrow icon-angle-down"></b>
                                </a>
                                <ul class="submenu" style="display: none;">                                    
                                    <li>
                                        <a target="_blank" href="<?php echo site_url(); ?>/delegaciones/liquidaciondiaria">
                                            <i class="icon-eur"></i><span class="menu-text"> Liquidacion Licencias </span>
                                        </a>                                        
                                    </li>
                                    <li>
                                        <a target="_blank" href="<?php echo site_url(); ?>/delegaciones/liquidacionrangofechas">
                                            <i class="icon-eur"></i><span class="menu-text"> Liquidacion Rango Fechas </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="<?php echo site_url(); ?>/delegaciones/informependientespdf">
                                            <i class="icon-eur"></i><span class="menu-text"> Informe Pendientes </span>
                                        </a>
                                    </li>                                     
                                </ul>
                            </li>
                            <li><?php echo anchor('delegaciones/ventas', '<i class="icon-eur"></i><span class="menu-text"> Ventas </span>'); ?>
                            </li>
                            <li><?php echo anchor('carreras/listacarreras', '<i class="icon-time"></i><span class="menu-text"> Pruebas </span>'); ?>
                            </li>
                        <?php } ?>
                        <li><?php echo anchor('incidencias', '<i class="icon-envelope"></i><span class="menu-text"> Incidencias <span class="badge badge-success numincidencias">' . $numincidencias . '</span><span class="badge badge-warning numincidencias_cerradas">' . $numincidencias_cerradas . '</span></span>'); ?>
                        </li>                       
                        <li><?php echo anchor('notificaciones', '<i class="icon-bell-alt"></i><span class="menu-text"> Avisos <span class="badge badge-warning ">' . $numnotificaciones . '</span></span>'); ?>
                        </li>
                        <?php if ($esdesignacionarbitros) { ?>
                            <li><?php echo anchor('carreras/listacarrerasarbitros', '<i class="icon-time"></i><span class="menu-text"> Designación Arbitros </span>'); ?>
                            </li>
                        <?php } ?>
                        <?php if($this->data['avisos_pruebas_preferidas'] || $this->data['avisos_pruebas_preferidas_rfec']){ ?>
                            <li>
                                <?php echo anchor('carreras/listacarreraspreferidas', '<i class="icon-list"></i><span class="menu-text"> Pruebas preferidas </span>'); ?>
                            </li>
                        <?php } ?>
                        <?php if ($esadminreglamentos) { ?>
                            <li><?php echo anchor('carreras/listacarreras', '<i class="icon-time"></i><span class="menu-text"> Pruebas </span>'); ?>
                            </li>
                        <?php } ?>
                        <?php if ($esclub) { ?>
                            <li><?php echo anchor('equipos/listaequipos', '<i class="icon-html5"></i><span class="menu-text"> Equipos </span>'); ?>
                            </li>
                            <li><?php echo anchor('federados/listafederados', '<i class="icon-shield"></i><span class="menu-text"> Autorizados Club </span>'); ?>
                            </li>
                            <li><?php echo anchor('federados/pendientespago', '<i class="icon-eur"></i><span class="menu-text"> Pendientes de pago </span>'); ?>
                            </li>
                            <li><?php echo anchor('carreras/listacarreras', '<i class="icon-time"></i><span class="menu-text"> Pruebas </span>'); ?>
                            </li>
                            <?php if ($habilitar_noticias) { ?><li><?php echo anchor('noticias/listado', '<i class="icon-camera"></i><span class="menu-text"> Noticias web </span>'); ?></li><?php } ?>
                        <?php } else if ($esarbitro) { ?>
                            <li><?php echo anchor('carreras/listacarrerasarbitrosasignadas', '<i class="icon-thumbs-up-alt"></i><span class="menu-text"> Designaciones </span>'); ?>
                            </li>
                            <li><?php echo anchor('arbitros/datos_irpf', '<i class="icon-eur"></i><span class="menu-text"> Datos IRPF </span>'); ?>
                            </li>
                        <?php /*} else if ($esfederado) { ?>
                            <li><?php echo anchor('carreras/listacarreraspreferidas', '<i class="icon-star"></i><span class="menu-text"> Pruebas Preferidas </span>'); ?>
                            </li>
                        <?php */} else if ($esfederativotecnicopruebas) { ?>
                            <li><?php echo anchor('carreras/listacarrerasfederativos', '<i class="icon-comment"></i><span class="menu-text"> Encuestas </span>'); ?>
                            </li>
                        <?php } ?>
                        <?php if ($estienda) { ?>
                            <li><?php echo anchor('tiendas/validar', '<i class="icon-briefcase"></i><span class="menu-text"> Validar C&oacute;digos </span>'); ?>
                            </li>
                        <?php } ?>
                        <?php if ($asamblea_rfec || $junta_rfec || $comision_rfec || $asamblea_territorial || $junta_territorial || $comision_territorial || $auditoria_control) { ?>
                            <li><?php echo anchor('reuniones/listado', '<i class="icon-briefcase"></i><span class="menu-text"> Reuniones </span>'); ?>
                            </li>                            
                        <?php }
                        if ($director_deportivo) { ?>
                            <li><?php echo anchor('reuniones/listadocursos', '<i class="icon-briefcase"></i><span class="menu-text"> Cursos </span>'); ?>
                            </li>                            
                        <?php } ?>        

                    </ul>
                    <!--/.nav-list-->
                <?php } ?>
                    
                <?php if($esinventario) { ?>
                <ul class="nav nav-list">
                    <li>
                        <a class="dropdown-toggle" href="#">
                            <i class="icon-list"></i>
                            <span class="menu-text"> Inventario </span>
                            <b class="arrow icon-angle-down"></b>
                        </a>
                        <ul class="submenu" style="display: none;">
                            <li>
                                <?php echo anchor('inventarios/articulos', '<i class="icon-eur"></i><span class="menu-text"> Artículos </span>'); ?>
                            </li>
                            <li>
                                <?php echo anchor('inventarios/movimientos', '<i class="icon-eur"></i><span class="menu-text"> Movimientos </span>'); ?>
                            </li>                                                                       
                        </ul>
                    </li>
                </ul>
                <?php } ?>
                    
                <?php if ($estrabajador) { ?>
                <ul class="nav nav-list">    
                    <li><?php echo anchor('tareasdiarias/listado', '<i class="icon-time"></i><span class="menu-text"> Tareas diarias </span>'); ?></li>
                </ul>
                <?php } ?>
                    
                <div class="sidebar-collapse" id="sidebar-collapse">
                    <i class="icon-double-angle-left"
                       data-icon1="icon-double-angle-left"
                       data-icon2="icon-double-angle-right"></i>
                </div>

                <script type="text/javascript">
                    try {
                        ace.settings.check('sidebar', 'collapsed')
                    } catch (e) {
                    }
                </script>
            </div>

            <div class="main-content">


                <div class="page-content">
                    <div class="row-fluid">
                        <div class="span12">
                            <?php if ($this->config->item('aviso')!='') { ?>
                                <div class="alert alert-info"> <?php echo $this->config->item('aviso') . "<br>"; ?> </div>
                            <?php } ?>
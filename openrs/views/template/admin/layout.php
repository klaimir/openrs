<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Open RS</title>

        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/font-awesome/4.2.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/admin.css" />
		
        <!-- page specific plugin styles -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/chosen.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/daterangepicker.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/datepicker.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/dropzone.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/colorbox.min.css" />

        <!-- text fonts -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/fonts/fonts.googleapis.com.css" />

        <!-- ace styles -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

        <!--[if lte IE 9]>
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/ace-part2.min.css" class="ace-main-stylesheet" />
        <![endif]-->

        <!--[if lte IE 9]>
          <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/ace-ie.min.css" />
        <![endif]-->

        <!-- inline styles related to this page -->
        <script src="<?php echo base_url(); ?>assets/admin/js/functions.js"></script>

        <!-- ace settings handler -->
        <script src="<?php echo base_url(); ?>assets/admin/js/ace-extra.min.js"></script>

        <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

        <!--[if lte IE 8]>
        <script src="<?php echo base_url(); ?>assets/admin/js/html5shiv.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/respond.min.js"></script>
        <![endif]-->

        <!-- basic scripts -->

        <!--[if !IE]> -->
        <script src="<?php echo base_url(); ?>assets/admin/js/jquery.2.1.1.min.js"></script>

        <!-- <![endif]-->

        <!--[if IE]>
        <script src="<?php echo base_url(); ?>assets/admin/js/jquery.1.11.1.min.js"></script>
        <![endif]-->

        <!--[if !IE]> -->
        <script type="text/javascript">
            window.jQuery || document.write("<script src='<?php echo base_url(); ?>assets/admin/js/jquery.min.js'>" + "<" + "/script>");
        </script>

        <!-- <![endif]-->

        <!--[if IE]>
        <script type="text/javascript">
         window.jQuery || document.write("<script src='<?php echo base_url(); ?>assets/admin/js/jquery1x.min.js'>"+"<"+"/script>");
        </script>
        <![endif]-->
        <script type="text/javascript">
            if ('ontouchstart' in document.documentElement)
                document.write("<script src='<?php echo base_url(); ?>assets/admin/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
        </script>
        <script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/ckeditor/ckeditor.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/jquery.dataTables.min.js"></script>
        
        <?php /*if(isset($google_map)) { echo $google_map['js']; } */ ?>
    </head>

    <body class="no-skin">
        <div id="navbar" class="navbar navbar-default">
            <script type="text/javascript">
            try {
                ace.settings.check('navbar', 'fixed')
            } catch (e) {
            }
            </script>

            <div class="navbar-container" id="navbar-container">
                <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                    <span class="sr-only">Toggle sidebar</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>
                </button>

                <div class="navbar-header pull-left">
                    <a href="index.html" class="navbar-brand">
                        <small>
                            <i class="fa fa-leaf"></i>
                            Open RS
                        </small>
                    </a>
                </div>

                <div class="navbar-buttons navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">
                        
                        <li class="purple">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="ace-icon fa fa-bell icon-animated-bell"></i>
                                <span class="badge badge-important">8</span>
                            </a>

                            <ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                                <li class="dropdown-header">
                                    <i class="ace-icon fa fa-exclamation-triangle"></i>
                                    8 Notifications
                                </li>

                                <li class="dropdown-content">
                                    <ul class="dropdown-menu dropdown-navbar navbar-pink">
                                        <li>
                                            <a href="#">
                                                <div class="clearfix">
                                                    <span class="pull-left">
                                                        <i class="btn btn-xs no-hover btn-pink fa fa-comment"></i>
                                                        New Comments
                                                    </span>
                                                    <span class="pull-right badge badge-info">+12</span>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="btn btn-xs btn-primary fa fa-user"></i>
                                                Bob just signed up as an editor ...
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <div class="clearfix">
                                                    <span class="pull-left">
                                                        <i class="btn btn-xs no-hover btn-success fa fa-shopping-cart"></i>
                                                        New Orders
                                                    </span>
                                                    <span class="pull-right badge badge-success">+8</span>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <div class="clearfix">
                                                    <span class="pull-left">
                                                        <i class="btn btn-xs no-hover btn-info fa fa-twitter"></i>
                                                        Followers
                                                    </span>
                                                    <span class="pull-right badge badge-info">+11</span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="dropdown-footer">
                                    <a href="#">
                                        See all notifications
                                        <i class="ace-icon fa fa-arrow-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <?php /*
                        <li class="green">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
                                <span class="badge badge-success">5</span>
                            </a>

                            <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                                <li class="dropdown-header">
                                    <i class="ace-icon fa fa-envelope-o"></i>
                                    5 Messages
                                </li>

                                <li class="dropdown-content">
                                    <ul class="dropdown-menu dropdown-navbar">
                                        <li>
                                            <a href="#" class="clearfix">
                                                <img src="<?php echo base_url(); ?>assets/admin/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar" />
                                                <span class="msg-body">
                                                    <span class="msg-title">
                                                        <span class="blue">Alex:</span>
                                                        Ciao sociis natoque penatibus et auctor ...
                                                    </span>

                                                    <span class="msg-time">
                                                        <i class="ace-icon fa fa-clock-o"></i>
                                                        <span>a moment ago</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="clearfix">
                                                <img src="<?php echo base_url(); ?>assets/admin/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
                                                <span class="msg-body">
                                                    <span class="msg-title">
                                                        <span class="blue">Susan:</span>
                                                        Vestibulum id ligula porta felis euismod ...
                                                    </span>

                                                    <span class="msg-time">
                                                        <i class="ace-icon fa fa-clock-o"></i>
                                                        <span>20 minutes ago</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="clearfix">
                                                <img src="<?php echo base_url(); ?>assets/admin/avatars/avatar4.png" class="msg-photo" alt="Bob's Avatar" />
                                                <span class="msg-body">
                                                    <span class="msg-title">
                                                        <span class="blue">Bob:</span>
                                                        Nullam quis risus eget urna mollis ornare ...
                                                    </span>

                                                    <span class="msg-time">
                                                        <i class="ace-icon fa fa-clock-o"></i>
                                                        <span>3:15 pm</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="clearfix">
                                                <img src="<?php echo base_url(); ?>assets/admin/avatars/avatar2.png" class="msg-photo" alt="Kate's Avatar" />
                                                <span class="msg-body">
                                                    <span class="msg-title">
                                                        <span class="blue">Kate:</span>
                                                        Ciao sociis natoque eget urna mollis ornare ...
                                                    </span>

                                                    <span class="msg-time">
                                                        <i class="ace-icon fa fa-clock-o"></i>
                                                        <span>1:33 pm</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="clearfix">
                                                <img src="<?php echo base_url(); ?>assets/admin/avatars/avatar5.png" class="msg-photo" alt="Fred's Avatar" />
                                                <span class="msg-body">
                                                    <span class="msg-title">
                                                        <span class="blue">Fred:</span>
                                                        Vestibulum id penatibus et auctor  ...
                                                    </span>

                                                    <span class="msg-time">
                                                        <i class="ace-icon fa fa-clock-o"></i>
                                                        <span>10:09 am</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="dropdown-footer">
                                    <a href="inbox.html">
                                        See all messages
                                        <i class="ace-icon fa fa-arrow-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        */
                        ?>
                        
                        <li class="light-blue">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                <img class="nav-user-photo" src="<?php echo base_url(); ?>assets/admin/avatars/user.jpg" alt="Jason's Photo" />
                                <span class="user-info">
                                    <small>Bienvenido,</small>
                                    <?php echo $session_identity; ?>
                                </span>

                                <i class="ace-icon fa fa-caret-down"></i>
                            </a>

                            <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">

                                <li>
                                    <a href="<?php echo site_url("auth/edit_user/$session_user_id"); ?>">
                                        <i class="ace-icon fa fa-user"></i>
                                        Perfil
                                    </a>
                                </li>

                                <li class="divider"></li>

                                <li>
                                    <a href="<?php echo site_url('auth/logout'); ?>">
                                        <i class="ace-icon fa fa-power-off"></i>
                                        Salir
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div><!-- /.navbar-container -->
        </div>

        <div class="main-container" id="main-container">
            <script type="text/javascript">
                try {
                    ace.settings.check('main-container', 'fixed')
                } catch (e) {
                }
            </script>

            <div id="sidebar" class="sidebar responsive">
                <script type="text/javascript">
                    try {
                        ace.settings.check('sidebar', 'fixed')
                    } catch (e) {
                    }
                </script>

                <?php /*
                <div class="sidebar-shortcuts" id="sidebar-shortcuts">
                    <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                        <button class="btn btn-success">
                            <i class="ace-icon fa fa-signal"></i>
                        </button>

                        <button class="btn btn-info">
                            <i class="ace-icon fa fa-pencil"></i>
                        </button>

                        <button class="btn btn-warning">
                            <i class="ace-icon fa fa-users"></i>
                        </button>

                        <button class="btn btn-danger">
                            <i class="ace-icon fa fa-cogs"></i>
                        </button>
                    </div>

                    <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                        <span class="btn btn-success"></span>

                        <span class="btn btn-info"></span>

                        <span class="btn btn-warning"></span>

                        <span class="btn btn-danger"></span>
                    </div>
                </div><!-- /.sidebar-shortcuts -->
                 * 
                 */
                ?>
                
                <ul class="nav nav-list">
                <?php
                if($session_es_agente) {
                    $this->load->view('template/admin/agente_menu', $this->data);
                }
                
                if($session_es_admin) {
                    $this->load->view('template/admin/admin_menu', $this->data);
                }
                ?>
                </ul><!-- /.nav-list -->
                
                <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                    <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
                </div>

                <script type="text/javascript">
                    try {
                        ace.settings.check('sidebar', 'collapsed')
                    } catch (e) {
                    }
                </script>
            </div>

            <div class="main-content">
                <div class="main-content-inner">
                    <?php /* if (isset($breadcrumb)) { ?>
                        <div class="breadcrumbs" id="breadcrumbs">
                            <script type="text/javascript">
                                try {
                                    ace.settings.check('breadcrumbs', 'fixed')
                                } catch (e) {
                                }
                            </script>

                            <ul class="breadcrumb">
                                <li>
                                    <i class="ace-icon fa fa-home home-icon"></i>
                                    <a href="#">Home</a>
                                </li>
                                <li class="active">Dashboard</li>
                            </ul><!-- /.breadcrumb -->
                        </div>
                    <?php } */ ?>

                    <div class="page-content">
                        <div class="ace-settings-container" id="ace-settings-container">
                            <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                                <i class="ace-icon fa fa-cog bigger-130"></i>
                            </div>

                            <div class="ace-settings-box clearfix" id="ace-settings-box">
                                <div class="pull-left width-50">

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
                                        <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
                                        <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
                                        <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
                                        <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
                                        <label class="lbl" for="ace-settings-add-container">
                                            Inside
                                            <b>.container</b>
                                        </label>
                                    </div>
                                </div><!-- /.pull-left -->

                                <div class="pull-left width-50">
                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" />
                                        <label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" />
                                        <label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" />
                                        <label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
                                    </div>
                                </div><!-- /.pull-left -->
                            </div><!-- /.ace-settings-box -->
                        </div><!-- /.ace-settings-container -->

                        <div class="row">
                            <div class="col-xs-12">
                                <!-- PAGE CONTENT BEGINS -->

                                <?php $this->load->view($_view_path, $this->data); ?>

                                <!-- PAGE CONTENT ENDS -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div>

                </div>

            </div><!-- /.main-content -->

            <div class="footer">
                <div class="footer-inner">
                    <div class="footer-content">
                        <span class="bigger-120">
                            Open RS &copy; 2017
                        </span>
                        <?php /*
                        &nbsp; &nbsp;
                        <span class="action-buttons">
                            <a href="#">
                                <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                            </a>

                            <a href="#">
                                <i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
                            </a>

                            <a href="#">
                                <i class="ace-icon fa fa-rss-square orange bigger-150"></i>
                            </a>
                        </span>
                         * 
                         */
                        ?>
                    </div>
                </div>
            </div>

            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
        </div><!-- /.main-container -->

        <!--basic scripts-->
        <script type="text/javascript">

            function muestra_oculta(id) {
                if (document.getElementById) { //se obtiene el id
                    var el = document.getElementById(id); //se define la variable "el" igual a nuestro div
                    el.style.display = (el.style.display == 'none') ? 'block' : 'none'; //damos un atributo display:none que oculta el div
                }
            }

            function trim(str)
            {
                str = str.replace(/^\s+/, '');
                for (var i = str.length - 1; i >= 0; i--) {
                    if (/\S/.test(str.charAt(i))) {
                        str = str.substring(0, i + 1);
                        break;
                    }
                }
                return str;
            }

            function dateHeight(dateStr) {
                if (trim(dateStr) != '') {
                    var frDate = trim(dateStr).split(' ');
                    if (frDate.length > 1)
                        var frTime = frDate[1].split(':');
                    else
                        var frTime = "00:00:00".split(':');
                    var frDateParts = frDate[0].split('/');
                    var day = frDateParts[0] * 60 * 24;
                    var month = frDateParts[1] * 60 * 24 * 31;
                    var year = frDateParts[2] * 60 * 24 * 366;
                    var hour = frTime[0] * 60;
                    var minutes = frTime[1];
                    var x = day + month + year + hour + minutes;
                } else {
                    var x = 99999999999999999; //GoHorse!
                }
                return x;
            }

            if ("ontouchend" in document) {
                document.write("<script src='<?php echo base_url(); ?>assets/admin/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
            }

            $(function () {

                $(window).keydown(function (event) {
                    if (event.keyCode == 13) {
                        event.preventDefault();
                        return false;
                    }
                });

                /*
                 $('.toggleinput').inputtoggle();
                 $('.editinputinline').editinputinline();
                 */


                jQuery.fn.dataTableExt.oSort['date-euro-asc'] = function (a, b) {
                    var x = dateHeight(a);
                    var y = dateHeight(b);
                    var z = ((x < y) ? -1 : ((x > y) ? 1 : 0));
                    return z;
                };

                jQuery.fn.dataTableExt.oSort['date-euro-desc'] = function (a, b) {
                    var x = dateHeight(a);
                    var y = dateHeight(b);
                    var z = ((x < y) ? 1 : ((x > y) ? -1 : 0));
                    return z;
                };

                // Documentos

                $('#fichero').ace_file_input({
                    no_file: 'Sin fichero ...',
                    btn_choose: 'Seleccionar',
                    btn_change: 'Cambiar',
                    droppable: false,
                    onchange: null,
                    thumbnail: false
                            //	whitelist:'gif|png|jpg|jpeg|pdf|doc|docx',
                            //	blacklist:'exe|php'
                });
                
                if(!ace.vars['touch']) {
                        $('.chosen-select').chosen({allow_single_deselect:true}); 
                        //resize the chosen on window resize

                        $(window)
                        .off('resize.chosen')
                        .on('resize.chosen', function() {
                                $('.chosen-select').each(function() {
                                         var $this = $(this);
                                         $this.next().css({'width': $this.parent().width()});
                                })
                        }).trigger('resize.chosen');
                        //resize chosen on sidebar collapse/expand
                        $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
                                if(event_name != 'sidebar_collapsed') return;
                                $('.chosen-select').each(function() {
                                         var $this = $(this);
                                         $this.next().css({'width': $this.parent().width()});
                                })
                        });


                        $('#chosen-multiple-style .btn').on('click', function(e){
                                var target = $(this).find('input[type=radio]');
                                var which = parseInt(target.val());
                                if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
                                 else $('#form-field-select-4').removeClass('tag-input-style');
                        });
                }

                // Generales
                /*
                 $('.date-picker').datepicker({
                 weekStart: 1,
                 language: "es-ES"
                 }).next().on(ace.click_event, function () {
                 $(this).prev().focus();
                 });
                 
                 $('.date-picker2').datepicker({
                 weekStart: 1,
                 language: "es-ES"
                 }).next().on(ace.click_event, function () {
                 $(this).prev().focus();
                 });
                 
                 $('#timepicker1').timepicker({
                 minuteStep: 1,
                 showMeridian: false
                 });
                 
                 $('#timepicker2').timepicker({
                 minuteStep: 1,
                 showMeridian: false
                 });
                 */

                $('#tabgrid').dataTable({
                    "iDisplayLength": 100,
                    "oLanguage": {"sUrl": "<?php echo base_url(); ?>assets/admin/js/dataTables.spanish.txt"}
                });
                
                //datepicker plugin
                //link
                $('.date-picker').datepicker({
                        autoclose: true,
                        todayHighlight: true
                })
                //show datepicker when clicking on the icon
                .next().on(ace.click_event, function(){
                        $(this).prev().focus();
                });

                //or change it into a date range picker
                $('.input-daterange').datepicker({autoclose:true});

            });
        </script>

        <!-- page specific plugin scripts -->
        <script src="<?php echo base_url(); ?>assets/admin/js/chosen.jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/jquery.dataTables.bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/dataTables.tableTools.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/dataTables.colVis.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/bootbox.min.js" type="text/javascript"></script>    
        <script src="<?php echo base_url(); ?>assets/admin/js/daterangepicker.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/bootstrap-datepicker.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/dropzone.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/jquery.colorbox.min.js"></script>

        <!--[if lte IE 8]>
          <script src="<?php echo base_url(); ?>assets/admin/js/excanvas.min.js"></script>
        <![endif]-->
        <script src="<?php echo base_url(); ?>assets/admin/js/jquery-ui.custom.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/jquery.ui.touch-punch.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/jquery.easypiechart.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/jquery.sparkline.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/jquery.flot.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/jquery.flot.pie.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/jquery.flot.resize.min.js"></script>

        <!-- ace scripts -->
        <script src="<?php echo base_url(); ?>assets/admin/js/ace-elements.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/ace.min.js"></script>

    </body>
</html>
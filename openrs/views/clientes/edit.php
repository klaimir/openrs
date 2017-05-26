<div class="hidden">
    <button data-target="#sidebar2" data-toggle="collapse" type="button" class="pull-left navbar-toggle collapsed">
        <span class="sr-only">Toggle sidebar</span>

        <i class="ace-icon fa fa-dashboard white bigger-125"></i>
    </button>

    <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse">
        <ul class="nav nav-list">
            <li class="hover active">
                <a href="<?php echo site_url('clientes/edit/'.$element->id); ?>">
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

            <li class="hover">
                <a href="#">
                    <i class="menu-icon fa fa-picture-o"></i>
                    <span class="menu-text"> DEMANDAS </span>
                </a>

                <b class="arrow"></b>
            </li>

            <li class="hover">
                <a href="<?php echo site_url('ficheros_cliente'); ?>">
                    <i class="menu-icon fa fa-tag"></i>
                    <span class="menu-text"> FICHEROS ADJUNTOS </span>
                </a>

                <b class="arrow"></b>
            </li>
            
            <li class="hover">
                <a href="<?php echo site_url('fichas_cliente'); ?>">
                    <i class="menu-icon fa fa-file-pdf-o"></i>
                    <span class="menu-text"> FICHAS DEL CLIENTE </span>
                </a>
                <b class="arrow"></b>
            </li>
        </ul><!-- /.nav-list -->
    </div><!-- .sidebar -->
</div>

<div class="page-header">
    <h1>
        Plantillas de documentación
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            <?php echo lang('common_btn_edit'); ?>
        </small>
    </h1>
</div>

<?php $this->load->view('common/message', $this->data); ?> 

<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>

<?php $this->load->view($_view.'/form', $this->data); ?>

<div class="clearfix form-actions">
    <div class="col-md-offset-3 col-md-9">
        <button class="btn btn-info" type="submit" name="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>
            <?php echo lang('common_btn_edit'); ?>
        </button>
    </div>
</div>

<?php echo form_hidden('id',$element->id); ?>

<?php echo form_close(); ?>

<script type="text/javascript">
    jQuery(function($) {
       $('#sidebar2').insertBefore('.page-content');

       $('.navbar-toggle[data-target="#sidebar2"]').insertAfter('#menu-toggler');


       $(document).on('settings.ace.two_menu', function(e, event_name, event_val) {
             if(event_name == 'sidebar_fixed') {
                     if( $('#sidebar').hasClass('sidebar-fixed') ) {
                            $('#sidebar2').addClass('sidebar-fixed');
                            $('#navbar').addClass('h-navbar');
                     }
                     else {
                            $('#sidebar2').removeClass('sidebar-fixed')
                            $('#navbar').removeClass('h-navbar');
                     }
             }
       }).triggerHandler('settings.ace.two_menu', ['sidebar_fixed' ,$('#sidebar').hasClass('sidebar-fixed')]);
    })
</script>
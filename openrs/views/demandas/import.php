<div class="page-header">
    <h1>
        Clientes
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Importar
        </small>
    </h1>
</div>

<?php $this->load->view('common/message', $this->data); ?> 

<div class="row">
    <div class="col-xs-12">
        <?php echo form_open_multipart($this->uri->uri_string(), 'class="form-horizontal"'); ?>

        <div class="form-group">            
            <?php echo label('Fichero a importar', 'fichero', 'class="col-sm-3 control-label no-padding-right"'); ?>
            <div class="col-sm-9">
                <input type="file" id="fichero" name="fichero" size="20"  />
            </div>
        </div>

        <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
                <button class="btn btn-info" type="submit" name="submit">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    Validar
                </button>
            </div>
        </div>
    </div>
</div>

<?php echo form_close(); ?>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function($) {                

        $('#fichero').ace_file_input({
            no_file: 'Sin fichero ...',
            btn_choose: 'Seleccionar',
            btn_change: 'Cambiar',
            droppable: false,
            onchange: null,
            thumbnail: false,
            whitelist:'csv'
                    //blacklist:'exe|php'
                    //onchange:''
                    //
        });

    });
</script>
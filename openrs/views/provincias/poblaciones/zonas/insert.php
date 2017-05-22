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
            <a href="<?php echo site_url('provincias'); ?>">Provincias</a>
        </li>
        <li>
            <a href="<?php echo site_url('poblaciones/index/'.$provincia->id); ?>"><?php echo $provincia->provincia; ?></a>
        </li>
        <li>
            <a href="<?php echo site_url('zonas/index/'.$poblacion->id); ?>"><?php echo $poblacion->poblacion; ?></a>
        </li>
        <li class="active"><?php echo lang('common_btn_insert'); ?></li>
    </ul><!-- /.breadcrumb -->
</div>

<div class="space-4"></div>
<div class="page-header">
    <div class="row">
        <div class="col-xs-12">
            <h1>
                Zonas de <?php echo $poblacion->poblacion; ?>
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    <?php echo lang('common_btn_insert'); ?>
                </small>
            </h1>
        </div>
    </div>
</div>

<?php $this->load->view('common/message', $this->data); ?> 

<div class="row">
    <div class="col-xs-12">
        <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>

        <?php $this->load->view($_view.'/form', $this->data); ?>

        <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
                <button class="btn btn-info" type="submit" name="submit">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    <?php echo lang('common_btn_insert'); ?>
                </button>
                <button class="btn" type="reset">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    Reset
                </button>
            </div>
        </div>
    </div>
</div>

<?php echo form_close(); ?>

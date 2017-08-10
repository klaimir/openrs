<div class="page-header">
    <h1>
        Usuarios
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            <?php echo lang('deactivate_heading');?>
        </small>
    </h1>
</div>

<div class="row">
    <div class="col-xs-12">
        <?php echo form_open("auth/deactivate/".$user->id, 'class="form-horizontal"');?>
        
        <p align="center"><?php echo sprintf(lang('deactivate_subheading'), $user->email);?></p>
        
        <p align="center">
            <?php echo lang('deactivate_confirm_y_label', 'confirm');?>
            <input type="radio" name="confirm" value="yes" checked="checked" />
            <?php echo lang('deactivate_confirm_n_label', 'confirm');?>
            <input type="radio" name="confirm" value="no" />
        </p>

        <?php echo form_hidden($csrf); ?>
        <?php echo form_hidden(array('id'=>$user->id)); ?>
        
        <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
                <button class="btn btn-info" type="submit" name="submit">
                    <?php echo lang('deactivate_submit_btn'); ?>
                </button>
            </div>
        </div>
        
        <?php echo form_close();?>
    </div>
</div>
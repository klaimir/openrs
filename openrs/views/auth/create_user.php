<div class="page-header">
    <h1>
        <?php echo lang('create_user_heading'); ?>
    </h1>
</div>

<p><?php echo lang('create_user_subheading'); ?></p>

<?php $this->load->view('common/message', $this->data); ?> 

<?php echo form_open("auth/create_user", 'class="form-horizontal"'); ?>

<div class="form-group">            
    <?php echo lang('create_user_fname_label', 'first_name', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_input($first_name); ?>
    </div>
</div>

<div class="form-group"> 
    <?php echo lang('create_user_lname_label', 'last_name', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_input($last_name); ?>
    </div>
</div>

<div class="form-group"> 
    <?php echo lang('create_user_email_label', 'email', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_input($email); ?>
    </div>
</div>

<div class="form-group"> 
    <?php echo lang('create_user_phone_label', 'phone', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_input($phone); ?>
    </div>
</div>

<div class="form-group"> 
    <?php echo lang('create_user_password_label', 'password', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_input($password); ?>
    </div>
</div>

<div class="form-group"> 
    <?php echo lang('create_user_password_confirm_label', 'password_confirm', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_input($password_confirm); ?>
    </div>
</div>

<div class="clearfix form-actions">
    <div class="col-md-offset-3 col-md-9">
        <button class="btn btn-info" type="submit" name="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>
            <?php echo lang('create_user_submit_btn'); ?>
        </button>
        <button class="btn" type="reset">
            <i class="ace-icon fa fa-undo bigger-110"></i>
            Reset
        </button>
    </div>
</div>

<?php echo form_close(); ?>

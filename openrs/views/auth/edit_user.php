<div class="page-header">
    <h1>
        <?php echo lang('edit_user_heading'); ?>
    </h1>
</div>

<p><?php echo lang('edit_user_subheading'); ?></p>

<?php $this->load->view('common/message', $this->data); ?> 

<?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>

<div class="form-group">            
    <?php echo lang('edit_user_fname_label', 'first_name', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_input($first_name); ?>
    </div>
</div>

<div class="form-group"> 
    <?php echo lang('edit_user_lname_label', 'last_name', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_input($last_name); ?>
    </div>
</div>

<div class="form-group"> 
    <?php echo lang('edit_user_phone_label', 'phone', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_input($phone); ?>
    </div>
</div>

<div class="form-group"> 
    <?php echo lang('edit_user_password_label', 'password', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_input($password); ?>
    </div>
</div>

<div class="form-group"> 
    <?php echo lang('edit_user_password_confirm_label', 'password_confirm', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_input($password_confirm); ?>
    </div>
</div>

<?php if ($this->ion_auth->is_admin()): ?>

    <h3 class="header smaller lighter blue"><?php echo lang('edit_user_groups_heading'); ?></h3>
    <?php foreach ($groups as $group): ?>
        <?php
        $gID = $group['id'];
        $checked = null;
        $item = null;
        foreach ($currentGroups as $grp) {
            if ($gID == $grp->id) {
                $checked = ' checked="checked"';
                break;
            }
        }
        ?>            
        <div class="checkbox">
            <label>
                <input class="ace" type="checkbox" name="groups[]" value="<?php echo $group['id']; ?>"<?php echo $checked; ?>>
                <span class="lbl"> <?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?></span>
            </label>
        </div>
    <?php endforeach ?>

<?php endif ?>

<?php echo form_hidden('id', $user->id); ?>
<?php echo form_hidden($csrf); ?>

<div class="clearfix form-actions">
    <div class="col-md-offset-3 col-md-9">
        <button class="btn btn-info" type="submit" name="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>
            <?php echo lang('edit_user_submit_btn'); ?>
        </button>
        <button class="btn" type="reset">
            <i class="ace-icon fa fa-undo bigger-110"></i>
            Reset
        </button>
    </div>
</div>

<?php echo form_close(); ?>

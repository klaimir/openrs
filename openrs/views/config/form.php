<div class="form-group">            
    <?php echo label('Email Contacto', 'email_contacto', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_input($email_contacto, '', 'class="form-control" onchange="mark_modified_field();"'); ?>
    </div>
</div>
<div class="form-group">            
    <?php echo label('API-KEY de Google', 'google_api_key', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_input($google_api_key, '', 'class="form-control" onchange="mark_modified_field();"'); ?>
    </div>
</div>
<div class="form-group">            
    <?php echo label('ID Google Analytics', 'google_analytics_ID', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_input($google_analytics_ID, '', 'class="form-control" onchange="mark_modified_field();"'); ?>
    </div>
</div>
<div class="section">
    <h5><?php echo lang('login_heading'); ?></h5>
    <div class="divider"></div>
    <p><?php echo lang('login_subheading'); ?></p>

    <?php if(isset($message)) { ?>
    <div id="infoMessage" class="card-panel">
        <span class="red-text darken-4">
        <?php echo $message; ?>
        </span>
    </div>
    <?php } ?>
    
    <div class="row">
        <div class="col s12 m6 l6 offset-m3 offset-l3">
            <?php echo form_open("auth/login"); ?>

            <div class="row">
                <div class="input-field">
                    <?php echo form_input($identity); ?>
                    <?php echo lang('login_identity_label', 'identity'); ?>
                </div>
            </div>
            <div class="row">
                <div class="input-field">
                    <?php echo lang('login_password_label', 'password'); ?>
                    <?php echo form_input($password); ?>
                </div>
            </div>

            <div class="row">
                <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?>
                <?php echo lang('login_remember_label', 'remember'); ?>                
            </div>
            
            <div class="row">
                <button class="btn waves-effect waves-light" type="submit" name="submit">
                    <?php echo lang('login_submit_btn'); ?>                    
                </button>
            </div>
            
            <?php echo form_close(); ?>

            <p><a href="forgot_password"><?php echo lang('login_forgot_password'); ?></a></p>
        </div>
    </div>

</div>

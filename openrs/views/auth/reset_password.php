<div class="section">
    <h5><?php echo lang('reset_password_heading'); ?></h5>
    <div class="divider"></div>

    <?php if (isset($message)) { ?>
        <div id="infoMessage" class="card-panel">
            <span class="red-text darken-4">
                <?php echo $message; ?>
            </span>
        </div>
    <?php } ?>

    <div class="row">
        <div class="col s12 m6 l6 offset-m3 offset-l3">
            <?php echo form_open('auth/reset_password/' . $code); ?>
            
            <br>
            
            <div class="row">
                <div class="input-field">
                    <label for="new_password"><?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length); ?></label> <br />
                    <?php echo form_input($new_password); ?>
                </div>
            </div>

            <div class="row">
                <div class="input-field">
                    <?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm'); ?> <br />
                    <?php echo form_input($new_password_confirm); ?>
                </div>
            </div>

            <div class="row">
                <button class="btn waves-effect waves-light" type="submit" name="submit">
                    <?php echo lang('reset_password_submit_btn'); ?>                    
                </button>
            </div>

            <?php echo form_input($user_id); ?>
            <?php echo form_hidden($csrf); ?>

            <?php echo form_close(); ?>
        </div>
    </div>
</div>
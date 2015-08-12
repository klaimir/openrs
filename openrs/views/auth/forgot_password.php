<div class="section">
    <h5><?php echo lang('forgot_password_heading'); ?></h5>
    <div class="divider"></div>

    <p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label); ?></p>

    <?php if (isset($message)) { ?>
        <div id="infoMessage" class="card-panel">
            <span class="red-text darken-4">
                <?php echo $message; ?>
            </span>
        </div>
    <?php } ?>

    <div class="row">
        <div class="col s12 m6 l6 offset-m3 offset-l3">
            <?php echo form_open("auth/forgot_password"); ?>

            <div class="row">
                <div class="input-field">
                    <label for="email"><?php echo sprintf(lang('forgot_password_email_label'), $identity_label); ?></label> <br />
                    <?php echo form_input($email); ?>
                </div>
            </div>

            <div class="row">
                <button class="btn waves-effect waves-light" type="submit" name="submit">
                    <?php echo lang('forgot_password_submit_btn'); ?>                    
                </button>
            </div>

            <?php echo form_close(); ?>
        </div>
    </div>
</div>
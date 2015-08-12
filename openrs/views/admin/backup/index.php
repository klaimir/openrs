<style type="text/css">
    .message_box {
        margin-top: 10px;
    }

    .error, .success {
        /*padding: 20px 20px 20px 40px;*/
        max-width: 525px;
        margin: auto;
        padding: 10px 10px 10px 45px;
        margin-bottom: 5px;
        border-style: solid;
        border-width: 1px;
        background-position: 10px 10px;
        background-repeat: no-repeat;
    }

    .error {
        background-color: #f5dfdf;
        background-image: url(assets/admin/images/error.png);
        border-color: #ce9e9e;
    }

    .success {
        background-color: #e8f5df;
        background-image: url(assets/admin/images/success.png);
        border-color: #9ece9e;
    }
</style>
<div class="page-header">
    <h1>
        Get Site and Database Backup
    </h1>
</div>

<div class="row">
    <div class="col-xs-12">
        <table class="table table-striped table-bordered table-hover" id="tabgrid">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Tipo</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $element) { ?>
                    <tr>
                        <td><?php echo $element->backup_location; ?></td>
                        <td><?php echo $element->created_date; ?></td>
                        <td>
                            <button class="btn btn-xs btn-success">
                                <i class="ace-icon fa fa-check bigger-120"></i>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="space-15"></div>

<div class="message_box">
    <?php
    if (isset($success) && strlen($success)) {
        echo '<div class="success">';
        echo '<p>' . $success . '</p>';
        echo '</div>';
    }

    if (isset($errors) && strlen($errors)) {
        echo '<div class="error">';
        echo '<p>' . $errors . '</p>';
        echo '</div>';
    }

    if (validation_errors()) {
        echo validation_errors('<div class="error">', '</div>');
    }
    ?>
</div>
<?php
$back_url = $this->uri->uri_string();
$key = 'referrer_url_key';
$this->session->set_flashdata($key, $back_url);
?>

<div class="row">
    <div class="col-xs-12">
        <?php
        echo form_open($this->uri->uri_string(), 'class="form-horizontal"');
        ?>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="backup_type"> Backup Type </label>
            <div class="col-sm-9">
                <select name="backup_type">
                    <option value="" selected disabled>Backup Type</option>
                    <option value="1" <?php echo (isset($success) && strlen($success) ? '' : (set_value('backup_type') == '1' ? 'selected' : '')) ?>>DB Backup</option>
                    <option value="2" <?php echo (isset($success) && strlen($success) ? '' : (set_value('backup_type') == '2' ? 'selected' : '')) ?>>Site Backup</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="file_type"> File Type </label>
            <div class="col-sm-9">
                <select name="file_type">
                    <option value="" selected disabled>File Type</option>
                    <option value="1" <?php echo (isset($success) && strlen($success) ? '' : (set_value('file_type') == 1 ? 'selected' : '')) ?>>ZIP</option>
                    <option value="2" <?php echo (isset($success) && strlen($success) ? '' : (set_value('file_type') == 2 ? 'selected' : '')) ?>>GZIP</option>
                </select>
            </div>
        </div>
        
        <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
                <button class="btn btn-info" type="submit" name="backup" value="backup">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    Get Backup
                </button>
                <button class="btn" type="reset">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    Reset
                </button>
            </div>
        </div>

        <?php
        echo form_close();
        ?>

    </div>
</div>
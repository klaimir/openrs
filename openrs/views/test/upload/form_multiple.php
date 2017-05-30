<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>

<?php echo form_open_multipart('test/upload/do_upload_multiple');?>

    <input type="file" name="userfile[]" multiple size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>
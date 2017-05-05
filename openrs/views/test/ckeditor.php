<div id="container">
	<h1>Test CodeIgniter 2.1 + Ckeditor 3.6.1 + kcfinder 2.51</h1>

	<div id="body"><h2>Textarea con CodeIgniter</h2>
	<?php
		$config_mini = array();
		$config_mini['toolbar'] = array(
			array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ,'-', 'Link', 'Unlink', 'Anchor','Image')
		);
 
	/* Y la configuración del kcfinder, la debemos poner así si estamos trabajando en local */
	$config_mini['filebrowserBrowseUrl'] = base_url()."assets/admin/ckeditor/kcfinder/browse.php";
	$config_mini['filebrowserImageBrowseUrl'] = base_url()."assets/admin/ckeditor/kcfinder/browse.php?type=images";
	$config_mini['filebrowserUploadUrl'] = base_url()."assets/admin/ckeditor/kcfinder/upload.php?type=files";
	$config_mini['filebrowserImageUploadUrl'] = base_url()."assets/admin/ckeditor/kcfinder/upload.php?type=images";
	/*$_SESSION['KCFINDER'] = array();
	$_SESSION['KCFINDER']['disabled'] = false; // Activate the uploader, Users to this page MUST be authenticated
	$_SESSION['KCFINDER']['uploadURL'] = "/uploads/".$this->ion_auth->user()->row()->id; // Based on my second folder structure
	*/
	
	echo $this->ckeditor->editor($this->ion_auth->user()->row()->id, "Valor Inicial", $config_mini);
	?>
	</div>
    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
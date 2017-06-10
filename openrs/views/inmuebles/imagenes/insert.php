<?php menu_inmuebles ($inmueble->id,"inmuebles_imagenes"); ?>

<div class="space-4"></div>
<div class="page-header">
    <div class="row">
        <div class="col-xs-12">
            <h1>
                Imágenes del inmueble
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    Subir imágenes
                </small>
            </h1>
        </div>
    </div>
</div>

<?php $this->load->view('common/message', $this->data); ?> 

<?php echo form_open_multipart(site_url('inmuebles_imagenes/upload/'.$inmueble->id), 'class="dropzone" id="dropzone"'); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="fallback">
            <input type="file" name="file" multiple=""  />
        </div>
    </div>
</div>

<?php echo form_close(); ?>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function ($) {  
        try {
            Dropzone.autoDiscover = false;
            var myDropzone = new Dropzone("#dropzone" , {
                paramName: "file", // The name that will be used to transfer the file
                dictDefaultMessage :
                '<span class="bigger-150 bolder"><i class="ace-icon fa fa-caret-right red"></i> Arrastre las imágenes</span> para subirlas \
                <span class="smaller-80 grey">(o haga click)</span> <br /> \
                <i class="upload-icon ace-icon fa fa-cloud-upload blue fa-3x"></i>'
                ,
                //change the previewTemplate to use Bootstrap progress bars
                previewTemplate: "<div class=\"dz-preview dz-file-preview\">\n  <div class=\"dz-details\">\n    <div class=\"dz-filename\"><span data-dz-name></span></div>\n    <div class=\"dz-size\" data-dz-size></div>\n    <img data-dz-thumbnail />\n  </div>\n  <div class=\"progress progress-small progress-striped active\"><div class=\"progress-bar progress-bar-success\" data-dz-uploadprogress></div></div>\n  <div class=\"dz-success-mark\"><span></span></div>\n  <div class=\"dz-error-mark\"><span></span></div>\n  <div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n</div>"
            });

            $(document).one('ajaxloadstart.page', function(e) {
                try {
                        myDropzone.destroy();
                } catch(e) {}
            });

        } catch(e) {
          alert('Dropzone.js does not support older browsers!');
        }
        
        show_submenu();
    })
</script>
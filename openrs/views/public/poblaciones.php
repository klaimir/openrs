<?php echo form_dropdown('poblacion_id',$poblaciones,'','class="form-control" id="poblacion"');?>
<script>
    $(document).ready(function(){
        $('#poblacion').on('change',function(){
        var poblacion = $(this).val();
            $('#zona').fadeIn(500);
            $('#zona').load('<?php echo site_url('seccion/cargar_zonas');?>/'+poblacion);
        });
    });
</script>



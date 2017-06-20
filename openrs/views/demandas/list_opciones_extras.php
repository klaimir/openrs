<div class="space-10"></div>

<div class="row">
    <?php 
    if($opciones_extras)
    {
        foreach ($opciones_extras as $key => $value)
        {
        ?>    
            <div class="col-sm-3 col-xs-6 checkbox">                
                <label>
                    <input type="checkbox" class="opciones_extras ace" name="opcion_extra_<?php echo $key; ?>" <?php if (in_array($key, $opciones_extras_seleccionadas)) echo 'checked="checked"'; ?> data-id="<?php echo $key; ?>" >
                    <span class="lbl">&nbsp;&nbsp;<?php echo $value; ?></span>
                </label>
            </div>
    <?php 
        }
    }
    ?>
</div>
<!-- inline scripts related to this page -->
<script type="text/javascript">   
    jQuery(function ($) {
        
        $('.opciones_extras').on('change', function () {
            var id = $(this).data("id");
            if ($(this).is(':checked'))
            {
                var marcar = 1;
            }
            else
            {
                var marcar = 0;
            }
            $.ajax({
                url: '<?php echo site_url(); ?>/demandas/marcar_opcion_extra/<?php echo $element->id; ?>/' + id + '/' + marcar,
                success: function (e) {
                    if (e != 1) {
                        alert(e);
                    }
                }
            });
        });
        
    })
</script>
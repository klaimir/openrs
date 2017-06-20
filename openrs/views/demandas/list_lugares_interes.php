<div class="space-10"></div>

<div class="row">
    <?php 
    if($lugares_interes)
    {
        foreach ($lugares_interes as $key => $value)
        {
        ?>    
            <div class="col-sm-3 col-xs-6 checkbox">                
                <label>
                    <input type="checkbox" class="lugares_interes ace" name="lugar_interes_<?php echo $key; ?>" <?php if (in_array($key, $lugares_interes_seleccionados)) echo 'checked="checked"'; ?> data-id="<?php echo $key; ?>" >
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
        
        $('.lugares_interes').on('change', function () {
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
                url: '<?php echo site_url(); ?>/demandas/marcar_lugar_interes/<?php echo $element->id; ?>/' + id + '/' + marcar,
                success: function (e) {
                    if (e != 1) {
                        alert(e);
                    }
                }
            });
        });
        
    })
</script>
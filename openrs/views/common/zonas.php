<select id="zona_id" name="zona_id" class="chosen-select form-control">
    <option <?php echo set_select('zona_id', ''); ?> value="">- Seleccione zona -</option>
    <?php
    foreach ($zonas as $zona)
    {
        if($zona_seleccionada==$zona->id)
            $default_zona=TRUE;
        else
            $default_zona=FALSE;
    ?>                                
        <option <?php echo set_select('zona_id', $zona->id, $default_zona); ?> value="<?php echo $zona->id; ?>"><?php echo $zona->nombre; ?></option>
    <?php
    }
    ?>
</select>

<script type="text/javascript">
if(!ace.vars['touch']) {
    $('#zona_id').chosen({allow_single_deselect:true}); 
    //resize the chosen on window resize

    $(window)
    .on('resize.chosen', function() {
            $('#zona_id').each(function() {
                     var $this = $(this);
                     $this.next().css({'width': $this.parent().width()});
            })
    }).trigger('resize.chosen');
}
</script>
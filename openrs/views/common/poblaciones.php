<select id="poblacion_id" name="poblacion_id" class="chosen-select form-control">
    <option <?php echo set_select('poblacion_id', ''); ?> value="">- Seleccione población -</option>
    <?php
    foreach ($poblaciones as $poblacion)
    {
        if($poblacion_seleccionada==$poblacion->id)
            $default_poblacion=TRUE;
        else
            $default_poblacion=FALSE;
    ?>                                
        <option <?php echo set_select('poblacion_id', $poblacion->id, $default_poblacion); ?> value="<?php echo $poblacion->id; ?>"><?php echo $poblacion->poblacion; ?></option>
    <?php
    }
    ?>
</select>

<script type="text/javascript">
if(!ace.vars['touch']) {
    $('#poblacion_id').chosen({allow_single_deselect:true}); 
    //resize the chosen on window resize

    $(window)
    .on('resize.chosen', function() {
            $('#poblacion_id').each(function() {
                     var $this = $(this);
                     $this.next().css({'width': $this.parent().width()});
            })
    }).trigger('resize.chosen');
}
</script>
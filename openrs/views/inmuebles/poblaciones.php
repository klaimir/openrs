<select id="poblacion_id" name="poblacion_id" class="form-control" onchange="show_zonas();" >
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

function show_zonas() {
    var poblacion_id = $('#poblacion_id').val();
    $('#zonas').load('<?php echo site_url("inmuebles/load_zonas");?>/'+poblacion_id);
}
</script>
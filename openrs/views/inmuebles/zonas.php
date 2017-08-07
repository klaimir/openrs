<select id="zona_id" name="zona_id" class="form-control">
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
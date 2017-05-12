<div class="form-group">     
    <input type="hidden" name="id" id="id" value="<?php echo $usuario_id; ?>" />        
    
    <?php if(count($idiomas)==0) { ?>
        <div class="alert alert-danger">
            <strong>Actualmente no existen idiomas que se puedan asignar al usuario</strong>
        </div>
    <?php } else { ?>
        <div class="row">
            <label class="col-sm-3 control-label no-padding-right">Idioma actual</label>
            <div class="col-sm-9">           
                <select id="id_idioma" name="id_idioma">
                    <?php
                    foreach ($idiomas as $idioma) {
                        if ($idioma->id_idioma == $id_idioma) {
                            $selected='selected';
                        } else { 
                            $selected='';
                        }
                        ?>
                        <option <?php echo $selected; ?> value="<?php echo $idioma->id_idioma; ?>"><?php echo $idioma->nombre; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
    <?php } ?>
</div>
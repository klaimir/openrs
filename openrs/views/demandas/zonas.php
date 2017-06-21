<?php
if($zonas)
{
?>
<select id="zonas_id" name="zonas_id[]" class="form-control" multiple="multiple">
    <?php
    foreach ($zonas as $zona)
    {
    ?>                                
        <option value="<?php echo $zona->id; ?>"><?php echo $zona->nombre; ?></option>
    <?php
    }
    ?>
</select>
<?php
}
else
{
?>
<p class="form-control"><i class="ace-icon fa fa-info-circle"></i> Actualmente no existen zonas registradas para la población seleccionada</p>
<?php
}
?>

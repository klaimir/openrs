<div class="space-2"></div>
<small class="text-info block">Estas son las marcas que puedes usar con el tipo de plantilla seleccionado:</small>
<div class="space-2"></div>
<?php
foreach($categorias as $categoria)
{
    ?>    
    <small class="col-sm-4"><strong>Datos <?php echo $categoria->nombre; ?>:</strong> 
        <ul>
            <?php foreach ($categoria->marcas as $marca) { ?>
                <li>%<?php echo $categoria->referencia.".".$marca->referencia; ?>%: <?php echo $marca->descripcion; ?></li>
            <?php } ?>
        </ul>
    </small>
    <?php
}

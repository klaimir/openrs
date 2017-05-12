<div class="error-container">
    <div class="well">
        <h1 class="grey lighter smaller">
            <span class="blue bigger-125">
                <i class="icon-random"></i>
                Error de acceso: 
            </span>
            No se puede realizar la acción
        </h1>
        <?php $this->load->view('common/message',$this->data); ?> 
        <?php /*
        <hr />
        <h3 class="lighter smaller">
            Estamos trabajando
            <i class="icon-wrench icon-animated-wrench bigger-125"></i>
            para resolverlo
        </h3>

        <div class="space"></div>

        
        <div>
            <h4 class="lighter smaller">Mientras tanto, puedes:</h4>

            <ul class="unstyled spaced  bigger-110">
                <li>
                    <i class="icon-hand-right blue"></i>
                    Leer la ayuda
                </li>

                <li>
                    <i class="icon-hand-right blue"></i>
                    Escribir una incidencia d&aacute;ndonos m&aacute;s informaci&oacute;n
                </li>
            </ul>
        </div>
         * 
         */
        ?>
        <hr />
        <div class="space"></div>        
         
        <div class="row-fluid">
            <div class="center">																					
                <?php echo anchor('usuarios/index','<span class="btn btn-primary btn-small"><i class="icon-home"></i> Inicio </span>');?>                
                <a href="<?php echo $this->utilities->enlace_anterior(); ?>"><span class="btn btn-small"><i class="icon-arrow-left"></i> Volver </span></a>                
            </div>
        </div>
    </div>
</div>
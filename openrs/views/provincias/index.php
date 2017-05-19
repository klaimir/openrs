<div class="page-header">
    <div class="row">
        <div class="col-xs-12">
            <h1>
                Provincias
            </h1>
        </div>
    </div>
</div>

<?php $this->load->view('common/message', $this->data); ?>

<div class="row">
    <div class="col-xs-12">
        <table class="table table-striped table-bordered table-hover" id="tabgrid">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Activar</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($provincias as $provincia)
                {
                ?>
                <tr>
                    <td>            
                        <?php 
                        if($provincia->activa) 
                        {
                        ?>
                            <a class="green" href="<?php echo site_url("poblaciones/index/" . $provincia->id); ?>" title="Ver poblaciones de <?php echo $provincia->provincia; ?>"><?php echo $provincia->provincia; ?></a>
                        <?php
                        } 
                        else 
                        { 
                            echo $provincia->provincia;
                        }
                        ?>
                    </td>
                    <td>
                        <input type="checkbox" class="activar" name="provincia_<?php echo $provincia->id; ?>" <?php if($provincia->activa) echo 'checked="checked"'; ?> data-id="<?php echo $provincia->id; ?>">
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function ($) {

        $('.activar').on('change', function() {
            var id = $(this).data("id");  
            if($(this).is(':checked'))
            {
                var validar=1;
            }
            else
            {
                var validar=0;
            }            
            $.ajax({
                url: '<?php echo site_url(); ?>/provincias/activar/' + id + '/' + validar,
                success: function(e) {
                    if (e == 1) {
                        if(validar == 1)
                        {
                            window.location = '<?php echo site_url('poblaciones/index/'); ?>' + id;
                        }
                    } else {
                        alert(e);
                    }
                }
            });
        });
    })
</script>
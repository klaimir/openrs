<div class="page-header">
    <div class="row">
        <div class="col-xs-12">
            <h1>
                <?php echo lang('index_heading'); ?>
            </h1>
        </div>
    </div>
</div>

<?php $this->load->view('common/message', $this->data); ?>

<div class="row">
    <div class="col-xs-12">
        <a class="btn btn-info pull-right" href="<?php echo site_url('auth/create_user'); ?>">
            <i class="menu-icon fa fa-plus-circle"></i>
            <span class="menu-text"><?php echo lang('index_create_user_link'); ?></span>
        </a>
    </div>
</div>

<?php /*<p><?php echo lang('index_subheading');?></p>*/ ?>

<div class="space-10"></div>

<div class="row">
    <div class="col-xs-12" style="overflow-y:auto">
        <table class="table table-striped table-bordered table-hover" id="tabgrid">
            <thead>
                <tr>
                    <th><?php echo lang('index_fname_th');?></th>
                    <th><?php echo lang('index_lname_th');?></th>
                    <th><?php echo lang('index_email_th');?></th>
                    <th><?php echo lang('index_groups_th');?></th>
                    <th><?php echo lang('index_status_th');?></th>
                    <?php if(ENVIRONMENT=='development') { ?>
                        <th>Idioma</th>
                    <?php } ?>
                    <th><?php echo lang('index_action_th');?></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($users as $user):?>
                <tr>
                    <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
                    <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
                    <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
                    <td>
                        <?php foreach ($user->groups as $group):?>
                            <?php echo htmlspecialchars($group->name,ENT_QUOTES,'UTF-8'); //anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
                        <?php endforeach?>
                    </td>
                    <td><span class="label label-sm"><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></span></td>
                    <?php if(ENVIRONMENT=='development') { ?>
                        <td>
                            <button type="button" class="btn btn-mini btn-info idioma" data-toggle="modal" data-id="<?php echo $user->id;?>" data-target="#cambiar_idioma">
                                Cambiar idioma
                            </button>
                        </td>
                    <?php } ?>
                    <td>
                        <div class="hidden-sm hidden-xs action-buttons">
                            <a class="green" href="<?php echo site_url("auth/edit_user/".$user->id) ;?>" title="Editar">
                                <i class="ace-icon fa fa-pencil bigger-130"></i>
                            </a>

                            <a class="red borrar-usuario" data-id="<?php echo $user->id; ?>" href="#" title="Borrar">
                                <i class="ace-icon fa fa-trash-o bigger-130"></i>
                            </a>
                        </div>

                        <div class="hidden-md hidden-lg">
                            <div class="inline pos-rel">
                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                    <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                    <li>
                                        <a href="<?php echo site_url("auth/edit_user/".$user->id) ;?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                            <span class="green">
                                                <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                            </span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" class="tooltip-error borrar-usuario" data-id="<?php echo $user->id; ?>" data-rel="tooltip" title="Delete">
                                            <span class="red">
                                                <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>                    
                    </td>
                </tr>
                <?php endforeach;?>            
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="cambiar_idioma" tabindex="-1" role="dialog" aria-labelledby="myModalLabelIdioma" data-url="<?php echo site_url('usuarios/cambiar_idioma'); ?>">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabelIdioma">Cambiar idioma</h4>
      </div>
      <div class="modal-body" id="modal-body-idioma">
      </div>        
      <div class="modal-footer">
        <button class="btn btn-small" data-dismiss="modal">
            <i class="icon-remove"></i>
            Cancelar
        </button>

        <button class="btn btn-small btn-primary">
            <i class="icon-ok"></i>
            Aplicar
        </button>
      </div>
    </div>
  </div>
</div>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function ($) {
        
        $('.idioma').on('click', function(e){
            var id = $(this).data('id');
            $('#modal-body-idioma').load('<?php echo site_url("usuarios/cargar_idioma"); ?>/' + id);
        });
        
        $('#cambiar_idioma .btn-primary').on('click', function () {
            var modal=$(this).parents('#cambiar_idioma');
            var posturl=$(modal).data('url');
            var datastring=$(modal).find('input,select').serialize();
            $.ajax({
                type: 'POST',
                data: datastring,
                url: posturl,
                success: function(data) {
                    if (data==1) {   
                        window.location = '<?php echo site_url('auth'); ?>';
                    } else {
                        alert(data);
                    }
                }
            });
        });
        
        $('.borrar-usuario').click(function () {
            var id = $(this).data("id");
            bootbox.confirm("¿Estás seguro/a?", function (result) {
                if (result) {
                    window.location = '<?php echo site_url(); ?>/usuarios/delete_user/' + id;
                }
            });
        });

    })
</script>
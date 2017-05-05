<div class="page-header">
    <h1>
        <?php echo lang('index_heading'); ?>
    </h1>
</div>

<p><?php echo lang('index_subheading');?></p>

<?php $this->load->view('common/message', $this->data); ?> 

<p><?php echo anchor('auth/create_user', lang('index_create_user_link'))?></p>

<div class="clearfix">
    <div class="pull-right tableTools-container"></div>
</div>
<div class="table-header">
    Results for "Latest Registered Domains"
</div>

<!-- div.table-responsive -->

<!-- div.dataTables_borderWrap -->
<div>
    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>
                    <label class="pos-rel">
                        <input type="checkbox" class="ace" />
                        <span class="lbl"></span>
                    </label>
                </th>
                <th><?php echo lang('index_fname_th');?></th>
                <th><?php echo lang('index_lname_th');?></th>
                <th><?php echo lang('index_email_th');?></th>
                <th><?php echo lang('index_groups_th');?></th>
                <th><?php echo lang('index_status_th');?></th>
                <th>Idioma</th>
                <th><?php echo lang('index_action_th');?></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($users as $user):?>
            <tr>
                <td>
                    <label class="pos-rel">
                        <input type="checkbox" class="ace" />
                        <span class="lbl"></span>
                    </label>
                </td>
                <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
                <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
                <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
                <td>
                    <?php foreach ($user->groups as $group):?>
                        <?php echo htmlspecialchars($group->name,ENT_QUOTES,'UTF-8'); //anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
                    <?php endforeach?>
                </td>
                <td><span class="label label-sm"><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></span></td>
                <td>
                    <button type="button" class="btn btn-mini btn-info idioma" data-toggle="modal" data-id="<?php echo $user->id;?>" data-target="#cambiar_idioma">
                        Cambiar idioma
                    </button>
                </td>
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
        
        //initiate dataTables plugin
        var oTable1 =
                $('#dynamic-table')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .dataTable({
                    bAutoWidth: false,
                    "aoColumns": [
                        {"bSortable": false},
                        null, null, null, null, null, null,
                        {"bSortable": false}
                    ],
                    "aaSorting": [],
                    //,
                    //"sScrollY": "200px",
                    //"bPaginate": false,
                    //"sScrollX": "100%",
                    //"sScrollXInner": "120%",
                    //"bScrollCollapse": true,
                    //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
                    //you may want to wrap the table inside a "div.dataTables_borderWrap" element
                    //"iDisplayLength": 50
                });
        //oTable1.fnAdjustColumnSizing();

        //TableTools settings
        TableTools.classes.container = "btn-group btn-overlap";
        TableTools.classes.print = {
            "body": "DTTT_Print",
            "info": "tableTools-alert gritter-item-wrapper gritter-info gritter-center white",
            "message": "tableTools-print-navbar"
        }

        //initiate TableTools extension
        var tableTools_obj = new $.fn.dataTable.TableTools(oTable1, {
            "sSwfPath": "<?php echo base_url(); ?>assets/admin/swf/copy_csv_xls_pdf.swf",
            "sRowSelector": "td:not(:last-child)",
            "sRowSelect": "multi",
            "fnRowSelected": function (row) {
                //check checkbox when row is selected
                try {
                    $(row).find('input[type=checkbox]').get(0).checked = true;
                }
                catch (e) {
                }
            },
            "fnRowDeselected": function (row) {
                //uncheck checkbox
                try {
                    $(row).find('input[type=checkbox]').get(0).checked = false;
                }
                catch (e) {
                }
            },
            "sSelectedClass": "success",
            "aButtons": [
                {
                    "sExtends": "copy",
                    "sToolTip": "Copy to clipboard",
                    "sButtonClass": "btn btn-white btn-primary btn-bold",
                    "sButtonText": "<i class='fa fa-copy bigger-110 pink'></i>",
                    "fnComplete": function () {
                        this.fnInfo('<h3 class="no-margin-top smaller">Table copied</h3>\
                                                        <p>Copied ' + (oTable1.fnSettings().fnRecordsTotal()) + ' row(s) to the clipboard.</p>',
                                1500
                                );
                    }
                },
                {
                    "sExtends": "csv",
                    "sToolTip": "Export to CSV",
                    "sButtonClass": "btn btn-white btn-primary  btn-bold",
                    "sButtonText": "<i class='fa fa-file-excel-o bigger-110 green'></i>"
                },
                {
                    "sExtends": "pdf",
                    "sToolTip": "Export to PDF",
                    "sButtonClass": "btn btn-white btn-primary  btn-bold",
                    "sButtonText": "<i class='fa fa-file-pdf-o bigger-110 red'></i>"
                },
                {
                    "sExtends": "print",
                    "sToolTip": "Print view",
                    "sButtonClass": "btn btn-white btn-primary  btn-bold",
                    "sButtonText": "<i class='fa fa-print bigger-110 grey'></i>",
                    "sMessage": "<div class='navbar navbar-default'><div class='navbar-header pull-left'><a class='navbar-brand' href='#'><small>Optional Navbar &amp; Text</small></a></div></div>",
                    "sInfo": "<h3 class='no-margin-top'>Print view</h3>\
                                                          <p>Please use your browser's print function to\
                                                          print this table.\
                                                          <br />Press <b>escape</b> when finished.</p>",
                }
            ]
        });
        //we put a container before our table and append TableTools element to it
        $(tableTools_obj.fnContainer()).appendTo($('.tableTools-container'));

        //also add tooltips to table tools buttons
        //addding tooltips directly to "A" buttons results in buttons disappearing (weired! don't know why!)
        //so we add tooltips to the "DIV" child after it becomes inserted
        //flash objects inside table tools buttons are inserted with some delay (100ms) (for some reason)
        setTimeout(function () {
            $(tableTools_obj.fnContainer()).find('a.DTTT_button').each(function () {
                var div = $(this).find('> div');
                if (div.length > 0)
                    div.tooltip({container: 'body'});
                else
                    $(this).tooltip({container: 'body'});
            });
        }, 200);

        //ColVis extension
        var colvis = new $.fn.dataTable.ColVis(oTable1, {
            "buttonText": "<i class='fa fa-search'></i>",
            "aiExclude": [0, 6],
            "bShowAll": true,
            //"bRestore": true,
            "sAlign": "right",
            "fnLabel": function (i, title, th) {
                return $(th).text();//remove icons, etc
            }

        });

        //style it
        $(colvis.button()).addClass('btn-group').find('button').addClass('btn btn-white btn-info btn-bold');

        //and append it to our table tools btn-group, also add tooltip
        $(colvis.button())
                .prependTo('.tableTools-container .btn-group')
                .attr('title', 'Show/hide columns').tooltip({container: 'body'});

        //and make the list, buttons and checkboxed Ace-like
        $(colvis.dom.collection)
                .addClass('dropdown-menu dropdown-light dropdown-caret dropdown-caret-right')
                .find('li').wrapInner('<a href="javascript:void(0)" />') //'A' tag is required for better styling
                .find('input[type=checkbox]').addClass('ace').next().addClass('lbl padding-8');


        /////////////////////////////////
        //table checkboxes
        $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);

        //select/deselect all rows according to table header checkbox
        $('#dynamic-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function () {
            var th_checked = this.checked;//checkbox inside "TH" table header

            $(this).closest('table').find('tbody > tr').each(function () {
                var row = this;
                if (th_checked)
                    tableTools_obj.fnSelect(row);
                else
                    tableTools_obj.fnDeselect(row);
            });
        });

        //select/deselect a row when the checkbox is checked/unchecked
        $('#dynamic-table').on('click', 'td input[type=checkbox]', function () {
            var row = $(this).closest('tr').get(0);
            if (!this.checked)
                tableTools_obj.fnSelect(row);
            else
                tableTools_obj.fnDeselect($(this).closest('tr').get(0));
        });

        $(document).on('click', '#dynamic-table .dropdown-toggle', function (e) {
            e.stopImmediatePropagation();
            e.stopPropagation();
            e.preventDefault();
        });

    })
</script>
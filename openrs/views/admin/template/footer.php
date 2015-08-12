
</div>
<!--/.span-->
</div>
<!--/.row-fluid-->
</div>
<!--/.page-content-->


</div>
<!--/.main-content-->
</div>
<!--/.main-container-->



<!--basic scripts-->
<script type="text/javascript">
    
    function muestra_oculta(id){
        if (document.getElementById){ //se obtiene el id
        var el = document.getElementById(id); //se define la variable "el" igual a nuestro div
        el.style.display = (el.style.display == 'none') ? 'block' : 'none'; //damos un atributo display:none que oculta el div
        }
    }
    
    function showCategoriasLicencias() {
        var temporada=$('#temporada_buscador').val();
        $('#categorias_licencia').load('<?php echo site_url("licencias/cargarcategoriasbuscador"); ?>/' + temporada);
    }

    function showClases() {
        var idespecialidad=$('#especialidad_buscador').val();
        var temporada=$('#temporada_buscador').val();
        $('#idclase').load('<?php echo site_url("clases/cargar"); ?>/' + idespecialidad + '/' + temporada);
    }
    
    function trim(str)
    {
        str = str.replace(/^\s+/, '');
        for (var i = str.length - 1; i >= 0; i--) {
            if (/\S/.test(str.charAt(i))) {
                str = str.substring(0, i + 1);
                break;
            }
        }
        return str;
    }

    function dateHeight(dateStr) {
        if (trim(dateStr) != '') {
            var frDate = trim(dateStr).split(' ');
            if (frDate.length > 1)
                var frTime = frDate[1].split(':');
            else
                var frTime = "00:00:00".split(':');
            var frDateParts = frDate[0].split('/');
            var day = frDateParts[0] * 60 * 24;
            var month = frDateParts[1] * 60 * 24 * 31;
            var year = frDateParts[2] * 60 * 24 * 366;
            var hour = frTime[0] * 60;
            var minutes = frTime[1];
            var x = day + month + year + hour + minutes;
        } else {
            var x = 99999999999999999; //GoHorse!
        }
        return x;
    }

    if ("ontouchend" in document)
        document.write("<script src='<?php echo base_url();?>assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");

    $(function () {

        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });

        $('.toggleinput').inputtoggle();
        $('.toggleinputpago').inputtogglepago();
        $('.editinputinline').editinputinline();


        jQuery.fn.dataTableExt.oSort['date-euro-asc'] = function (a, b) {
            var x = dateHeight(a);
            var y = dateHeight(b);
            var z = ((x < y) ? -1 : ((x > y) ? 1 : 0));
            return z;
        };

        jQuery.fn.dataTableExt.oSort['date-euro-desc'] = function (a, b) {
            var x = dateHeight(a);
            var y = dateHeight(b);
            var z = ((x < y) ? 1 : ((x > y) ? -1 : 0));
            return z;
        };

        // Notificaciones        

        $('#blistanotificacionespendientes').click(function () {
            window.location = '<?php echo site_url(); ?>/notificaciones/index/0';
        });

        $('#blistanotificacioneshistorico').click(function () {
            window.location = '<?php echo site_url(); ?>/notificaciones/index/1';
        });

        // Usuarios

        $('#blistausuariosadmin').click(function () {
            window.location = '<?php echo site_url(); ?>/usuarios/listausuarios/admin';
        });

        $('#blistausuariosresto').click(function () {
            window.location = '<?php echo site_url(); ?>/usuarios/listausuarios/resto';
        });

        $('#blistausuariostodos').click(function () {
            window.location = '<?php echo site_url(); ?>/usuarios/listausuarios/todos';
        });

        $('#bvolverusuario').click(function (e) {
            e.preventDefault();
            window.location = '<?php echo site_url(); ?>/usuarios/listausuarios';
        });

        $('#bvolverusuariocuenta').click(function (e) {
            e.preventDefault();
            window.location = '<?php echo site_url(); ?>/usuarios/index';
        });

        $('#insertarusuarioweb').click(function () {
            window.location = '<?php echo site_url(); ?>/usuarios/insertar/members';
        });

        $('#insertarusuarioadmin').click(function () {
            window.location = '<?php echo site_url(); ?>/usuarios/insertar/admin';
        });

        $('#insertardelegacion').click(function () {
            window.location = '<?php echo site_url(); ?>/usuarios/insertar/delegacion';
        });

        $('#insertarusuariosuperadmin').click(function () {
            window.location = '<?php echo site_url(); ?>/usuarios/insertar/superadmin';
        });

        $('.editarusuario').click(function () {
            window.location = '<?php echo site_url(); ?>/usuarios/editar/' + $(this).data("id");
        });

        $('.bvalidaradjuntousuario').click(function () {
            var id = $(this).data("id");
            bootbox.confirm("¿Estás seguro/a?", function (result) {
                if (result) {
                    window.location = '<?php echo site_url(); ?>/usuarios/validaradjunto/' + id;
                }
            });
        });

        $('.beliminaradjuntousuario').click(function () {
            var id = $(this).data("id");
            bootbox.confirm("¿Estás seguro/a?", function (result) {
                if (result) {
                    window.location = '<?php echo site_url(); ?>/usuarios/borraradjunto/' + id;
                }
            });
        });

        $('.borrarusuario').click(function () {
            var id = $(this).data("id");
            bootbox.confirm("¿Estás seguro/a?", function (result) {
                if (result) {
                    window.location = '<?php echo site_url(); ?>/usuarios/borrar/' + id;
                }
            });
        });

        // Documentos
        $('#fichero').ace_file_input({
            no_file: 'Sin fichero ...',
            btn_choose: 'Seleccionar',
            btn_change: 'Cambiar',
            droppable: false,
            onchange: null,
            thumbnail: false
                    //	whitelist:'gif|png|jpg|jpeg|pdf|doc|docx',
                    //	blacklist:'exe|php'
        });

        $('#bvolverrevisardocumento').click(function (e) {
            e.preventDefault();
            window.location = '<?php echo site_url(); ?>/usuarios/editar/' + $(this).data("id");
        });

        $('#bnorevisardocumento').click(function (e) {
            e.preventDefault();
            window.location = '<?php echo site_url(); ?>/usuarios/editar/' + $(this).data("id");
        });

        $('#bvolverdocumento').click(function (e) {
            e.preventDefault();
            window.location = '<?php echo site_url(); ?>/documentos/index';
        });

        $('#insertardocumento').click(function () {
            window.location = '<?php echo site_url(); ?>/documentos/insertar';
        });

        $('.editardocumento').click(function () {
            window.location = '<?php echo site_url(); ?>/documentos/editar/' + $(this).data("id");
        });

        $('.bvalidardocumento').click(function () {
            var id = $(this).data("id");
            bootbox.confirm("¿Estás seguro/a?", function (result) {
                if (result) {
                    window.location = '<?php echo site_url(); ?>/documentos/validar/' + id;
                }
            });
        });

        $('.borrardocumento').click(function () {
            var id = $(this).data("id");
            bootbox.confirm("¿Estás seguro/a?", function (result) {
                if (result) {
                    window.location = '<?php echo site_url(); ?>/documentos/borrar/' + id;
                }
            });
        });

        // Equipos
        $('#anexo , #contrato, #justificante').ace_file_input({
            no_file: 'Sin fichero ...',
            btn_choose: 'Seleccionar',
            btn_change: 'Cambiar',
            droppable: false,
            onchange: null,
            thumbnail: false
                    //	whitelist:'gif|png|jpg|jpeg|pdf|doc|docx',
                    //	blacklist:'exe|php'
        });
        $('#nuevoequipo').click(function () {
            window.location = 'nuevoequipo';
        });

        $('#nuevoautorizado').click(function () {
            window.location = '<?php echo site_url(); ?>/federados/nuevofederado';
        });

        $('.editarequipo').click(function () {
            window.location = 'editarequipo/' + $(this).data("id");
        });

        $('.autorizarfederado').click(function () {
            window.location = '<?php echo site_url(); ?>/federados/autorizar/' + $(this).data("id");
        });

        $('#bvolvernuevacarrera').click(function (e) {
            e.preventDefault();
            window.location = '<?php echo site_url(); ?>/carreras/listacarreras';
        });

        $('#bvolverdatosprueba').click(function (e) {
            e.preventDefault();
            window.location = '<?php echo site_url(); ?>/carreras/editarcarrera/' + $(this).data("id");
        });

        $('#bvolversolicitudprueba').click(function (e) {
            e.preventDefault();
            window.location = '<?php echo site_url(); ?>/carreras/editarcarrera/' + $(this).data("id");
        });

        $('#bvolvereditarreglamentopaso1').click(function (e) {
            e.preventDefault();
            window.location = '<?php echo site_url(); ?>/carreras/editarcarrera/' + $(this).data("id");
        });

        $('#bvolvereditarreglamentopaso2').click(function (e) {
            e.preventDefault();
            window.location = '<?php echo site_url(); ?>/carreras/editarcarrera/' + $(this).data("id");
        });

        $('#banterioreditarreglamentopaso2').click(function (e) {
            e.preventDefault();
            window.location = '<?php echo site_url(); ?>/carreras/editarreglamentopruebapaso1/' + $(this).data("id");
        });

        $('#bvolvereditarreglamentopaso3').click(function (e) {
            e.preventDefault();
            window.location = '<?php echo site_url(); ?>/carreras/editarcarrera/' + $(this).data("id");
        });

        $('#banterioreditarreglamentopaso3').click(function (e) {
            e.preventDefault();
            window.location = '<?php echo site_url(); ?>/carreras/editarreglamentopruebapaso2/' + $(this).data("id");
        });

        $('#nuevacarreranacional').click(function () {
            window.location = '<?php echo site_url(); ?>/carreras/nuevacarrera/nacional';
        });

        $('#nuevacarreraautonomica').click(function () {
            window.location = '<?php echo site_url(); ?>/carreras/nuevacarrera/autonomica';
        });

        $('.editarcarrera').click(function (e) {
            e.preventDefault();
            window.location = '<?php echo site_url(); ?>/carreras/editarcarrera/' + $(this).data("id");
        });

        $('.borrarcarrera').click(function (e) {
            e.preventDefault();
            var id = $(this).data("id");
            bootbox.confirm("¿Estás seguro/a?", function (result) {
                if (result) {
                    window.location = '<?php echo site_url(); ?>/carreras/borrarcarrera/' + id;
                }
            });
        });

        // Documentos Prueba

        $('#bvolverdocumentocarrera').click(function (e) {
            e.preventDefault();
            window.location = '<?php echo site_url(); ?>/carreras/documentos/' + $(this).data("id");
        });

        $('#documentoscarrera').click(function () {
            window.location = '<?php echo site_url(); ?>/carreras/documentos/' + $(this).data("id");
        });

        $('#insertardocumentocarrera').click(function () {
            window.location = '<?php echo site_url(); ?>/carreras/insertardoc/' + $(this).data("id");
        });

        $('.editardocumentocarrera').click(function () {
            window.location = '<?php echo site_url(); ?>/carreras/editardoc/' + $(this).data("id");
        });

        $('.validardocumentocarrera').click(function () {
            var id = $(this).data("id");
            bootbox.confirm("¿Estás seguro/a?", function (result) {
                if (result) {
                    window.location = '<?php echo site_url(); ?>/carreras/validardoc/' + id;
                }
            });
        });

        $('.borrardocumentocarrera').click(function () {
            var id = $(this).data("id");
            bootbox.confirm("¿Estás seguro/a?", function (result) {
                if (result) {
                    window.location = '<?php echo site_url(); ?>/carreras/borrardoc/' + id;
                }
            });
        });

        $('.publicardocumentocarrera').click(function () {
            var id = $(this).data("id");
            bootbox.confirm("¿Estás seguro/a?", function (result) {
                if (result) {
                    $.ajax({
                        url: '<?php echo site_url(); ?>/carreras/publicardoc/' + id,
                            success: function(e) {
                                if(e == '3'){
                                    alert("Error al cargar el registro");
                                }
                            }
                    });
                }else{ 
                    if($('#publicardocumentocarrera_'+id).is(':checked')){
                        $("#publicardocumentocarrera_"+id).prop("checked", "");
                    }
                    else{
                        $("#publicardocumentocarrera_"+id).prop("checked", "checked");
                    }
                }
            });
        });
        
        $('.soloarbitrosdocumentocarrera').click(function () {
            var id = $(this).data("id");
            $.ajax({
                url: '<?php echo site_url(); ?>/carreras/soloarbitrosdoc/' + id,
                    success: function(e) {
                        if(e == '3'){
                            alert("Error al cargar el registro");
                        }
                    }
            });
        });
        
        $('.solodelegaciondocumentocarrera').click(function () {
            var id = $(this).data("id");
            $.ajax({
                url: '<?php echo site_url(); ?>/carreras/solodelegaciondoc/' + id,
                    success: function(e) {
                        if(e == '3'){
                            alert("Error al cargar el registro");
                        }
                    }
            });
        });
        
        $('.soloclubesdocumentocarrera').click(function () {
            var id = $(this).data("id");
            $.ajax({
                url: '<?php echo site_url(); ?>/carreras/soloclubesdoc/' + id,
                    success: function(e) {
                        if(e == '3'){
                            alert("Error al cargar el registro");
                        }
                    }
            });
        });

        // Carga de documentos
<?php
if (isset($idusuario) && isset($idlicencia)) {
    ?>
            $('#idtipodoc').change(function () {
                $('#documento').load('<?php echo site_url(); ?>/documentos/cargar_disponibles/' + <?php echo $idusuario; ?> + '/' + $('#idtipodoc').val() + '/<?php echo $idlicencia; ?>');
            });
    <?php
}
?>

        // Carga de poblaciones

        $('#idprovincia').change(function () {
            $('#poblacion').load('<?php echo site_url(); ?>/poblaciones/cargar/' + $('#idprovincia').val());
        });

<?php
if (isset($poblacion_seleccionada) && $poblacion_seleccionada != '') {
    ?>
            $('#poblacion').load('<?php echo site_url(); ?>/poblaciones/cargar/' + $('#idprovincia').val() + '/' + <?php echo $poblacion_seleccionada; ?>);
    <?php
} else if (!isset($idpoblacion)) {
    ?>
            $('#poblacion').load('<?php echo site_url(); ?>/poblaciones/cargar/' + $('#idprovincia').val());

<?php } ?>
        
    // Carga de clases
    $('#idespecialidad').change(function () {
        var idespecialidad=$('#idespecialidad').val();
        var temporada=$('#temporadaprueba').val();
        $('#idclase').load('<?php echo site_url("clases/cargar"); ?>/' + idespecialidad + '/' + temporada);
    });
    
    $('#temporadaprueba').change(function () {
        var idespecialidad=$('#idespecialidad').val();
        var temporada=$('#temporadaprueba').val();
        $('#idclase').load('<?php echo site_url("clases/cargar"); ?>/' + idespecialidad + '/' + temporada);
    });

    <?php
    if (isset($clase_seleccionada) && $clase_seleccionada != '') {
    ?>
        $('#idclase').load('<?php echo site_url(); ?>/clases/cargar/<?php echo $especialidad_seleccionada; ?>'+ '/' +<?php echo $temporada; ?> + '/' + <?php echo $clase_seleccionada; ?>);
    <?php
    } else {
        if (isset($especialidad_seleccionada) && $especialidad_seleccionada != '') {
        ?>
            $('#idclase').load('<?php echo site_url(); ?>/clases/cargar/<?php echo $especialidad_seleccionada; ?>'+ '/' +<?php echo $temporada; ?>);
        <?php
        }
    }
?>

    // Admin
    $('.beditarcat').click(function () {
        window.location = '<?php echo site_url(); ?>/categorias/editarcategoria/' + $(this).data('id');
    });

    $('#bvolvercat').click(function (e) {
        e.preventDefault();
        window.location = '<?php echo site_url(); ?>/categorias/listacategorias';
    });

    $('#bvolverequipos').click(function (e) {
        e.preventDefault();
        window.location = '<?php echo site_url(); ?>/equipos/listaequipos';
    });

    // Licencias
<?php
if ($habilitar_raed) {
?>
        $("#tablelicenciasadmin").dataTable({
            "iDisplayLength": 100,
            "oLanguage": {"sUrl": "<?php echo base_url();?>assets/js/dataTables.spanish.txt"},
            "bStateSave": true,
            "fnStateSave": function (oSettings, oData) {
                localStorage.setItem('DataTables', JSON.stringify(oData));
            },
            "fnStateLoad": function (oSettings) {
                return JSON.parse(localStorage.getItem('DataTables'));
            },
            "aoColumns": [
                null,
                {"sType": "date-euro"},
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                {"sType": "date-euro"},
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null
            ]
        });
        $("#tablelicenciasadmindeleg").dataTable({
            "iDisplayLength": 100,
            "oLanguage": {"sUrl": "<?php echo base_url();?>assets/js/dataTables.spanish.txt"},
            "bStateSave": true,
            "fnStateSave": function (oSettings, oData) {
                localStorage.setItem('DataTables', JSON.stringify(oData));
            },
            "fnStateLoad": function (oSettings) {
                return JSON.parse(localStorage.getItem('DataTables'));
            },
            "aoColumns": [
                {"sType": "date-euro"},
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                {"sType": "date-euro"},
                null,
                null,
                {"sType": "date-euro"},
                null,
                {"sType": "date-euro"},
                null,
                {"sType": "date-euro"},
                null,
                {"sType": "date-euro"},
                null,
                null
            ]
        });
        $("#tablelicenciasadmindeleglista").dataTable({
            "iDisplayLength": 100,
            "oLanguage": {"sUrl": "<?php echo base_url();?>assets/js/dataTables.spanish.txt"},
            "bStateSave": true,
            "fnStateSave": function (oSettings, oData) {
                localStorage.setItem('DataTables', JSON.stringify(oData));
            },
            "fnStateLoad": function (oSettings) {
                return JSON.parse(localStorage.getItem('DataTables'));
            },
            "aoColumns": [
                null,
                {"sType": "date-euro"},
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                {"sType": "date-euro"},
                null,
                null,
                {"sType": "date-euro"},
                null,
                {"sType": "date-euro"},
                null,
                {"sType": "date-euro"},
                null,
                {"sType": "date-euro"},
                null,
                null
            ]
        });
        
        $("#tablelicenciasadmindelegconsulta").dataTable({
            "iDisplayLength": 100,
            "oLanguage": {"sUrl": "<?php echo base_url();?>assets/js/dataTables.spanish.txt"},
            "bStateSave": true,
            "fnStateSave": function (oSettings, oData) {
                localStorage.setItem('DataTables', JSON.stringify(oData));
            },
            "fnStateLoad": function (oSettings) {
                return JSON.parse(localStorage.getItem('DataTables'));
            },
            "aoColumns": [
                {"sType": "date-euro"},
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                {"sType": "date-euro"},
                null,
                null,
                null,
                {"sType": "date-euro"},
                null,
                {"sType": "date-euro"},
                null,
                {"sType": "date-euro"},
                null,
                {"sType": "date-euro"},
                null,
                null
            ]
        });
<?php
} else {
?>
        $("#tablelicenciasadmin").dataTable({
            "iDisplayLength": 100,
            "oLanguage": {"sUrl": "<?php echo base_url();?>assets/js/dataTables.spanish.txt"},
            "bStateSave": true,
            "fnStateSave": function (oSettings, oData) {
                localStorage.setItem('DataTables', JSON.stringify(oData));
            },
            "fnStateLoad": function (oSettings) {
                return JSON.parse(localStorage.getItem('DataTables'));
            },
            "aoColumns": [
                null,
                {"sType": "date-euro"},
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                {"sType": "date-euro"},
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null
            ]
        });
        $("#tablelicenciasadmindeleg").dataTable({
            "iDisplayLength": 100,
            "oLanguage": {"sUrl": "<?php echo base_url();?>assets/js/dataTables.spanish.txt"},
            "bStateSave": true,
            "fnStateSave": function (oSettings, oData) {
                localStorage.setItem('DataTables', JSON.stringify(oData));
            },
            "fnStateLoad": function (oSettings) {
                return JSON.parse(localStorage.getItem('DataTables'));
            },
            "aoColumns": [
                {"sType": "date-euro"},
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                {"sType": "date-euro"},
                null,
                null,
                {"sType": "date-euro"},
                null,
                {"sType": "date-euro"},
                null,
                {"sType": "date-euro"},
                null,
                {"sType": "date-euro"},
                null,
                null
            ]
        });
        $("#tablelicenciasadmindeleglista").dataTable({
            "iDisplayLength": 100,
            "oLanguage": {"sUrl": "<?php echo base_url();?>assets/js/dataTables.spanish.txt"},
            "bStateSave": true,
            "fnStateSave": function (oSettings, oData) {
                localStorage.setItem('DataTables', JSON.stringify(oData));
            },
            "fnStateLoad": function (oSettings) {
                return JSON.parse(localStorage.getItem('DataTables'));
            },
            "aoColumns": [
                {"sType": "date-euro"},
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                {"sType": "date-euro"},
                null,
                null,
                null,
                {"sType": "date-euro"},
                null,
                {"sType": "date-euro"},
                null,
                {"sType": "date-euro"},
                null,
                {"sType": "date-euro"},
                null,
                null
            ]
        });
        $("#tablelicenciasadmindelegconsulta").dataTable({
            "iDisplayLength": 100,
            "oLanguage": {"sUrl": "<?php echo base_url();?>assets/js/dataTables.spanish.txt"},
            "bStateSave": true,
            "fnStateSave": function (oSettings, oData) {
                localStorage.setItem('DataTables', JSON.stringify(oData));
            },
            "fnStateLoad": function (oSettings) {
                return JSON.parse(localStorage.getItem('DataTables'));
            },
            "aoColumns": [
                {"sType": "date-euro"},
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                {"sType": "date-euro"},
                null,
                null,
                null,
                {"sType": "date-euro"},
                null,
                {"sType": "date-euro"},
                null,
                {"sType": "date-euro"},
                null,
                {"sType": "date-euro"},
                null,
                null
            ]
        });
<?php
}
?>


    $('#bsolicitarlicencia').click(function () {
        window.location = '<?php echo site_url(); ?>/licencias/solicitar';
    });

    $('#bsolicitarlicenciaadmin').click(function () {
        window.location = '<?php echo site_url(); ?>/licencias/solicitaradmin';
    });

    $('#blicenciaspendientes').click(function () {
        window.location = '<?php echo site_url(); ?>/licencias/listalicencias/1';
    });

    $('#blicenciastodas').click(function () {
        window.location = '<?php echo site_url(); ?>/licencias/listalicencias/0';
    });

    $('.beditarlicencia').click(function (e) {
        e.preventDefault();
        window.location = '<?php echo site_url(); ?>/licencias/editarlicencia/' + $(this).data("id");
    });

    $('#bvolverlic').click(function (e) {
        e.preventDefault();
        <?php
        // Tipo de acceso
        $enlace_editar_licencia = $this->session->userdata('licencias_editar_enlace');
        // Redirección
        if (trim($enlace_editar_licencia) == "") {
        $enlace_editar_licencia = site_url() . '/licencias/listalicencias';
        }
        ?>
        window.location = '<?php echo $enlace_editar_licencia; ?>';
    });

    $('#bvalidarlicencia').click(function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        window.location = '<?php echo site_url(); ?>/licencias/validar/' + id;
    });

    $('#bpagarlicencia').click(function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        window.location = '<?php echo site_url(); ?>/licencias/pagar/' + id;
    });

    $('#beliminarlicencia').click(function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        bootbox.confirm("¿Estás seguro/a?", function (result) {
            if (result) {
                window.location = '<?php echo site_url(); ?>/licencias/borrar/' + id;
            }
        });
    });

    $('.benviarlicencianavision').click(function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        bootbox.confirm("¿Estás seguro/a?", function (result) {
            if (result) {
                window.location = '<?php echo site_url(); ?>/licencias/enviarnavision/' + id;
            }
        });
    });

    $('.bvalidarlicencia').click(function () {
        var id = $(this).data("id");
        window.location = '<?php echo site_url(); ?>/licencias/validar/' + id;
    });

    $('.bpagarlicencia').click(function () {
        var id = $(this).data("id");
        window.location = '<?php echo site_url(); ?>/licencias/pagar/' + id;

    });

    $('.beliminarlicencia').click(function () {
        var id = $(this).data("id");
        bootbox.confirm("¿Estás seguro/a?", function (result) {
            if (result) {
                window.location = '<?php echo site_url(); ?>/licencias/borrar/' + id;
            }
        });
    });

    $('.benviadacorreolicencia').click(function (e) {
        var id = $(this).data("id");
        window.location = '<?php echo site_url(); ?>/licencias/enviar_correo/' + id;
    });

    $('.benviadasegurolicencia').click(function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        window.location = '<?php echo site_url(); ?>/licencias/enviar_seguro/' + id;
    });

    $('.benviadarfeclicencia').click(function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        window.location = '<?php echo site_url(); ?>/licencias/enviar_rfec/' + id;
    });

    $('.bimpresalicencia').click(function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        window.location = '<?php echo site_url(); ?>/licencias/enviar_impresion/' + id;
    });

    $('#bvolverasociardocumentolicencia').click(function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        window.location = '<?php echo site_url(); ?>/licencias/editarlicencia/' + $(this).data("id");
    });

<?php
if (isset($idlicencia)) {
?>
        $('.bvalidaradjuntolicencia').click(function () {
            var id = $(this).data("id");
            bootbox.confirm("¿Estás seguro/a?", function (result) {
                if (result) {
                    window.location = '<?php echo site_url(); ?>/licencias/validaradjunto/<?php echo $idlicencia; ?>/' + id;
                }
            });
        });

        $('.beliminaradjuntolicencia').click(function () {
            var id = $(this).data("id");
            bootbox.confirm("¿Estás seguro/a?", function (result) {
                if (result) {
                    window.location = '<?php echo site_url(); ?>/licencias/borraradjunto/<?php echo $idlicencia; ?>/' + id;
                }
            });
        });
<?php
}
?>

    $('#idclub').change(function () {
        var cif;
        cif = $('#cif').val();
        if (cif != '')
        {
            $('#equipo').load('<?php echo site_url(); ?>/equipos/cargarpornif/' + $('#idclub').val() + '/' + cif);
        }
    });

<?php
if (isset($cif) && isset($idclub) && isset($tipolicencia)) {
if ($cif != '' && $idclub != '' && ($tipolicencia == 3 || $tipolicencia == 5)) {
if (isset($equipo_seleccionado) && $equipo_seleccionado != '') {
?>
                $('#equipo').load('<?php echo site_url(); ?>/equipos/cargarpornif/<?php echo $idclub; ?>/<?php echo $cif; ?>/<?php echo $equipo_seleccionado; ?>');
<?php
} else {
?>
                        $('#equipo').load('<?php echo site_url(); ?>/equipos/cargarpornif/<?php echo $idclub; ?>/<?php echo $cif; ?>');
<?php
}
}
}
?>

                    // Generales

                    $('.date-picker').datepicker({
                        weekStart: 1,
                        language: "es-ES"
                    }).next().on(ace.click_event, function () {
                        $(this).prev().focus();
                    });

                    $('.date-picker2').datepicker({
                        weekStart: 1,
                        language: "es-ES"
                    }).next().on(ace.click_event, function () {
                        $(this).prev().focus();
                    });

                    $('#timepicker1').timepicker({
                        minuteStep: 1,
                        showMeridian: false
                    });

                    $('#timepicker2').timepicker({
                        minuteStep: 1,
                        showMeridian: false
                    });

                    $('#timepicker3').timepicker({
                        minuteStep: 1,
                        showMeridian: false
                    });

                    $('#timepicker4').timepicker({
                        minuteStep: 1,
                        showMeridian: false
                    });

                    $('#tabgrid').dataTable({
                        "iDisplayLength": 100,
                        "oLanguage": {"sUrl": "<?php echo base_url();?>assets/js/dataTables.spanish.txt"}
                    });

                    $('#tabgrid_equipos').dataTable({
                        "iDisplayLength": 100,
                        "oLanguage": {"sUrl": "<?php echo base_url();?>assets/js/dataTables.spanish.txt"},
                        "aaSorting": []
                    });

                    $('#tabcert').dataTable({
                        "iDisplayLength": 25,
                        "oLanguage": {"sUrl": "<?php echo base_url();?>assets/js/dataTables.spanish.txt"},
                        "aaSorting": [[0,'desc']],
                        "aoColumns": [
                            {"sType": "date-euro"},
                            null,
                            null,
                            null,
                            null,
                            null
                            ]
                    });             
    });
</script>

<!--<script src="<?php echo base_url();?>assets/js/adminevents.js"></script>-->
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootbox.min.js" type="text/javascript"></script>

<!--page specific plugin scripts-->
<script src="<?php echo base_url();?>assets/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-ui-1.10.3.full.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="<?php echo base_url();?>assets/js/date-time/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/js/date-time/locales/bootstrap-datepicker.es.js"></script>
<script src="<?php echo base_url();?>assets/js/date-time/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/js/date-time/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo base_url();?>assets/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.inputtoggle.js"></script>

<script src="<?php echo base_url();?>assets/js/jquery.nestable.min.js"></script>

<?php
/*
  <script src="<?php echo base_url();?>assets/js/x-editable/bootstrap-editable.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/fuelux/fuelux.spinner.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/date-time/daterangepicker.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/bootstrap-colorpicker.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/jquery.knob.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/jquery.autosize-min.js"></script>
  <script src="<?php echo base_url();?>assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/jquery.maskedinput.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/bootstrap-tag.min.js"></script>
 */
?>
<!--ace scripts-->
<script src="<?php echo base_url();?>assets/js/ace-elements.min.js"></script>
<script	src="<?php echo base_url();?>assets/js/ace.min.js"></script>
<script>
                            $(".chosen-select").chosen({width: '206px'});
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53107492-3', 'auto');
  ga('send', 'pageview');

</script>
<!--inline scripts related to this page-->
</body>
</html>

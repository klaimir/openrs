// Para el control de cambios guardados o no
modificado = false;

// Funcion para mostrar submenus responsive
function show_submenu()
{
    $('#sidebar2').insertBefore('.page-content');

    $('.navbar-toggle[data-target="#sidebar2"]').insertAfter('#menu-toggler');


    $(document).on('settings.ace.two_menu', function (e, event_name, event_val) {
        if (event_name == 'sidebar_fixed') {
            if ($('#sidebar').hasClass('sidebar-fixed')) {
                $('#sidebar2').addClass('sidebar-fixed');
                $('#navbar').addClass('h-navbar');
            }
            else {
                $('#sidebar2').removeClass('sidebar-fixed')
                $('#navbar').removeClass('h-navbar');
            }
        }
    }).triggerHandler('settings.ace.two_menu', ['sidebar_fixed', $('#sidebar').hasClass('sidebar-fixed')]);
}

// Funcion para mostrar ventana de configmación para salir de una zona en la que ha introducido datos
function show_confirm_exit_message()
{
    if (modificado == true) {
        if (confirm('Va a salir de esta interfaz sin guardar los datos. ¿Desea salir de todas formas?'))
            return true;
        else
            return false;
    }
}

<li>
    <a href="<?php echo site_url('usuarios/dashboard'); ?>" onClick="return show_confirm_exit_message();">
        <i class="menu-icon fa fa-home"></i>
        <span class="menu-text"> Inicio </span>
    </a>

    <b class="arrow"></b>
</li>

<li class="<?php echo set_active_option($_active_section,'inmuebles'); ?>">
    <a href="<?php echo site_url('inmuebles'); ?>" onClick="return show_confirm_exit_message();">
        <i class="menu-icon fa fa-building"></i>
        <span class="menu-text"> Inmuebles </span>
    </a>

    <b class="arrow"></b>
</li>

<li class="<?php echo set_active_option($_active_section,'clientes'); ?>">
    <a href="<?php echo site_url('clientes'); ?>" onClick="return show_confirm_exit_message();">
        <i class="menu-icon fa fa-users"></i>
        <span class="menu-text"> Clientes </span>
    </a>

    <b class="arrow"></b>
</li>

<li class="<?php echo set_active_option($_active_section,'demandas'); ?>" onClick="return show_confirm_exit_message();">
    <a href="<?php echo site_url('demandas'); ?>">
        <i class="menu-icon fa fa-briefcase"></i>
        <span class="menu-text"> Demandas </span>
    </a>

    <b class="arrow"></b>
</li>
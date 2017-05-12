<?php

function set_active_menu($active_section, $options)
{
    if (in_array($active_section, $options))
    {
        return "active open";
    }
    else
    {
        return NULL;
    }
}

function set_active_option($active_section, $option)
{
    if ($active_section == $option)
    {
        return "active";
    }
    else
    {
        return NULL;
    }
}

function label($line, $for, $attributes = array())
{
    $line = '<label for="' . $for . '"' . _stringify_attributes($attributes) . '>' . $line . '</label>';

    return $line;
}

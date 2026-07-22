<?php

function mudt_pt_html($value)
{
    if ($value === null || $value === false || $value === '') {
        return '';
    }
    return wp_kses_post($value);
}

function mudt_pt_plain($value)
{
    if ($value === null || $value === false || $value === '') {
        return '';
    }
    return esc_html(wp_strip_all_tags((string) $value));
}

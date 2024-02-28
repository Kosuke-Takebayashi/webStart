<?php

function ws_register_style()
{
    wp_enqueue_style('ws-header-style', get_template_directory_uri() . '/assets/css/header.css');
    wp_enqueue_style('ws-footer-style', get_template_directory_uri() . '/assets/css/footer.css');
}

add_action('wp_enqueue_scripts', 'ws_register_style');

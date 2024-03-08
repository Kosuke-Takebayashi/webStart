<?php

function webstart_register_style()
{
    wp_enqueue_style('webstart-header-style', get_template_directory_uri() . '/assets/css/header.css');
    wp_enqueue_style('webstart-main-style', get_template_directory_uri() . '/assets/css/main.css');
    wp_enqueue_style('webstart-footer-style', get_template_directory_uri() . '/assets/css/footer.css');
    wp_enqueue_style('webstart-custom-style', get_template_directory_uri() . '/assets/css/custom.css');
}

add_action('wp_enqueue_scripts', 'webstart_register_style');

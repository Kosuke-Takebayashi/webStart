<?php

function setMainLoop($query)
{
    $query->set('posts_per_page', '3');
    return $query;
}

add_filter('pre_get_posts', 'setMainLoop');

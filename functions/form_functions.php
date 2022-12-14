<?php 

function are_all_posts_filled():bool {
    $result = true;

    foreach ($_POST as $post) {
        if ($post === '') {
            $result = false;
        }
    }

    return $result;
}
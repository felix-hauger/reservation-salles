<?php

class Form {


    public static function areAllPostsFilled():bool {
        $result = true;
    
        foreach ($_POST as $post) {
            if ($post === '') {
                $result = false;
            }
        }
    
        return $result;
    }

}
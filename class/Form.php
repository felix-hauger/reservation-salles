<?php

class Form
{

    public static function areAllPostsFilled(): bool
    {

        $result = true;

        foreach ($_POST as $post) {
            if ($post === '') {
                $result = false;
                break;
            }
        }

        return $result;
    }

    public static function passConfirm($password, $confirmation): bool
    {
        if ($password === $confirmation) {
            return true;
        } else {
            return false;
        }

    }
}

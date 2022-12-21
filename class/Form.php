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

    public static function passConfirm($password, $confirmation): array
    {
        if ($password === $confirmation) {
            // return true;
            return [
                'bool' => true,
            ];
        } else {
            // return false;
            return [
                'bool' => false,
                'err'  => ' Champs des Mots de Passe différents.'
            ];
        }

    }
}

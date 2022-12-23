<?php

class Form
{

    private static Array $_errors = [];

    public static function areAllPostsFilled(): bool
    {

        $result = true;

        foreach ($_POST as $post) {
            if ($post === '') {
                $result = false;
                static::$_errors['unfilled'] = 'Remplissez tous les champs';
                break;
            }
        }

        return $result;
    }

    public static function passConfirm($password, $confirmation): bool
    {
        // if ($password === $confirmation) {
            //     // return true;
            //     return [
        //         'bool' => true,
        //     ];
        // } else {
            //     // return false;
            //     return [
        //         'bool' => false,
        //         'err'  => ' Champs des Mots de Passe différents.'
        //     ];
        // }
        if ($password === $confirmation) {
            $result = true;
        } else {
            $result = false;
            self::$_errors['password'] = 'Champs des Mots de Passe différents.';
        }

        return $result;

    }

    public static function getErrors() {
        return self::$_errors;
    }
}

// var_dump(Form::$_errors);
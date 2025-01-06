<?php

namespace app\core\Helpers;

class DebugHelper {
    public static function dump($var, $exit = true) {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
        if ($exit) {
            exit;
        }
    }

    public static function debugPrint($var, $exit = true) {
        echo '<pre>';
        print_r($var);
        echo '</pre>';
        if ($exit) {
            exit;
        }
    }
}
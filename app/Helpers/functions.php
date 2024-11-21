<?php

if (!function_exists('membreFonction')) {
    function membreFonction($value) {
        $values = explode(', ', $value);
        return !empty($values) ? implode('<br>', $values) : '';
    }
}

function urlIs($value){
    return $_SERVER['REQUEST_URI'] === $value;
}

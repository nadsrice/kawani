<?php

defined('BASEPATH') OR exit('No direct script access allowed!');

require APPPATH.'/third_party/kint.php';

if ( ! function_exists('remove_unknown_field'))
{
    function remove_unknown_field($raw_data, $expected_fields)
    {
        $new_data = [];
        foreach ($raw_data as $field_name => $field_value)
        {
            if ($field_value != "" && in_array($field_name, array_values($expected_fields)))
            {
                $new_data[$field_name] = $field_value;
            }
        }

        return $new_data;
    }
}

if ( ! function_exists('dump')) {
    function dump($var, $label = 'Dump', $echo = true)
    {
        // Store dump in variable
        ob_start();
        var_dump($var);
        $output = ob_get_clean();

        // Custom CSS style
        $style = 'background: #282c34;
                color: #83c379;
                margin: 10px;
                padding: 10px;
                text-align: left;
                font-family: Inconsolata, Monaco, Consolas, Courier New, Courier;;
                font-size: 15px;
                border: 1px;
                border-radius: 1px;
                overflow: auto;
                border: 2px;
                -webkit-box-shadow: 5px 5px 5px #a4a4a4;';

        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", '] => ', $output);
        $output = '<pre style="'.$style.'">'.$label.' => '.$output.'</pre>';

        // Output
        if ($echo == true) {
            echo $output;
        } else {
            return $output;
        }
    }
}

if ( ! function_exists('dd')) {
    function dd($var)
    {
        d($var);
    }
}


if ( ! function_exists('generateRandomString')) {
    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
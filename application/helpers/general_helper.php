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

if ( ! function_exists('filter_data'))
{
    function filter_data($table, $data)
    {
        $ci =& get_instance();

        $filtered_data = array();
        $columns = $ci->db->list_fields($table);

        if ( ! is_array($data)) return FALSE;

        foreach ($columns as $column)
        {
            if (array_key_exists($column, $data))
                $filtered_data[$column] = $data[$column];
        }

        return $filtered_data;
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

if ( ! function_exists('daterange'))
{
    function daterange($date_start, $date_end, $differenceFormat = '%a')
    {
        $new_date_start = date_create($date_start);
        $new_date_end   = date_create($date_end);
        $interval       = date_diff($new_date_start, $new_date_end);
        $pre_total      = $interval->format($differenceFormat);
        $total          = $pre_total + 1;
        return $total;
    }
}

if ( ! function_exists('calculate_leave_balance'))
{
    function calculate_leave_balance($leave_balance, $total_days_filed)
    {
        $new_leave_balance      = $leave_balance;
        $new_dtotal_days_filed  = $total_days_filed;
        $total                  = $new_leave_balance - $new_dtotal_days_filed;
        return (float)$total;
    }
}

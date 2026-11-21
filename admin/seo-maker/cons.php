<?php

    if (!defined('__SEO_MAKER_ABS_PATH___')) {
        define('__SEO_MAKER_ABS_PATH___', __DIR__ . '/');
    }

    if (!defined('__SEO_MAKER_TOOLS___')) {
        define('__SEO_MAKER_TOOLS___', __SEO_MAKER_ABS_PATH___ . 'tools/');
    }

    function get_tool_buttons($action_button_obj)
    {
        $button_group = '';
        for ($index = 0; $index < count($action_button_obj); $index++) {
            $button = $action_button_obj[$index];

            $button_group .= '<button type="button" onclick="window.location.href=\'' . systemVariable('SITE_HOME') . 'admin/' . $button['href'].'\'" class="btn '.$button['class'].' mx-2"> '.$button['name'].' </button>';
        }
        return $button_group;
    }

    function the_sub_tools(){
        
    }

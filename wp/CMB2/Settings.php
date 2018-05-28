<?php

namespace Inggo\WordPress\CMB2;

class Settings
{
    public static function init()
    {
        static::initShowOn();
    }

    public static function initShowOn()
    {
        add_action('cmb2_show_on', [static::class, 'showOnFrontPage']);
    }

    public static function showOnFrontPage($display, $meta_box = null)
    {
        if (!isset($meta_box['show_on']['key'])) {
            return $display;
        }
    
        if ('front-page' !== $meta_box['show_on']['key']) {
            return $display;
        }
    
        $post_id = 0;
    
        if (isset($_GET['post'])) {
            $post_id = $_GET['post'];
        } elseif (isset($_POST['post_ID'])) {
            $post_id = $_POST['post_ID'];
        }
    
        if (!$post_id) {
            return false;
        }
    
        // Get ID of page set as front page, 0 if there isn't one
        $front_page = get_option('page_on_front');
    
        // there is a front page set and we're on it!
        return $post_id == $front_page;
    }
}

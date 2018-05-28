<?php

namespace Inggo\WordPress\PSBAManila;

use Inggo\WordPress\Admin as BaseAdmin;

class Admin extends BaseAdmin
{
    public function __construct()
    {
        parent::__construct('psba-manila');
    }

    public function init()
    {
        parent::init();
        add_action('admin_init', [$this, 'hideEditor']);
        add_action('admin_init', [$this, 'createDefaultCategories']);
    }

    public function createDefaultCategories()
    {
        wp_insert_term('News', 'category');
        wp_insert_term('Announcement', 'category');
        wp_insert_term('Event', 'category');
    }

    public function hideEditor()
    {
        $post_id = 0;
    
        if (isset($_GET['post'])) {
            $post_id = $_GET['post'];
        } elseif (isset($_POST['post_ID'])) {
            $post_id = $_POST['post_ID'];
        }
    
        if (!$post_id) {
            return false;
        }
    
        $front_page = get_option('page_on_front');

        if ($post_id != $front_page) {
            return false;
        }

        return remove_post_type_support('page', 'editor');
    }
}

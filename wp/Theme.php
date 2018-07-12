<?php

namespace Inggo\WordPress;

use Inggo\WordPress\Traits\DisplaysMessages;
use Inggo\WordPress\Contracts\Customizer;
use Inggo\WordPress\ShortcodeRegistrar;

class Theme
{
    use DisplaysMessages;

    public $customizer;

    public $admin;

    public $theme_data;
    public $version;
    public $slug = '';

    protected $alertMessage = '';

    private $current_post = null;

    public $shortcode_registrar = [];

    public $cpt_registrar = [];
    
    public function __construct($slug = 'theme')
    {
        $this->slug = $slug;
        $this->theme_data = wp_get_theme();
        $this->version = $this->theme_data->get('Version');
        $this->shortcode_registrar[] = new ShortcodeRegistrar;
    }

    public function init()
    {
        // Setup theme customizer
        $customizer = apply_filters('Inggo\WordPress\Filters\ThemeCustomizerClass', ThemeCustomizer::class);
        $this->customizer = new $customizer();

        // Add theme hooks
        add_action('after_setup_theme', [$this, 'setup'], 100);
        add_action('after_setup_theme', [$this, 'disableAdminBar'], 100);
        
        add_action('wp_enqueue_scripts', [$this, 'registerScriptStyles']);
        add_action('wp_enqueue_scripts', [$this, 'enqueueStyles']);
        add_action('wp_enqueue_scripts', [$this, 'enqueueScripts']);

        add_action('customize_register', [$this->customizer, 'register']);

        add_filter('pre_get_posts', [$this, 'searchFilter']);

        add_filter('next_posts_link_attributes', [$this, 'postLinkAttributes']);
        add_filter('previous_posts_link_attributes', [$this, 'postLinkAttributes']);

        add_filter('page_link', [$this, 'editPermalink'], 1110, 2);

        // Shortcode <p> wrap fix
        remove_filter( 'the_content', 'wpautop' );
        add_filter( 'the_content', 'wpautop' , 12);
    }

    public function postLinkAttributes()
    {
        return 'class="page-link"';
    }

    public function disableAdminBar()
    {
        show_admin_bar(false);
    }

    public function searchFilter($query)
    {
        if ($query->is_search) {
            $query->set('post_type', 'post');
        }
        return $query;
    }

    public function registerScriptStyles()
    {
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://code.jquery.com/jquery-3.3.1.min.js', [], '3.3.1');
        wp_register_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', [], '1.12.9');
        wp_register_script('bootstrap_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', ['jquery', 'popper'], '4.0.0');
        wp_register_script('main_js', get_template_directory_uri() . '/script.js', ['bootstrap_js'], $this->version);

        wp_register_style('bootstrap_css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css', [], '4.0.0');
    }

    public function enqueueStyles()
    {
        wp_enqueue_style('main_css', get_template_directory_uri() . '/style.css', ['bootstrap_css'], $this->version);
    }

    public function enqueueScripts()
    {
        wp_enqueue_script('main_js');
    }

    /**
     * Set-up the theme features
     */
    public function setup()
    {
        // Add thumbnail support
        add_theme_support('post-thumbnails');

        // Set the thumbnail size
        set_post_thumbnail_size(420, 280);

        // Add custom image sizes
        $this->addImageSizes();
        
        // Add menus support
        add_theme_support('menus');

        // Register the nav menus
        register_nav_menus(array(
            'main_menu' => 'Main Menu',
        ));

        // Add widgets support
        add_theme_support('widgets');
    }

    protected function addImageSizes()
    {
        return;
    }

    public function alert($message, $type = 'error')
    {
        $this->setAlertMessage($message);
        $this->showAlertMessage($type);
    }

    public function setAlertMessage($message)
    {
        $this->alertMessage = $message;
    }

    public function getAlertMessage()
    {
        return $this->alertMessage;
    }

    public function showAlertMessage($type = 'error')
    {
        get_template_part('partials/alert', $type);
    }

    public function setCurrentPost($post)
    {
        $this->current_post = $post;
    }

    public function getCurrentPost()
    {
        return $this->current_post;
    }

    public function hasCurrentPost()
    {
        return !is_null($this->current_post);
    }

    public function isCurrentPost($post)
    {
        return $this->hasCurrentPost() && $this->current_post->ID == $post->ID;
    }

    public function getCurrrentPostTemplate()
    {
        return $this->hasCurrentPost() && $this->current_post->post_type === 'page' ?
            get_post_meta($parent_id, '_wp_page_template', true) :
            null;
    }

    public function editPermalink($url, $post_id)
    {
        $post = get_post($post_id);

        if ($post->post_type != 'page') {
            return $url;
        }

        $parent_id = wp_get_post_parent_id($post_id);

        if (!$parent_id) {
            return $url;
        }

        if (get_post_meta($parent_id, '_wp_page_template', true) !== 'templates/parent-page.php') {
            return $url;
        }

        return str_replace('/' . $post->post_name . '/', '/#page-' . $post->post_name, $url);
    }
}

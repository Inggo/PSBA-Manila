<?php

namespace Inggo\WordPress\PSBAManila;

use Inggo\WordPress\Theme as BaseTheme;
use Inggo\WordPress\PSBAManila\CPTRegistrar;

class Theme extends BaseTheme
{
    public function __construct()
    {
        parent::__construct('psba-manila');
        $this->cpt_registrar[] = new CPTRegistrar;

        add_filter('pre_get_posts', [$this, 'addCPTToSearch']);
        add_filter('Inggo\WordPress\Filters\ThemeCustomizerClass', function ($class) {
            return ThemeCustomizer::class;
        }, 10);
    }

    public function addCPTToSearch($query)
    {
        if ($query->is_search) {
            $query->set('post_type', ['post', 'page', 'curriculum']);
        }
    
        return $query;
    }

    public function registerScriptStyles()
    {
        parent::registerScriptStyles();

        wp_register_script('photoswipe-ui', 'https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.2/photoswipe-ui-default.min.js', [], '4.1.2');
        wp_register_script('photoswipe', 'https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.2/photoswipe.min.js', ['photoswipe-ui'], '4.1.2');

        wp_register_style('google-webfonts', 'https://fonts.googleapis.com/css?family=Merriweather:400,700|Open+Sans:400,700', [], '');
        wp_register_style('google-webfonts-accent', 'https://fonts.googleapis.com/css?family=Nanum+Myeongjo&text=“”');
        wp_register_style('photoswipe-skin', 'https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.2/default-skin/default-skin.min.css', [], '4.1.2');
        wp_register_style('photoswipe', 'https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.2/photoswipe.min.css', ['photoswipe-skin'], '4.1.2');
        wp_register_style('font-awesome', 'https://use.fontawesome.com/releases/v5.8.1/css/all.css', [], '5.8.1');
    }

    public function enqueueStyles()
    {
        wp_enqueue_style('main_css', get_template_directory_uri() . '/style.css', ['google-webfonts', 'google-webfonts-accent', 'bootstrap_css', 'photoswipe'], $this->version);
    }

    public function enqueueScripts()
    {
        wp_enqueue_script('photoswipe');
        wp_enqueue_script('main_js');
    }

    protected function addImageSizes()
    {
        add_image_size('psba-small', 240, 240);
        add_image_size('psba-medium', 480, 480);
        add_image_size('psba-large', 960, 960);
    }

    public function setup()
    {
        parent::setup();

        register_sidebar([
            'id' => 'footer-left',
            'name' => 'Footer Widgets - Left',
            'before_widget' => '<div class="footer-widget footer-widget--left">',
            'after_widget' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        ]);

        register_sidebar([
            'id' => 'footer-right',
            'name' => 'Footer Widgets - Right',
            'before_widget' => '<div class="footer-widget footer-widget--right">',
            'after_widget' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        ]);
    }
}

<?php

namespace Inggo\WordPress\PSBAManila;

use Inggo\WordPress\ThemeCustomizer as BaseCustomizer;

use WP_Customize_Manager;

class ThemeCustomizer extends BaseCustomizer
{
    public function __construct($slug = 'psba-manila')
    {
        parent::__construct('psba-manila');
    }

    public function register(WP_Customize_Manager $manager)
    {
        parent::register($manager);

        $this->initializeSiteHeader();
    }

    public function initializeSiteHeader()
    {
        $this->ch->addSection($this->slug . '_site_header', 'Site Header');
        $this->ch->addControl('header_title', $this->slug . '_site_header', 'Title', '', 'textarea');
        $this->ch->addImageControl('header_logo', $this->slug . '_site_header', 'Logo');
    }
}

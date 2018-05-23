<?php

namespace Inggo\WordPress\Contracts;

use WP_Customize_Manager;

interface Customizer
{
    public function __construct($slug);

    public function register(WP_Customize_Manager $wp_customize);
}

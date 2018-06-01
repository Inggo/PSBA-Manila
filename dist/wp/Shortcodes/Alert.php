<?php

namespace Inggo\WordPress\Shortcodes;

class Alert
{
    public function __construct()
    {
        add_shortcode('bs_alert', [$this, 'output']);
    }

    public function output($atts, $content = null)
    {
        $atts = shortcode_atts([
            'type' => 'warning',
        ], $atts, 'bs_alert');

        return "<div class='alert alert-" . $atts['type'] . "'>" .
            do_shortcode($content) .
            "</div>";
    }
}

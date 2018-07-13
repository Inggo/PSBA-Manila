<?php

namespace Inggo\WordPress\Shortcodes;

class Caption
{
    public function __construct()
    {
        add_shortcode('wp_caption', [$this, 'output']);
        add_shortcode('caption', [$this, 'output']);
    }

    public function output($attr, $content = null)
    {
        if ( ! isset( $attr['caption'] ) ) {
            if ( preg_match( '#((?:<a [^>]+>\s*)?<img [^>]+>(?:\s*</a>)?)(.*)#is', $content, $matches ) ) {
                $content = $matches[1];
                $attr['caption'] = trim( $matches[2] );
            }
        }

        $output = apply_filters('img_caption_shortcode', '', $attr, $content);
        if ( $output != '' )
            return $output;

        extract(shortcode_atts(array(
            'id'      => '',
            'align'   => 'alignnone',
            'width'   => '',
            'caption' => ''
        ), $attr));

        if ( 1 > (int) $width || empty($caption) )
            return $content;

        if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

        return '<figure ' . $id . 'class="wp-caption ' . esc_attr($align) . '">'
            . do_shortcode( $content )
            . '<figcaption class="wp-caption-text">' . $caption . '</figcaption></figure>';
    }
}

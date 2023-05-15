<?php

namespace Inggo\WordPress;

use Inggo\WordPress\CMB2\Settings as CMB2Settings;

class Admin
{
    public $slug;
    public $prefix;

    public function __construct($slug = '')
    {
        $this->slug = $slug;
        $this->prefix = '_' . $slug . '_';

        $this->init();
    }

    public function init()
    {
        $this->initCmb2();
        add_action('admin_init', [$this, 'hideEditor']);
        add_action('cmb2_admin_init', [$this, 'addMetaBoxes']);
        add_filter('site_url',  [$this, 'adminUrl'], 10, 3);
        add_action('admin_enqueue_scripts', [$this, 'loadStyles']);
    }

    public function adminUrl($url, $path, $orig_scheme)
    {
        if (!defined('WP_ADMIN_DIR')) {
            return $url;
        }

        $old  = array("/(wp-admin)/");
        $admin_dir = WP_ADMIN_DIR;
        $new  = array($admin_dir);
        return preg_replace($old, $new, $url, 1);
    }

    public function initCMB2()
    {
        CMB2Settings::init();
    }

    public function addMetaBoxes()
    {
        $this->addFrontPageBannersMetaBoxes();
    }

    private function addFrontPageBannersMetaBoxes()
    {
        $cmb = new_cmb2_box([
            'id'            => 'front_page_banners_metabox',
            'title'         => __('Banners', $this->slug),
            'object_types'  => ['page'],
            'show_on'       => ['key' => 'front-page', 'value' => ''],
            'context'       => 'normal',
            'priority'      => 'high',
            'show_names'    => true
        ]);

        $group_field_id = $cmb->add_field([
            'id'          => 'front_page_banners',
            'type'        => 'group',
            'options'     => array(
                'group_title'   => __('Banner {#}', $this->slug),
                'add_button'    => __('Add Banner', $this->slug),
                'remove_button' => __('Remove Banner', $this->slug),
                'sortable'      => true, // beta
            ),
        ]);

        $cmb->add_group_field($group_field_id, [
            'name' => 'Image',
            'id'   => 'image',
            'type' => 'file',
        ]);
        
        $cmb->add_group_field($group_field_id, [
            'name' => 'Caption',
            'id'   => 'caption',
            'type' => 'textarea_small',
        ]);

        $cmb->add_group_field($group_field_id, [
            'name' => 'Call To Action Button',
            'id'   => 'cta_button',
            'type' => 'text',
        ]);

        $cmb->add_group_field($group_field_id, [
            'name' => 'Call To Action Link',
            'id'   => 'cta_url',
            'type' => 'text_url',
        ]);

        $cmb->add_group_field($group_field_id, [
            'name' => 'Call To Action Color',
            'id' => 'cta_class',
            'type' => 'select',
            'default' => 'btn-primary',
            'options' => $this->colorChoices('btn'),
        ]);
    }

    private function colorChoices($pre = 'is')
    {
        return [
            $pre . '-primary' => 'Primary',
            $pre . '-secondary' => 'Secondary',
            $pre . '-success' => 'Success',
            $pre . '-danger' => 'Danger',
            $pre . '-warning' => 'Warning',
            $pre . '-info' => 'Info',
            $pre . '-light' => 'Light',
            $pre . '-dark' => 'Dark',
            $pre . '-link' => 'Link',
        ];
    }

    public function hideEditor()
    {
        return false;
        // return $this->removeEditor();
    }

    protected function removeEditor()
    {
        return remove_post_type_support('page', 'editor');
    }

    public function loadStyles()
    {
        wp_enqueue_style('psba_admin_css', get_template_directory_uri() . '/admin.css', false);
    }
}

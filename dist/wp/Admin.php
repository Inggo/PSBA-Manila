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
        add_action('save_post', [$this, 'overridePageContents'], 20, 3);
        add_filter('site_url',  [$this, 'adminUrl'], 10, 3);
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
            'id'            => 'front_page_metabox',
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

    public function overridePageContents($post_id, $post, $update)
    {
        $post_type = get_post_type($post_id);

        if ($post_type != "page") {
            return;
        }

        $front_page = get_option('page_on_front');

        if ($post_id == $front_page) {
            return $this->overrideFrontPageContents($post);
        }
    }

    private function overrideFrontPageContents($post)
    {
        $banners = get_post_meta($post->ID, 'front_page_banners', true);

        // Clear post content
        $post->post_content = "";

        // Append caption and CTA to post content
        foreach ($banners as $index => $banner) {
            $post->post_content .= $banner['caption'] . "\n\n";
            $post->post_content .= $banner['cta_button'] . "\n\n";
            $post->post_content .= "\n";
        }

        remove_action('save_post', [$this, 'overridePageContents'], 20);

        wp_update_post($post);

        add_action('save_post', [$this, 'overridePageContents'], 20, 3);
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

        return $this->removeEditor();
    }

    protected function removeEditor()
    {
        return remove_post_type_support('page', 'editor');
    }
}

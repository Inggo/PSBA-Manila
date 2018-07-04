<?php

namespace Inggo\WordPress\PSBAManila\CPT;

use Inggo\WordPress\AbstractCPT;
use Inggo\WordPress\CMB2\Filters;

class Proceedings extends AbstractCPT
{   
    public $slug = 'psba-manila';

    public function register()
    {
        $labels = array(
            'name'                  => _x( 'Proceedings', 'Post Type General Name', $this->slug ),
            'singular_name'         => _x( 'Proceedings', 'Post Type Singular Name', $this->slug ),
            'menu_name'             => __( 'Proceedings', $this->slug ),
            'name_admin_bar'        => __( 'Proceedings', $this->slug ),
            'archives'              => __( '', $this->slug ),
            'attributes'            => __( 'Proceedings Attributes', $this->slug ),
            'parent_item_colon'     => __( '', $this->slug ),
            'all_items'             => __( 'All Proceedings', $this->slug ),
            'add_new_item'          => __( 'Add New Proceedings', $this->slug ),
            'add_new'               => __( 'Add New', $this->slug ),
            'new_item'              => __( 'New Proceedings', $this->slug ),
            'edit_item'             => __( 'Edit Proceedings', $this->slug ),
            'update_item'           => __( 'Update Proceedings', $this->slug ),
            'view_item'             => __( 'View Proceedings', $this->slug ),
            'view_items'            => __( 'View Proceedings', $this->slug ),
            'search_items'          => __( 'Search Proceedings', $this->slug ),
            'not_found'             => __( 'Not found', $this->slug ),
            'not_found_in_trash'    => __( 'Not found in Trash', $this->slug ),
            'insert_into_item'      => __( 'Insert into proceedings', $this->slug ),
            'uploaded_to_this_item' => __( 'Uploaded to this proceedings', $this->slug ),
            'items_list'            => __( 'Proceedings list', $this->slug ),
            'items_list_navigation' => __( 'Proceedings list navigation', $this->slug ),
            'filter_items_list'     => __( 'Filter proceedings list', $this->slug ),
        );
        $args = array(
            'label'                 => __( 'Proceedings', $this->slug ),
            'labels'                => $labels,
            'supports'              => array('title', 'revisions', 'page-attributes'),
            'taxonomies'            => array(),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 30,
            'menu_icon'             => 'dashicons-clipboard',
            'show_in_admin_bar'     => false,
            'show_in_nav_menus'     => false,
            'can_export'            => true,
            'has_archive'           => false,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => true,
            'capability_type'       => 'post',
        );

        register_post_type('proceedings', $args);

        add_filter('manage_proceedings_posts_columns', [$this, 'applyColumns']);

        add_filter('cmb2_admin_init', [$this, 'addMetaBoxes'], 15);

        add_action('save_post', [$this, 'applyContents'], 30, 3);
    }

    public function applyColumns($posts_columns)
    {
        $posts_columns = [
            'cb' => '<input type="checkbox" />',
            'title' => 'Title',
            'date' => 'Date',
        ];

        return $posts_columns;
    }

    public function addMetaBoxes()
    {
        $cmb = new_cmb2_box([
            'id'            => 'proceedings_details_metabox',
            'title'         => __('Details'),
            'object_types'  => ['proceedings'],
            'context'       => 'normal',
            'priority'      => 'high',
            'show_names'    => true
        ]);

        $cmb->add_field([
            'name' => 'Concept Note',
            'id'   => 'concept_note',
            'type' => 'wysiwyg',
            'options' => array(),
            'default' => '',
        ]);

        $cmb->add_field([
            'name' => 'Speaker Profiles',
            'id'   => 'speaker_profiles',
            'type' => 'wysiwyg',
            'options' => array(),
            'default' => '',
        ]);

        $cmb->add_field([
            'name' => 'Program of Activities',
            'id'   => 'program_of_activities',
            'type' => 'wysiwyg',
            'options' => array(),
            'default' => '',
        ]);

        $cmb->add_field([
            'name' => 'Proceedings',
            'id'   => 'proceedings',
            'type' => 'wysiwyg',
            'options' => array(),
            'default' => '',
        ]);

        $cmb->add_field([
            'name' => 'Venue Map/Location',
            'id'   => 'location',
            'type' => 'wysiwyg',
            'options' => array(),
            'default' => '',
        ]);

        $cmb->add_field([
            'name' => 'Gallery',
            'id'   => 'gallery',
            'type' => 'file_list',
        ]);
    }

    public function applyContents($post_id, $post, $update)
    {
        $post_type = get_post_type($post_id);

        if ($post_type != 'proceedings') {
            return;
        }

        // Just append to post content all fields so that they are searchable
        $post->post_content = get_post_meta($post_id, 'concept_note', true);
        $post->post_content .= "\n\n" . get_post_meta($post_id, 'speaker_profiles', true);
        $post->post_content .= "\n\n" . get_post_meta($post_id, 'program_of_activities', true);
        $post->post_content .= "\n\n" . get_post_meta($post_id, 'proceedings', true);
        $post->post_content .= "\n\n" . get_post_meta($post_id, 'location', true);

        // Avoid infinite loop
        remove_action('save_post', [$this, 'applyContents']);

        wp_update_post($post);

        add_action('save_post', [$this, 'applyContents'], 30, 3);
    }
}

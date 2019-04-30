<?php

namespace Inggo\WordPress\PSBAManila\CPT;

use Inggo\WordPress\AbstractCPT;
use Inggo\WordPress\CMB2\Filters;

class Event extends AbstractCPT
{   
    public $slug = 'psba-manila';

    public function register()
    {
        $labels = array(
            'name'                  => _x( 'Events', 'Post Type General Name', $this->slug ),
            'singular_name'         => _x( 'Event', 'Post Type Singular Name', $this->slug ),
            'menu_name'             => __( 'Events', $this->slug ),
            'name_admin_bar'        => __( 'Event', $this->slug ),
            'archives'              => __( '', $this->slug ),
            'attributes'            => __( 'Event Attributes', $this->slug ),
            'parent_item_colon'     => __( '', $this->slug ),
            'all_items'             => __( 'All Events', $this->slug ),
            'add_new_item'          => __( 'Add New Event', $this->slug ),
            'add_new'               => __( 'Add New', $this->slug ),
            'new_item'              => __( 'New Event', $this->slug ),
            'edit_item'             => __( 'Edit Event', $this->slug ),
            'update_item'           => __( 'Update Event', $this->slug ),
            'view_item'             => __( 'View Event', $this->slug ),
            'view_items'            => __( 'View Events', $this->slug ),
            'search_items'          => __( 'Search Events', $this->slug ),
            'not_found'             => __( 'Not found', $this->slug ),
            'not_found_in_trash'    => __( 'Not found in Trash', $this->slug ),
            'insert_into_item'      => __( 'Insert into event', $this->slug ),
            'uploaded_to_this_item' => __( 'Uploaded to this event', $this->slug ),
            'items_list'            => __( 'Events list', $this->slug ),
            'items_list_navigation' => __( 'Events list navigation', $this->slug ),
            'filter_items_list'     => __( 'Filter events list', $this->slug ),
        );

        $args = array(
            'label'                 => __( 'Event', $this->slug ),
            'labels'                => $labels,
            'supports'              => array('title', 'revisions', 'page-attributes'),
            'taxonomies'            => array('post_tag'),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 30,
            'menu_icon'             => 'dashicons-calendar-alt',
            'show_in_admin_bar'     => false,
            'show_in_nav_menus'     => false,
            'can_export'            => true,
            'has_archive'           => false,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => true,
            'capability_type'       => 'post',
        );

        register_post_type('event', $args);

        add_filter('manage_event_posts_columns', [$this, 'applyColumns']);
        add_filter('manage_event_posts_custom_column', [$this, 'applyColumnContents'], 10, 2);

        add_filter('cmb2_admin_init', [$this, 'addMetaBoxes'], 15);
    }

    public function applyColumns($posts_columns)
    {
        $posts_columns = [
            'cb' => '<input type="checkbox" />',
            'title' => 'Title',
            'color' => 'Color',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
        ];

        return $posts_columns;
    }

    public function applyColumnContents($column_name, $post_ID)
    {
        if ($column_name === 'menu_order') {
            echo get_post($post_ID)->menu_order;
        }

        if ($column_name === 'color') {
            echo get_post_meta($post_ID, 'event_color', true);
        }

        if ($column_name === 'event_link') {
            echo get_post_meta($post_ID, 'event_link', true);
        }

        if ($column_name === 'start_date') {
            echo get_post_meta($post_ID, 'start_date', true);
        }

        if ($column_name === 'end_date') {
            echo get_post_meta($post_ID, 'end_date', true);
        }
    }

    public function addMetaBoxes()
    {
        $cmb = new_cmb2_box([
            'id'            => 'event_details_metabox',
            'title'         => __('Event Details'),
            'object_types'  => ['event'],
            'context'       => 'normal',
            'priority'      => 'high',
            'show_names'    => true
        ]);

        $cmb->add_field([
            'name' => 'Start Date',
            'id'   => 'start_date',
            'type' => 'text_date',
            'options' => array(),
            'default' => '',
            'date_format' => 'Y-m-d'
        ]);

        $cmb->add_field([
            'name' => 'End Date',
            'id'   => 'end_date',
            'type' => 'text_date',
            'options' => array(),
            'default' => '',
            'date_format' => 'Y-m-d'
        ]);

        $cmb->add_field( array(
            'name' => 'Details',
            'id' => 'event_details',
            'type' => 'textarea'
        ) );

        $cmb->add_field([
            'name' => 'Event Color',
            'id'   => 'event_color',
            'type' => 'colorpicker',
            'options' => array(),
            'default' => '',
        ]);

        $cmb->add_field([
            'name' => 'Event Link',
            'id'   => 'event_link',
            'type' => 'text_url',
            'options' => array(),
            'default' => '',
        ]);
    }
}

<?php

namespace Inggo\WordPress\PSBAManila\CPT;

use Inggo\WordPress\AbstractCPT;

class Personnel extends AbstractCPT
{   
    public function register()
    {
        $labels = array(
            'name'                  => _x( 'Personnel', 'Post Type General Name', '$this->slug' ),
            'singular_name'         => _x( 'Personnel', 'Post Type Singular Name', '$this->slug' ),
            'menu_name'             => __( 'Personnel', '$this->slug' ),
            'name_admin_bar'        => __( 'Personnel', '$this->slug' ),
            'archives'              => __( '', '$this->slug' ),
            'attributes'            => __( 'Personnel Attributes', '$this->slug' ),
            'parent_item_colon'     => __( '', '$this->slug' ),
            'all_items'             => __( 'All Personnel', '$this->slug' ),
            'add_new_item'          => __( 'Add New Personnel', '$this->slug' ),
            'add_new'               => __( 'Add New', '$this->slug' ),
            'new_item'              => __( 'New Personnel', '$this->slug' ),
            'edit_item'             => __( 'Edit Personnel', '$this->slug' ),
            'update_item'           => __( 'Update Personnel', '$this->slug' ),
            'view_item'             => __( 'View Personnel', '$this->slug' ),
            'view_items'            => __( 'View Personnel', '$this->slug' ),
            'search_items'          => __( 'Search Personnel', '$this->slug' ),
            'not_found'             => __( 'Not found', '$this->slug' ),
            'not_found_in_trash'    => __( 'Not found in Trash', '$this->slug' ),
            'featured_image'        => __( 'Photo', '$this->slug' ),
            'set_featured_image'    => __( 'Set photo', '$this->slug' ),
            'remove_featured_image' => __( 'Remove photo', '$this->slug' ),
            'use_featured_image'    => __( 'Use as photo', '$this->slug' ),
            'insert_into_item'      => __( 'Insert into personnel', '$this->slug' ),
            'uploaded_to_this_item' => __( 'Uploaded to this personnel', '$this->slug' ),
            'items_list'            => __( 'Personnel list', '$this->slug' ),
            'items_list_navigation' => __( 'Personnel list navigation', '$this->slug' ),
            'filter_items_list'     => __( 'Filter personnel list', '$this->slug' ),
        );
        $args = array(
            'label'                 => __( 'Personnel', '$this->slug' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'thumbnail', 'revisions' ),
            'taxonomies'            => array( 'post_tag' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 25,
            'menu_icon'             => 'dashicons-businessman',
            'show_in_admin_bar'     => false,
            'show_in_nav_menus'     => false,
            'can_export'            => true,
            'has_archive'           => false,
            'exclude_from_search'   => true,
            'publicly_queryable'    => false,
            'rewrite'               => false,
            'capability_type'       => 'post',
        );

        register_post_type('personnel', $args);

        add_filter('manage_personnel_posts_columns', [$this, 'applyColumns']);
        add_filter('manage_personnel_posts_custom_column', [$this, 'applyColumnContents'], 10, 2);
        add_filter('gettext', [$this, 'replacePlaceholder']);

        add_filter('cmb2_admin_init', [$this, 'addMetaBoxes']);
    }

    public function applyColumns($posts_columns)
    {
        $posts_columns = [
            'title' => 'Title',
            'featured_image' => 'Photo',
            'tags' => 'Tags',
            'date' => 'Date',
        ];

        return $posts_columns;
    }

    public function applyColumnContents($column_name, $post_ID)
    {
        if ($column_name === 'featured_image' && $thumb = get_the_post_thumbnail_url($post_ID))
        {
            echo '<img src="' . $thumb . '" alt="" width="100px" />';
        }
    }

    public function replacePlaceholder($input)
    {
        global $post_type;

        if(is_admin() && 'Enter title here' == $input && 'personnel' == $post_type) {
            return 'Enter Full Name';
        }

        return $input;
    }

    public function addMetaBoxes()
    {
        $cmb = new_cmb2_box([
            'id'            => 'personnel_metabox',
            'title'         => __('Personnel Details'),
            'object_types'  => ['personnel'],
            'context'       => 'normal',
            'priority'      => 'high',
            'show_names'    => true
        ]);

        $cmb->add_field([
            'name' => 'Titles',
            'description' => 'Appended to name, separate with commas (e.g. BBA, MBA, DBA, CPA)',
            'id'   => 'titles',
            'type' => 'text',
        ]);

        $cmb2 = new_cmb2_box([
            'id'            => 'personnel_board_metabox',
            'title'         => __('Board Member Details'),
            'object_types'  => ['personnel'],
            'show_on'       => ['key'   => 'taxonomy', 'value' => ['post_tag' => 'board-member']],
            'context'       => 'normal',
            'priority'      => 'high',
            'show_names'    => true
        ]);

        $cmb2->add_field([
            'name' => 'Position',
            'id'   => 'board_position',
            'type' => 'text',
        ]);

        $cmb3 = new_cmb2_box([
            'id'            => 'personnel_officer_metabox',
            'title'         => __('Officer Details'),
            'object_types'  => ['personnel'],
            'show_on'       => ['key'   => 'taxonomy', 'value' => ['post_tag' => 'officer']],
            'context'       => 'normal',
            'priority'      => 'high',
            'show_names'    => true
        ]);

        $cmb3->add_field([
            'name' => 'Position',
            'id'   => 'officer_position',
            'type' => 'text',
        ]);
    }
}
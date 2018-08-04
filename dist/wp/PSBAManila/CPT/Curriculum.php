<?php

namespace Inggo\WordPress\PSBAManila\CPT;

use Inggo\WordPress\AbstractCPT;
use Inggo\WordPress\CMB2\Filters;

class Curriculum extends AbstractCPT
{   
    public $slug = 'psba-manila';

    public function register()
    {
        $labels = array(
            'name'                  => _x( 'Curricula', 'Post Type General Name', $this->slug ),
            'singular_name'         => _x( 'Curriculum', 'Post Type Singular Name', $this->slug ),
            'menu_name'             => __( 'Curricula', $this->slug ),
            'name_admin_bar'        => __( 'Curriculum', $this->slug ),
            'archives'              => __( '', $this->slug ),
            'attributes'            => __( 'Curriculum Attributes', $this->slug ),
            'parent_item_colon'     => __( '', $this->slug ),
            'all_items'             => __( 'All Curricula', $this->slug ),
            'add_new_item'          => __( 'Add New Curriculum', $this->slug ),
            'add_new'               => __( 'Add New', $this->slug ),
            'new_item'              => __( 'New Curriculum', $this->slug ),
            'edit_item'             => __( 'Edit Curriculum', $this->slug ),
            'update_item'           => __( 'Update Curriculum', $this->slug ),
            'view_item'             => __( 'View Curriculum', $this->slug ),
            'view_items'            => __( 'View Curricula', $this->slug ),
            'search_items'          => __( 'Search Curricula', $this->slug ),
            'not_found'             => __( 'Not found', $this->slug ),
            'not_found_in_trash'    => __( 'Not found in Trash', $this->slug ),
            'insert_into_item'      => __( 'Insert into curriculum', $this->slug ),
            'uploaded_to_this_item' => __( 'Uploaded to this curriculum', $this->slug ),
            'items_list'            => __( 'Curricula list', $this->slug ),
            'items_list_navigation' => __( 'Curricula list navigation', $this->slug ),
            'filter_items_list'     => __( 'Filter curricula list', $this->slug ),
        );
        $args = array(
            'label'                 => __( 'Curriculum', $this->slug ),
            'labels'                => $labels,
            'supports'              => array('title', 'revisions', 'page-attributes'),
            'taxonomies'            => array('post_tag'),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 30,
            'menu_icon'             => 'dashicons-welcome-learn-more',
            'show_in_admin_bar'     => false,
            'show_in_nav_menus'     => false,
            'can_export'            => true,
            'has_archive'           => false,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => true,
            'capability_type'       => 'post',
        );

        register_post_type('curriculum', $args);

        add_filter('manage_curriculum_posts_columns', [$this, 'applyColumns']);
        add_filter('manage_curriculum_posts_custom_column', [$this, 'applyColumnContents'], 10, 2);

        add_filter('cmb2_admin_init', [$this, 'addMetaBoxes'], 15);

        add_action('save_post', [$this, 'applyContents'], 20, 3);
    }

    public function applyColumns($posts_columns)
    {
        $posts_columns = [
            'cb' => '<input type="checkbox" />',
            'title' => 'Title',
            'menu_order' => 'Order',
            'tags' => 'Tags',
            'date' => 'Date',
        ];

        return $posts_columns;
    }

    public function applyColumnContents($column_name, $post_ID)
    {
        if ($column_name === 'menu_order') {
            echo get_post($post_ID)->menu_order;
        }
    }

    public function addMetaBoxes()
    {
        $cmb = new_cmb2_box([
            'id'            => 'curriculum_courses_metabox',
            'title'         => __('Courses'),
            'object_types'  => ['curriculum'],
            'context'       => 'normal',
            'priority'      => 'high',
            'show_names'    => true
        ]);

        $cmb->add_field([
            'name' => 'Page Title',
            'id'   => 'page_title',
            'type' => 'text',
        ]);

        $group_field_id = $cmb->add_field([
            'id'          => 'curriculum_rows',
            'type'        => 'group',
            'options'     => array(
                'group_title'   => __('Row {#}', $this->slug),
                'add_button'    => __('Add Row', $this->slug),
                'remove_button' => __('Remove Row', $this->slug),
                'sortable'      => true,
            ),
        ]);

        $cmb->add_group_field($group_field_id, [
            'name' => 'Title',
            'id'   => 'title',
            'type' => 'text',
        ]);

        $cmb->add_group_field($group_field_id, [
            'name' => 'Course Code',
            'id'   => 'code',
            'type' => 'text_small',
        ]);

        $cmb->add_group_field($group_field_id, [
            'name' => 'Course Description',
            'id'   => 'description',
            'type' => 'wysiwyg',
            'options' => array(),
            'default' => '',
        ]);

        $cmb->add_group_field($group_field_id, [
            'name' => 'Units',
            'id'   => 'units',
            'type' => 'text_small',
        ]);

        $cmb->add_group_field($group_field_id, [
            'name' => 'Row Type',
            'id'   => 'row_type',
            'type' => 'select',
            'default' => 'normal',
            'options' => [
                'normal' => __('Normal', $this->slug),
                'header' => __('Header', $this->slug),
                'subtotal' => __('Sub Total', $this->slug),
                'total' => __('Grand Total', $this->slug),
            ],
        ]);

        $cmb->add_field([
            'name' => 'Additional Remarks',
            'id'   => 'additional_remarks',
            'type' => 'wysiwyg',
            'options' => array(),
            'default' => '',
        ]);

        $cmb2 = new_cmb2_box([
            'id'            => 'curriculum_requirements_metabox',
            'title'         => __('Requirements'),
            'object_types'  => ['curriculum'],
            'context'       => 'normal',
            'priority'      => 'high',
            'show_names'    => true
        ]);

        $cmb2->add_field([
            'name' => 'Title',
            'id'   => 'requirements_title',
            'type' => 'text',
        ]);

        $cmb2->add_field([
            'name' => 'Content',
            'id'   => 'requirements_content',
            'type' => 'wysiwyg',
            'options' => array(),
            'default' => '',
        ]);
    }

    public function applyContents($post_id, $post, $update)
    {
        $post_type = get_post_type($post_id);

        if ($post_type != 'curriculum') {
            return;
        }

        $post->post_content = '<table class="table curriculum-table table-light table-striped"><tbody>';

        // Get rows
        $curr_rows = get_post_meta($post_id, 'curriculum_rows', true);

        if ($curr_rows) {
            foreach ($curr_rows as $index => $row) {
                $post->post_content .= $this->applyRowContents($row, $index);
            }    
        }

        $post->post_content .= '</tbody></table>';

        $post->post_content .= get_post_meta($post_id, 'additional_remarks', true);

        $requirements_title = get_post_meta($post_id, 'requirements_title', true);
        $requirements_content = get_post_meta($post_id, 'requirements_content', true);

        if ($requirements_title || $requirements_content) {
            $post->post_content .= '<div class="card">';

            if ($requirements_title) {
                $post->post_content .= '<div class="card-header"><h4>' . $requirements_title . '</h4></div>';
            }

            if ($requirements_content) {
                $post->post_content .= '<div class="card-body">' . $requirements_content . '</div>';
            }

            $post->post_content .= '</div>';
        }

        remove_action('save_post', [$this, 'applyContents'], 20);

        wp_update_post($post);

        add_action('save_post', [$this, 'applyContents'], 20, 3);
    }

    private function applyRowContents($row, $index)
    {
        $type = $row['row_type'];

        $content = "<tr class='row-" . $type . "'>";

        switch ($type) {
            case 'header':
            case 'subtotal':
            case 'total':
                $content .= "<td colspan='2'>";
                $content .= $row['code'] . ' ' . $row['title'];
                $content .= "</td>";
                break;
            case 'normal':
            default:
                $content .= "<td>" . $row['code'] . "</td>";
                $content .= "<td class='text-center'><div><a href='#course-description-" . $index;
                $content .= "' data-toggle='modal'>" . $row['title'] . "</a></div>";
                if ($row['description']) {
                    $content .= $this->applyCourseDescriptionContents($row['title'], $row['description'], $index);
                }
                $content .= "</td>";
                break;
        }

        $content .= "<td>" . $row['units'] . "</td>";

        $content .= "</tr>";

        return $content;
    }

    private function applyCourseDescriptionContents($title, $description, $index)
    {
        $id = 'course-description-' . $index;

        $content = '<div class="modal fade" id="' . $id;
        $content .= '" tabindex="-1" role="dialog" aria-labelledby="';
        $content .= $id . '" aria-hidden="true">';

        $content .= '<div class="modal-dialog modal-dialog-centered" role="document">';
        $content .= '<div class="modal-content">';
        $content .= '<div class="modal-header">';
        $content .= '<h5 class="modal-title">' . $title . '</h5>';
        $content .= '<div><button type="button" class="close" data-dismiss="modal" aria-label="Close">';
        $content .= '<span aria-hidden="true">&times;</span>';
        $content .= '</button></div>';
        $content .= '</div>';
        $content .= '<div class="modal-body text-justify">';
        $content .= $description;
        $content .= '</div></div></div></div>';

        return $content;
    }
}

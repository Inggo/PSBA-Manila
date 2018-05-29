<?php

namespace Inggo\WordPress\PSBAManila;

use Inggo\WordPress\Admin as BaseAdmin;

class Admin extends BaseAdmin
{
    public function __construct()
    {
        parent::__construct('psba-manila');
    }

    public function init()
    {
        parent::init();
        add_action('admin_init', [$this, 'createDefaultCategories']);
    }

    public function addMetaBoxes()
    {
        parent::addMetaBoxes();
        $this->addParentPageMetaBoxes();
        $this->addMultiContentPageMetaBoxes();
    }

    private function addParentPageMetaBoxes()
    {
        $cmb = new_cmb2_box([
            'id'            => 'parent_page_metabox',
            'title'         => __('Parent Page', $this->slug),
            'object_types'  => ['page'],
            'show_on'       => ['key' => 'page-template', 'value' => 'templates/parent-page.php'],
            'context'       => 'normal',
            'priority'      => 'high',
            'show_names'    => true
        ]);

        $cmb->add_field([
            'name' => '',
            'desc' => 'This page will display its subpages as their own content with a vertical tab list at the left side.<br>' .
                'Start adding your subpages via the Pages menu.',
            'type' => 'title',
            'id' => ''
        ]);
    }

    private function addMultiContentPageMetaBoxes()
    {
        $cmb = new_cmb2_box([
            'id'            => 'multi_content_metabox',
            'title'         => __('Contents', $this->slug),
            'object_types'  => ['page'],
            'show_on'       => ['key' => 'page-template', 'value' => 'templates/multi-content.php'],
            'context'       => 'normal',
            'priority'      => 'high',
            'show_names'    => true
        ]);

        $group_field_id = $cmb->add_field([
            'id'          => 'multi_page_contents',
            'type'        => 'group',
            'options'     => array(
                'group_title'   => __('Content {#}', $this->slug),
                'add_button'    => __('Add Content', $this->slug),
                'remove_button' => __('Remove Content', $this->slug),
                'sortable'      => true,
            ),
        ]);

        $cmb->add_group_field($group_field_id, [
            'name' => 'Title',
            'id'   => 'title',
            'type' => 'text',
        ]);

        $cmb->add_group_field($group_field_id, [
            'name' => 'Content',
            'id'   => 'content',
            'type' => 'wysiwyg',
            'options' => array(),
            'default' => '',
        ]);
    }

    public function createDefaultCategories()
    {
        wp_insert_term('News', 'category');
        wp_insert_term('Announcement', 'category');
        wp_insert_term('Event', 'category');
    }

    public function hideEditor()
    {
        parent::hideEditor();

        $post_id = 0;
    
        if (isset($_GET['post'])) {
            $post_id = $_GET['post'];
        } elseif (isset($_POST['post_ID'])) {
            $post_id = $_POST['post_ID'];
        }
    
        if (!$post_id) {
            return false;
        }

        $page_template = get_post_meta($post_id, '_wp_page_template', true);

        if ($page_template === 'templates/parent-page.php' ||
            $page_template === 'templates/multi-content.php') {
            // return $this->removeEditor();
        }
    }

    public function overridePageContents($post_id, $post, $update)
    {
        parent::overridePageContents($post_id, $post, $update);
        
        $page_template = get_post_meta($post_id, '_wp_page_template', true);

        if ($page_template === 'templates/multi-content.php') {
            return $this->overrideMultiPageContents($post);
        }
    }

    private function overrideMultiPageContents($post)
    {
        $contents = get_post_meta($post->ID, 'multi_page_contents', true);

        // Clear post content
        $post->post_content = "";

        // Append caption and CTA to post content
        foreach ($contents as $index => $content) {
            $post->post_content .= "<h3>" . $content['title'] . "</h3>\n";
            $post->post_content .= $content['content'] . "\n";
            $post->post_content .= "\n";
        }

        remove_action('save_post', [$this, 'overridePageContents']);

        wp_update_post($post);

        add_action('save_post', [$this, 'overridePageContents'], 10, 3);
    }
}

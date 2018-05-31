<?php

namespace Inggo\WordPress\PSBAManila;

use Inggo\WordPress\Admin as BaseAdmin;
use Inggo\WordPress\PSBAManila\Traits\ContentOverrides;
use Inggo\WordPress\PSBAManila\Traits\CMB2MetaBoxes;

class Admin extends BaseAdmin
{
    use ContentOverrides;
    use CMB2MetaBoxes;

    public function __construct()
    {
        parent::__construct('psba-manila');
    }

    public function init()
    {
        parent::init();
        add_action('admin_init', [$this, 'createDefaultCategories']);
    
        add_filter('image_size_names_choose', [$this, 'applyImageSizes']);
    }

    public function applyImageSizes($sizes)
    {
        return array_merge($sizes, [
            'psba-small' => __('Small (up to 240px)'),
            'psba-medium' => __('Medium (up to 480px)'),
            'psba-large' => __('Large (up to 960px)'),
        ]);
    }

    public function addMetaBoxes()
    {
        parent::addMetaBoxes();
        $this->addParentPageMetaBoxes();
        $this->addMultiContentPageMetaBoxes();
        $this->addContactPageMetaBoxes();
        $this->addPersonnelPageMetaBoxes();
        $this->addPortalPageMetaBoxes();
    }

    public function createDefaultCategories()
    {
        wp_insert_term('News', 'category');
        wp_insert_term('Announcement', 'category');
        wp_insert_term('Event', 'category');

        wp_insert_term('Board Member', 'post_tag');
        wp_insert_term('Officer', 'post_tag');
        wp_insert_term('Faculty', 'post_tag');
        wp_insert_term('Graduate', 'post_tag');
        wp_insert_term('Undergraduate', 'post_tag');
        wp_insert_term('Senior High', 'post_tag');
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
                $page_template === 'templates/multi-content.php' ||
                $page_template === 'templates/contact-page.php' ||
                $page_template === 'templates/portal-page.php') {
            return $this->removeEditor();
        }
    }
}

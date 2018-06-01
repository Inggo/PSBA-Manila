<?php

namespace Inggo\WordPress\PSBAManila\Traits;

trait CMB2MetaBoxes
{
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

    private function addContactPageMetaBoxes()
    {
        $cmb = new_cmb2_box([
            'id'            => 'contact_page_metabox',
            'title'         => __('Contents', $this->slug),
            'object_types'  => ['page'],
            'show_on'       => ['key' => 'page-template', 'value' => 'templates/contact-page.php'],
            'context'       => 'normal',
            'priority'      => 'high',
            'show_names'    => true
        ]);

        $cmb->add_field([
            'name' => 'Content',
            'id'   => 'content_top',
            'type' => 'wysiwyg',
            'options' => array(),
            'default' => '',
        ]);

        $group_field_id = $cmb->add_field([
            'id'          => 'contact_email_addresses',
            'type'        => 'group',
            'options'     => array(
                'group_title'   => __('Email {#}', $this->slug),
                'add_button'    => __('Add Email', $this->slug),
                'remove_button' => __('Remove Email', $this->slug),
                'sortable'      => true,
            ),
        ]);

        $cmb->add_group_field($group_field_id, [
            'name' => 'Title',
            'id'   => 'title',
            'type' => 'text',
        ]);

        $cmb->add_group_field($group_field_id, [
            'name' => 'Email',
            'id'   => 'email',
            'type' => 'text_email',
        ]);

        $group_field_id = $cmb->add_field([
            'id'          => 'contact_numbers',
            'type'        => 'group',
            'options'     => array(
                'group_title'   => __('Contact Number {#}', $this->slug),
                'add_button'    => __('Add Contact Number', $this->slug),
                'remove_button' => __('Remove Contact Number', $this->slug),
                'sortable'      => true,
            ),
        ]);

        $cmb->add_group_field($group_field_id, [
            'name' => 'Title',
            'id'   => 'title',
            'type' => 'text',
        ]);

        $cmb->add_group_field($group_field_id, [
            'name' => 'Contact Number',
            'id'   => 'contact_number',
            'type' => 'text',
        ]);
    }

    private function addPersonnelPageMetaBoxes()
    {
        $cmb = new_cmb2_box([
            'id'            => 'personnel_page_metabox',
            'title'         => __('Personnel Page', $this->slug),
            'object_types'  => ['page'],
            'show_on'       => ['key' => 'page-template', 'value' => 'templates/personnel-page.php'],
            'context'       => 'normal',
            'priority'      => 'high',
            'show_names'    => true
        ]);

        $cmb->add_field([
            'name' => 'Page Type',
            'type' => 'select',
            'id' => 'personnel_page_type',
            'options' => [
                'board-members' => 'Board Members',
                'officers' => 'Officers',
                'faculty' => 'Faculty',
            ],
        ]);
    }

    private function addPortalPageMetaBoxes()
    {
        $cmb = new_cmb2_box([
            'id'            => 'portal_page_metabox',
            'title'         => __('Links', $this->slug),
            'object_types'  => ['page'],
            'show_on'       => ['key' => 'page-template', 'value' => 'templates/portal-page.php'],
            'context'       => 'normal',
            'priority'      => 'high',
            'show_names'    => true
        ]);

        $group_field_id = $cmb->add_field([
            'id'          => 'portal_page_contents',
            'type'        => 'group',
            'options'     => array(
                'group_title'   => __('Page {#}', $this->slug),
                'add_button'    => __('Add Page', $this->slug),
                'remove_button' => __('Remove Page', $this->slug),
                'sortable'      => true,
            ),
        ]);

        $cmb->add_group_field($group_field_id, [
            'name' => 'Image',
            'id'   => 'image',
            'type' => 'file',
        ]);

        $cmb->add_group_field($group_field_id, [
            'name' => 'Text',
            'id'   => 'text',
            'type' => 'textarea_small',
        ]);

        $pages = get_pages([
            'post_type' => 'page',
        ]);

        foreach ($pages as $page) {
            $page_select[$page->ID] = $page->post_title;
        }

        $cmb->add_group_field($group_field_id, [
            'name' => 'Page',
            'id'   => 'page',
            'type' => 'select',
            'show_option_none' => true,
            'options' => $page_select,
        ]);
    }
}
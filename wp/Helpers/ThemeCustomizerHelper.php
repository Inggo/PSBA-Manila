<?php

namespace Inggo\WordPress;

use WP_Customize_Manager;
use WP_Customize_Control;
use WP_Customize_Image_Control;

class ThemeCustomizerHelper
{
    protected $manager;
    private $pages = null;
    private $slug = '';

    /**
     * Create a ThemeCustomizer object and manage dependencies
     * @param WP_Customize_Manager  $manager  Reference to the WP_Customize_Manager object
     */
    public function __construct($slug = '')
    {
        $this->slug = $slug;
    }

    public function setManager(WP_Customize_Manager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Adds a section to the customizer
     * @param string   $name      Name of the section
     * @param string   $title     Label of the section
     * @param integer  $priority  Priority of the section
     */
    public function addSection($name, $title, $priority = 120)
    {
        $this->manager->add_section($name, array(
            'title'      => __($title, $this->slug),
            'priority'   => $priority,
            'capability' => 'edit_theme_options',
        ));
    }

    /**
     * Add a page select control to a section
     * @param string  $name         Name of the control
     * @param string  $section      Section where the control will go
     * @param string  $label        Label of the control
     * @param string  $description  Description of the control
     */
    public function addPagesControl($name, $section, $label, $description = '')
    {
        $this->addControl($name, $section, $label, $description, 'select', $this->getFlatPageArray(), 0);
    }

    public function addImageControl($name, $section, $label, $description = '')
    {
        $this->addSetting($name);
        $this->manager->add_control(new WP_Customize_Image_Control(
            $this->manager,
            $name,
            array(
                'label'       => __($label, $this->slug),
                'description' => __($description, $this->slug),
                'section'     => $section,
                'settings'    => $name,
            )
        ));
    }

    /**
     * Adss a control to a section
     * @param string  $name         Name of the control
     * @param string  $section      Section where the control will go
     * @param string  $label        Label of the control
     * @param string  $description  Description of the control
     * @param string  $type         Type of the control (text|textarea)
     * @param array   $choices      Choices for select|radio|checkbox type controls
     */
    public function addControl($name, $section, $label, $description = '', $type = 'text', $choices = [], $default = '')
    {
        $this->addSetting($name);
        $this->manager->add_control(new WP_Customize_Control(
            $this->manager,
            $name,
            array(
                'label'       => __($label, $this->slug),
                'description' => __($description, $this->slug),
                'section'     => $section,
                'settings'    => $name,
                'type'        => $type,
                'choices'     => $choices,
                'default'     => $default,
            )
        ));
    }

    /**
     * Add a setting
     * @param string  $name  Name of the setting
     */
    public function addSetting($name)
    {
        $this->manager->add_setting($name, array(
            'default'   => '',
            'type'      => 'option',
            'transport' => 'postMessage',
        ));
    }

    /**
     * Get a flat array for all pages with ID as Key and Title as Value
     * @return array  Flat array of all pages
     */
    private function getFlatPageArray()
    {
        if (is_array($this->pages)) {
            return $this->pages;
        }

        $pages = get_pages();

        // Create blank selection
        $this->pages[0] = "-none-";

        foreach ($pages as $page) {
            $this->pages[$page->ID] = $page->post_title;
        }

        return $this->pages;
    }
}

<?php

namespace Inggo\WordPress;

use Inggo\WordPress\Contracts\Customizer;
use Inggo\WordPress\ThemeCustomizeHelper;

use WP_Customize_Manager;

class ThemeCustomizer implements Customizer
{
    // Reference to the ThemeCustomizeHelper object
    protected $ch;
    public $social = array(
        'facebook'  => 'Facebook',
        'twitter'   => 'Twitter',
        'linkedin'  => 'LinkedIn',
        'google'    => 'Google+',
        'instagram' => 'Instagram',
    );

    protected $slug;

    public function __construct($slug = 'theme')
    {
        $this->slug = $slug;
        $this->ch = new ThemeCustomizerHelper($slug);
    }

    /**
     * Register the customize controls
     * @param  WP_Customize_Manager $wp_customize WP_Customize_Manager object
     */
    public function register(WP_Customize_Manager $manager)
    {
        $this->ch->setManager($manager);
        $this->initializeContactDetails();
        $this->initializeSocialMedia();
        $this->initializeFooterPages();
    }

    /**
     * Initialize Contact Details section and fields
     */
    private function initializeContactDetails()
    {
        $this->ch->addSection($this->slug . '_contact_details', 'Contact Details');
        $this->ch->addControl('contact_address', $this->slug . '_contact_details', 'Address', '', 'textarea');
        $this->ch->addControl('contact_number', $this->slug . '_contact_details', 'Contact Number');
        $this->ch->addControl('contact_email', $this->slug . '_contact_details', 'Email Address');
    }

    /**
     * Initialize Social Media section and fields
     */
    private function initializeSocialMedia()
    {
        $this->ch->addSection($this->slug . '_social_media', 'Social Media', 130);
        foreach ($this->social as $media => $label) {
            $this->ch->addControl("social_{$media}", $this->slug . '_social_media', $label);
        }
    }

    /**
     * Initialize Footer Pages section and fields
     */
    private function initializeFooterPages()
    {
        $this->ch->addSection($this->slug . '_footer_pages', 'Footer Pages', 140);
        $this->ch->addPagesControl('footer_privacy_policy', $this->slug . '_footer_pages', 'Privacy Policy Page');
        $this->ch->addPagesControl('footer_cookie_policy', $this->slug . '_footer_pages', 'Cookie Policy Page');
    }

    /**
     * Get social options
     */
    public function getSocialOptions()
    {
        return array_map(function ($media) {
            return "social_{$media}";
        }, array_keys($this->social));
    }
}

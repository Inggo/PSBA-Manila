<?php

namespace Inggo\WordPress;

use Inggo\WordPress\Contracts\Customizer;
use Inggo\WordPress\Helpers\ThemeCustomizeHelper;

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


    // Uses Ionic Icons: https://ionic.io/ionicons
    public $contact_types = [
        'call'                => 'Phone',
        'phone-portrait'      => 'Mobile',
        'mail'                => 'Email',
        'location'            => 'Location',
        'chatbubble-ellipses' => 'SMS'
    ];

    protected $slug;

    protected $max_contact = 4;

    public function __construct($slug = 'theme')
    {
        $this->slug = $slug;
        $this->ch = new Helpers\ThemeCustomizerHelper($slug);
    }

    /**
     * Register the customize controls
     * @param  WP_Customize_Manager $wp_customize WP_Customize_Manager object
     */
    public function register(WP_Customize_Manager $manager)
    {
        $this->ch->setManager($manager);
        $this->initializeSocialMedia();
        $this->initializeContactInfo();
        $this->initializeFooterPages();
        $this->initializeCopyrightInfo();
        $this->initializeGoogleAnalytics();
    }

    private function initializeContactInfo()
    {
        $this->ch->addSection($this->slug . '_contact_info', 'Contact Info', 135);
        for ($i = 1; $i <= $this->max_contact; $i++) {
            $this->ch->addControl("contact_{$i}", $this->slug . '_contact_info', "Contact Info {$i}");
            $this->ch->addControl("contact_{$i}_type", $this->slug . '_contact_info', "Contact Type", "", "select", $this->contact_types);
        }
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

    private function initializeCopyrightInfo()
    {
        $this->ch->addSection($this->slug . '_copyright_info', 'Copyright Info', 150);
        $this->ch->addControl('copyright', $this->slug . '_copyright_info', 'Copyright Text', '', 'textarea');
    }

    private function initializeGoogleAnalytics()
    {
        $this->ch->addSection($this->slug . '_google_analytics', 'Google Analytics', 150);
        $this->ch->addControl('google_analytics', $this->slug . '_google_analytics', 'Tracking ID');
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

    public function getContactInfo()
    {
        $contact_info = [];
        for ($i = 1; $i <= $this->max_contact; $i++) {
            if (get_option("contact_{$i}") == "") continue;
            $contact_info[get_option("contact_{$i}_type")] = get_option("contact_{$i}");
        }
        
        return $contact_info;
    }
}

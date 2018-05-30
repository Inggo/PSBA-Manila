<?php

namespace Inggo\WordPress\PSBAManila\Traits;

trait ContentOverrides
{
    public function overridePageContents($post_id, $post, $update)
    {
        parent::overridePageContents($post_id, $post, $update);
        
        $page_template = get_post_meta($post_id, '_wp_page_template', true);

        if ($page_template === 'templates/multi-content.php') {
            return $this->overrideMultiPageContents($post);
        }

        if ($page_template === 'templates/contact-page.php') {
            return $this->overrideContactPageContents($post);
        }

        if ($page_template === 'templates/portal-page.php') {
            return $this->overridePortalPageContents($post);
        }
    }

    private function overrideMultiPageContents($post)
    {
        $contents = get_post_meta($post->ID, 'multi_page_contents', true);

        // Clear post content
        $post->post_content = "";

        // Append caption and CTA to post content as cards
        foreach ($contents as $index => $content) {
            $post->post_content .= "<h3 class='card-header'>" . $content['title'] . "</h3>\n";
            $post->post_content .= "<div class='card-body'><div class='card-text'>" . $content['content'] . "</div></div>\n";
        }

        remove_action('save_post', [$this, 'overridePageContents']);

        wp_update_post($post);

        add_action('save_post', [$this, 'overridePageContents'], 10, 3);
    }

    private function overrideContactPageContents($post)
    {
        $contents = get_post_meta($post->ID, 'content_top', true);
        $emails = get_post_meta($post->ID, 'contact_email_addresses', true);
        $contact_numbers = get_post_meta($post->ID, 'contact_numbers', true);

        // Clear post content
        $post->post_content = $contents . "\n\n";

        // Append email addresses
        $post->post_content .= "<div class='row contact-details'><div class='col-md-6'>";
        $post->post_content .= "<div class='card'><div class='card-body'>";
        $post->post_content .= "<h5 class='card-title text-center'>Email Addresses</h5>";
        $post->post_content .= "<div class='list-group text-center'>";

        foreach ($emails as $index => $content) {
            $post->post_content .= "<a class='list-group-item' href='mailto:";
            $post->post_content .= $content['email'] . "' title='" . $content['title'] . " - ";
            $post->post_content .= $content['email'] . "'>";
            $post->post_content .= "<b>" . $content['title'] . "</b>\n";
            $post->post_content .= $content['email'];
            $post->post_content .= "</a>";
        }

        $post->post_content .= "</div></div></div></div>";

        // Append contact numbers
        $post->post_content .= "<div class='col-md-6'>";
        $post->post_content .= "<div class='card'><div class='card-body'>";
        $post->post_content .= "<h5 class='card-title text-center'>Contact Numbers</h5>";
        $post->post_content .= "<div class='list-group text-center'>";

        foreach ($contact_numbers as $index => $content) {
            $post->post_content .= "<a class='list-group-item' href='tel:";
            $post->post_content .= $content['contact_number'] . "' title='" . $content['title'] . " - ";
            $post->post_content .= $content['contact_number'] . "'>";
            $post->post_content .= "<b>" . $content['title'] . "</b>\n";
            $post->post_content .= $content['contact_number'];
            $post->post_content .= "</a>";
        }

        $post->post_content .= "</div></div></div></div></div>";

        remove_action('save_post', [$this, 'overridePageContents']);

        wp_update_post($post);

        add_action('save_post', [$this, 'overridePageContents'], 10, 3);
    }

    private function overridePortalPageContents($post)
    {
        $contents = get_post_meta($post->ID, 'portal_page_contents', true);

        // Clear post content
        $post->post_content = "<div class='row no-gutters'><div class='card-deck'>";

        foreach ($contents as $index => $content) {
            $post->post_content .= "<div class='card'>";
            $post->post_content .= "<a href='" . get_the_permalink($content['page']) . "'>";
            $post->post_content .= "<img src='" . $content['image'] . "' alt =''>";
            $post->post_content .= "</a>";
            $post->post_content .= "<div class='card-body'>";
            $post->post_content .= "<p class='text-center'>" . $content['text'] . "</p>";
            $post->post_content .= "</div></div>";
        }

        $post->post_content .= "</div></div>";

        remove_action('save_post', [$this, 'overridePageContents']);

        wp_update_post($post);

        add_action('save_post', [$this, 'overridePageContents'], 10, 3);
    }
}
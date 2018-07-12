<?php

namespace Inggo\WordPress\PSBAManila\Traits;

use WP_Query;

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

        if ($page_template === 'templates/personnel-page.php') {
            return $this->overridePersonnelPageContents($post);
        }
    }

    protected function overrideMultiPageContents($post)
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

    protected function overrideContactPageContents($post)
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

    protected function overridePortalPageContents($post)
    {
        $contents = get_post_meta($post->ID, 'portal_page_contents', true);

        // Clear post content
        $post->post_content = "<div class='row no-gutters'><div class='card-deck'>";

        foreach ($contents as $index => $content) {
            $post->post_content .= "<div class='card'>";
            $post->post_content .= "<a href='" . get_the_permalink($content['page']) . "' class='a-img'>";
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

    protected function overridePersonnelPageContents($post)
    {
        $page_type = get_post_meta($post->ID, 'personnel_page_type', true);

        if ($page_type == 'board-members') {
            return $this->applyBoardMemberPersonnel($post);
        }

        if ($page_type == 'officers') {
            return $this->applyOfficerPersonnel($post);
        }

        if ($page_type == 'faculty') {
            return $this->applyFacultyPersonnel($post);
        }
    }

    protected function applyBoardMemberPersonnel($post)
    {
        $personnel = get_posts([
            'post_type' => 'personnel',
            'tag' => 'board-member',
            'order' => 'ASC',
            'orderby' => 'menu_order',
            'posts_per_page' => -1,
        ]);

        // Clear post content
        $post_content = "<div class='row row-eq-height board-members'>";

        foreach ($personnel as $person) {
            $post_content .= "<div class='col col-md-6'><div class='card personnel-card'><div class='card-body text-center'>";

            if (has_post_thumbnail($person->ID)) {
                $post_content .= "<p><img src='" . get_the_post_thumbnail_url($person->ID) . "' alt='" . $person->post_title . "'></p>";
            }

            $post_content .= "<h5>" . get_post_meta($person->ID, 'board_position', true) . "</h5>";
            $post_content .= '<p><b>' . $person->post_title . '</b>';

            if ($title = get_post_meta($person->ID, 'titles', true)) {
                $post_content .= ', ' . $title;
            }

            $post_content .= '</p>';
            $post_content .= "</div></div></div>";
        }

        $post_content .= "</div>";

        $post->post_content = $post_content;

        remove_action('save_post', [$this, 'overridePageContents']);

        wp_update_post($post);

        add_action('save_post', [$this, 'overridePageContents'], 10, 3);
    }

    protected function applyOfficerPersonnel($post)
    {
        $personnel = get_posts([
            'post_type' => 'personnel',
            'tag' => 'officer',
            'order' => 'ASC',
            'orderby' => 'menu_order',
            'posts_per_page' => -1,
        ]);

        // Clear post content
        $post_content = "<div class='row officers'>";

        foreach ($personnel as $person) {
            $post_content .= "<div class='col col-12'><div class='card personnel-card'><div class='card-body text-center'>";

            if (has_post_thumbnail($person->ID)) {
                $post_content .= "<p><img src='" . get_the_post_thumbnail_url($person->ID) . "' alt='" . $person->post_title . "'></p>";
            }

            $post_content .= "<h5>" . $person->post_title;

            if ($title = get_post_meta($person->ID, 'titles', true)) {
                $post_content .= ', ' . $title;
            }

            $post_content .= "</h5>";
            $post_content .= '<p>' . get_post_meta($person->ID, 'officer_position', true) . '</p>';
            $post_content .= "</div></div></div>";
        }

        $post_content .= "</div>";

        $post->post_content = $post_content;

        remove_action('save_post', [$this, 'overridePageContents']);

        wp_update_post($post);

        add_action('save_post', [$this, 'overridePageContents'], 10, 3);
    }

    protected function applyFacultyPersonnel($post)
    {
        $personnel = get_posts([
            'post_type' => 'personnel',
            'tag' => 'faculty',
            'order' => 'ASC',
            'orderby' => 'title',
            'posts_per_page' => -1,
        ]);

        // Clear post content
        $post_content = "";

        $undergrad_content = "";
        $graduate_content = "";
        $shs_content = "";

        $faculty_modals = [];
        $faculty_modal_contents = [];

        foreach ($personnel as $person) {
            $modal_toggle = "<a href='javascript:;' data-toggle='modal' data-target='#faculty-" . $person->ID . "' class='disable-ps'>";
            $card_content = "<div class='col col-4'><div class='card personnel-card'><div class='card-body text-center'>";

            if (has_post_thumbnail($person->ID)) {
                $card_content .= "<p>{$modal_toggle}<img src='" . get_the_post_thumbnail_url($person->ID) . "' alt='" . $person->post_title . "'></a></p>";
            }

            $card_content .= "<h6>{$modal_toggle}" . $person->post_title;
            $card_content .= "</a></h6>";

            $modal_content = get_post_meta($person->ID, 'faculty_bio', true);

            if ($modal_content && !in_array($person->ID, $faculty_modals)) {
                $faculty_modals[] = $person->ID;
                $faculty_modal_content .= '<div class="modal fade" tabindex="-1" role="dialog" id="faculty-' . $person->ID . '">';
                $faculty_modal_content .= '<div class="modal-dialog modal-dialog-centered" role="document">';
                $faculty_modal_content .= '<div class="modal-content">';
                $faculty_modal_content .= '<div class="modal-header">';
                $faculty_modal_content .= '<h5 class="modal-title">' . $person->post_title . '</h5>';
                $faculty_modal_content .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                $faculty_modal_content .= '<span aria-hidden="true">&times;</span>';
                $faculty_modal_content .= '</button>';
                $faculty_modal_content .= '</div>';
                $faculty_modal_content .= '<div class="modal-body">';
                $faculty_modal_content .= $modal_content;
                $faculty_modal_content .= '</div></div></div></div>';
                $faculty_modal_contents[] = $faculty_modal_content;
            }

            $card_content .= "</div></div></div>";

            if (has_term('graduate', 'post_tag', $person)) {
                $graduate_content .= $card_content;
            }

            if (has_term('undergraduate', 'post_tag', $person)) {
                $undergrad_content .= $card_content;
            }

            if (has_term('senior-high', 'post_tag', $person)) {
                $shs_content .= $card_content;
            }
        }

        $valid_contents = [];

        if ($undergrad_content != "") {
            $undergrad_content = "<div class='row row-eq-height faculty faculty-undergraduate'>" .
                "<h4 class='col col-12'>Undergraduate Program Faculty</h4>" .
                $undergrad_content . "</div>";
            $valid_contents[] = $undergrad_content;
        }
        
        if ($graduate_content != "") {
            $graduate_content = "<div class='row faculty faculty-graduate'>" .
                "<h4 class='col col-12'>Graduate Program Faculty</h4>" .
                $graduate_content . "</div>";
            $valid_contents[] = $graduate_content;
        }

        if ($shs_content != "") {
            $shs_content = "<div class='row faculty faculty-shs'>" .
                "<h4 class='col col-12'>Senior High School Faculty</h4>" .
                $shs_content . "</div>";
            $valid_contents[] = $shs_content;
        }

        $post_content .= implode("<hr>", $valid_contents);

        foreach ($faculty_modal_contents as $modal_content) {
            $post_content .= $modal_content;
        }

        $post->post_content = $post_content;

        remove_action('save_post', [$this, 'overridePageContents']);

        wp_update_post($post);

        add_action('save_post', [$this, 'overridePageContents'], 10, 3);
    }
}

<?php

$title = get_post_meta($post->ID, 'page_title', true);

$fields = [
    'concept_note' => 'Concept Note',
    'speaker_profiles' => 'Speaker Profiles',
    'program_of_activities' => 'Program of Activities',
    'abstracts' => 'Abstracts',
    'proceedings' => 'Proceedings',
    'location' => 'Venue Map / Location',
    'gallery' => 'Gallery',
];

$contents = [];

foreach ($fields as $field => $t) {
    $content = get_post_meta($post->ID, $field, true);

    if (!$content) {
        continue;
    }

    $contents[$field] = $content;

    if (!isset($first_tab)) {
        $first_tab = $field;
    }
}

function print_proceedings_content($field, $content)
{
    if ($field === 'gallery') {
        return print_proceedings_gallery($content);
    }
    return do_shortcode($content);
}

function print_proceedings_gallery($gallery)
{
    foreach ($gallery as $section) {
        ?>
        <h4><?= $section["section_title"]; ?></h4>
        <div class="proceedings-gallery row">
        <?php
        if (array_key_exists("gallery", $section) && $section["gallery"]):
            foreach ($section["gallery"] as $attachment_id => $attachment_url):
            ?>
            <div class="col-sm-3 col-md-2">
                <figure>
                    <a href="<?= $attachment_url ?>">
                        <?= wp_get_attachment_image($attachment_id, 'thumbnail'); ?>
                    </a>
                    <?php if (wp_get_attachment_caption($attachment_id)): ?>
                    <figcaption><?= wp_get_attachment_caption($attachment_id); ?></figcaption>
                    <?php endif; ?>
                </figure>
            </div>
            <?php
            endforeach;
        endif;
        ?>
        </div>
        <?php
    }
}

?>
<h2><?= $title ? $title : get_the_title(); ?></h2>
<section class="container">
    <div class="row justify-content-md-center">
        <div class="col col-md-3">
            <div class="list-group" id="page-tabs" role="tablist" aria-orientation="vertical">
                <?php foreach ($contents as $field => $content): ?>
                <a class="list-group-item
                    <?= $field == $first_tab ? 'active' : '' ?>"
                    id="event-<?= $field ?>-tab"
                    data-toggle="tab"
                    href="#event-<?= $field ?>"
                    role="tab"
                    aria-controls="event-tab-contents"
                    aria-selected="event-<?= $field ?>"
                >
                    <?= $fields[$field]; ?>
                </a>
                <?php endforeach; ?>
                
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content" id="event-tab-contents">
                <?php foreach ($contents as $field => $content): ?>
                <div class="tab-pane fade <?= $field == $first_tab ? 'active show' : '' ?>" id="event-<?= $field ?>">
                    <article class="card">
                        <h3 class="card-header"><?= $fields[$field]; ?></h3>
                        <div class="card-body">
                            <?= print_proceedings_content($field, $content); ?>
                        </div>
                    </article>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

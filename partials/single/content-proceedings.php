<?php

$title = get_post_meta($post->ID, 'page_title', true);

$fields = [
    'concept_note' => 'Concept Note',
    'speaker_profiles' => 'Speaker Profiles',
    'program' => 'Program of Activities',
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

?>
<h2><?= $title ? $title : get_the_title(); ?></h2>
<section class="container">
    <div class="row justify-content-md-center">
        <div class="col col-md-3">
            <div class="list-group" id="page-tabs" role="tablist" aria-orientation="vertical">
                <?php foreach ($contents as $field => $content): ?>
                <a class="list-group-item
                    <?= $field == $first_tab ? 'active' : '' ?>"
                    id="<?= $post->post_name . '-' . $field ?>-tab"
                    data-toggle="tab"
                    href="#<?= $post->post_name . '-' . $field ?>"
                    role="tab"
                    aria-controls="<?= $post->post_name ?>-tab-contents"
                    aria-selected="<?= $post->post_name . '-' . $field ?>"
                >
                    <?= $fields[$field]; ?>
                </a>
                <?php endforeach; ?>
                
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content" id="<?= $post->post_name ?>-tab-contents">
                <?php foreach ($contents as $field => $content): ?>
                <div class="tab-pane fade
                    <?= $field == $first_tab ? 'active show' : '' ?>"
                    " id="<?= $post->post_name . '-' . $field ?>">
                    <article class="card">
                        <h3 class="card-header"><?= $fields[$field]; ?></h3>
                        <div class="card-body">
                            <?php if ($field === 'gallery'): ?>
                                <div class="proceedings-gallery row">
                                <?php foreach ($content as $photo_id => $photo): ?>
                                    <div class="col col-3">
                                        <a href="<?= $photo; ?>">
                                            <?= wp_get_attachment_image($photo_id, 'thumbnail') ?>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                            <?= $content; ?>
                            <?php endif; ?>
                        </div>
                    </article>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

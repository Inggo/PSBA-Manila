<?php

get_template_part('partials/front-page/content', 'banners');

$tabs = [
    'announcements' => 'Announcements',
    'news' => 'News &amp; Events',
    'links' => 'Partners &amp; Linkages',
];

?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="front-page-tabs">
                <ul class="nav nav-tabs justify-content-center" role="tablist">
                    <?php $index = 0; foreach ($tabs as $tab => $label): ?>
                    <li class="nav-item">
                        <a class="nav-link
                            <?php if ($index === 0): ?>
                            active
                            <?php endif; ?>
                            "
                            aria-controls="#tab-<?= $tab; ?>"
                            aria-selected="<?= ($index === 0) ? 'true' : 'false'; ?>"
                            href="#tab-<?= $tab; ?>"
                            data-toggle="tab"
                            id="nav-<?= $tab; ?>-tab"
                        ><h4><?= $label; ?></h4></a>
                    </li>
                    <?php $index++; endforeach; ?>
                </ul>    
                <div class="tab-content">
                    <?php $index = 0; foreach ($tabs as $tab => $label): ?>
                    <div class="tab-pane fade
                        <?php if ($index === 0): ?>
                        show active
                        <?php endif; ?>
                        " id="tab-<?= $tab; ?>" role="tabpanel" aria-labelledby="nav-<?= $tab; ?>-tab"
                    >
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <?php get_template_part('partials/archive', $tab); ?>
                            </div>
                        </div>
                    </div>
                    <?php $index++; endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div id="events-calendar">
                <full-calendar :events="events"></full-calendar>
            </div>
        </div>
    </div>
</div>
<?php
// Isolate to own page
$event_posts = get_posts([
    'post_type' => 'event',
    'posts_per_page' => -1,
    'post_status' => 'publish'
]);

$events = [];

foreach ($event_posts as $post) {
    $events[] = [
        'title' => $post->post_title,
        'start' => $post->start_date,
        'end' => $post->end_date,
        'color' => $post->event_color
    ];
}

?>
<script>
window.calendar_events = <?php echo json_encode($events); ?>
</script>

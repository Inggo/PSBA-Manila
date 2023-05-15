<?php

get_template_part('partials/front-page/content', 'banners');

$tabs = [
    'announcements' => 'Announcements',
    'news' => 'News &amp; Events',
    'links' => 'Partners &amp; Linkages',
];

?>
<div class="container-fluid p-0" id="front-page-contents">
    <?php echo $post->post_content; ?>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
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
    </div>
</div>

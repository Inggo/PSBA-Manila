<?php

$banners  = get_post_meta(get_the_ID(), 'front_page_banners', true);

if (!$banners || count($banners) === 0) {
    return;
}

?>
<div id="front-page-banners" class="front-page-banners carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php foreach ($banners as $index => $banner): ?>
        <li data-target="#front-page-banners"
            data-slide-to="<?= $index; ?>"
            <?php if ($index === 0): ?>
            class="active"
            <?php endif; ?>
        ></li>
        <?php endforeach; ?>
    </ol>
    <div class="carousel-inner">
        <?php foreach ($banners as $index => $banner): ?>
        <div
            class="carousel-item
            <?php if ($index === 0): ?>
            active
            <?php endif; ?>
            banner-item"
        >
            <img class="d-block w-100" src="<?= $banner['image'] ?>" alt="">
            <?php if (isset($banner['caption']) && $banner['caption']): ?>
            <div class="banner-caption">
                <?= nl2br($banner['caption']); ?>
            </div>
            <?php endif; ?>

            <?php if (isset($banner['cta_button']) && $banner['cta_button']): ?>
                <a class="banner-cta <?= $banner['cta_class'] ?> btn"
                    href="<?= isset($banner['cta_url']) && $banner['cta_url'] ? $banner['cta_url'] : '#' ?>"
                    role="button"
                >
                    <?= $banner['cta_button']; ?>
                </a>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
    <a class="carousel-control-prev" href="#front-page-banners" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#front-page-banners" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

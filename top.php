<?php global $theme; ?>
<header class="site-header">
  <section class="site-header--top">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="tagline text-center">
            <?php bloginfo('description'); ?>
          </div>
        </div>
        <div class="col-md-4">
          <ul class="social-media">
            <?php foreach ($theme->customizer->getSocialOptions() as $socialMedia): ?>
              <?php if (get_option($socialMedia) && get_option($socialMedia) !== ''): ?>
                  <li class="social-media--item"><a href="<?=get_option($socialMedia);?>" target="_blank"><i class="social-media--icon icon-<?=$socialMedia?>"></i></a>
              <?php endif; ?>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <section class="site-header--main">
    <div class="container">
      <div class="row no-gutters">
        <div class="col-6 col-md-2">
          <?php if (get_option('header_logo')): ?>
          <div class="site-logo">
            <a href="/">
              <img src="<?=get_option('header_logo');?>" alt="<?php bloginfo('name'); ?>">
            </a>
          </div>
          <?php endif; ?>
        </div>
        <div class="col-6 col-md-10">
          <h1 class="site-title"><?php if (get_option('header_title')): ?>
          <?=(get_option('header_title'))?>
          <?php else: ?>
          <?php bloginfo('name'); ?>
          <?php endif; ?></h1>
        </div>
      </div>
    </div>
  </section>
</header>
<!doctype html>
<html lang="en" class="no-js">
  <head>
    <?php if (get_option('google_analytics')): ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= esc_js(get_option('google_analytics')); ?>"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', '<?= esc_js(get_option('google_analytics')); ?>');
    </script>
    <?php endif; ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php bloginfo('name') . (!is_front_page() ? ' | ' . wp_title('') : ''); ?></title>
    <?php wp_head(); ?>
</head>
<body <?=body_class();?>>
<?php

get_template_part('top');
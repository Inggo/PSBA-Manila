<!doctype html>
<html lang="en" class="no-js">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php bloginfo('name') . (!is_front_page() ? ' | ' . wp_title('') : ''); ?></title>
    <?php wp_head(); ?>
</head>
<body <?=body_class();?>>
<?php

get_template_part('top');
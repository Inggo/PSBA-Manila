<!DOCTYPE html>
<html class="no-js">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php bloginfo('name') . (!is_front_page() ? ' | ' . wp_title('') : ''); ?></title>
    <?php wp_head(); ?>
</head>
<body <?=body_class($post->post_name);?>>

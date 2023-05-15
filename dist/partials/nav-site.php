<?php

class PSBA_Nav_Menu extends Walker_Nav_Menu
{
    public function end_el(&$output, $data_object, $depth = 0, $args = null) {
        if ($depth > 0 && isset($data_object->classes) && in_array("menu-item-has-children", $data_object->classes)) {
            $output .= "<button class=\"sub-menu-toggle btn btn-primary\">&plus;</button>";
        }
        parent::end_el($output, $data_object, $depth, $args);
    }   
}

?>
<nav class="navbar navbar-expand-lg navbar-dark align-self-center">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <?php
    wp_nav_menu(array(
        'theme_location'  => 'main_menu',
        'container'       => 'div',
        'container_class' => 'collapse navbar-collapse',
        'container_id'    => 'main-menu',
        'menu_class'      => 'navbar-nav mr-auto ml-auto',
        'walker'          => new PSBA_Nav_Menu()
    ));
    ?>
</nav>

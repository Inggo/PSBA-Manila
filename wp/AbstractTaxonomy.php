<?php

namespace Inggo\WordPress;

abstract class AbstractTaxonomy
{
    public function __construct()
    {
        add_action('init', [$this, 'register'], 0);
    }

    abstract public function register();
}

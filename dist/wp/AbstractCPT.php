<?php

namespace Inggo\WordPress;

abstract class AbstractCPT
{
    public function __construct()
    {
        add_action('init', [$this, 'register'], 0);
    }

    abstract public function register();
}

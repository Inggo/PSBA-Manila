<?php

namespace Inggo\WordPress;

abstract class AbstractCPT
{
    public function __construct()
    {
        add_action('init', [$this, 'register'], 1);
    }

    abstract public function register();
}

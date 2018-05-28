<?php

namespace Inggo\WordPress\PSBAManila;

use Inggo\WordPress\Admin as BaseAdmin;

class Admin extends BaseAdmin
{
    public function __construct()
    {
        parent::__construct('psba-manila');
    }
}

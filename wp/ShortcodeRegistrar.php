<?php

namespace Inggo\WordPress;

use Inggo\WordPress\Shortcodes\Alert;
use Inggo\WordPress\Shortcodes\Caption;

class ShortcodeRegistrar
{
    protected $shortcodes;

    public function __construct()
    {
        $this->shortcodes[] = new Alert();
        $this->shortcodes[] = new Caption();
    }
}

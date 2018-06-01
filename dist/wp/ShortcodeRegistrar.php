<?php

namespace Inggo\WordPress;

use Inggo\WordPress\Shortcodes\Alert;

class ShortcodeRegistrar
{
    protected $shortcodes;

    public function __construct()
    {
        $this->shortcodes[] = new Alert();
    }
}

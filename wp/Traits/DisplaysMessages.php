<?php

namespace Inggo\WordPress\Traits;

trait DisplaysMessages
{
    private function printError ($message)
    {
        echo '<div class="error"><p>' . __($message, 'psba-manila') . '</p></div>';
    }
}
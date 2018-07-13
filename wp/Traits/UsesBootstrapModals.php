<?php

namespace Inggo\WordPress\Traits;

trait UsesBootstrapModals
{
    private function parseBootstrapModal($id, $title, $content, $footer = null, $closable = true)
    {
        $close_button = $closable
            ? '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                . '<span aria-hidden="true">&times;</span>'
                . '</button>'
            : '';

        $footer = $footer
            ? '<div class="modal-footer">'
                . $footer . '</div>'
            : '';

        $content = '<div class="modal fade" id="' . $id
            . '" tabindex="-1" role="dialog" aria-hidden="true">'
            . '<div class="modal-dialog" role="document">'
            . '<div class="modal-content">'
            . '<div class="modal-header">'
            . '<h3 class="modal-title">' . $title . '</h3>'
            . $close_button . '</div>'
            . '<div class="modal-body">'
            . $content . '</div>'
            . $footer . '</div></div></div>';

        return $content;
    }
}

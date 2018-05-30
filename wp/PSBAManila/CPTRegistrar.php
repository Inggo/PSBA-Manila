<?php

namespace Inggo\WordPress\PSBAManila;

use Inggo\WordPress\PSBAManila\CPT\Personnel;

class CPTRegistrar
{
    protected $cpts;

    public function __construct()
    {
        $this->cpts[] = new Personnel();
    }
}

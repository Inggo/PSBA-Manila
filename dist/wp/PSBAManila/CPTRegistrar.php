<?php

namespace Inggo\WordPress\PSBAManila;

use Inggo\WordPress\PSBAManila\CPT\Personnel;
use Inggo\WordPress\PSBAManila\CPT\Curriculum;
use Inggo\WordPress\PSBAManila\CPT\Proceedings;

class CPTRegistrar
{
    protected $cpts;

    public function __construct()
    {
        $this->cpts[] = new Personnel();
        $this->cpts[] = new Curriculum();
        $this->cpts[] = new Proceedings();
    }
}

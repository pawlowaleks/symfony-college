<?php

namespace App\Engine\Engine;

interface EngineInterface
{

    public function load(string $url): AbstractEntity;

}
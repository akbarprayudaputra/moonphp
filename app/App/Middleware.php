<?php

namespace Moonphp\Moonphp\App;

interface Middleware
{
    public function before(): void;
}
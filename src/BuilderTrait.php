<?php

namespace D2my\Builders;

use Illuminate\Support\Str;

trait BuilderTrait
{
    /**
     * @param string $method
     * @param string $replace
     * @return string
     */
    public function replaceMethodName(string $method, string $replace): string
    {
        return Str::of($method)->after($replace)->lcfirst();
    }
}
<?php

namespace FmTod\Quotes\Facades;

use FmTod\Quotes\Contracts\QuotesContract;
use Illuminate\Support\Facades\Facade;

class Quotes extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return QuotesContract::class;
    }
}
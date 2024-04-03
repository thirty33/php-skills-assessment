<?php

namespace FmTod\Quotes\Facades;

use Illuminate\Support\Facades\Facade;
use FmTod\Quotes\Contracts\QuotesContract;

class QuotesFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return QuotesContract::class;
    }
}
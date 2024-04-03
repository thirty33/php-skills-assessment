<?php

namespace App\Facades;

// use App\Repositories\RandomQuotesRepository;
use App\Contracts\QuotesContract;
use Illuminate\Support\Facades\Facade;

class Quotes extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return QuotesContract::class;
    }
}
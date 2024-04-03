<?php

namespace FmTod\Quotes\Contracts;

use App\Models\User;

interface QuotesContract
{
    public function getRandomQuotes(User $user, int $amount);
    public function getQuotesFromApi(int $amount);
}
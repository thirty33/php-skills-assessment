<?php

namespace App\Contracts;

use App\Models\User;

interface QuotesContract
{
    public function getRandomQuotes(User $user, int $amount);
}
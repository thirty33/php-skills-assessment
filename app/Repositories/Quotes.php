<?php

namespace App\Repositories;

use App\Contracts\QuotesContract;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Http\Request;


class Quotes implements QuotesContract
{
    public function getRandomQuotes(User $user, int $amount)
    {
        $favoriteQuoteIds = $user->quotes()->pluck('quote_id')->toArray() ?? [];

        $quotes = Quote::inRandomOrder()
            ->limit($amount)
            ->get();

        $quotes = $quotes->map(function ($quote) use ($favoriteQuoteIds) {
            $quote->favorite = in_array($quote->id, $favoriteQuoteIds);
            return $quote;
        });

        return $quotes;
    }

}
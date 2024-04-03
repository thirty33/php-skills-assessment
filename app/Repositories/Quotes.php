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

    public function getQuotesFromApi(int $amount)
    {
        $url = "https://dummyjson.com/quotes?limit=$amount&skip=0";

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($curl);

        curl_close($curl);

        $data = json_decode($response, true);

        if ($data === null) {
            throw new \Exception("Error al decodificar la respuesta JSON: " . curl_error($curl));
        }

        return $data["quotes"];
    }
}

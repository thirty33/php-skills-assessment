<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Facades\Quotes;
use App\Models\Quote;

class SetQuotes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:set-quotes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {

            $quotes = Quotes::getQuotesFromApi(1400);
            
            foreach ($quotes as $quoteData) {

                $quote = new Quote();

                $quote->quote = $quoteData["quote"];
                $quote->author = $quoteData["author"];

                $quote->save();
            }

        } catch (\Exception $e) {
            dd([
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
            ]);
        }
    }
}

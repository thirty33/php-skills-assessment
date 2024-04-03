<?php

namespace App\Http\Controllers;

use FmTod\Quotes\Models\Quote;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use \FmTod\Quotes\Facades\QuotesFacade;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
    */
    public function index(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
        ]);

        $quotes = QuotesFacade::getRandomQuotes($request->user(), $request->amount);

        return Inertia::render('Quotes/Index', [
            'quotes' => $quotes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function favorite(Request $request)
    {
        $quote = Quote::find($request->quote_id);

        $request
            ->user()
            ->quotes()
            ->attach($quote);

        return redirect()->route('quotes.index')
            ->with('status', 'favorite saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleleFavorite(Request $request, Quote $quote)
    {
        $request
            ->user()
            ->quotes()
            ->detach($quote);

        return redirect()
            ->route('quotes.favorites', $request->user()->id)
            ->with('status', 'favorite deleted');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function getFavoritesByUser(Request $request, User $user)
    {
        $quotes = $user->quotes()
            ->get();
        
        return Inertia::render('Quotes/FavoriteList', [
            'quotes' => $quotes
        ]);
    }
}

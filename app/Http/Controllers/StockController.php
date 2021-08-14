<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Stock;
use App\Models\Market;
use App\Models\Industry;
use Goutte;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apitest()
    {
        //
        $msg = "api test message!";
        return $msg;
    }

     public function index()
    {
        //
        $stocks = Stock::all();
        $uniquedMarketIds = $stocks->unique('market_id');   //キャメルケースOK、スネークケース、パスカルケースNG
        $uniquedIndustryIds = $stocks->unique('industry_id');   //キャメルケースOK、スネークケース、パスカルケースNG
        return view('dashboard', compact('stocks','uniquedMarketIds','uniquedIndustryIds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_markets($id)
    {
        //
        $stocks = Stock::all();
        $uniquedMarketIds = $stocks->unique('market_id');   //キャメルケースOK、スネークケース、パスカルケースNG
        $uniquedIndustryIds = $stocks->unique('industry_id');   //キャメルケースOK、スネークケース、パスカルケースNG

        $stock = Stock::where('id', $id)->first();
        $stocks = $stock::where('market_id', $stock->market_id)->get();
        //dd($stocks);
        return view('dashboard', compact('stocks','uniquedMarketIds','uniquedIndustryIds'));
        //return redirect('/dashboard');
    }

    public function show_industries($id)
    {
        //
        $stocks = Stock::all();
        $uniquedMarketIds = $stocks->unique('market_id');   //キャメルケースOK、スネークケース、パスカルケースNG
        $uniquedIndustryIds = $stocks->unique('industry_id');   //キャメルケースOK、スネークケース、パスカルケースNG

        $stock = Stock::where('id', $id)->first();
        $stocks = $stock::where('industry_id', $stock->industry_id)->get();
        //dd($stocks);
        return view('dashboard', compact('stocks','uniquedMarketIds','uniquedIndustryIds'));
        //return redirect('/dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

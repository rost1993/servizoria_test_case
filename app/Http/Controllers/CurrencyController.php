<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Currency;

class CurrencyController extends Controller
{
    public function index() {
        $currency = Currency::select(['name', 'code'])->get();

        return response()->json($currency);
    }
}

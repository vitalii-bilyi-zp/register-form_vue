<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;

class CountriesController extends Controller
{
    public function index()
    {
        $countries = Country::all();

        return response()->json($countries);
    }
}

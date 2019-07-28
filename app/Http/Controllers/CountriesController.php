<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Resources\Country as CountryResource;
use App\Country;
use Auth;

class CountriesController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return CountryResource::collection($countries);
    }
}

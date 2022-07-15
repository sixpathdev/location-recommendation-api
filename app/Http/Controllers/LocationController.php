<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocationRequest;
use App\Repositories\LocationRepository;
use Illuminate\Http\Request;


class LocationController extends Controller
{
    public function index()
    {
        return response()->json(['status' => 'success', 'data' => LocationRepository::getAll()], 200);
    }

    public function suggestPlaces($category)
    {
        return response()->json(['status' => 'success', 'data' => LocationRepository::getRandom($category)], 200);
    }

    public function store(StoreLocationRequest $request)
    {
        $data = LocationRepository::storeLocation($request->validated());
        return response()->json(['status' => 'success', 'data' => $data], 200);
    }
}

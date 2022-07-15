<?php

namespace App\Repositories;

use App\Models\Location;

class LocationRepository
{
    public static function getAll()
    {
        $locations = Location::get();
        return $locations;
    }

    public static function getRandom($category)
    {
        $locations = Location::where('location_category_id',$category)->get()->random(2);
        return $locations;
    }

    public static function storeLocation($data)
    {
        $location = Location::create($data);
        return $location;
    }
}

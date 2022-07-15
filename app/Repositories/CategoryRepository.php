<?php

namespace App\Repositories;

use App\Models\LocationCategory;

class CategoryRepository
{
    public static function getAll()
    {
        $categories = LocationCategory::get();
        return $categories;
    }

    public static function createCategory($data)
    {
        $newCategory = LocationCategory::create($data);
        return $newCategory;
    }
}

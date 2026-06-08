<?php

namespace App\Services;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\User;
use App\Notifications\NewProductNotification;
use Illuminate\Support\Facades\Auth;

class ProductService{

public function getFormData()
    {

        return [
            'categories' => Category::pluck('name','id'),
            'subcategories' => Subcategory::pluck('name','id'),
            'brands' => Brand::pluck('name','id')
        ];
    }

    // public function sendProductNotification($product,$action){
    // $super_admins = User::SuperAdmins()->get();
    // foreach ($super_admins as $super_admin) {
    //     $super_admin->notify(new NewProductNotification($product,$action));
    // }
    // Auth::user()->notify(new NewProductNotification($product,$action));

    // }

}
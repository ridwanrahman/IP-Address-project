<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function index()
    {
        Product::create([
            'name' => 'TV 32 Inche',
            'price' => 10000,
            'manufacturer_id' => 1
            ]);
        
            Product::create([
            'name' => 'Walton Fridge',
            'price' => 20000,
            'manufacturer_id' => 1
            ]);
        
            Product::create([
            'name' => 'IPS 7832',
            'price' => 25000,
            'manufacturer_id' => 2
            ]);
        
            echo "Product data inserted";
    }
}

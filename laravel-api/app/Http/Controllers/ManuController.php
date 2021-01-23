<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use App\Models\Product;
use Illuminate\Http\Request;

class ManuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');

    }//end __construct()
    //
    public function create_data()
    {
        error_log("asdfds");
        Manufacturer::create([
            'name'=>'ABC Trade',
            'address'=>'34, Mirpur, Dhaka',
            'phone'=>'123'
        ]);
        Manufacturer::create([
            'name'=>'rahimafroze',
            'address'=>'34, uttra, Dhaka',
            'phone'=>'123'
        ]);
        echo "Manufacturer data inserted";

    }

    public function select_data()
    {
        $manufacturer = Manufacturer::all();
        foreach($manufacturer as $manu) {
            $products = Product::where('manufacturer_id', $manu->id)->get();
            error_log($products);
        }

        
    }
}

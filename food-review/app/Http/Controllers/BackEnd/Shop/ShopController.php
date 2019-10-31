<?php

namespace App\Http\Controllers\BackEnd\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function getShops()
    {
        $shops = Shop::with('city')->paginate(5);
        return response()->json($shops, 200);
    }
}

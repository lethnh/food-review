<?php

namespace App\Http\Controllers\FrontEnd\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;

class GetShopController extends Controller
{
    public function index()
    {
        $shops = Shop::all();
        return $shops;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModProduct;
use App\ListProduct;

class ModProductsController extends Controller
{
    public function GetAllMod(){
        $modproduct = ModProduct::all();
        return respone()->json($modproduct);
    }
}

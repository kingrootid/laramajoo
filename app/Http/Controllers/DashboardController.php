<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data =  [
            'title' => env('APP_NAME'),
            'page' => 'Dashboard',
            'product' => Product::all()
        ];
        return view('dashboard', $data);
    }
}

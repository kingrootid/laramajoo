<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterController extends Controller
{
    public function category()
    {
        $data =  [
            'title' => env('APP_NAME'),
            'page' => 'Master Category',
            'user' => Auth::user(),
        ];
        return view('master.category', $data);
    }
    public function product()
    {
        $data =  [
            'title' => env('APP_NAME'),
            'page' => 'Master Product',
            'user' => Auth::user(),
            'category' => Category::all()
        ];
        return view('master.product', $data);
    }
}

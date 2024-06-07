<?php

namespace App\Http\Controllers;

use App\Http\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisplayController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            if ($user->del_flg === 0) {
                $stocks = Stock::with('product')->get();
                return view('admin.all_stores_list', compact('stocks'));
    
            } elseif ($user->del_flg === 1) {
                $stocks = Stock::with('product')->get();
                return view('general.inventory', compact('stocks'));
            }
        }
        
        return view('auth.login');
    }
}




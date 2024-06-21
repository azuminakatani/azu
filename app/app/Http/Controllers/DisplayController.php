<?php

namespace App\Http\Controllers;

use App\Stock;
use App\Store;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisplayController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            if ($user->del_flg === 0) {
                $stores = Store::all();
                return view('admin.all_stores_list', compact('stores'));
    
            } elseif ($user->del_flg === 1) {
                $stocks = Stock::where('store_id', Auth::user()->store_id)->get();
                return view('general.inventory', compact('stocks'));
            }
        }
        
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // ログインのバリデーション
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }
        return back()->withErrors([
            'email' => 'ログインに失敗しました。メールアドレスまたはパスワードが正しくありません。',
        ]);
    }
}




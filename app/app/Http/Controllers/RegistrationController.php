<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function register(Request $request)
    {
        return view('register');
    }

    public function confirm(Request $request)
    {
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ];

        return view('auth.confirm', compact('userData'));
    }
    
    public function complete(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->del_flg = 1;
        $user->save();

        return view('auth.complete');
    }


    public function search(Request $request)
{
    $keyword = $request->input('keyword');
    $stocks = Stock::whereHas('product', function ($query) use ($keyword) {
        $query->where('name', 'like', '%' . $keyword . '%');
    })->get();

    return view('inventory.search_results', compact('stocks'));
}
    
}


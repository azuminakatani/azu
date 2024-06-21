<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{

    public function register(Request $request){//新規登録
        return view('auth.register');
    }

    public function confirm(Request $request)//新規登録確認
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Session::put('registration_data', $validatedData);

        return view('auth.confirm', compact('validatedData'));
    }

    public function complete(Request $request)//新規登録完了
    {
        $userData = Session::get('registration_data');

        $user = new User();
        $user->name = $userData['name'];
        $user->email = $userData['email'];
        $user->password = Hash::make($userData['password']);
        $user->del_flg = 1;
        $user->save();

        Session::forget('registration_data');

        return view('auth.complete');
    }

    public function search(Request $request){//全店舗一覧

        $keyword = $request->input('keyword');
        $stocks = Stock::whereHas('product', function ($query) use ($keyword) {
        $query->where('name', 'like', '%' . $keyword . '%');
        })->get();

        return view('inventory.search_results', compact('stocks'));
    }

    public function allStoresList(){
        return view('admin.all_stores_list');
    }

    public function productList(){
        return view('admin.product_list');
    }
    
    public function ownStoreInventory(){//自店舗在庫一覧
        $stocks = Stock::where('store_id', Auth::user()->store_id)->get();
        return view('admin.own_store_inventory', compact('stocks'));
        }
            
    public function arrivalSchedule(){
        return view('admin.arrival_schedule');
        }
    
    public function employeeList(){
        return view('admin.employee_list');
        }
}


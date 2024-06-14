<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function register(Request $request){//新規登録
        return view('register');
    }

    public function confirm(Request $request){//新規登録確認
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ];
        return view('auth.confirm', compact('userData'));
    }
    
    public function complete(Request $request){//新規登録完了
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->del_flg = 1;
        $user->save();
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


<?php

namespace App\Http\Controllers;

use App\Stock;
use App\Store;
use App\Product;
use App\User;
use App\IncomingShipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function allStoresList(){//全店舗一覧
        $stores = Store::all();
        return view('admin.all_stores_list', compact('stores'));
    }

    public function productList(){//商品一覧
        $products = Product::all();
        return view('admin.product_list', compact('products')); 
    }
    public function productDelete($id){//商品削除
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('success', '商品が削除されました');
    }

    public function ownStoreInventory(){//自店舗一覧
        $stocks = Stock::where('store_id', Auth::user()->store_id)->get();
        return view('admin.own_store_inventory_list', compact('stocks'));
    }
            
    public function arrivalSchedule(){//入荷予定一覧
        $user = Auth::user();
        $incomingShipments = IncomingShipment::where('store_id', Auth::user()->store_id)->get();
        return view('admin.arrival_schedule_list', compact('incomingShipments'));
    }
    
    public function employeeList(){//一般社員一覧
        $employees = User::where('del_flg', 1)->get();
        return view('admin.employee_list', compact('employees'));
    }

    public function employeDelete($id){//商品削除
        $employee = User::findOrFail($id); 
        $employee->delete();
        return redirect()->back()->with('success', '社員が削除されました');
    }
    
    public function search(Request $request){//全店舗一覧

        $keyword = $request->input('keyword');
        $stocks = Stock::whereHas('product', function ($query) use ($keyword) {
        $query->where('name', 'like', '%' . $keyword . '%');
        })->get();

        return view('inventory.search_results', compact('stocks'));
    }
}

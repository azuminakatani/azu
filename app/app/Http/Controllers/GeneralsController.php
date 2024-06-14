<?php

namespace App\Http\Controllers;

use App\Stock;
use App\Store;
use App\Product;
use App\User;
use App\IncomingShipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class GeneralsController extends Controller
{
    public function index(){//在庫一覧
        $stocks = Stock::where('store_id', Auth::user()->store_id)->get();
        return view('general.inventory', compact('stocks'));
    }

    public function inventoryDelete($id){//在庫削除
        $stock = Stock::findOrFail($id);
        $stock->delete();
        return redirect()->back()->with('success', '在庫が削除されました');
    }
    
    public function inventorySearch(Request $request){//在庫一覧検索
        $keyword = $request->input('keyword');
        $store_id = auth()->user()->store_id; 
        $stocks = Stock::whereHas('product', function ($query) use ($keyword) {
        $query->where('name', 'like', '%' . $keyword . '%');})->where('store_id', $store_id)->get();
        return view('general.inventory', compact('stocks'));
    }

    public function arrivalList(){//入荷予定一覧
        $user = Auth::user();
        $incomingShipments = IncomingShipment::where('store_id', Auth::user()->store_id)->get();
        return view('general.arrival_list', compact('incomingShipments'));
    }

    public function arrivalListDelete($id){//入荷予定削除
        $incomingShipment = IncomingShipment::findOrFail($id);
        $incomingShipment->delete();
        return redirect()->back()->with('success', '入荷予定が削除されました');
    }

    public function arrivalListSearch(Request $request){//入荷予定検索
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $keyword = $request->input('keyword');
        $store_id = Auth::user()->store_id;
    
        $query = IncomingShipment::where('store_id', $store_id);
    
        if ($start_date) {
            $query->where('scheduled_date', '>=', $start_date);
        } 
    
        if ($end_date) {
            $query->where('scheduled_date', '<=', $end_date);
        }
    
        if ($keyword) {
            $query->whereHas('product', function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%');
            });
        }
    
        $incomingShipments = $query->get();
    
        return view('general.arrival_list', compact('incomingShipments', 'start_date', 'end_date', 'keyword'));
    }
    
    

    public function arrivalListShow($id){//入荷予定詳細
        $incomingShipment = IncomingShipment::findOrFail($id);
        return view('general.arrival_edit', compact('incomingShipment'));
    }

    public function arrivalListCreate(Request $request){//入荷登録画面表示
        return view('general.arrival_register');
    }    
    public function arrivalListStore(Request $request){//入荷登録画面表示
        return view('general.arrival_register');
    }

}

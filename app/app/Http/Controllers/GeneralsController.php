<?php

namespace App\Http\Controllers;

use App\Stock;
use App\Store;
use App\Product;
use App\User;
use App\IncomingShipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class GeneralsController extends Controller
{
    public function index(){//在庫一覧
        $stocks = Stock::where('store_id', Auth::user()->store_id)
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        
        return view('general.inventory', compact('stocks'));
    }

    public function infiniteScroll(Request $request){//
        $store_id = auth()->user()->store_id;
        $perPage = 10; 
        
        $stocks = Stock::where('store_id', $store_id)
                   ->orderBy('created_at', 'desc')
                   ->paginate($perPage);
                   
        if ($request->ajax()) {
            return response()->json([
                'stocks' => $stocks
            ]);
        } 
        return view('general.inventory', compact('stocks'));
    }


    public function inventoryDelete($id){//在庫削除
        $stock = Stock::findOrFail($id);
        $stock->delete();
        return redirect()->back()->with('success', '在庫が削除されました');
    }
    
    public function inventorySearch(Request $request)//在庫一覧検索
    {
        $keyword = $request->input('keyword');
        $store_id = auth()->user()->store_id;
        
        $query = Stock::where('store_id', $store_id);
        
        if (!empty($keyword)) {
            $query->whereHas('product', function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%');
            });
        }
        $stocks = $query->get();
        return view('general.inventory', compact('stocks', 'keyword'));
    }
    

    public function arrivalList(){//入荷予定一覧
        $user = Auth::user();
        $incomingShipments = IncomingShipment::where('store_id', Auth::user()->store_id)->get();
        return view('general.arrival_list', compact('incomingShipments'));
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
        $products = Product::all();
        return view('general.arrival_register', compact('products'));
    }    

    public function arrivalListStore(Request $request){//入荷登録確認画面へ
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'scheduled_date' => 'required|date',
            'quantity' => 'required|integer|min:1',
        ]);
        
        $product = Product::findOrFail($validatedData['product_id']);
        $weight = $product->weight * $validatedData['quantity'];
        Session::put('arrival_registration_data', [
            'product_id' => $validatedData['product_id'],
            'scheduled_date' => $validatedData['scheduled_date'],
            'quantity' => $validatedData['quantity'],
            'weight' => $weight,
        ]);
        return view('general.arrival_register_confirmation', compact('validatedData', 'product', 'weight'));
    }

    public function arrivalListComplete(Request $request){//入荷登録
        
        $validatedData = Session::get('arrival_registration_data');
        
        $shipment = new IncomingShipment();
        $shipment->product_id = $validatedData['product_id'];
        $shipment->scheduled_date = $validatedData['scheduled_date'];
        $shipment->quantity = $validatedData['quantity'];
        $shipment->weight = $validatedData['weight'];
        $shipment->store_id = Auth::user()->store_id;
        $shipment->save();

        Session::forget('arrival_registration_data');
        return redirect()->route('arrival_list');
    }
    
    public function arrivalListDelete($id){//入荷予定削除
        $incomingShipment = IncomingShipment::findOrFail($id);
        $incomingShipment->delete();
        return redirect()->route('arrival_list')->with('success', '入荷予定を削除しました。');
    }

        public function arrivalListEdit($id){//入荷予定編集画面
        $incomingShipment = IncomingShipment::findOrFail($id);
        $products = Product::all();
        return view('general.arrival_detail', compact('incomingShipment', 'products'));
    }

    public function arrivalListUpdate(Request $request, $id){//入荷編集
        
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'scheduled_date' => 'required|date',
            'quantity' => 'required|integer|min:1',
            'weight' => 'required|numeric|min:0',
        ]);
        
        $incomingShipment = IncomingShipment::findOrFail($id);
        $incomingShipment->product_id = $validatedData['product_id'];
        $incomingShipment->scheduled_date = $validatedData['scheduled_date'];
        $incomingShipment->quantity = $validatedData['quantity'];
        $incomingShipment->weight = $validatedData['weight'];
        $incomingShipment->save();

        return redirect()->route('arrival_list.show', $incomingShipment->id);
    }
    
    public function confirmArrival($id){//入荷確定
        $incomingShipment = IncomingShipment::findOrFail($id);
        
        $stock = Stock::where('product_id', $incomingShipment->product_id)
            ->where('store_id', $incomingShipment->store_id)
            ->first();
            
        if ($stock) {
            $stock->quantity += $incomingShipment->quantity;
            $stock->weight += $incomingShipment->weight;
            $stock->save();
        } else {
            $stock = new Stock();
            $stock->product_id = $incomingShipment->product_id;
            $stock->store_id = $incomingShipment->store_id;
            $stock->quantity = $incomingShipment->quantity;
            $stock->weight = $incomingShipment->weight;
            $stock->save();
        }
        $incomingShipment->delete();
        return redirect()->route('arrival_list');
    }
}

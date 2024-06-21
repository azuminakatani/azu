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


class AdminController extends Controller
{
    public function allStoresList(){//全店舗一覧
        $stores = Store::all();
        return view('admin.all_stores_list', compact('stores'));
    }

    public function storeSearch(Request $request){//店舗検索
        $query = Store::query();

        if ($request->has('search') && $request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%$search%");
        }
        $stores = $query->get();
        return view('admin.all_stores_list', compact('stores'));
    }

    public function storeStocks(Store $store, Request $request){//各店舗在庫一覧
        $query = Stock::where('store_id', $store->id)->with('product');
    
        if ($request->has('keyword')) {
            $keyword = $request->input('keyword');
            $query->whereHas('product', function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%');
            });
        }
    
        $stocks = $query->get();
        
        return view('admin.store_inventory_list', compact('store', 'stocks'));
    }

    public function productList(){//商品一覧
        $products = Product::all();
        return view('admin.product_list', compact('products')); 
    }

    public function productsSearch(Request $request){//商品検索
        $keyword = $request->input('keyword');
        $query = Product::query();

        if ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        $products = $query->get();

        return view('admin.product_list', compact('products', 'keyword'));
    }

    public function productDelete($id){//商品削除
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('success', '商品が削除されました');
    }


    public function showProductRegistrForm(){//商品登録画面へ
        return view('admin.product_register');
    }

    public function ProductRegistr(Request $request){//商品登録確認画面へ
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'weight' => 'required|numeric|min:0',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);
            $validatedData['image_url'] = '/storage/images/' . $imageName; 
        } else {
            $validatedData['image_url'] = null;
        }
    
        return view('admin.product_register_confirmation', compact('validatedData'));
    }
    
    public function ProductRegistrConfirm(Request $request) {//商品登録確認

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'weight' => 'required|numeric|min:0',
            'image_url' => 'nullable|string',
        ]);
    
        $product = new Product();
        $product->name = $validatedData['name'];
        $product->weight = $validatedData['weight'];
        $product->image_url = $validatedData['image_url'];
        $product->save();
    
        return redirect()->route('product_list');
    }

    public function productEdit($id){//商品編集画面へ
        $product = Product::findOrFail($id);
        return view('admin.product_edit', compact('product'));
    }

    public function productUpdate(Request $request, $id){//商品編集
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'weight' => 'required|numeric|min:0',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);
            $validatedData['image_url'] = '/storage/images/' . $imageName;
        }

        $product = Product::findOrFail($id); 
        $product->name = $validatedData['name'];
        $product->weight = $validatedData['weight'];
        if (isset($validatedData['image_url'])) {
            $product->image_url = $validatedData['image_url'];
        }
        $product->save();

        return redirect()->route('product_list')->with('success', '商品を更新しました。');
    }

    


    public function ownStoreInventory(){//自店舗在庫一覧
        $stocks = Stock::where('store_id', Auth::user()->store_id)->get();
        return view('admin.own_store_inventory_list', compact('stocks'));
    }

    public function ownInventorySearch(Request $request)//自店舗在庫一覧検索
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
        return view('admin.own_store_inventory', compact('stocks', 'keyword'));
    }

    public function ownInventoryDelete($id){//自店舗在庫削除
        $stock = Stock::findOrFail($id);
        $stock->delete();
        return redirect()->back()->with('success', '在庫が削除されました');
    }
            
    public function arrivalSchedule(){//入荷予定一覧
        $user = Auth::user();
        $incomingShipments = IncomingShipment::where('store_id', Auth::user()->store_id)->get();
        return view('admin.arrival_schedule_list', compact('incomingShipments'));
    }


    public function arrivalScheduleSearch(Request $request){//入荷予定検索
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
    
        return view('admin.arrival_schedule_list', compact('incomingShipments', 'start_date', 'end_date', 'keyword'));
    }
    
    public function arrivalScheduleCreate(Request $request){//入荷登録画面表示
        $products = Product::all();
        return view('admin.arrival_schedule_register', compact('products'));
    }    

    public function arrivalScheduleStore(Request $request){//入荷登録確認画面へ
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'scheduled_date' => 'required|date',
            'quantity' => 'required|integer|min:1',
            'weight' => 'required|numeric|min:0',
        ]);
        $product = Product::findOrFail($validatedData['product_id']);

        Session::put('arrival_registration', $validatedData);
        Session::put('arrival_product', $product);

        return view('admin.arrival_schedule_register_confirmation', compact('validatedData', 'product'));
    }

    public function arrivalScheduleComplete(Request $request){//入荷登録

        $validatedData = Session::get('arrival_registration');
        $product = Session::get('arrival_product');
        
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'scheduled_date' => 'required|date',
            'quantity' => 'required|integer|min:1',
            'weight' => 'required|numeric|min:0',
        ]);
    
        $shipment = new IncomingShipment();
        $shipment->product_id = $validatedData['product_id'];
        $shipment->scheduled_date = $validatedData['scheduled_date'];
        $shipment->quantity = $validatedData['quantity'];
        $shipment->weight = $validatedData['weight'];
        $shipment->store_id = Auth::user()->store_id;
        $shipment->save();

        Session::forget('arrival_registration');
        Session::forget('arrival_product');
    
        return redirect()->route('arrival_schedule');
    }
         
    public function confirmArrivalSchedule($id){//入荷確定
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
        return redirect()->route('arrival_schedule');
    }
    



    public function employeeList(){//一般社員一覧
        $employees = User::where('del_flg', 1)->get();
        return view('admin.employee_list', compact('employees'));
    }

    public function employeDelete($id){//一般社員削除
        $employee = User::findOrFail($id); 
        $employee->delete();
        return redirect()->back()->with('success', '社員が削除されました');
    }
    
    /*public function search(Request $request){//全店舗一覧

        $keyword = $request->input('keyword');
        $stocks = Stock::whereHas('product', function ($query) use ($keyword) {
        $query->where('name', 'like', '%' . $keyword . '%');
        })->get();

        return view('inventory.search_results', compact('stocks'));
    }*/

}

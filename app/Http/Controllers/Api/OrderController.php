<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\Store;
use App\Http\Requests\UpdateOrderStatusRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Resources\Order as OrderResource;
use App\Models\Order_item;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\type;

class OrderController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $user = Auth::user();
        $orders = Order::with(["order_items.product", "cook", "customer.user"]);
        if ($user->type == "EC") {
            $orders->where("prepared_by", $user->id)->whereIn("status", ["H", "P"]);
        } else {
            if ($user->type == "C") {
                $orders->where("customer_id", $user->id);
            } elseif ($user->type == "ED") {

                $orders->where(function ($subquery) use ($user) {
                    $subquery
                        ->where('delivered_by', $user->id)->where('status', 'T')
                        ->orWhereNull('delivered_by')->where('status', 'R');
                });
            } elseif ($user->type == "EM") {
                $orders->whereNotIn("status", ["D", "C"]);
            }
        }
        return OrderResource::collection($orders->get());
    }
    
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Store $request)
    {
        $order = new Order();
        $order->fill($request->validated());
        $order->customer_id = Auth::user()->id;
        $order->total_price = 0;
        $order->date = Carbon::now();
        $order->opened_at = Carbon::now();
        $order->current_status_at = Carbon::now();
        $order->save();
        
        $products_ids = array_map(function ($product){ 
            return $product['id'];
        }, $request->products);
        
        $products = Product::whereIn('id', $products_ids)->get();
        
        $total_price = 0;
        
        foreach($request->products as $product){
            $orderItem = new Order_item();
            $orderItem->order_id = $order->id;
            $orderItem->quantity = $product['quantity'];
            $orderItem->unit_price = $products->firstWhere('id', $product['id'])->price;
            $orderItem->sub_total_price = ($orderItem->unit_price)*$orderItem->quantity;
            $orderItem->product_id = $product['id'];
            $total_price+=$orderItem->sub_total_price;
            $orderItem->save();
        }
        
        $order->total_price = $total_price;
        $order->prepared_by = $this->getLatestAvailableCook();
        if($order->prepared_by != null){
            $order->status = 'P';
        }
        $order->save();
        
        return response()->json(new OrderResource($order), 201);
    }
    
    public function getLatestAvailableCook (){
        
        $cooks = Order::where('status', 'P') 
        ->whereNotNull('prepared_by')
        ->pluck('prepared_by');
        
        return $order = Order::select(\DB::raw('prepared_by, min(opened_at) as opened_at'))
        ->join('users', 'users.id', '=', 'orders.prepared_by')
        ->whereNotIn('status' , ['H', 'P'])
        ->whereNotNull('prepared_by')
        ->whereNotIn('prepared_by', $cooks)
        ->where('blocked', '0')
        ->groupBy('prepared_by')
        ->orderBy('opened_at', 'asc')
        ->pluck('prepared_by')
        ->first();
    }
    
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show(Order $order)
    {
        return new OrderResource($order);
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function updateStatus(Request $request, Order $order)
    {
        $order->update($request->only(['status', 'delivered_by']));

        if ($pendingOrder = $this->getHoldingOrder()) {
            $pendingOrder->prepared_by = $this->getLatestAvailableCook();
            if($pendingOrder->prepared_by != null){
                $pendingOrder->status = 'P';
                $pendingOrder->current_status_at = Carbon::now();
            }
            $pendingOrder->save();
        }

        $currentStatusDate = Carbon::parse($order->current_status_at);

        if($request->status == "R"){
            $order->preparation_time = Carbon::now()->diffInSeconds($currentStatusDate);
            $order->current_status_at = Carbon::now()->toDateTimeString();
        }

        if($request->status == "D"){
            $order->delivery_time = Carbon::now()->diffInSeconds($currentStatusDate);
            $order->current_status_at = Carbon::now()->toDateTimeString();
            $order->closed_at = Carbon::now()->toDateTimeString();
            $order->total_time = Carbon::now()->diffInSeconds(Carbon::parse($order->opened_at));
        }

        $order->save();
        
        return new OrderResource($order);
    }
    
    public function getHoldingOrder(){
        return Order::where('status', 'H')->orderBy('opened_at', 'asc')->first();
    }
    
    public function getOrdersStatistics()
    {
        // $mes9 = Order::where('date','between',"2020-09-01", 'and', "2020-09-31");
        $mes9 = Order::whereBetween('date', ["2020-09-01", "2020-09-31"])->count();
        $mes10 = Order::whereBetween('date', ["2020-10-01", "2020-10-31"])->count();
        $mes11 = Order::whereBetween('date', ["2020-11-01", "2020-11-31"])->count();
        $mes12 = Order::whereBetween('date', ["2020-12-01", "2020-12-31"])->count();
        $mes2021 = Order::whereBetween('date', ["2021-01-01", "2021-01-31"])->count();
        
        $labels = array('Setembro 2020', 'Outubro 2020', 'Novembro 2020', 'Dezembro 2020', 'Janeiro 2021');
        $data  = array($mes9, $mes10, $mes11, $mes12, $mes2021);
        return response()->json(["data"=> $data, "label"=>$labels]);
    }
   

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        //
    }
}

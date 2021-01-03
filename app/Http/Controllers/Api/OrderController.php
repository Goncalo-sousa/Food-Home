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
            $orders->where("prepared_by", $user->id)->where("status", "H");
        } else {
            if ($user->type == "C") {
                $orders->where("customer_id", $user->id);
            } elseif ($user->type == "ED") {
                $orders->where("delivered_by", $user->id)->whereIn("status", ["T", "R"]);
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
        $order->save();

        return response()->json(new OrderResource($order), 201);
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
        $order->update($request->only(['status']));
        return new OrderResource($order);
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

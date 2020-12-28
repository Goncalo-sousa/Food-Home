<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Resources\Order as OrderResource;
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
        $orders = Order::with(["order_items.product","cook","customer.user"]);
        if($user->type == "EC"){
            $orders->where("prepared_by", $user->id)->where("status", "H");
            
        }else{
            if($user->type == "C"){
                $orders->where("customer_id", $user->id);
            }elseif($user->type == "ED"){
                $orders->where("delivered_id", $user->id);
            }elseif($user->type == "EM"){
                $orders->whereNotIn("status", ["D","C"]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

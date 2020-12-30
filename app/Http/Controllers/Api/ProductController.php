<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product as ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    public function getFilterProducts(Request $request){
        if(!is_null($request->name) || !is_null($request->type)){
        
            $products = Product::all();
            if(!is_null($request->name)){
                $products = $products->where('name', 'like', $request->name . '%');
            }
            if(!is_null($request->type)){
                $products = $products->where('type', $request->type);
            }
           
            $products = $products->paginate(10);
        }else{
            $products = Product::all()->paginate(10);
        }
        return $users;
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
        return new ProductResource($id);
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
    public function DeleteSoftDeleted($id)
    {
        $product = Product::onlyTrashed()->find($id);

        if (!is_null($product)) {
            // $product->forceDelete();
            $response = $this->successulMessage(200, 'Successfully deleted', true, 0, $product);
            return response($response);
        }
        return;
    }

    private function notFoundMessage()
    {

        return [
            'code' => 404,
            'message' => 'Note not found',
            'success' => false,
        ];

    }

    private function successulMessage($code, $message, $status, $count, $payload)
    {
        return [
            'code' => $code,
            'message' => $message,
            'success' => $status,
            'count' => $count,
            'data' => $payload,
        ];
    }
}

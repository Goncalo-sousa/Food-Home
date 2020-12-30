<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product as ProductResource;
use App\Http\Requests\UpdateProductRequest;
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
        
            if(!is_null($request->name)){
                $products = Product::where('name', 'like', $request->name . '%');
            }
            if(!is_null($request->type)){
                if(isset($products))
                {
                    $products = $products->where('type', $request->type);
                }
                else{
                    $products = Product::where('type', $request->type);
                }
                
            }
           
            $products = $products->paginate(10);
        }else{
            $products = Product::paginate(10);
        }
        return $products;
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
    public function show( Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        // 
        $product->update($request->validated());
        return new ProductResource($product);
    
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
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

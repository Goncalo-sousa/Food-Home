<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product as ProductResource;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use GuzzleHttp\Promise\Create;
use Illuminate\Auth\Events\Validated;
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

    public function getFilterProducts(Request $request)
    {


        if (!is_null($request->name) || !is_null($request->type)) {

            if (!is_null($request->name)) {
                $products = Product::where('name', 'like', $request->name . '%');
            }
            if (!is_null($request->type)) {
                if (isset($products)) {
                    $products = $products->where('type', $request->type);
                } else {
                    $products = Product::where('type', $request->type);
                }
            }

            $products = $products->paginate(20);
        } else {
            $products = Product::paginate(50);
        }
        return $products;
    }

    public function update_avatar(Request $request, Product $product)
    {
        $imageName = time() . '.' . $request->photo_url->getClientOriginalExtension();
        $request->photo_url->move(public_path('storage/products/'), $imageName);
        $product->photo_url = $imageName;
        $product->save();
        return response()->json(['success' => 'You have successfully upload image.']);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product($request->input());

        if ($file = $request->hasFile('photo_url')) {

            $file = $request->file('photo_url');

            $fileName = time() . '.' . $file->getClientOriginalName();
            $destinationPath = public_path() . 'storage/products/';
            $file->move($destinationPath, $fileName);
            $product->product_image = $fileName;
        }
        $product->save();

        return response()->json(new ProductResource($product), 201);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
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
}

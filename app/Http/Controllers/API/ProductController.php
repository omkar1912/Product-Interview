<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $products = Product::all();
            if(!$products->isEmpty())
            {
                return ProductResource::collection($products);
            }
            return response()->json([
                'message' => 'Records Not Found'
            ],404);
        }
        catch(\Exception $e)
        {
            logger($e->getMessage());
            return response()->json([
                'message' => 'Something Went Wrong',
            ],500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        try{
            $product = Product::create([
                'name'          => $request->name,
                'price'         => $request->price,
                'category_id'   => $request->category_id,
                'created_by'    => auth()->user()->id
            ]);

            if($product)
            {
                return new ProductResource($product);
            }
            else{
                return response()->json([
                    'message' => 'Records Not Found'
                ],404);
            }
        }
        catch(\Exception $e)
        {
            logger($e->getMessage());
            return response()->json([
                'message' => 'Something Went Wrong',
            ],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $product = Product::where('id',$id)->first();
            if($product)
            {
                return new ProductResource($product);
            }
            return response()->json([
                'message'=> 'Record Not Found',
            ],404);
        }
        catch(\Exception $e)
        {
            logger($e->getMessage());
            return response()->json([
                'message' => 'Something Went Wrong',
            ],500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(UpdateProductRequest $request, $id)
    {
        try{
            $product = Product::where('id',$id)->first();
            if($product)
            {
                $product->update([
                    'id'            => $id,
                    'name'          => $request->name,
                    'price'         => $request->price,
                    'category_id'   => $request->category_id,
                    'created_by'    => auth()->user()->id
                ]);

                return new ProductResource($product);
            }
            return response()->json([
                'message' => 'Record Not Found',
            ],404);
        }
        catch(\Exception $e)
        {
            logger($e->getMessage());
            return response()->json([
                'message' => 'Something Went Wrong',
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $product = Product::find($id);
            if($product)
            {
                $product->delete();
                return response()->json([
                    'message'=> 'Record Deleted Successfully'
                ],200);
            }
            return response()->json([
                'message' => 'Record Not Found'
            ],404);
        }
        catch(\Exception $e)
        {
            logger($e->getMessage());
            return response()->json([
                'message' => 'Something Went Wrong',
            ],500);
        }
    }
}

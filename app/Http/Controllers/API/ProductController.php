<?php

namespace App\Http\Controllers\API;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Product\DestroyProductRequest;
use App\Http\Requests\API\Product\FilterByCategoryRequest;
use App\Http\Requests\API\Product\FilterByPriceRequest;
use App\Http\Requests\API\Product\ShowProductRequest;
use App\Http\Requests\API\Product\StoreProductRequest;
use App\Http\Requests\API\Product\UpdateProductRequest;
use App\Repository\contracts\ProductRepositoryContract;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public ProductRepositoryContract $productProvider;
    public function __construct(
        ProductRepositoryContract $productProvider
    ) {
        $this->productProvider = $productProvider;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            $this->productProvider->index(),
            200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'category_id'=>$request->category_id
        ];

        if (isset($request->image)) {
            //upload file to storage 
            $imagePath = Helper::uploadProductImage($request->file('image'));
            $data['image'] = $imagePath;
        }

        $record = $this->productProvider->store($data);
        return response()->json(
            $record
            , 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowProductRequest $request)
    {
        $record = $this->productProvider->show($request->id);
        return response()->json(
            $record
            , 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request)
    {
        $data = $request->all(); 

        if (isset($request->image)) {
            if ($request->image != DEFAULT_PRODUCT_IMAGE) {
                $old_image = $this->productProvider->show($request->id)->image;
                File::delete(public_path($old_image));
            }
            $imagePath = Helper::uploadProductImage($request->file('image'));
            $data['image'] = $imagePath;
        }

        $isUpdated = $this->productProvider->update($data, $request->id);
        return response()->json(
            $isUpdated
            , 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyProductRequest $request)
    {
        try {
            $imagePath = $this->productProvider->show($request->id)->image;
            $isDeleted = $this->productProvider->destroy($request->id);
            if ($isDeleted) {
                if ($imagePath != DEFAULT_PRODUCT_IMAGE) {
                    File::delete(public_path($imagePath));
                }
            }
        } catch (\Throwable $th) {
            $isDeleted = $this->productProvider->destroy($request->id);
        }
        return response()->json(
            $isDeleted ? true : false,
            $isDeleted ? 200 : 404);
    }
    public function filterByCategory(FilterByCategoryRequest $request ){
        $records = $this->productProvider->filterByCategory($request->category_id); 
        return response()->json($records); 
    }
    public function filterByMaxPrice(FilterByPriceRequest $request ){
        $records = $this->productProvider->filterByMaxPrice($request->max_price); 
        return response()->json($records); 

    }
   
}

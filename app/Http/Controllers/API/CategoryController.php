<?php

namespace App\Http\Controllers\API;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Category\DestroyCategoryRequest;
use App\Http\Requests\API\Category\ShowCategoryRequest;
use App\Http\Requests\API\Category\StoreCategoryRequest;
use App\Http\Requests\API\Category\UpdateCategoryRequest;
use App\Repository\contracts\CategoryRepositoryContract;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public CategoryRepositoryContract $categoryProvider;
    public function __construct(
        CategoryRepositoryContract $categoryProvider
    ) {
        $this->categoryProvider = $categoryProvider;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            $this->categoryProvider->index(),
            200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {        
        $data = [
            'name' => $request->name, 
       ];

        if (isset($request->image)){
            //upload file to storage 
            $imagePath = Helper::uploadCategoryImage($request->file('image'));
            $data['image'] = $imagePath ; 
        }

        $record = $this->categoryProvider->store($data);
        return response()->json(
            $record
            , 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowCategoryRequest $request)
    {
        $record = $this->categoryProvider->show($request->id);
        return response()->json(
            $record
            , 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request)
    {
        $data = $request->all(); 

        if (isset($request->image)){
            if ($request->image != DEFAULT_CATEGORY_IMAGE) {
                $old_image = $this->categoryProvider->show($request->id)->image ; 
                File::delete(public_path($old_image)); 
            }
            $imagePath = Helper::uploadCategoryImage($request->file('image'));
            $data['image'] = $imagePath ; 
        }

        $isUpdated = $this->categoryProvider->update($data , $request->id);
        return response()->json(
           $isUpdated 
            , 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyCategoryRequest $request)
    {
        $imagePath = $this->categoryProvider->show($request->id)->image; 
        $isDeleted = $this->categoryProvider->destroy($request->id); 
        if ($isDeleted){
            if($imagePath != DEFAULT_CATEGORY_IMAGE){
                File::delete(public_path($imagePath)); 
            }
        }
         return response()->json(
            $isDeleted ? true : false, 
             $isDeleted ? 200 : 404);
    }
}

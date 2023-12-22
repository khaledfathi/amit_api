<?php 

namespace App\Repository;
use App\Models\CategoryModel;
use App\Repository\contracts\CategoryRepositoryContract; 

class CategoryRepository implements CategoryRepositoryContract {
    public function index(){
        return CategoryModel::get(); 
    }
    // public function create(){}
    public function store(array $data){
        return CategoryModel::where( 'id' ,  CategoryModel::create($data)->id )->first(); 
    }
    public function show(int $id){
        return CategoryModel::where('id' , $id)->first(); 
    }
    // public function edit(int $id){}
    public function update(array $data, int $id){
        $found = CategoryModel::find($id); 
        return $found ? $found->update($data) : false ; 
    }
    public function destroy(int $id){
        $found = CategoryModel::find($id); 
        return $found ? $found->delete() : false ; 

    }
}


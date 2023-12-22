<?php 
namespace App\Repository;
use App\Models\ProductModel;
use App\Repository\contracts\ProductRepositoryContract; 

class ProductRepository implements ProductRepositoryContract {

    public function index(){
        return ProductModel::get(); 
    }
    // public function create(){}
    public function store(array $data){
        return ProductModel::where( 'id' ,  ProductModel::create($data)->id )->first(); 
    }
    public function show(int $id){
        return ProductModel::where('id' , $id)->first(); 
    }
    // public function edit(int $id){}
    public function update(array $data, int $id){
        $found = ProductModel::find($id); 
        return $found ? $found->update($data) : false ; 
    }
    public function destroy(int $id){
        $found = ProductModel::find($id); 
        return $found ? $found->delete() : false ; 

    }
}
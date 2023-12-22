<?php

namespace App\Repository;
use App\Models\User as UserModel;
use App\Repository\contracts\UserRepositoryContract; 

class UserRepository implements UserRepositoryContract{

    public function index(){
        return UserModel::get(); 
    }
    // public function create(){}
    public function store(array $data){
        return UserModel::where( 'id' ,  UserModel::create($data)->id )->first(); 
    }
    public function show(int $id){
        return UserModel::where('id' , $id)->first(); 
    }
    // public function edit(int $id){}
    public function update(array $data, int $id){
        $found = UserModel::find($id); 
        return $found ? $found->update($data) : false ; 
    }
    public function destroy(int $id){
        $found = UserModel::find($id); 
        return $found ? $found->delete() : false ; 

    }
}
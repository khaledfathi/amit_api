<?php 

namespace App\Repository\contracts ;
use App\Repository\contracts\interface\RepositoryInterface; 

interface ProductRepositoryContract  extends RepositoryInterface{
    public function filterByCategory(int $id); 
    public function filterByMaxPrice(int $maxPrice);

}
<?php
namespace App\Helper;
use Illuminate\Http\Request; 


class BadRequest extends Request {

    function expectsJson(){
        return true ; 
    }
    function wantsJson(){
        return true ; 
    }
}
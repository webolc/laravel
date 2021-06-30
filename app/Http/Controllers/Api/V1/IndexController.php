<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;

class IndexController extends ApiController{
    
    public function index(){
        return $this->success('Api');
    }
}
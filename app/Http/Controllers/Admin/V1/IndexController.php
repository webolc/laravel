<?php
namespace App\Http\Controllers\Admin\V1;

use App\Http\Controllers\Common\CommonController;

class IndexController extends CommonController{
    
    public function index(){
        return $this->success('Admin');
    }
}
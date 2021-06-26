<?php
namespace App\Http\Controllers\Web\V1;

use App\Http\Controllers\Web\WebController;

class IndexController extends WebController{
    
    public function index(){
        return $this->view();
    }
}
<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ApiController extends Controller{
    
    protected function __init(){
        $this->current_version = 'V1';
    }
}
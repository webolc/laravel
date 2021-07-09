<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ServiceRequest extends Facade{
    
    protected static function getFacadeAccessor() {
        return 'service_request';
    }
}
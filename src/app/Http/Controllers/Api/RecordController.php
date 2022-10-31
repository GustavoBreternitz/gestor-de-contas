<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\Api\RecordCreateRequest;
use Illuminate\Routing\Controller as BaseController;

class RecordController extends BaseController
{
    public function __construct()
    {
        
    }
    public function create(RecordCreateRequest $request) 
    {
        echo '<pre>';
        print_r($request->all());
        echo '</pre>';
        exit('arvore');
    }
}

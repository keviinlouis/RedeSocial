<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param array $data
     * @param array $rules
     */
    protected function validator(Array $data, Array $rules){
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            response()->json(["messages" => $validator->messages()->toArray()], 400)->send();
            exit;
        }
    }
}

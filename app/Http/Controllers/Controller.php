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
    protected function validateRequest(Array $data, Array $rules)
    {
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            response()->json(["messages" => $validator->messages()->toArray()], 400)->send();
            exit;
        }
    }

    protected function makeNextPageLink($route, $start, $limit, $count)
    {
        return $count >= $limit ?
            route($route, ["start" => $start + $limit, "limit" => $limit]) : null;
    }

    protected function makePreviousPageLink($route, $start, $limit)
    {
        $start - $limit >= 0 ?
            route($route, ["start" => $start - $limit, "limit" => $limit]) : null;
    }

    protected function makeMeta($route, $start, $limit, $count)
    {
        return [
            "_prev" => $this->makePreviousPageLink($route, $start, $limit),
            "_next" => $this->makeNextPageLink($route, $start, $limit, $count),
            "length" => $count
        ];
    }
}

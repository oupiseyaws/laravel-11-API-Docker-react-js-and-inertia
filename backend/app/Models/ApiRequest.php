<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class ApiRequest extends Model
{
    protected $fillable = ['method','url','ip','headers','body','response'];

    public static function Add(Request $request, $response = null)
    {
        $apiRequest = new ApiRequest();
        $apiRequest->method = $request->method();
        $apiRequest->url = $request->url();
        $apiRequest->ip = $request->ip();
        $apiRequest->headers = json_encode($request->header());
        $apiRequest->body = json_encode($request->all());
        $apiRequest->response = json_encode($response);
        $apiRequest->save();
    }
}

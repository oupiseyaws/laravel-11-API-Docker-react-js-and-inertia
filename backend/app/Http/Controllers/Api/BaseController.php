<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as Controller;
use App\Models\ApiRequest;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
 * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse(Request $request,$result, $message)
    {
        // $response = [
        //     'success' => true,
        //     'data'    => $result,
        //     'message' => $message,
        // ];

        // save to api_requests table
        ApiRequest::Add($request,$result);

        return response()->json($result, 200);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

         // save to api_requests table
         ApiRequest::Add($request);

        return response()->json($response, $code);
    }
}

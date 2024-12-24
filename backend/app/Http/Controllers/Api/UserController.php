<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * @OA\Info(title="My First API", version="0.1")
 */
class UserController extends Controller
{
    /**
    * @OA\Post(
     *     path="/api/users",
     *     summary="Register a new user",
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="User's name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="User's email",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="User's password",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="201", description="User registered successfully"),
     *     @OA\Response(response="422", description="Validation errors")
     * )
     */
    public function index(Request $request)
    {
        Log::info('UserController@index');
        Log::info('User: ' . auth()->user()->name);
        Log::info(User::get());
        return User::all();
    }

    public function store(Request $request)
    {
        // Your API logic here
    }

    public function show(Request $request)
    {
        // Your API logic here
    }

    public function update(Request $request)
    {
        // Your API logic here
    }

    public function destory(Request $request)
    {
        // Your API logic here
    }

}

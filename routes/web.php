<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
public function login(Request $request)
{

    $validator = Validator::make($request->all(), [

        'email' => 'required|string|email|unique:users',
        'password' => 'required|string|min:8']);

    if ($validator->fails())
    {
        return response()->json($validator->errors(), status: 422);
    }
    if(!$token=auth()->attempt($validator->validated()))
    {
        return response()->json(['error'=>'Unauthorized'], status: 401);
    }
    return $this->createNewToken($token);
}

protected function createNewToken ($token): JsonResponse
{
    return response()->json(data: [

        'access_token'=>$token,
        'token_type'=>'bearer',
        'expires_in'=>auth()->factory()->getTTL()*60,
        'user'=>auth()->user()
    ]);
*/

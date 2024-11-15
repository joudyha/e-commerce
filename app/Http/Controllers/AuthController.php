<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Auth;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',
            'phone_number'=>'nullable|max:10',
            'address'=>'nullable',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = new User();


        $user = User::create(array_merge(
            $validator->validated(), ['password' => bcrypt($request->password)]
        ));

            $token=JWTAuth::fromUser($user);

        return response()->json([
            'message' => 'User Successfully Registered', 'user' => $user,'access_token'=>$token], 201);
    }

    /**
     * @throws ValidationException
     */

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);

    }
        public function profile()

         {
        return response()->json(auth()->user());
         }

         public function updateProfile(Request $request,string $id)
         {

             {
                 // قم بتنفيذ التحقق من صحة البيانات المستلمة
                 // $user = Auth::user();
                 $user = User::find($id);
                 if (!$user) {
                     return response()->json(['message' => 'user not found'], 404);
                 }
                 $user->update($request->all());
                 return response()->json(['data' => $user, 'message' => 'تم تحديث الملف الشخصي بنجاح']);
             }


         }




             /*
             $user = $request->user(); // احصل على الشخص المستخدم المرتبط بالطلب


             // قم بتحديث المعلومات المرتبطة بالملف الشخصي
             $user->phone_number = $request->input('phone_number');
             $user->name = $request->input('name');
             $user->email = $request->input('email');
             $user->password = $request->input('password');
             $user->address = $request->input('address');
*/
             // احفظ التغييرات




         public function logout()
         {

        auth()->logout();
             return response()->json([
                 'message' => 'User Successfully logged out']);
         }
}

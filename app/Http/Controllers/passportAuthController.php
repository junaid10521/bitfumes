<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use DB;
class passportAuthController extends Controller
{
    /**
     * Registration
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);
 
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
       
        $token = $user->createToken('LaravelAuthApp')->accessToken;
 
        return response()->json(['token' => $token], 200);
    }
 
    /**
     * Login
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function logout(Request $request){
        $api_token = $request->header('Authorization');
        if(empty($api_token)){
            return response()->json(['error'=>false, 'message'=>"unable ot Logout"],422);
        }else{
            echo "User Logout Successfully";
            // $api_token= str_replace("Bearer", "", $api_token);
            // $userCount =User::where('api_token', $api_token)->count();
            // if($userCount>0){
            //     User::where('api_token', $api_token)->update(['api_token'=>Null]);
            //     return response()->json(['error'=>true, 'message'=>"User logout Successfully"]);
            // }
        }
    }   

     // public function logout(Request $request)
    // {        
    // if (Auth::check()) {
    //     $token = Auth::user()->token();
    //     $token->revoke();
    //     return $this->sendResponse(null, 'User is logout');
    // } 
    // else{ 
    //     return $this->sendError('Unauthorised.', ['error'=>'Unauthorised'] , Response::HTTP_UNAUTHORIZED);
    // } 
    // {
    //     $token =$request->user()->token();
    //     $token =revoke();
    //     return response()->json(['message'=>"You have Successfully Logout"],200);

    // }
    //  public function logout()
    // {
    //     dd("hello");
    //   if (Auth::check()) {
    //     $user = Auth::user()->token();
    //     $user->revoke();

    //     return response()->json([
    //       'success' => true,
    //       'message' => 'Logout successfully'
    //   ]);
    //   }
    //   else {
    //     return response()->json([
    //       'success' => false,
    //       'message' => 'Unable to Logout'
    //     ]);
    //   }
    //  }

    // public function logout()
    // { 
    // if (Auth::check()) {
    //    Auth::user()->AauthAcessToken()->delete();

    //    return response()->json(['message'=>"logout Successfully"]);
    //     }
    // else{
    //     return response()->json(['message'=> "Unable to Logout"]);
    // }

    // }
    // public function logout(Request $request)
    // {
    // DB::table('oauth_access_tokens')
    //     ->where('user_id', Auth::user()->id)
    //     ->update([
    //         'revoked' => true
    //     ]);
    // }
}
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Login
     *
     * @param  Request $request
     * @return response
     */
    public function login(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required',
                'password' => 'required'
            ]
        );

        $user = User::where('email', $request->input('email'))->first();
        if (Hash::check($request->input('password'), $user->password)) {
            $api_token = base64_encode(str_random(40));
            User::where('email', $request->input('email'))
                ->update(['api_token' => "$api_token"]);
            return response()->json(
                ['status' => 'success','api_token' => $api_token]
            );
        } else {
            return response()->json(['status' => 'fail'], 401);
        }
    }
}

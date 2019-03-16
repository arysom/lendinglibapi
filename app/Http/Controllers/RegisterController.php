<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;

class RegisterController extends Controller
{
    /**
     * Insert
     *
     * @param Request $request
     * @return response
     */
    public function insert(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required'
            ]
        );

        $user = User::create(
            [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => app('hash')->make($request->input('password'))
            ]
        );

        return response('the user has been created', 201);
    }
}

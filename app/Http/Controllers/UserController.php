<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(){
        return view('account.login');
    }

    public function register(){
        return view('account.register');
    }

    public function register_process(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ]);

        if ($validator->passes()) {

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make(($request->password));
            $user->save();

            session()->flash('success', 'User Registration Successfully');
            return response()->json([
                'status' => true,
                'message' => 'User Registration Successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

    }

    public function login_process(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){

                return response()->json([
                    'status' => true,
                    'redirect' => route('books')
                ]);
            }else{
                session()->flash('errors', 'Invalid Credentials');
                return response()->json([
                    'status' => false,
                    'errors' => [
                        'credentials' => 'Invalid Credentials'
                    ]
                ]);
            }
    }

    public function user_logout(){
        Auth::logout();
        session()->flash('success', 'User Logout Successfully');
        return redirect()->route('login');
    }

}

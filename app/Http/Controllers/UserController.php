<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function showFormLogin()
    {
//        if (Session::has('role'))
        return view('login_register.login');
    }

    public function showFormRegister()
    {
        return view('login_register.register');
    }

    public function getAll(){
        $user = User::all();
    }


    public function store(StoreUserRequest $request): RedirectResponse
    {
        $user = new User();
        $user->fill($request->all());

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if ($request->name === 'admin') {
            $user->role = 1;
        }

        $user->password = Hash::make($request->password);
        $user->save();
        Session::flash('data', $data);

        return redirect()->route('user.showFormLogin')->with('message', 'Đăng ký thành công');
    }
    public function logout(){
        Auth::logout();
        Session::forget('email_user');
        return redirect()->back();
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $data = [
            'email' => $email,
            'password' => $password
        ];

        if (!Auth::attempt($data)) {
            Session::flash('error_info', 'Tài khoản hoặc mật khẩu không đúng');
            return redirect()->route('user.showFormLogin');
        }
        Session::put('email_user',$email);

        return redirect()->route('product.index');
    }
}

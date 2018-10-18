<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\User;
use  Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'admin' => '1'])) {
                // echo "succes";die; // return view('admin.dashboard');
                //zzzsession(['admin'=>Auth::$data['email']]);
                return redirect('admin/dashboard');

            } else {
                return redirect('/admin')->with('flash_message_error', 'Неверный логин или пароль');
            }
        }
        return view('admin.login');
    }

    public function dashboard()
    {
        /*
                if(session()->has('admin')){

                }
                else {
                    return redirect('/admin')->with('flash_message_error','Войдите в систему под учетной записи админа');
                }*/

        return view('admin.dashboard');
    }

    public function logout()
    {
        Session::flush();
        return redirect('/admin')->with('flash_message_success', 'Вы успешно вышли из системы' . session('admin'));
    }

    public function settings()
    {
        return view('admin.settings');

    }


    public function checkPassword(Request $request){
        $data=$request->all();
        $current_password=$data['current_pwd'];
        $check_password=User::where(['admin'=>'1'])->first();
        if(Hash::check($current_password,$check_password->password)){
            echo "true"; die;
        }
        else{
            echo  "false"; die;
        }


    }

    public function  updatePwd(Request $request){
        if($request->method('post')){
            $data=$request->all();

            $current_pwd=$data['current_pwd'];
            $check_pwd=User::where(['email'=> Auth::user()->email])->first();
            if(Hash::check($current_pwd,$check_pwd->password)){
               $password=bcrypt($data['new_pwd']);
                User::where(['admin'=>'1'])->update(['password'=>$password]);
                return redirect('/admin/settings')->with('flash_message_success','Пароль успешно обнавлен');
            }
            else{
                return redirect('/admin/settings')->with('flash_message_error','Не коректо виден текущий пароль');
            }
        }
    }

}

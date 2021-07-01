<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Customer;
use DB;
use Validator;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Session;

class LoginController extends Controller
{
    public function getAdminLogin() 
    {
        if (Auth::check()) {
            return redirect()->route('admin-index');
        }
        return view('admin.login');
    }

    public function postAdminLogin(Request $request) 
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $rules = [
            'username' =>'required|min:3',
            'password' => 'required|min:3'
        ];
        $messages = [
            'username.required' => 'User là trường bắt buộc',
            'username.min' => 'Tên User phải chứa ít nhất 3 ký tự',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.min' => 'Mật khẩu phải chứa ít nhất 3 ký tự',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            if ($username) {
                $checkin = [
                    'username' => $username,
                    'password' => $password,
                    'status' => 1,
                    'deleted' => 0
                ];
                if(Auth::attempt($checkin)) 
                {
                    // Kiểm tra đúng email và mật khẩu sẽ chuyển trang và tạo một phiên làm việc tạm thời mới
                    return redirect()->route('admin-index')->with('success','Đăng nhập thành công');
                } 
                else 
                {
                    // Kiểm tra không đúng sẽ hiển thị thông báo lỗi
                    $request->session()->flash('fail', 'Tên đăng nhập hoặc mật khẩu không đúng!');
                    return redirect()->back();
                }
            }
        }
    }

    public function adminLogout(){
        Auth::logout();
        session()->forget('username');
        return redirect()->route('admin-login');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        $check_role = Auth::user()->role_id;
        $data = [];
        if ($check_role < 2) {
            $data = User::where('deleted', 0)->get();
        }else{
            $data = User::where('id', Auth::user()->id)->where('deleted', 0)->get();
        }
        return view('admin.user.index', compact('data'));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $rules = [
                'username'=>'required|max:255|regex:/^\S*$/u',
                'email'=>'required|max:5000',
                'password' => 'min:3|required_with:password_confirmation|same:password_confirmation|regex:/^\S*$/u',
                'password_confirmation' => 'required',
                'status'=>'required',
            ];

            $messages = [
                'username.required' => 'Tên tài khoản là trường bắt buộc',
                'username.regex' => 'Tên tài khoản không hợp lệ',
                'email.required' => 'Email là trường bắt buộc',
                'username.min' => 'Độ dài tối thiểu là 3 ký tự',
                'email.min' => 'Độ dài tối thiểu là 3 ký tự',
                'password.required' => 'Mật khẩu là trường bắt buộc',
                'password.min' => 'Độ dài tối thiểu là 3 ký tự',
                'password.regex' => 'Mật khẩu không hợp lệ',
                'password_confirmation.required'=>'Mật khẩu không trùng khớp',
                'password_confirmation.required_with'=>'Mật khẩu không trùng khớp',
            ];

            $input = $request->all();
            $validator = Validator::make($input, $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = new User();
            $data->username = $input['username'];
            $data->email = $input['email'];
            $data->password = bcrypt($input['password']);
            $data->role_id = $input['role_id'];
            $data->status = 0;
            $data->save();

            return redirect()->route('admin-user-list');
        }else{
            return view('admin.user.create');
        }
    }

    public function update(Request $request, $id)
    {
        $data = User::where('id', $id)->first();

        if ($request->isMethod('post')) {
            $input = $request->all();

            $rules = [
                'username'=>'required|max:255|regex:/^\S*$/u',
                'email'=>'required|max:5000',
                'status'=>'required',
            ];

            $messages = [
                'username.required' => 'Tên tài khoản là trường bắt buộc',
                'username.regex' => 'Tên tài khoản không hợp lệ',
                'email.required' => 'Email là trường bắt buộc',
                'username.min' => 'Độ dài tối thiểu là 3 ký tự',
                'email.min' => 'Độ dài tối thiểu là 3 ký tự',
            ];

            $validator = Validator::make($input, $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data->username = $input['username'];
            $data->email = $input['email'];
            $data->role_id = $input['role_id'];
            $data->status = (int)$input['status'];
            $data->update();
            return redirect()->route('admin-user-list');
        }else{
            if (!$data) {
                return view('admin.404');
            }
            return view('admin.user.update', compact('data'));
        }
    }

    public function delete($id)
    {
        $check_role = Auth::user()->role_id;
        if ($check_role > 1) {
            return redirect()->back()->with('Lỗi', 'Bạn không thể thao tác');
        }
        $data = User::where('id', $id)->first();
        $data->deleted = 1;
        $data->update();
        return redirect()->back();
    }

    public function changePassword(Request $request)
    {
        $input = $request->all();
        if (Auth::check()) {
            $data = [];
            if (Auth::user()->role_id < 2) {
                $data = User::where('deleted', 0)->get();
            }
            return view('admin.user.change-password', compact('data'));
        }else{
            return redirect()->route('admin-login')->with('fail', 'Đăng nhập để sử dụng');
        }
    }

    public function postChangePassword(Request $request)
    {
        $input = $request->all();
        if (Auth::check()) {
            $user = [];
            if (Auth::user()->role_id < 2) {
                $rules = [
                    'new_password' => 'min:3|required_with:password_confirmation|same:password_confirmation',
                    'password_confirmation' => 'required',
                ];

                $messages = [
                    'new_password.min' => 'Độ dài tối thiểu là 3 ký tự',
                    'password_confirmation.required'=>'Mật khẩu không trùng khớp',
                    'password_confirmation.required_with'=>'Mật khẩu không trùng khớp',
                ];
                $user = User::where('id', $input['user_id'])->where('deleted', 0)->first();
                $route = 'admin-user-list';
            }else{
                $rules = [
                    'old_password' => 'required',
                    'new_password' => 'min:3|required_with:password_confirmation|same:password_confirmation',
                    'password_confirmation' => 'required',
                ];

                $messages = [
                    'old_password.required' => 'Mật khẩu là trường bắt buộc',
                    'new_password.min' => 'Độ dài tối thiểu là 3 ký tự',
                    'password_confirmation.required'=>'Mật khẩu không trùng khớp',
                    'password_confirmation.required_with'=>'Mật khẩu không trùng khớp',
                ];
                $user = User::where('id', Auth::user()->id)->where('deleted', 0)->first();
                $route = 'admin-logout';
            }
            $validator = Validator::make($input, $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $user->password = bcrypt($input['new_password']);
            $user->save();

            return redirect()->route($route)->with('success', 'Đổi mật khẩu thành công. Đăng nhập lại để sử dụng');
        }else{
            return redirect()->route('admin-login')->with('fail', 'Đăng nhập để sử dụng');
        }
    }

}

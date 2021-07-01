<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Customer;
use DB;
use Illuminate\Support\Facades\Validator;
use Auth;

class CustomerController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_id != 1) {
            return view('admin.404');
        }
        $data = Customer::where('deleted', 0)->get();
        return view('admin.customer.index', compact('data'));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $rules = [
                'name'=>'required|max:50',
                'email'=>'required|max:255',
                'phone'=>'required|max:11',
                'address'=>'required|max:255',
                'date_of_birth'=>'required',
                'gender'=>'required',
            ];

            $messages = [
                'name.required'=>"Tên khách hàng không được để trống!",
                'name.max'=>"Tên khách hàng tối đa 50 ký tự",
                'email.required'=>"Email không được để trống!",
                'email.max'=>"Email tối đa 255 ký tự",
                'phone.required'=> "Số điện thoại không được để trống",
                'phone.max'=>"Số điện thoại tối đa 11 ký tự",
                'address.required'=> "Địa chỉ không được để trống",
                'address.max'=>"Địa chỉ tối đa 255 ký tự",
                'date_of_birth.required'=> "Ngày sinh không được để trống",
                'gender.required'=> "Đơn vị không được để trống",
            ];

            $input = $request->all();
            $validator = Validator::make($input, $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = new Customer();
            $data->name = $input['name'];
            $data->email = $input['email'];
            $data->phone = $input['phone'];
            $data->address = $input['address'];
            $data->date_of_birth = $input['date_of_birth'];
            $data->gender = (int)$input['gender'];
            $data->save();

            return redirect()->route('admin-customer-list');
        }else{
            return view('admin.customer.create');
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role_id != 1) {
            return view('admin.404');
        }
        $data = Customer::where('id', $id)->first();

        if ($request->isMethod('post')) {
            $input = $request->all();

             $rules = [
                'name'=>'required|max:50',
                'email'=>'required|max:255',
                'phone'=>'required|max:11',
                'address'=>'required|max:255',
                'date_of_birth'=>'required',
                'gender'=>'required',
            ];

            $messages = [
                'name.required'=>"Tên khách hàng không được để trống!",
                'name.max'=>"Tên khách hàng tối đa 50 ký tự",
                'email.required'=>"Email không được để trống!",
                'email.max'=>"Email tối đa 255 ký tự",
                'phone.required'=> "Số điện thoại không được để trống",
                'phone.max'=>"Số điện thoại tối đa 11 ký tự",
                'address.required'=> "Địa chỉ không được để trống",
                'address.max'=>"Địa chỉ tối đa 255 ký tự",
                'date_of_birth.required'=> "Ngày sinh không được để trống",
                'gender.required'=> "Đơn vị không được để trống",
            ];

            $validator = Validator::make($input, $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data->name = $input['name'];
            $data->date_of_birth = $input['date_of_birth'];
            $data->phone = $input['phone'];
            $data->email = $input['email'];
            $data->address = $input['address'];
            $data->gender = (int)$input['gender'];
            $data->save();
            return redirect()->route('admin-customer-list');
        }else{
            if (!$data) {
                return view('admin.404');
            }
            return view('admin.customer.update', compact('data'));
        }
    }

    public function delete($id)
    {
        $check_role = Auth::user()->role_id;
        if ($check_role > 1) {
            return redirect()->back()->with('Lỗi', 'Bạn không thể thao tác');
        }
        $data = Customer::where('id', $id)->first();
        $data->deleted = 1;
        $data->update();
        return redirect()->back();
    }


    public function customerInfo(){
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('login');
        }else{
            $customer = Auth::guard('customer')->user();
        }
        return view('customer.info');
    }
    public function postCustomerInfo(Request $request){
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('login');
        }else{
            $input = $request->all();

             $rules = [
                'name'=>'required|max:50',
                'email'=>'required|max:255|email',
                'phone'=>'required|max:11',
                'address'=>'required|max:255',
                'date_of_birth'=>'required',
                'gender'=>'required',
            ];

            $messages = [
                'name.required'=>"Tên khách hàng không được để trống!",
                'name.max'=>"Tên khách hàng tối đa 50 ký tự",
                'email.required'=>"Email không được để trống!",
                'email.max'=>"Email tối đa 255 ký tự",
                'email.email'=>"Email không hợp lệ",
                'phone.required'=> "Số điện thoại không được để trống",
                'phone.max'=>"Số điện thoại tối đa 11 ký tự",
                'address.required'=> "Địa chỉ không được để trống",
                'address.max'=>"Địa chỉ tối đa 255 ký tự",
                'date_of_birth.required'=> "Ngày sinh không được để trống",
                'gender.required'=> "Vui lòng chọn giới tính",
            ];
            $validator = Validator::make($input, $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $customer = Customer::where('id', Auth::guard('customer')->user()->id)->first();
            $customer->name = $input['name'];
            $customer->email = $input['email'];
            $customer->phone = $input['phone'];
            $customer->address = $input['address'];
            $customer->date_of_birth = $input['date_of_birth'];
            $customer->gender = (int)$input['gender'];
            $status = $customer->save();
            if (!$status) {
                return redirect()->back()->with('fail', 'Cập nhật thất bại, vui lòng thử lại');
            }
            return redirect()->back()->with('success', 'Cập nhật thành công');
        }
    }


    public function getLogin() 
    {
        return view('login.login');
    }

    public function postLogin(Request $request) 
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $rules = [
            'email' =>'required|min:3',
            'password' => 'required|min:3'
        ];
        $messages = [
            'email.required' => 'Email là trường bắt buộc',
            'email.min' => 'Email phải chứa ít nhất 3 ký tự',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.min' => 'Mật khẩu phải chứa ít nhất 3 ký tự',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            if ($email) {
                $checkin = [
                    'email' => $email,
                    'password' => $password,
                    'status' => 1
                ];
                if(Auth::guard('customer')->attempt($checkin)) 
                {
                    // Kiểm tra đúng email và mật khẩu sẽ chuyển trang và tạo một phiên làm việc tạm thời mới
                    return redirect()->route('index')->with('success','Đăng nhập thành công');
                } else {
                    // Kiểm tra không đúng sẽ hiển thị thông báo lỗi
                    return redirect()->back()->with('fail', 'Email hoặc mật khẩu không đúng');
                }
            }
        }
    }

    public function getRegister()
    {
        return view('login.register');
    }
    public function register(Request $request)
    {
        $input = $request->all();
        // Kiểm tra dữ liệu nhập vào
        $rules = [
            'name' =>'required|min:3',
            'email' =>'required|min:3',
            'password' => 'min:3|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required'
        ];
        $messages = [
            'name.required' => 'Họ tên là trường bắt buộc',
            'email.required' => 'Email là trường bắt buộc',
            'name.min' => 'Độ dài tối thiểu là 3 ký tự',
            'email.min' => 'Độ dài tối thiểu là 3 ký tự',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.min' => 'Độ dài tối thiểu là 3 ký tự',
            'password_confirmation.required'=>'Mật khẩu không trùng khớp',
            'password_confirmation.required_with'=>'Mật khẩu không trùng khớp',
        ];
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) 
        {
            // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng ký và thông báo lỗi
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else
        {
            // Nếu dữ liệu hợp lệ sẽ thêm vào csdl
            $user = new Customer;
            $user->name = $input['name'];
            $user->email = $input['email'];
            $user->password = bcrypt($input['password']);
            $user->role_id = 3;
            $user->status = 1;
            $user->save();
            return redirect()->route('login');
        }
    }

    public function logout(){
        Auth::guard('customer')->logout();
        return redirect()->route('index');
    }

    public function customerChangePassword(){
        return view('customer.change-password');
    }

    public function postCustomerChangePassword(Request $request){
        $input = $request->all();
        $rules = [
            'old_password' => 'required',
            'new_password' => 'min:3|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required'
        ];
        $messages = [
            'old_password.required' => 'Mật khẩu là trường bắt buộc',
            'new_password.required' => 'Mật khẩu là trường bắt buộc',
            'new_password.min' => 'Độ dài tối thiểu là 3 ký tự',
            'confirm_password.required'=>'Mật khẩu không trùng khớp',
            'confirm_password.required_with'=>'Mật khẩu không trùng khớp',
        ];
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) 
        {
            // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng ký và thông báo lỗi
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (Auth::guard('customer')->check()) {
           $checkin = [
               'email' => Auth::guard('customer')->user()->email,
               'password' => $input['old_password']
           ];
           if (Auth::guard('customer')->attempt($checkin)) {
               $customer = Customer::where('id', Auth::guard('customer')->user()->id)->first();
               $customer->password = bcrypt($input['new_password']);
               $customer->save();
           }
        }
        return redirect()->route('customer-info')->with('success', 'Đổi mật khẩu thành công!');
    }
}

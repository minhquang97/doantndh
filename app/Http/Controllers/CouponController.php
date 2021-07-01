<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Customer;
use DB;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    public function index()
    {
        $data = Coupon::all();
        $status_coupon = ['Đã sử dụng', 'Chưa sử dụng'];
        return view('admin.coupon.index', compact('data', 'status_coupon'));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $rules = [
                'coupon_code'=>'max:10',
                'value'=>'required|max:255',
                'expire'=>'required|max:11',
            ];

            $messages = [
                'coupon_code.max'=>"Mã giảm giá tối đa 10 ký tự",
                'value.required'=>"Giá trị không được để trống!",
                'value.max'=>"Giá trị tối đa 255 ký tự",
                'expire.required'=> "Hạn sử dụng không được để trống",
            ];

            $input = $request->all();
            $validator = Validator::make($input, $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = new Coupon();
            $coupon_code = $input['coupon_code'];
            if (empty($coupon_code)) {
                render:
                $coupon_code = Str::upper(Str::random(5));
                $check_code = $this->checkCouponCode($coupon_code);
                if ($check_code) {
                    goto render;
                }
            }else{
               $check_code = $this->checkCouponCode($coupon_code);
                if ($check_code) {
                    return redirect()->back()->with('fail', "Mã giảm giá đã tồn tại");
                } 
            }
            $data->coupon_code = $coupon_code;
            $data->value = $input['value'];
            $data->expire = $input['expire'];
            $data->status = (int)$input['status'];
            $data->save();

            return redirect()->route('admin-coupon-list');
        }else{
            return view('admin.coupon.create');
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role_id != 1) {
            return view('admin.404');
        }
        $data = Coupon::where('id', $id)->whereNull('customer_id')->first();

        if ($request->isMethod('post')) {
            $input = $request->all();

             $rules = [
                'coupon_code'=>'max:10',
                'value'=>'required|max:255',
                'expire'=>'required|max:11',
            ];

            $messages = [
                'coupon_code.max'=>"Mã giảm giá tối đa 10 ký tự",
                'value.required'=>"Giá trị không được để trống!",
                'value.max'=>"Giá trị tối đa 255 ký tự",
                'expire.required'=> "Hạn sử dụng không được để trống",
            ];

            $validator = Validator::make($input, $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $coupon_code = $input['coupon_code'];
            if (empty($coupon_code)) {
                render:
                $coupon_code = Str::upper(Str::random(5));
                $check_code = $this->checkCouponCode($coupon_code);
                if ($check_code) {
                    goto render;
                }
            }else{
               $check_code = $this->checkCouponCode($coupon_code);
                if ($check_code) {
                    return redirect()->back()->with('fail', "Mã giảm giá đã tồn tại");
                } 
            }
            $data->coupon_code = $coupon_code;
            $data->value = $input['value'];
            $data->expire = $input['expire'];
            $data->status = (int)$input['status'];
            $data->save();
            return redirect()->route('admin-coupon-list');
        }else{
            if (!$data) {
                return view('admin.404');
            }
            return view('admin.coupon.update', compact('data'));
        }
    }

    public function delete($id)
    {
        $check_role = Auth::user()->role_id;
        if ($check_role > 1) {
            return redirect()->back()->with('Lỗi', 'Bạn không thể thao tác');
        }
        $data = Coupon::where('id', $id)->first();
        $data->customer_id = null;
        $data->status = 0;
        $data->update();
        return redirect()->back();
    }

    public function checkCouponCode($code)
    {
        return Coupon::where('coupon_code', $code)->count();
    }
}

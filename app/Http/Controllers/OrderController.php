<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Auth;

class OrderController extends Controller
{
    public function index()
    {
        $data = Order::with('hasCustomer')
                        ->where('deleted', 0)
                        ->paginate(8);
        // $data_type = ProductType::all();
        return view('admin.order.index', compact('data'));
    }

    public function detail(Request $request, $id)
    {
        $data = Order::where('id', $id)
                        ->with('hasCustomer')
                        ->with('coupon')
                        ->first();
        // $data_type = ProductType::all();
        $order_status = ["Hủy", "Thành công", "Đang xử lý", "Đã xác nhận","Chờ xác nhận"];
        return view('admin.order.detail', compact('data', 'order_status'));
    }

    public function update(Request $request, $id)
    {
         $data = Order::where('id', $id)
                        ->with('hasCustomer')
                        ->with('coupon')
                        ->first();
        $order_status = ["Hủy", "Xác nhận", "Đang xử lý", "Đã xác nhận","Chờ xác nhận"];

        if ($request->isMethod('post')) {
            $input = $request->all();

            $rules = [
                'note'=>'max:5000',
                'status'=>'required',
            ];

            $messages = [
                'note.max' => 'Độ dài tối đa là 5000 ký tự',
                'status.required' => 'Bạn chưa chọn trạng thái',
            ];

            $validator = Validator::make($input, $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data->note = $input['note'];
            $data->status = (int)$input['status'];
            $data->update();
            return redirect()->route('admin-order-list');
        }else{
            if (!$data) {
                return view('admin.404');
            }
            return view('admin.order.update', compact('data', 'order_status'));

        }
    }

    public function delete($id)
    {
        $check_role = Auth::user()->role_id;
        if ($check_role > 1) {
            return redirect()->back()->with('Lỗi', 'Bạn không thể thao tác');
        }
        $data = Order::where('id', $id)->first();
        $data->deleted = 1;
        $data->update();
        return redirect()->back();
    }
}

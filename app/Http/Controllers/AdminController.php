<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Order;
use App\Models\MakeAppointment;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function getAdminIndex(){
        if (Auth::check()) {
            $order = Order::where('deleted', 0)->orderBy('total_price', 'DESC')->get();
            $order_success = Order::where('deleted', 0)->where('status', 1)->orderBy('total_price', 'DESC')->get();
            $order_percent_success = round(count($order_success)/count($order)*100, 2);
            $order_status = ["Hủy", "Thành công", "Đang xử lý", "Đã xác nhận","Chờ xác nhận"];
            $order_status_color = ["badge-secondary", "badge-success", "badge-primary", "badge-warning","badge-danger"];

            $products = Product::whereNull('deleted')->orderBy('cost_sale', 'DESC')->get();
            $make_appointment = MakeAppointment::all();
            $customer = Customer::where('deleted', 0)->get();
            return view('admin.dashboard', compact('order', 'products', 'make_appointment', 'customer', 'order_percent_success', 'order_success','order_status', 'order_status_color'));
        }else{
            return redirect()->route('admin-login');
        }
    }

    public function makeAppointment(Request $request)
    {
        $data = MakeAppointment::orderBy('status', 'ASC')->paginate(8);
        return view('admin.make-appointment', compact('data'));
    }

    public function detailMakeAppointment(Request $request, $id)
    {
        $data = MakeAppointment::where('id', $id)->with('creator')->first();
        $appointment_status = ['Đặt lịch', 'Đã liên hệ'];
        return view('admin.detail-make-appointment', compact('data', 'appointment_status'));
    }

    public function closedMakeAppointment(Request $request)
    {
        $input  = $request->all();
        $closed = MakeAppointment::where('id', $input['id'])->first();
        $closed->status = 1;
        $closed->closed_date = Carbon::now();
        $closed->creator_id = Auth::user()->id;
        $status = $closed->update();
        if ($status) {
            $message = 'Đã tiếp nhận';
        }else{
            $message = 'Cõ lỗi, thử lại';
        }
        $data = [
            'message' => $message,
            'status' => $status
        ];
        return response()->json($data);
    }
}

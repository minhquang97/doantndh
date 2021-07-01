<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Customer;
use App\Models\MakeAppointment;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
    public function getIndex(){
        $products = Product::whereNull('deleted')->where('status', 1)->orderBy('cost_sale', 'DESC')->paginate(8);
        return view('home', compact('products'));
    }

    public function getAbountUs(){
        return view('about-us');
    }

    public function getMakeAppointment(){
        return view('make-appointment');
    }

    public function postMakeAppointment(Request $request){
        $input = $request->all();
        $rules = [
            'first_name'=>'required|max:255',
            'last_name'=>'required|max:255',
            'email'=>'required|max:255',
            'phone'=>'required|max:11',
            'subject'=>'required|max:5000',
            'description'=>'required|max:5000',
        ];

        $messages = [
            'first_name.required'=>"Tên không được để trống!",
            'last_name.required'=>"Tên không được để trống!",
            'first_name.max'=>"Tên tối đa 50 ký tự",
            'last_name.max'=>"Tên tối đa 50 ký tự",
            'email.required'=>"Email không được để trống!",
            'email.max'=>"Email tối đa 50 ký tự",
            'description.required'=> "Chi tiết không được để trống",
            'description.max'=>"Chi tiết tối đa 5000 ký tự",
            'phone.required'=> "Số điện thoại không được để trống",
            'phone.max'=>"Số điện thoại tối đa 11 ký tự",
            'subject.required'=> "Vấn đề không được để trống",
            'subject.max'=>"Vấn đề tối đa 50 ký tự",
        ];

        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = new MakeAppointment();
        $data->first_name = $input['first_name'];
        $data->last_name = $input['last_name'];
        $data->email = $input['email'];
        $data->phone = $input['phone'];
        $data->subject = $input['subject'];
        $data->description = $input['description'];
        $data->created_date = Carbon::now();
        $data->status = 0;
        $status = $data->save();
        if (!$status) return redirect()->route('index')->with('fail', 'Đã đặt lịch thất bại, vui lòng thử lại');
        return redirect()->route('index')->with('success', 'Đã đặt lịch thành công');
    }

    public function getListProduct(Request $request){
        $query = DB::table('product');
        if ($request->input('type')) {
            $query->where('product_type_id', $request->input('type'));
        }
        if ($request->input('price')) {
            $query->orderBy('cost_sale', $request->input('price'));
        }
        if ($request->input('search')) {
            $query->where('name', 'like', '%'.$request->input('search').'%');
        }
        $data = $query->whereNull('deleted')->where('status', 1)->paginate(9);
        $data_type = ProductType::all();
        return view('product-list', compact('data', 'data_type'));
    }

    public function getProductDetail(Request $request, $id){
        $data = Product::where('id', $id)->where('status', 1)->whereNull('deleted')->first();
        if (!$data) {
            return view('404');
        }
        $data_related = Product::where('product_type_id', $data->product_type_id)->where('status', 1)->whereNull('deleted')->take(3)->get();
        $data_type = ProductType::all();
        return view('product-detail', compact('data', 'data_type', 'data_related'));
    }

    public function getCart(){
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('login');
        }else{
            $customer = Auth::guard('customer')->user();
        }
        $data = Cart::where('customer_id', $customer->id)
                    ->with('infoProduct')
                    ->get();
        $coupon = Coupon::where('customer_id', $customer->id)->where('status', 1)->where('expire', '>', Carbon::now())->first();
        $cart_total = Cart::where('customer_id', $customer->id)->sum(DB::raw('quantity*price'));
        return view('cart', compact('data', 'cart_total', 'coupon'));
    }

    // Thêm sản phẩm vào giỏ hàng
    public function postAddCart(Request $request){
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('login');
        }else{
            $customer = Auth::guard('customer')->user();
        }
        $input = $request->all();
        $cart = new Cart();
        $cart->product_id = $input['product_id'];
        $cart->quantity = $input['quantity'];
        $cart->price = $input['price'];
        $cart->customer_id = $customer->id;
        $cart->save();

        return redirect()->route('shopping-cart');
    }

    //Xóa sản phẩm khỏi giỏ hàng
    public function removeCart(Request $request, $id){
        $input = $request->all();
        $cart = Cart::where('id', $id)->first();
        $status = $cart->delete();
        if (!$status) {
            return redirect()->back()->with('fail', 'Xóa thành thất bại');
        }
        return redirect()->back()->with('success', 'Xóa thành công');
    }

    //Thêm mã giảm giá
    public function addCoupon(Request $request){
        $input = $request->all();
        $coupon_info = Coupon::where('coupon_code', $input['code'])
                        ->whereNull('customer_id')
                        ->where('expire', '>', Carbon::now())
                        ->where('status', 1)
                        ->first();
        if(!$coupon_info){
            fail:
            $message = "Mã giảm giá bạn sử dụng không tồn tại, hết hạn hoặc đã được sử dụng";
            $status = "fail";
            $value = 0;
        }else{
            $coupon_info->customer_id = Auth::guard('customer')->user()->id;
            $status = $coupon_info->save();
            if ($status == true) {
                $message = "Bạn sử dụng thành công mã giảm giá";
                $status = "success";
                $value = $coupon_info;
            }
        }
        $data = [
            'message' => $message,
            'status' => $status,
            'data' => $value
        ];
        return response()->json($data);
    }

    //Xóa mã giảm giá
    public function removeCoupon($id){
        $data = Coupon::find($id);
        $data->customer_id = null;
        $data->save();
        return redirect()->back();
    }

    //Tạo đơn hàng
    public function postCheckoutCart(Request $request){
        $input = $request->all();
        if (count($input['products'])) {
            $order_detail = [];
            $total_price = 0;
            foreach($input['products'] as $item){
                array_push($order_detail, (object)$item);
                $total_price += $item['price'] * $item['quantity'];
            }
        }else{
            return redirect()->back()->with('fail', 'Không tìm thấy sản phẩm trong giỏ hàng');
        }

        if ($input['coupon_id']) {
            $check_coupon = Coupon::where('id', $input['coupon_id'])->where('status', 1)->where('expire', '>', Carbon::now())->first();
            if (!$check_coupon) {
                return redirect()->back()->with('fail', 'Mã giảm giá bạn sử dụng không tồn tại, hết hạn hoặc đã được sử dụng');
            }
            $total_price = $total_price - $check_coupon->value;
        }
        
        $id = DB::table('order')->insertGetId([
            'customer_id' => $input['customer_id'],
            'order_detail' => json_encode($order_detail),
            'coupon_id' => $input['coupon_id'],
            'order_date' => Carbon::now(),
            'total_price' => $total_price,
            'status' => 5, //Đang chờ đặt hàng
        ]);

        if ($id) {
            $carts = Cart::where('customer_id', $input['customer_id'])->delete();
            if (!$carts) {
                return redirect()->back()->with('fail', 'Giỏ hàng trống');
            }
        }else{
            return redirect()->back()->with('fail', 'Giỏ hàng trống');
        }
        return redirect()->route('checkout-cart', ['id' => $id]);
    }

    //Trang đặt hàng
    public function checkoutCart(Request $request, $id = null){
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('login');
        }else{
            $customer = Auth::guard('customer')->user();
        }
        if (!$id) {
            return view('404');
        }
        $data = Order::where('id', $id)
                    ->where('customer_id', $customer->id)
                    ->where('status', 5)
                    ->first();
        if (!$data) {
            return view('404');
        }

        $coupon = [];

        if ($data->coupon_id) {
            $coupon = Coupon::where('id', $data->coupon_id)->where('status', 1)->where('expire', '>', Carbon::now())->first();
            if (!$coupon) {
                $data->coupon_id = null;
                $data->save();
                return redirect()->route('checkout-cart', ['id', $data->id])->with('fail', 'Mã giảm giá của bạn đã hết hạn hoặc đã được sử dụng!');
            }
        }
        $data->coupon_value = $coupon ? $coupon->value : 0;
        $products = json_decode($data->order_detail);
        $cart_total = 0;
        foreach($products as $item){
            $cart_total += $item->price * $item->quantity;
        }

        return view('checkout-cart', compact('data', 'cart_total'));
    }

    // Trang nhập thông tin khách hàng và đặt hàng
    public function postCheckout(Request $request){
        $input = $request->all();
        $address = $input['ad']. ', ' . $input['sc']. ', ' . $input['city']. ', ' . $input['country'];
        $order = Order::where('id', $input['order_id'])->first();
        $order->address = $address;
        $order->status = 4;
        $order->note = $input['note'] ;
        $order->save();
        if ($order) {
            if ($input['coupon_id']) {
                $check_coupon = Coupon::where('id', $input['coupon_id'])->first();
                $check_coupon->status = 0;
                $check_coupon->save();
            }
        }else{
            redirect()->route('finish-cart')->with('fail', 'Có lỗi phát sinh trong quá trình đặt hàng. Bạn vui lòng thử lại!');
        }

        if (isset($input['update_customer']) && $input['update_customer'] == 'on') {
            $customer = Customer::where('id', $input['customer_id'])->first();
            $customer->name = $input['name'];
            $customer->date_of_birth = $input['date_of_birth'];
            $customer->phone = $input['phone'];
            $customer->email = $input['email'];
            $customer->address = $address;
            $status = $customer->save();
            if (!$status) {
                return redirect()->back()->with('fail', 'Cập nhật thông tin cá nhân thất bại');
            }
        }
        
        return redirect()->route('finish-cart')->with('success', 'Bạn đã đặt hàng thành công!');
    }

    public function finishCart(){
        return view('finish-cart');
    }


}

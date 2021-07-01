<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductType;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Auth;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::whereNull('deleted')
                        ->with('hasType')
                        ->orderBy('id', 'DESC')
                        ->paginate(18);
        $data_type = ProductType::all();
        return view('admin.products.index', compact('data', 'data_type'));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {

            $rules = [
                'name'=>'required|max:255',
                'title'=>'required|max:5000',
                'description'=>'required|max:5000',
                'cost_price'=>'required|max:50',
                'cost_sale'=>'required|max:50',
                'unit'=>'required|max:50',
            ];

            $messages = [
                'name.required'=>"Tên sản phẩm không được để trống!",
                'name.max'=>"Tên sản phẩm tối đa 255 ký tự",
                'title.required'=>"Nội dung không được để trống!",
                'title.max'=>"Nội dung tối đa 5000 ký tự",
                'description.required'=> "Mô tả không được để trống",
                'description.max'=>"Mô tả tối đa 5000 ký tự",
                'cost_price.required'=> "Giá nhập không được để trống",
                'cost_price.max'=>"Giá nhập tối đa 11 ký tự",
                'cost_sale.required'=> "Giá bán không được để trống",
                'cost_sale.max'=>"Giá bán tối đa 50 ký tự",
                'unit.required'=> "Đơn vị không được để trống",
                'unit.max'=>"Đơn vị tối đa 50 ký tự",
            ];

            $input = $request->all();
            $validator = Validator::make($input, $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $filename = $input['image']??"";
            if($request->hasFile('image')){
                $file = $input['image'];
                $extensions = ['jpg', 'jpeg', 'png'];
                if(in_array($file->getClientOriginalExtension('image'), $extensions)){
                    $filename = Str::random(6).'.'.$file->getClientOriginalExtension('image');
                    $file->move("upload/", "upload/$filename");
                }
            }

            render:
            $code = Str::upper(Str::random(6)); //Tạo một mã ngẫu nhiên duy nhất
            $check_code = Product::where('code', $code)->count(); //Kiểm tra nếu mã đã tồn tại trong DB thì render lại mã khác.
            if ($check_code) {
                goto render;
            }
            $data = new Product();
            $data->code = $code;
            $data->name = $input['name'];
            $data->product_type_id = $input['product_type_id'];
            $data->image = $filename ?? '';
            $data->cost_price = $input['cost_price'];
            $data->cost_sale = $input['cost_sale'];
            $data->title = $input['title'];
            $data->description = $input['description'];
            $data->status = 0;
            $data->save();

            return redirect()->route('admin-product-list');
        }else{
            $data_type = ProductType::all();
            return view('admin.products.create', compact('data_type'));
        }
    }

    public function update(Request $request, $id)
    {
        $data = Product::where('id', $id)->first();

        if ($request->isMethod('post')) {
            $input = $request->all();

            $rules = [
                'name'=>'required|max:255',
                'title'=>'required|max:5000',
                'description'=>'required|max:5000',
                'cost_price'=>'required|max:50',
                'cost_sale'=>'required|max:50',
                'unit'=>'required|max:50',
            ];

            $messages = [
                'name.required'=>"Tên sản phẩm không được để trống!",
                'name.max'=>"Tên sản phẩm tối đa 255 ký tự",
                'title.required'=>"Nội dung không được để trống!",
                'title.max'=>"Nội dung tối đa 5000 ký tự",
                'description.required'=> "Mô tả không được để trống",
                'description.max'=>"Mô tả tối đa 5000 ký tự",
                'cost_price.required'=> "Giá nhập không được để trống",
                'cost_price.max'=>"Giá nhập tối đa 11 ký tự",
                'cost_sale.required'=> "Giá bán không được để trống",
                'cost_sale.max'=>"Giá bán tối đa 50 ký tự",
                'unit.required'=> "Đơn vị không được để trống",
                'unit.max'=>"Đơn vị tối đa 50 ký tự",
            ];

            $input = $request->all();
            $validator = Validator::make($input, $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $filename = $input['image']??"";
            if($request->hasFile('image')){
                $file = $input['image'];
                $extensions = ['jpg', 'jpeg', 'png'];
                if(in_array($file->getClientOriginalExtension('image'), $extensions)){
                    $filename = Str::random(6).'.'.$file->getClientOriginalExtension('image');
                    $file->move("upload/", "upload/$filename");
                }
            }

            $data->name = $input['name'];
            $data->product_type_id = $input['product_type_id'];
            $data->image = $filename??'';
            $data->cost_price = $input['cost_price'];
            $data->cost_sale = $input['cost_sale'];
            $data->title = $input['title'];
            $data->description = $input['description'];
            $data->status = (int)$input['status'];
            $data->update();
            return redirect()->route('admin-product-list');
        }else{
            if (!$data) {
                return view('admin.404');
            }
            $data_type = ProductType::all();
            return view('admin.products.update', compact('data', 'data_type'));
        }
    }

    public function delete($id)
    {
        $check_role = Auth::user()->role_id;
        if ($check_role > 1) {
            return redirect()->back()->with('Lỗi', 'Bạn không thể thao tác');
        }
        $data = Product::where('id', $id)->first();
        $data->deleted = 1;
        $data->update();
        return redirect()->back();
    }

}

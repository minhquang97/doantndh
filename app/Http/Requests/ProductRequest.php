<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|max:255',
            'title'=>'required|max:5000',
            'description'=>'required|max:5000',
            'cost_price'=>'required|min:1|max:11',
            'sale_price'=>'required|min:1|max:11',
            'unit'=>'required|max:50',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'=>"Tên sản phẩm không được để trống!",
            'name.max'=>"Tên sản phẩm tối đa 255 ký tự",
            'title.required'=>"Nội dung không được để trống!",
            'title.max'=>"Nội dung tối đa 5000 ký tự",
            'description.required'=> "Mô tả không được để trống",
            'description.max'=>"Mô tả tối đa 5000 ký tự",
            'cost_price.required'=> "Giá nhập không được để trống",
            'cost_price.max'=>"Giá nhập tối đa 11 ký tự",
            'cost_price.min'=> "Giá nhập tối thiểu là 0",
            'sale_price.required'=> "Giá bán không được để trống",
            'sale_price.max'=>"Giá bán tối đa 99999999999",
            'sale_price.min'=> "Giá bán tối thiểu là 0",
            'unit.required'=> "Đơn vị không được để trống",
            'unit.max'=>"Đơn vị tối đa 50 ký tự",
        ];
    }
}

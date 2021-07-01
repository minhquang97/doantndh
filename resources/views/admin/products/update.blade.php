@extends('admin.index')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Quản lý sản phẩm</h3>
                        </div>
                        <!-- form start -->
                        <form action="{{ route('p-update-admin-product', $data->id) }}" method="post" enctype="multipart/form-data">
                        	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Tên sản phẩm</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Nhập tên sản phẩm"  value="{{ $data->name }}" />
                                    @if ($errors->has('name'))
                                        <p style="color: red;">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="name">Loại sản phẩm</label>
                                    <select class="form-control" name="product_type_id">
                                    	<option value="">Chọn loại sản phẩm</option>
                                    	@foreach($data_type as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $data->product_type_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('product_type_id'))
                                        <p style="color: red;">{{ $errors->first('product_type_id') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Ảnh minh họa</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="exampleInputFile" name="image"  />
                                    </div>
                                    @if ($errors->has('image'))
                                        <p style="color: red;">{{ $errors->first('image') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Giá niêm yết</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Giá niêm yết" name="cost_sale"  value="{{ $data->cost_sale }}" />
                                    @if ($errors->has('cost_sale'))
                                        <p style="color: red;">{{ $errors->first('cost_sale') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Giá bán</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Giá bán" name="cost_price" value="{{ $data->cost_price }}" />
                                    @if ($errors->has('cost_price'))
                                        <p style="color: red;">{{ $errors->first('cost_price') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số lượng</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Giá bán" name="unit" value="{{ $data->unit }}" />
                                    @if ($errors->has('unit'))
                                        <p style="color: red;">{{ $errors->first('unit') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tiêu đề</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Tiêu đề" name="title" value="{{ $data->title }}" />
                                    @if ($errors->has('title'))
                                        <p style="color: red;">{{ $errors->first('title') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea class="form-control" cols="20" rows="5" name="description">{{ $data->description?? "" }}</textarea>
                                    @if ($errors->has('description'))
                                        <p style="color: red;">{{ $errors->first('description') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Trạng thái</label>
                                    <select class="form-control" name="status">
                                    	<option value="">Trạn thái sản phẩm</option>
                                    	<option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Kích hoạt</option>
                                    	<option value="0" {{ $data->status == 0 ? 'selected' : '' }}>Chưa kích hoạt</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <p style="color: red;">{{ $errors->first('status') }}</p>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
</div>
@endsection
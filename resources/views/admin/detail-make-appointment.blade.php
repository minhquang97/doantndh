@extends('admin.index')
@section('content')
<div class="content-wrapper">
	<section class="content pt-5">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-calendar" title="Mã đặt lịch"></i> #{{ $data->id }}
                    <small class="float-right">{{ $data->created_date }}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-8 invoice-col">
                  <strong>{{ $data->first_name.' '.$data->last_name }}</strong>
                  <address>
                    <br>
                    <div class="row pl-2">
                    	<b>Vấn đề</b>: {{ $data->subject }}
                    </div>
                    <b>Email</b>: {{ $data->email }}<br>
                    <b>Số điện thoại</b>: {{ $data->phone }}<br>
                   	<b>Chi tiết</b>: {!! $data->description !!}
                  </address>
                </div>
                <div class="col-sm-4 invoice-col">
                  	<b></b><br>
                  	<br>
                  	<b>Trạng thái:</b> <span id="status">{{ $appointment_status[$data->status] }}</span><br>
                	@if($data->creator_id)
                  	<b>Nhân viên liên hệ:</b> {{ $data->creator->username }}<br>
                  	<b>Đã liên hệ:</b> {{ $data->closed_date }}<br>
                	@else
                  	<div class="row pt-2 pl-2">
                  		<input type="hidden" name="id" value="{{ $data->id }}">
		          		<div id="closed" class="btn btn-sm btn-success float-right">Đã tiếp nhận</div>
                  	</div>
                  	@endif
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
</div>
@section('script')
<script>
	$('#closed').click(function(){
		let id = $('input[name=id]').val();
		$.ajax({
           	type: "POST",
           	url: `{{ route('admin-make-appointment-closed') }}`,
           	dataType: "json",
           	data: {id: id, _token: `{{ csrf_token() }}`},
           	success: function (data) {
	           	if (data.status) {
	           		$('#status').html('Đã tiếp nhận');
	           		$('#closed').remove();
	           	}
               	alert(data.message);
           	},
       	});
	})
</script>
@endsection
@endsection
@extends('layout.index')

@section('content')

@include('layout.menu')
<h4 class="title"><span class="text"><strong>Đơn hàng</strong></span></h4>
				<table class="table table-striped" style="border: 1px solid #eaeaea;">
					<thead>
						<tr>
							<th>Tên sản phẩm</th>
						</tr>
					</thead>
					<tbody>
						@foreach($order as $item)
						<tr>
							<td>{!! $item->total !!}</td>
							
						</tr>
						@endforeach  
					</tbody>
				</table>

@endsection
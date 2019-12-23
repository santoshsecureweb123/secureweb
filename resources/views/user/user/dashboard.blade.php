@extends('user.user.header')
@section('dashboard_content')
<div class="content-page">
  <div class="content">
    <div class="container-fluid">
      <div class="table-responsive">
        <table class="table mb-0">
          <thead>@if(Session::has('success')) {{ Session::get('success') }} @endif
            <tr>
              <th>Sr.No</th>
              <th>Name</th>
              <th>Quiz Name</th>
              <th>Persentage</th>
              <th>Image</th>
            </tr>
          </thead>
          <tbody>
            <?php $i=1; ?>@foreach($final_Data as $datas)
            <tr>
              <td scope="row">{{$i}}</td>
              <td scope="row">{{$datas['name']}}</td>
              <td scope="row">{{$datas['quiz_name']}}</td>
              <td scope="row">{{$datas['percentage']}}</td>
              
              <td>
              <img src="{{ asset('image') }}/{{$datas['image']}}" height="50px" width="50px" style="border-radius: 50px;">
            </td>
            </tr>
            <?php $i++; ?>@endforeach</tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection
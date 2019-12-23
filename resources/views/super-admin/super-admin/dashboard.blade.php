@extends('super-admin.super-admin.header')

@section('dashboard_content')
  <div class="content-page">
    <div class="content">
      <div class="container-fluid">
        <div class="page-title-box">
         {!! $chart->html() !!}
        </div>
      </div>
    </div>
</div>
{!! Charts::scripts() !!}
{!! $chart->script() !!}
@endsection

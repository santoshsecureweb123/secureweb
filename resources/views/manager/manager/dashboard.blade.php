@extends('manager.manager.header')
@section('dashboard_content')
<div class="content-page">
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          {!! $chart->html() !!}
        </div>
        <div class="col-md-6">
          <h5 class="center mt5">Latest News</h5>
          <iframe name="NewsIFrame" src="{{URL::to('news')}}" frameborder="0" scrolling="no" width="100%" height="100%"></iframe>
        </div>
      </div>
    </div>
  </div>
</div>
{!! Charts::scripts() !!}
{!! $chart->script() !!}
@endsection
@extends('user.user.header')
@section('dashboard_content')
<div class="content-page">
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="table-responsive">
          @if(Session::has('success'))
              {{ Session::get('success') }}
          @endif
          <table class="table mb-0">
            <thead>                   
              <tr>
                <th>Sr.No</th>
                <th>Quiz Name</th>
                <th>Skill Name</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>@foreach($quizs as $allQuiz)
              <tr>
                <th scope="row">{{$i}}</th>
                <td>{{$allQuiz->quiz_name}}</td>
              <td>
              <a href="{{route('startQuiz',['id'=>$allQuiz->quiz_id])}}">
                <button type="button" class="btn btn-info waves-effect waves-light" >Start Quiz </button>
              </a>
              </td> 
              </tr>
              <?php $i++; ?>
            @endforeach</tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
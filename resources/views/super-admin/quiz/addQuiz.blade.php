@extends('super-admin.super-admin.header')
@section('dashboard_content')
   <div class="content-page">
   	<div class="content">
			<div class="container-fluid">
				<div class="page-title-box">
					@if(Session::has('success'))
					    {{ Session::get('success') }}
					@endif
					<h2>Add Quiz</h2>
					<form action="{{route('addQuestion') }}" method="post">
						@csrf

						<div class="form-group">
							<label for="skill_name">Skill:</label>
								<select class="form-control" name="skill_name" id="skill_name" value="{{ old('skill_name') }}">
								<option value="">Select a skill</option>
								@foreach($skills as  $skill)
								<option value="{{$skill->skills_id}}">{{$skill->skills_name}}</option>
								@endforeach
							</select>
						</div>
						@error('skill_name') 
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror

						<input type="hidden" name="author_id" value="{{$user_id}}">
						<input type="hidden" name="author_role_id" value="{{$role_id}}">
						<div class="form-group">
							<label for="role_name">Quiz Name:</label>
							<input type="text" class="form-control" id="quiz_name" placeholder="Enter Question" name="quiz_name" value="{{ old('quiz_name') }}">
						</div>
						@error('quiz_name') 
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror	

						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	
@endsection

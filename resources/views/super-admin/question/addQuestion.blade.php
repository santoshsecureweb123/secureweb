@extends('super-admin.super-admin.header')
@section('dashboard_content')
   <div class="content-page">
   	<div class="content">
			<div class="container-fluid">
				<div class="page-title-box">
					@if(Session::has('success'))
					    {{ Session::get('success') }}
					@endif
					<h2>Add Question</h2>
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
							<label for="role_name">Question Name:</label>
							<input type="text" class="form-control" id="ques_name" placeholder="Enter Question" name="ques_name" value="{{ old('ques_name') }}">
						</div>
						@error('ques_name') 
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror						

						<div class="form-group">
							<label for="option_value">Option Value:</label>
								<select class="form-control" id="option_value" name="option_value">
								<option value="">Select Option Value</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
							</select>
						</div>
						@error('option_value') 
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror	

						<div class="form-group options" style="display: none;">
							<label for="options">Enter Option:</label>
								<div class="form-group" name="options" id="options">
								
							</div>
						</div>	
						@error('option') 
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror	
						<div class="form-group">
							<label for="correct_answer">Correct Answer:</label>
							<input type="text" class="form-control" id="correct_answer" placeholder="Enter Correct Answer" name="correct_answer" value="{{ old('correct_answer') }}">
						</div>	
						@error('correct_answer') 
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
	<script>
		$('select#option_value').change(function(){
				var val = $(this).val();
				$('.options').show();
				$("#options").empty();
				for (i = 1; i <= val; i++) {
				  $("#options").append("<input type='text' class='form-control' name='option[]'>");
				}

		});
	</script>
@endsection

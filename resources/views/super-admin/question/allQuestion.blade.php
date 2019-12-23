@extends('super-admin.super-admin.header') @section('dashboard_content')
<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="page-title-box">
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-body">
								<button type="button" class="btn btn-info waves-effect waves-light" id="add_new_question">Add New Question</button>
								<div class="table-responsive">
									<table class="table mb-0">
										<thead>
											@if(Session::has('success')) {{ Session::get('success') }} @endif
											<tr>
												<th>Sr.No</th>
												<th>Question Name</th>
												<th>Skill Name</th>
												<th>Question Option</th>
												<th>Question Answer</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php $i=1; ?>@foreach($allQuestions as $allQuestion)
											<tr>
												<th scope="row">{{$i}}</th>
												<td>{{$allQuestion->question_name}}</td>
												<?php $skillName = App\Skill::where('skills_id',$allQuestion->skill_id)->first('skills_name'); ?>
												<td>{{$skillName->skills_name}}</td>
												<td>{{$allQuestion->option}}</td>
												<td>{{$allQuestion->answer}} 
											</td>
											<td>
												<button type="button" class="btn btn-info waves-effect waves-light" onClick="editquestion({{$allQuestion->question_id}})" data-toggle="modal" data-target="#myModal" >Edit</button>
												<button type="button" class="btn btn-danger waves-effect waves-light" onClick="deleteQuestion({{$allQuestion->question_id}})">Delete</button>
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

				<div class="addQuestion" id="addQuestion" style="display: none;">
					<h2>Add Question</h2>
					<form action="{{route('addQuestion') }}" method="post">
						@csrf

					<!-- 	<div class="form-group">
							<label for="skill_name">Skill:</label>
								<select class="form-control" name="skill_name" value="{{ old('skill_name') }}">
								<option value="">Select a skill</option>
								@foreach($skills as  $skill)
								<option value="{{$skill->skills_id}}">{{$skill->skills_name}}</option>
								@endforeach
							</select>
						</div> -->
				<!-- 		@error('skill_name') 
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror -->

						<input type="hidden" name="author_id" value="{{$user_id}}">
						<input type="hidden" name="author_role_id" value="{{$role_id}}">
						<input type="hidden" name="quiz_id" value="{{$quizID}}">
						<input type="hidden" name="skill_name" value="{{$skill_id}}">
						<div class="form-group">
							<label for="role_name">Question Name:</label>
							<input type="text" class="form-control" placeholder="Enter Question" name="ques_name" value="{{ old('ques_name') }}">
						</div>
						@error('ques_name') 
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror						

						<div class="form-group">
							<label for="option_value">Option Value:</label>
								<select class="form-control option_value"  name="option_value">
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
								<div class="form-group options" name="options" id="options">
								
							</div>
						</div>	
						@error('option') 
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror	
						<div class="form-group">
							<label for="correct_answer">Correct Answer:</label>
							<input type="text" class="form-control" placeholder="Enter Correct Answer" name="correct_answer" value="{{ old('correct_answer') }}">
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
</div>

<div class="container">
	<div class="modal" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					@if(Session::has('success'))
					    {{ Session::get('success') }}
					@endif
					<h2>Edit Question</h2>
					<form action="{{route('addQuestion') }}" method="post">
						@csrf
					<input type="hidden" name="question_id" id="question_id">
					<!-- 	<div class="form-group">
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
						@enderror -->

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
								<select class="form-control option_value" id="option_value" name="option_value">
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

						<div class="form-group options">
							<label for="options">Enter Option:</label>
								<div class="form-group options" name="options" id="options">
								
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
</div>

<script>

	$('#add_new_question').click(function(){
		$('#addQuestion').show();
	});
	$('select.option_value').change(function(){
				var val = $(this).val();
				$('.options').show();
				$(".options").empty();
				for (i = 1; i <= val; i++) {
				  $(".options").append("<input type='text' class='form-control' name='option[]'>");
				}

		});
	function editquestion(quesId) {
		$('select option').removeAttr('selected','selected');
		$.ajax({
		url:"{{route('editQuestion')}}",
		type:'get',
		data:{_token: "{{ csrf_token() }}", quesId:quesId},
		success:function(res)
		{
				console.log(res);
				$(".options").empty();
			if(res.success == true)
				{
					var optioncount = jQuery.parseJSON(res.option);					
					// $('#skill_name option[value="'+res.skill_id+'"]').attr('selected','selected');
					$('#ques_name').val(res.question_name);
					$('#question_id').val(res.question_id);
					$('#option_value option[value="'+optioncount.length+'"]').attr('selected','selected');
					$.each(optioncount, function(key, value) {
					    $(".options").append("<input type='text' class='form-control' name='option[]' value='"+value+"'>");
					});
					$('#correct_answer').val(res.answer);
				}
			}
		});
	}
	
	function deleteQuestion(quesId) {
	
		if (confirm("Are you sure delete team")){
			$.ajax({
				url:"{{route('deleteQuestion')}}",
				type:'get',
				data:{_token: "{{ csrf_token() }}", quesId:quesId},
				success:function(res)
				{
					if(res.success == true)
					{
						location.reload(true);
					}
				}
			});
		}
	
	}
</script>
@endsection
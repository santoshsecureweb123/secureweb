@extends('super-admin.super-admin.header') @section('dashboard_content')
<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="page-title-box">
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-body">
								<button type="button" class="btn btn-info waves-effect waves-light" id="add_new_quiz">Add New Quiz</button>
								@if(Session::has('success'))
								  {{ Session::get('success') }}
								@endif
								<div class="table-responsive">
									<table class="table mb-0">
										<thead>										
											<tr>
												<th>Sr.No</th>
												<th>Quiz Name</th>
												<th>Skill Name</th>
												<th>Action</th>
												<th>Question</th>
											</tr>
										</thead>
										<tbody>
											<?php $i=1; ?>@foreach($allQuizs as $allQuiz)
											<tr>
												<th scope="row">{{$i}}</th>
												<td>{{$allQuiz->quiz_name}}</td>
												<?php $skillName = App\Skill::where('skills_id',$allQuiz->skill_id)->first('skills_name'); ?>
												<td>{{$skillName->skills_name}}</td>
											<td>
												<button type="button" class="btn btn-info waves-effect waves-light" onClick="editquiz({{$allQuiz->quiz_id}})" data-toggle="modal" data-target="#myModal" >Edit</button>
												<button type="button" class="btn btn-danger waves-effect waves-light" onClick="deleteQuiz({{$allQuiz->quiz_id}})">Delete</button>
											</td>	
											<td>
											<a href="{{route('allQuestion',['id'=>$allQuiz->quiz_id,'skill'=>$allQuiz->skill_id])}}">
												<button type="button" class="btn btn-info waves-effect waves-light" >Quiz Question</button>
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

				<div class="add_quiz" id="add_quiz" style="display: none;">					
					<h2>Add Quiz</h2>
					<form action="{{route('addQuiz') }}" method="post">
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
</div>

<div class="container">
	<div class="modal" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
			
					<h6>Edit Quiz</h6>
					<form action="{{route('addQuiz') }}" method="post">
						@csrf

						<div class="form-group">
							<label for="skill_name">Skill:</label>
								<select class="form-control" name="skill_name" id="ski_name" value="{{ old('skill_name') }}">
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

						<input type="hidden" name="quiz_id" id="quiz_id">
						<div class="form-group">
							<label for="role_name">Quiz Name:</label>
							<input type="text" class="form-control" id="q_name" placeholder="Enter Question" name="quiz_name" value="{{ old('quiz_name') }}">
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
</div>
<script>
	$('#add_new_quiz').click(function(){
		$('#add_quiz').show();
	});

	function editquiz(quizId) {
		$('select option').removeAttr('selected','selected');
		$.ajax({
		url:"{{route('editQuiz')}}",
		type:'get',
		data:{_token: "{{ csrf_token() }}", quizId:quizId},
		success:function(res)
		{
			if(res.success == true)
				{
					$('#ski_name option[value="'+res.skill_id+'"]').attr('selected','selected');
					$('#q_name').val(res.quiz_name);
					$('#quiz_id').val(res.quiz_id);
				}
			}
		});
	}
	
	function deleteQuiz(quizId) {
	
		if (confirm("Are you sure delete team")){
			$.ajax({
				url:"{{route('deleteQuiz')}}",
				type:'get',
				data:{_token: "{{ csrf_token() }}", quizId:quizId},
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
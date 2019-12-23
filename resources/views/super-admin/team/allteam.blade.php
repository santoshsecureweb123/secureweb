@extends('super-admin.super-admin.header') @section('dashboard_content')
<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="page-title-box">
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-body">
								<div class="table-responsive">
									<table class="table mb-0">
										<thead>
											@if(Session::has('success')) {{ Session::get('success') }} @endif
											<tr>
												<th>Sr.No</th>
												<th>Team Name</th>
												<th>Team Manager</th>
												<th>Team Leader</th>
												<th>Team Member</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php $i=1; ?>@foreach($teams as $team)
											<tr>
												<th scope="row">{{$i}}</th>
												<td>{{$team->team_name}}</td>
												<?php $teamlead = App\User::where('id',$team->team_manager_id)->first('name'); ?>
												<td>{{$teamlead->name}}</td>
												<?php $teamlead = App\User::where('id',$team->team_lead_id)->first('name'); ?>
												<td>{{$teamlead->name}}</td>

												<td>@foreach(App\User::whereIn('id',explode(",",$team->team_member_id))->get() as $teamMember) {{$teamMember->name}} , 

												@endforeach
											</td>
											<td>
												<button type="button" class="btn btn-info waves-effect waves-light" onClick="editTeam({{$team->team_id}})" data-toggle="modal" data-target="#myModal" >Edit</button>
												<button type="button" class="btn btn-danger waves-effect waves-light" onClick="deleteTeam({{$team->team_id}})">Delete</button>
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
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="modal" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<h6>Edit Team</h6>
					<form action="{{route('create_team') }}" method="post">
						@csrf
						<input type="hidden" name="team_id" id="team_id">
						<div class="form-group">
							<label for="team_name">Team Name:</label>
							<input type="text" class="form-control" id="team_name" placeholder="Enter Name" name="team_name" value="{{ old('team_name') }}">
						</div>
						@error('team_name') 
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror

						<div class="form-group">
							<label for="team_manager">Team Manager</label>
								<select class="form-control" name="team_manager" id="team_manager" value="{{ old('team_manager') }}">
								<option value="">Select a team manager</option>
								@foreach($teamManager as  $teamMan)
								<?php $UID = array_search($teamMan->id,$assignUser); $UID = $assignUser[$UID];
								?>
								<option value="{{$teamMan->id}}" @if($UID == $teamMan->id) disabled @endif>{{$teamMan->name}}@if($UID == $teamMan->id) (Alerady Assiged ) @endif</option>
								@endforeach
							</select>
						</div>
						@error('team_manager') 
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror

						<div class="form-group">
							<label for="u_skills">Team Leader:</label>
							<select class="form-control" name="team_lead" id="team_lead" value="{{ old('team_lead') }}">
								<option value="">Select a team leader</option>
								@foreach($teamleader as  $teamLead)
								<?php $UID = array_search($teamLead->id,$assignUser); $UID = $assignUser[$UID];
								?>
									<option value="{{$teamLead->id}}" @if($UID == $teamLead->id) disabled @endif>{{$teamLead->name}} @if($UID == $teamLead->id) (Alerady Assiged ) @endif</option>
								@endforeach
							</select>
						</div>
						@error('team_lead') 
							<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
							</span>
						@enderror

						<div class="form-group">
							<label for="team_member">Team Member:</label>
							<select class="form-control team_member" name="team_member[]" id="team_member" multiple="multiple" value="{{ old('team_member[]') }}" >

							@foreach($teamMembers as  $teamMem)
								<?php $UID = array_search($teamMem->id,$assignUser); $UID = $assignUser[$UID];
								?>
							<option value="{{$teamMem->id}}" @if($UID == $teamMem->id) disabled @endif>{{$teamMem->name}}@if($UID == $teamMem->id) (Alerady Assiged ) @endif</option>
								@endforeach
							</select>
						</div>

						@error('team_member')
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
	function editTeam(teamId) {
		$('select option').removeAttr('selected','selected');
		$.ajax({
		url:"{{route('editTeam')}}",
		type:'get',
		data:{_token: "{{ csrf_token() }}", teamId:teamId},
		success:function(res)
		{
					
			if(res.success == true)
				{
					$.each(res.allUsed, function(key, value) {
					   $('select option[value='+value+']').attr('disabled','disabled');
					});
					$('#team_id').val(res.team_id);
					$('#team_name').val(res.team_name);
					$('#team_manager option[value='+res.team_manager+']').attr('selected','selected');
					$('#team_manager option[value='+res.team_manager+']').removeAttr('disabled','disabled');
					$('#team_lead option[value='+res.team_lead+']').attr('selected','selected');
					$('#team_lead option[value='+res.team_lead+']').removeAttr('disabled','disabled');
					$('#team_member').val(res.team_member).change();
					$.each(res.team_member, function(key, value) {
					    $('#team_member option[value='+value+']').removeAttr('disabled','disabled');
					});

				}
			}
		});
	}
	
	function deleteTeam(teamId) {
	
		if (confirm("Are you sure delete team")){
			$.ajax({
				url:"{{route('deleteTeam')}}",
				type:'get',
				data:{_token: "{{ csrf_token() }}", teamId:teamId},
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
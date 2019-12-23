@extends('super-admin.super-admin.header')

@section('dashboard_content')
   <div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="page-title-box">
				<h2>Role Management</h2>
				<div class="table-responsive">
					<table class="table mb-0">
						<thead>
							<tr>
								<th>Role Name</th>
								<th>Add</th>
								<th>Edit</th>
								<th>Delete</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<?php $rolemanager=App\RoleStatus::where( 'role_id',$manager)->first();?>
								<td>Manager</td>
								<td>
									<input type="checkbox" name="m_add" id="m_add" value="1" @if(isset($rolemanager->add) && $rolemanager->add == 1) checked @endif></td>
								<td>
									<input type="checkbox" name="m_edit" id="m_edit" value="1" @if(isset($rolemanager->edit) && $rolemanager->edit == 1) checked @endif></td>
								<td>
									<input type="checkbox" name="m_delete" id="m_delete" value="1" @if(isset($rolemanager->delete) && $rolemanager->delete == 1) checked @endif></td>
								<td>
									<button type="button" class="btn btn-info waves-effect waves-light" onClick="manager_({{$manager}})">Update</button>
								</td>
							</tr>
							<tr>
								<?php $rolTL=App\RoleStatus::where( 'role_id',$teamlead)->first();?>
								<td>TL</td>
								<td>
									<input type="checkbox" name="t_add" id="t_add" value="1" @if(isset($rolTL->add) && $rolTL->add == 1) checked @endif></td>
								<td>
									<input type="checkbox" name="t_edit" id="t_edit" value="1" @if(isset($rolTL->edit) && $rolTL->edit == 1) checked @endif></td>
								<td>
									<input type="checkbox" name="t_delete" id="t_delete" value="1" @if(isset($rolTL->delete) && $rolTL->delete == 1) checked @endif></td>
								<td>
									<button type="button" class="btn btn-info waves-effect waves-light" onClick="team_lead_({{$teamlead}})">Update</button>
								</td>
							</tr>
							<tr>
								<?php $roluser=App\RoleStatus::where( 'role_id',$user)->first();?>
								<td>User</td>
								<td>
									<input type="checkbox" name="u_add" id="u_add" value="1" @if(isset($roluser->add) && $roluser->add == 1) checked @endif></td>
								<td>
									<input type="checkbox" name="u_edit" id="u_edit" value="1" @if(isset($roluser->edit) && $roluser->edit == 1) checked @endif></td>
								<td>
									<input type="checkbox" name="u_delete" id="u_delete" value="1" @if(isset($roluser->delete) && $roluser->delete == 1) checked @endif></td>
								<td>
									<button type="button" class="btn btn-info waves-effect waves-light" onClick="user_({{$user}})">Update</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
	<script>
		var add,edit,Delete;
		function manager_(rol_id) {
			add = $('input[name=m_add]:checked').val();
			add = (add == '1' )?add:'0';
			edit = $('input[name=m_edit]:checked').val();
			edit = (edit == '1' )?edit:'0';
			Delete = $('input[name=m_delete]:checked').val();
			Delete = (Delete == '1' )?Delete:'0';
			$.ajax({
				url:"{{route('role_status')}}",
				type:'post',
				data:{_token: "{{ csrf_token() }}",rol_id:rol_id,add:add,edit:edit,Delete:Delete},
				success:function(res)
				{
					console.log(res);
					if(res.success == true)
					{
						location.reload(true);
					}
				}
			});
		}

		function team_lead_(rol_id) {
			add = $('input[name=t_add]:checked').val();
			add = (add == '1' )?add:'0';
			edit = $('input[name=t_edit]:checked').val();
			edit = (edit == '1' )?edit:'0';
			Delete = $('input[name=t_delete]:checked').val();
			Delete = (Delete == '1' )?Delete:'0';
			$.ajax({
				url:"{{route('role_status')}}",
				type:'post',
				data:{_token: "{{ csrf_token() }}",rol_id:rol_id,add:add,edit:edit,Delete:Delete},
				success:function(res)
				{
					console.log(res);
					if(res.success == true)
					{
						location.reload(true);
					}
				}
			});
		}

		function user_(rol_id) {
			add = $('input[name=u_add]:checked').val();
			add = (add == '1' )?add:'0';
			edit = $('input[name=u_edit]:checked').val();
			edit = (edit == '1' )?edit:'0';
			Delete = $('input[name=u_delete]:checked').val();
			Delete = (Delete == '1' )?Delete:'0';
			$.ajax({
				url:"{{route('role_status')}}",
				type:'post',
				data:{_token: "{{ csrf_token() }}",rol_id:rol_id,add:add,edit:edit,Delete:Delete},
				success:function(res)
				{
					console.log(res);
					if(res.success == true)
					{
						location.reload(true);
					}
				}
			});
		}
	</script>
@endsection

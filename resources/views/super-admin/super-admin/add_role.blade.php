@extends('super-admin.super-admin.header')

@section('dashboard_content')
   <div class="content-page">
   	<div class="content">
			<div class="container-fluid">
				<div class="page-title-box">
					<h2>Add Role</h2>
					<form action="{{route('add_new_role') }}" method="post">
						@csrf
						<div class="form-group">
							<label for="role_name">Role Name:</label>
							<input type="text" class="form-control" id="role_name" placeholder="Enter Role" name="role_name">
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

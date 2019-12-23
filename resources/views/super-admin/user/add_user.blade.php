@extends('super-admin.super-admin.header')

@section('dashboard_content')
   <div class="content-page">
   	<div class="content">
			<div class="container-fluid">
				<div class="page-title-box">
					<h2>Add New User</h2>
					   <form id="data" method="post" enctype="multipart/form-data" action="add_new_user">
      					@csrf
						<div class="form-group">
							<label for="name">Name:</label>
							<input type="text" class="form-control" id="name" placeholder="Enter Role" name="name">
						</div>
						@error('name')
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $message }}</strong>
	                    </span>
                		@enderror
						<div class="form-group">
							<label for="email">Email:</label>
							<input type="email" class="form-control" id="email" placeholder="Enter Email Address" name="email">
						</div>
						@error('email')
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $message }}</strong>
	                    </span>
                		@enderror
						<div class="form-group">
							<label for="pass">Password:</label>
							<input type="password" class="form-control" id="pass" placeholder="Enter Password" name="pass">
						</div>
						@error('pass')
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $message }}</strong>
	                    </span>
                		@enderror
						<div class="form-group">
							<label for="role_name">Role:</label>
							 <select class="role_name" name="role_name" id="role_name">
				                @foreach($roles as $role)
				                	<option value="{{$role->role_id}}">{{$role->role_name}}</option>
				                @endforeach
				            </select>
						</div>
						@error('role_name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
						<div class="form-group">
							<label for="number">Phone Number:</label>
							<input type="text" class="form-control" id="number" placeholder="Enter Phone Number" name="number">
						</div>
						@error('u_number')
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $message }}</strong>
	                    </span>
                		@enderror
						<div class="form-group">
							<label for="address">Address:</label>
							<input type="text" class="form-control" id="address" placeholder="Enter Address" name="address">
						</div>
						@error('address')
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $message }}</strong>
	                    </span>
                		@enderror
						<div class="form-group">
							<label for="dob">DOB:</label>
							<input type="date" class="form-control" id="datepicker" placeholder="Enter Date of birth" name="dob">
						</div>
						@error('dob')
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $message }}</strong>
	                    </span>
                		@enderror
						<div class="form-group">
							<label for="skills">Skills:</label>
							<input type="text" class="form-control" id="skills" placeholder="Enter Skill" name="skills">
						</div>
						@error('skills')
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $message }}</strong>
	                    </span>
                		@enderror
						<div class="form-group">
							<label for="experience">Experience:</label>
							<input type="text" class="form-control" id="experience" placeholder="Enter Experience" name="experience">
						</div>
						@error('experience')
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $message }}</strong>
	                    </span>
                		@enderror
						<div class="form-group">
							<label for="designation">Designation:</label>
							<input type="text" class="form-control" id="designation" placeholder="Enter Designation" name="designation">
						</div>
						@error('designation')
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $message }}</strong>
	                    </span>
                		@enderror
						<div class="form-group">
							<label for="name">Image:</label>
							<input type="file" class="form-control" id="image" placeholder="Enter Image" name="image">
						</div>
						@error('image')
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $message }}</strong>
	                    </span>
                		@enderror
						<button type="submit" id="saveEmployee" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
 
@endsection

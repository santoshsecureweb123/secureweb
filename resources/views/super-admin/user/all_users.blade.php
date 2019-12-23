@extends('super-admin.super-admin.header')

@section('dashboard_content')
   <div class="content-page">
   	<div class="content">
			<div class="container-fluid">
				<div class="page-title-box"><div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table mb-0">
									<thead>
										<tr>
											<th>Sr.No</th>
											<th>Name</th>
											<th>Email</th>
											<th>Phone Number</th>
											<th>Address</th>
											<th>Date of Birth</th>
											<th>Skills</th>
											<th>Experience</th>
											<th>Designation</th>
											<th>Image</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i=1; 

										?>
										@foreach($users as $user)

										<tr>
											<th scope="row">{{$i}}</th>
											<td>{{$user->name}}</td>
											<td>{{$user->email}}</td>
											<td>{{$user->phone_no}}</td>
											<td>{{$user->address}}</td>
											<td>{{$user->date_of_birth}}</td>
											<td>{{$user->skills}}</td>
											<td>{{$user->experience}}</td>
											<td>{{$user->designation}}</td>
											<td><img height="100px" width="100px" src= "http://127.0.0.1:8000/images/{{$user->image}}"/></td>
											
											<td style="width: 50px";>
												<button type="button" class="btn btn-info waves-effect waves-light" onClick="editUser({{$user->id}}) " data-toggle="modal" data-target="#user">Edit</button>
												<button type="button" class="btn btn-danger waves-effect waves-light" onClick="deleteRecord({{$user->id}})">Delete</button>
											</td>
										</tr>
										<?php $i++; ?>
										@endforeach

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Edit User Form -->

<div class="container">
  <div class="modal" id="user">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
        	<h3>Edit User details.... </h3>
        	<form id="f_data" method="post" enctype="multipart/form-data" action="add_new_user">
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
				@error('number')
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
					<label for="datepicker">DOB:</label>
					<input type="date" class="form-control" id="datepicker" placeholder="Enter Date of birth" name="dob">
				</div>
				@error('datepicker')
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
					<label for="image">Image:</label>
					<input type="file" class="form-control" id="e_image" placeholder="Enter Image" name="e_image">
					<input type="hidden" class="form-control" id="old_image" name="old_image">
					<input type="hidden" class="form-control" id="prev_user_id" name="prev_user_id">
					<input type="hidden" class="form-control" id="pass" placeholder="Enter Password" name="pass" value="123456">
					<img class="prev_image" id="prev_image" height="100px" width="100px" src="">
				</div>
				
				<button type="submit" id="saveEmployee" class="btn btn-primary">Submit</button>
			</form>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- End Edit User Form -->


<script type="text/javascript">
	function deleteRecord(id){
		// console.log(id);
		$.ajax({
			url: "{{ route('deleteUser') }}", 
			type: "POST",
			headers: { 'X-CSRF-Token': '{{ csrf_token() }}' },
			data: {    
				id  : id,
			},
			cache: false,
      	success: function(res){ 
          	location.reload();
      	}
     	});
		} 
	function editUser(id)
	{
		$.ajax({
          	url: "{{ route('get_editUser_id') }}",         
            type: "get",
            headers: { 'X-CSRF-Token': '{{ csrf_token() }}' },
            data: {    
               id : id,
            },
            cache: false,
            success: function(res){
            	// console.log(res)
                var url = window.location.origin;
                $('#prev_user_id').val(res.user[0]['id']);
				$('#name').val(res.user[0]['name']);
				$('#email').val(res.user[0]['email']);
				$('#role_name').val(res.user[0]['role_id']);
				$('#number').val(res.user[0]['phone_no']);
				$('#address').val(res.user[0]['address']);
				$('#datepicker').val(res.user[0]['date_of_birth']);
				$('#skills').val(res.user[0]['skills']);
				$('#experience').val(res.user[0]['experience']);
				$('#designation').val(res.user[0]['designation']);
				$('#old_image').val(res.user[0]['image']);
				$("#prev_image").attr("src", url+"/images/"+res.user[0]['image']);
            }
        });
		
	}
</script>
@endsection

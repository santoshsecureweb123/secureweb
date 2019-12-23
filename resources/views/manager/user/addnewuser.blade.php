@extends('manager.manager.header')

@section('dashboard_content')
   <div class="content-page">
   	<div class="content">
			<div class="container-fluid">
				<div class="page-title-box">
					<h2>Add New User</h2>
					@if(Session::has('success'))
					    {{ Session::get('success') }}
					@endif
					   <form id="data" method="post" enctype="multipart/form-data" action="{{route('addnew')}}">
      					@csrf
						<div class="form-group">
							<label for="u_name">Name:</label>
							<input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{ old('name') }}">

						</div>
						@error('name')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
						<div class="form-group">
							<label for="email">Email:</label>
							<input type="email" class="form-control" id="email" placeholder="Enter Email Address" name="email" value="{{ old('email') }}">
						</div>
						@error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
						<div class="form-group">
							<label for="pass">Password:</label>
							<input type="password" class="form-control" id="pass" placeholder="Enter Password" name="password">
						</div>
						@error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
						<div class="form-group">
							<label for="dob">DOB:</label>
							<input type="date" class="form-control" id="datepicker" placeholder="Enter Date of birth" name="dob" value="{{ old('dob') }}">
						</div>
						@error('dob')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
						<div class="form-group">
							<label for="address">Address:</label>
							<input type="text" class="form-control" id="address" placeholder="Enter Address" name="address" value="{{ old('address') }}">
						</div>
						@error('address')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
				
						<div class="form-group">
							<label for="phone_number">Phone Number:</label>
							<input type="text" class="form-control" id="phone_number" placeholder="Enter Phone Number" name="phone_number" value="{{ old('phone_number') }}">
						</div>
						@error('phone_number')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror	

            <div class="form-group">
              <label for="u_skills">Role:</label>
              <select class="form-control " name="role" id="role" value="{{ old('role') }}">
                <option value="">Select a role</option>
                @foreach($getrole as $role)
                @if($role->role_name != 'Admin')
                  <option value="{{$role->role_id}}">{{$role->role_name}}</option>
                @endif
                @endforeach
              </select>
            </div>
            @error('role')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror

						
						<div class="form-group">
							<label for="u_skills">Skills:</label>
							<select class="form-control skills" name="skills[]" id="skills" multiple="multiple" value="{{ old('skills[]') }}">
								@foreach($getskill as $skill)
								<option value="{{$skill->skills_id}}">{{$skill->skills_name}}</option>
								@endforeach
							</select>
						</div>
						@error('skills')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
						<div class="form-group">
							<label for="experience">Experience:</label>
							<input type="text" class="form-control" id="experience" placeholder="Enter Experience" name="experience" value="{{ old('experience') }}">
						</div>
						@error('experience')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
						<div class="form-group">
							<label for="designation">Designation:</label>
							<input type="text" class="form-control" id="designation" placeholder="Enter Designation" name="designation" value="{{ old('designation') }}">
						</div>
						@error('designation')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror

						<div class="form-group">
							<label for="u_name">Image:</label>
							<input type="file" class="form-control" id="image" placeholder="Enter Image" value="{{ old('image') }}">
              <input type="text" name="image" class="form-control" id="image_after_crop">
						</div>
						@error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

						<button type="submit" id="saveEmployee" class="btn btn-primary">Submit</button>
					</form>
					<div class="crop_image" id="crop_image">
            <div class="row">
              <div class="col-md-5">
    						<div id="upload"></div>
    					  </div>
                <div class="col-md-2">
                  <div class="btn btn-info waves-effect waves-light crop_IMG">Crop Image</div>
                </div>
                
             
              <div class="col-md-5">
                <div id="get_img" style="width:300px;padding:30px;height:300px;margin-top:30px"> Preview Image</div>
              </div>
            </div>
           </div>
				</div>
			</div>
		</div>
	</div>

<!-- <div id="image_model" class="model" role="dialog">
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">fghm
        	<div id="upload" style="width: 350px; margin-top: 30px;"></div> 
        </div>
      </div>
	</div>
  </div>
</div> -->

 <script>

$('#image_after_crop').hide();

var resize = $('#upload').croppie({
    enableExif: true,
    enableOrientation: true, 
    viewport: { 
        width: 200,
        height: 200,
        type: 'circle' //square
    },
    boundary: {
        width: 300,
        height: 300
    }
});
$('#crop_image').hide();
$('#image').on('change', function () { 
  var reader = new FileReader();
    reader.onload = function (e) {
      resize.croppie('bind',{
        url: e.target.result
      }).then(function(){
        // console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    $('#crop_image').show();
    $('#image').hide();
});

$('.crop_IMG').on('click', function (ev) {
  resize.croppie('result', {
    type: 'canvas',
    size: 'viewport'
  }).then(function (img) {
  	var image = img.replace('data:image/png;base64,','');
    $.ajax({
      url: "{{route('crop_image')}}",
      type: "post",
      data: {_token: "{{ csrf_token() }}","image":image},
      success: function (res) {
        console.log(res);
         html = '<img src="' + img + '" />';
         $("#get_img").html(html);
         $("#image_after_crop").val(res.image_name);
         $('#image_after_crop').show();
      }
    });
  });
});


	/*$(document).ready(function() {
		
		$( "#datepicker" ).datepicker(); 
		jQuery.browser = {};
		jQuery.browser.msie = false;
	}); */

 </script>
@endsection
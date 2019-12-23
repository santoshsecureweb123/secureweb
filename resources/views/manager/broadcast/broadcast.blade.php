@extends('manager.manager.header')
@section('dashboard_content')
<div class="content-page">
  <div class="content">
    <div class="container-fluid">
    	@if(Session::has('success'))
    		{{Session::get('success')}}
    	@endif
    	<form action="{{route('addbroadcast')}}" method="post">
    		@csrf
    		<input type="hidden" name="user_id" value="{{$user_id}}">
    		<div class="form-group">
				<label for="u_name">Title:</label>
    			<input type="text" class="form-control" placeholder="Enter Title" name="title_name" value="{{ old('title_name') }}">
    		</div>
    		@error('title_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    		<div class="form-group">
				<label for="u_name">Description:</label>
    			<textarea name="description"></textarea>
    		</div>
			@error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    		<input class="btn btn-primary" type="submit" name="">
    	</form>

    </div>
  </div>
</div>
<script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
	CKEDITOR.replace('description');
  
</script>

@endsection
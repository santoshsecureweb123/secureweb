@extends('super-admin.super-admin.header')
@section('dashboard_content')

<!-- run this command, composer require intervention/image -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/imgareaselect/0.9.10/css/imgareaselect-default.css" />
  <div class="content-page">
    <div class="content">
      <div class="container-fluid">
        <div class="page-title-box">
         <div class="container mt-5">
         <form action="{{ route('imagete') }}" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="exampleInputImage">Image:</label>
              <input type="file" name="profile_image" id="exampleInputImage" class="image" required>
              <input type="hidden" name="x1" value="" />
              <input type="hidden" name="y1" value="" />
              <input type="hidden" name="w" value="" />
              <input type="hidden" name="h" value="" />
            </div>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
          <div class="row mt-5">
        <p><img id="previewimage" style="display:none;"/></p>
        @if(session('path'))
            <img src="{{ session('path') }}" />
        @endif
    </div>
        </div>
      </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/imgareaselect/0.9.10/js/jquery.imgareaselect.min.js"></script>
    <!-- <script src="{{ asset('js/jquery.imgareaselect.min.js') }}"></script> -->
    <script>
        jQuery(function($) {
  
            var p = $("#previewimage");
            $("body").on("change", ".image", function(){
 
                var imageReader = new FileReader();
                imageReader.readAsDataURL(document.querySelector(".image").files[0]);
 
                imageReader.onload = function (oFREvent) {
                    p.attr('src', oFREvent.target.result).fadeIn();
                };
            });
 
            $('#previewimage').imgAreaSelect({
                onSelectEnd: function (img, selection) {
                    $('input[name="x1"]').val(selection.x1);
                    $('input[name="y1"]').val(selection.y1);
                    $('input[name="w"]').val(selection.width);
                    $('input[name="h"]').val(selection.height);            
                }
            });
        });
    </script>
@endsection